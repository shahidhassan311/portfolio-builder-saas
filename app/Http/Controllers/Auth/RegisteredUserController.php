<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profession;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Models\UserBlock;
use App\Models\ProfessionBlock;
use Illuminate\View\View;
use App\Models\EmailOtp;
use App\Events\UserRegistered;
use App\Support\RegistrationDraft;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;


class RegisteredUserController extends Controller
{
    /**
     * STEP 1 (Theme Selection)
     */
    public function selectTheme(Request $request): View
    {
        $themes = Theme::all();


        return view('auth.register', [
            'themes' => $themes,
        ]);
    }


    public function storeTheme(Request $request): RedirectResponse
    {
        $request->validate([
            'theme_id' => ['nullable', 'exists:themes,id'],
        ]);

        session([
            'theme_id' => $request->theme_id
        ]);

        return redirect()->route('profession.select');
    }

    /**
     * STEP 2 (Profession Selection)
     */
    public function selectProfession(): View
    {
        $professions = Profession::orderBy('name')->get();

        return view('auth.select-profession', [
            'professions' => $professions,
        ]);
    }

    public function storeProfession(Request $request): RedirectResponse
    {
        $request->validate([
            'profession_id' => ['required', 'exists:professions,id'],
        ]);

        session([
            'profession_id' => $request->profession_id
        ]);

        return redirect()->route('register');
    }

    /**
     * STEP 3 (Register View)
     */
    public function create(Request $request): View
    {
        $themes = Theme::where('is_active', true)->get();
        $professions = Profession::orderBy('name')->get();
        $draft = RegistrationDraft::get($request);

        return view('auth.register', [
            'themes' => $themes,
            'professions' => $professions,
            'draftProfessionId' => RegistrationDraft::resolvedProfessionId($request),
            'draftThemeId' => RegistrationDraft::resolvedThemeId($request),
            'draftName' => old('name', $draft['name'] ?? ''),
            'draftUsername' => old('username', $draft['username'] ?? ''),
            'draftEmail' => old('email', $draft['email'] ?? ''),
        ]);
    }

    public function saveDraft(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'profession_id' => ['sometimes', 'nullable', 'integer', 'exists:professions,id'],
            'theme_id' => ['sometimes', 'nullable', 'integer', 'exists:themes,id'],
            'name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'username' => ['sometimes', 'nullable', 'string', 'max:255', 'alpha_dash'],
            'email' => ['sometimes', 'nullable', 'string', 'email', 'max:255'],
        ]);

        if (isset($validated['theme_id']) && ! RegistrationDraft::isActiveTheme((int) $validated['theme_id'])) {
            return response()->json(['message' => 'The selected template is not available.'], 422);
        }

        RegistrationDraft::merge($request, $validated);

        return response()->json(['saved' => true]);
    }
    /**
     * FINAL REGISTER
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],

            'theme_id' => [
                'required',
                Rule::exists('themes', 'id')->where('is_active', true),
            ],

            'profession_id' => [
                'required',
                'exists:professions,id',
            ],
        ]);

        // Find user by email
        $existingUser = User::where('email', $request->email)->first();

        // Already verified
        RegistrationDraft::merge($request, $request->only([
            'profession_id',
            'theme_id',
            'name',
            'username',
            'email',
        ]));

        if ($existingUser && $existingUser->email_verified_at) {
            return back()
                ->withErrors([
                    'email' => 'This email is already registered. Please login.',
                ])
                ->withInput();
        }

        // Username already used by a verified account
        $usernameExists = User::where('username', $request->username)
            ->whereNotNull('email_verified_at')
            ->when($existingUser, function ($query) use ($existingUser) {
                $query->where('id', '!=', $existingUser->id);
            })
            ->exists();

        if ($usernameExists) {
            return back()
                   ->withErrors([
                    'username' => 'This username is already taken.',
                ])
                ->withInput();
        }

        // Create or update user
        if ($existingUser) {

            $existingUser->update([
                'name'            => $request->name,
                'username'        => $request->username,
                'password'        => Hash::make($request->password),
                'active_theme_id' => $request->theme_id,
            ]);

            $user = $existingUser;

        } else {

            $user = User::create([
                'name'            => $request->name,
                'username'        => $request->username,
                'email'           => $request->email,
                'password'        => Hash::make($request->password),
                'active_theme_id' => $request->theme_id,
            ]);
        }

        // Profession
        $user->professions()->sync([$request->profession_id]);

        // Profile
        if (!$user->profile) {
            $user->profile()->create([]);
        }

        // Remove old blocks
        UserBlock::where('user_id', $user->id)->delete();

        // Default blocks
        // $defaultBlocks = ProfessionBlock::where('profession_id', $request->profession_id)
        //     ->where('is_default', 1)
        //     ->orderBy('display_order')
        //     ->get();

        // foreach ($defaultBlocks as $block) {
        //     UserBlock::create([
        //         'user_id'       => $user->id,
        //         'block_id'      => $block->block_id,
        //         'is_enabled'    => true,
        //         'display_order' => $block->display_order,
        //     ]);
        // }

        // Delete previous OTPs
        EmailOtp::where('user_id', $user->id)->delete();

        // Send new OTP
        event(new UserRegistered($user));

        $message = $existingUser
            ? 'You already started registration. A new OTP has been sent to your email.'
            : 'Registration successful. Please verify your email using the OTP we sent.';

        RegistrationDraft::forget($request);

        return redirect()
            ->route('otp.verify.form', $user)
            ->with('success', $message);
    }
}
