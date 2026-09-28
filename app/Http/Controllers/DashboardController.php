<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\WaitlistSignup;
use App\Services\ResumeImporter;
use App\Services\ResumeParser;
use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\Achievement;
use App\Models\UserBlock;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function overview()
    {
        $user = $this->loadDashboardUser();
        $themes = $this->activeThemes();
        $onProWaitlist = WaitlistSignup::where('email', $user->email)->where('plan', 'pro')->exists();
        $portfolioUrl = route('portfolio.show', ['id' => $user->id, 'username' => $user->username]);
        $pdfUrl = route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]);
        $completion = $this->portfolioCompletion($user);

        return view('dashboard.overview', compact(
            'user',
            'themes',
            'onProWaitlist',
            'portfolioUrl',
            'pdfUrl',
            'completion'
        ));
    }
    public function content()
{
    $user = $this->loadDashboardUser();

    $themes = $this->activeThemes();

    // Default blocks
    $defaultBlocks = Block::whereIn('slug', [
        'profile',
        'about',
        'education',
        'skills',
        'experience',
        'projects',
    ])
    ->orderByRaw("
        FIELD(slug,
        'profile',
        'about',
        'education',
        'skills',
        'experience',
        'projects')
    ")
    ->get();


    // User added blocks
    $userBlocks = $user->userBlocks;


    $availableBlocks = Block::whereNotIn('id', function ($query) {
        $query->select('block_id')
            ->from('user_blocks')
            ->where('user_id', auth()->id());
    })
    ->orderBy('name')
    ->get();


    return view('dashboard.content', compact(
        'user',
        'themes',
        'defaultBlocks',
        'userBlocks',
        'availableBlocks'
    ));
}
public function templates()
{
    $user = $this->loadDashboardUser();

    $recommendedThemes = Theme::whereHas('professions', function ($q) use ($user) {
        $q->whereIn('profession_id', $user->professions->pluck('id'));
    })->get();

    $otherThemes = Theme::whereDoesntHave('professions', function ($q) use ($user) {
        $q->whereIn('profession_id', $user->professions->pluck('id'));
    })->get();

    return view('dashboard.templates', [
        'user' => $user,
        'recommendedThemes' => $recommendedThemes,
        'otherThemes' => $otherThemes,
    ]);
}

    public function publish()
    {
        $user = $this->loadDashboardUser();
        $portfolioUrl = route('portfolio.show', ['id' => $user->id, 'username' => $user->username]);

        return view('dashboard.publish', compact('user', 'portfolioUrl'));
    }

    public function export()
    {
        $user = $this->loadDashboardUser();
        $pdfUrl = route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]);
        $portfolioUrl = route('portfolio.show', ['id' => $user->id, 'username' => $user->username]);

        return view('dashboard.export', compact('user', 'pdfUrl', 'portfolioUrl'));
    }

    public function upgrade()
    {
        $user = $this->loadDashboardUser();
        $onProWaitlist = WaitlistSignup::where('email', $user->email)->where('plan', 'pro')->exists();
        $plans = config('plans');

        return view('dashboard.upgrade', compact('user', 'onProWaitlist', 'plans'));
    }

    public function joinWaitlist(Request $request)
    {
        $user = auth()->user();

        WaitlistSignup::firstOrCreate(
            ['email' => $user->email, 'plan' => 'pro'],
            ['user_id' => $user->id]
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'You\'re on the Pro waitlist! We\'ll email you when Pro launches.',
            ]);
        }

        return redirect()
            ->route('dashboard.upgrade')
            ->with('success', 'You\'re on the Pro waitlist! We\'ll email you when Pro launches.');
    }

    protected function loadDashboardUser()
    {
        $user = auth()->user();

        $user->load([
            'profile',
            'skills',
            'projects',
            'goals',
            'educations',
            'experiences',
            'activeTheme',

            'userBlocks' => function ($query) {
                $query->where('is_enabled', 1)
                    ->orderBy('display_order')
                    ->with('block');
            },
        ]);

        return $user;
    }
    protected function activeThemes()
    {
        $user = auth()->user();

        // return Theme::whereHas('professions', function ($q) use ($user) {
        //     $q->whereIn('profession_id', $user->professions->pluck('id'));
        // })->get();
        // return Theme::all();
    }
    protected function portfolioCompletion($user): array
    {
        $checks = [
            'profile' => filled($user->name) && filled($user->username),
            'about' => filled($user->profile?->about_short),
            'skills' => $user->skills->isNotEmpty(),
            'projects' => $user->projects->isNotEmpty(),
            'experience' => $user->experiences->isNotEmpty(),
            'education' => $user->educations->isNotEmpty(),
            'theme' => filled($user->active_theme_id),
            'contact' => filled($user->profile?->contact_email) || filled($user->email),
        ];

        $done = count(array_filter($checks));

        return [
            'checks' => $checks,
            'done' => $done,
            'total' => count($checks),
            'percent' => (int) round(($done / max(count($checks), 1)) * 100),
        ];
    }


    public function importResume(Request $request, ResumeParser $parser, ResumeImporter $importer)
    {
        $request->validate([
            'resume' => ['required', 'file', 'max:5120', 'extensions:pdf,txt'],
        ]);

        try {
            $text = $parser->extractText($request->file('resume'));

            if (strlen(trim($text)) < 30) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Could not read enough text from this file. Try a text-based PDF or export as TXT.',
                ], 422);
            }

            $parsed = $parser->parse($text);
            // dd($text);
            $stats = $importer->apply(auth()->user(), $parsed);

            return response()->json([
                'status' => 'success',
                'message' => $importer->buildMessage($stats),
                'stats' => $stats,
                'preview' => [
                    'name' => $parsed['name'] ?? null,
                    'email' => $parsed['email'] ?? null,
                    'skills_count' => count($parsed['skills'] ?? []),
                    'experiences_count' => count($parsed['experiences'] ?? []),
                    'educations_count' => count($parsed['educations'] ?? []),
                    'certifications_count' => count($parsed['certifications'] ?? []),
                ],
                'reload' => true,
            ]);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        // } catch (\Throwable $e) {
        //     report($e);

        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Failed to parse resume. Please ensure the file is a readable PDF or TXT.',

        //     ], 500);
        }catch (\Throwable $e) {
            \Log::error($e);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(), // sirf debugging ke liye
            ], 500);
        }
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . auth()->id(),
            'tagline' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        $profileData = [
            'tagline' => $request->tagline,
        ];

        if ($request->hasFile('profile_image')) {
            if ($user->profile && $user->profile->profile_image) {
                Storage::disk('public')->delete($user->profile->profile_image);
            }
            $profileData['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_title' => 'nullable|string|max:255',
            'about_short' => 'nullable|string|max:500',
            'about_long' => 'nullable|string',
        ]);

        auth()->user()->profile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $request->only(['about_title', 'about_short', 'about_long'])
        );
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'About section updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'About section updated successfully!');
    }

    /* ================= SKILLS ================= */

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);

        auth()->user()->skills()->create($request->only(['name', 'level']));

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Skill added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Skill added successfully!');
    }

    public function updateSkill(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);

        $skill = auth()->user()->skills()->findOrFail($id);
        $skill->update($request->only(['name', 'level']));

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Skill updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Skill updated successfully!');
    }

    public function deleteSkill($id)
    {
        $skill = auth()->user()->skills()->findOrFail($id);
        $skill->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Skill deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Skill deleted successfully!');
    }

    /* ================= PROJECTS ================= */

    public function storeProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'project_url' => 'nullable|url',
            'project_image' => 'nullable|image|max:2048',
        ]);

        $projectData = $request->only(['title', 'short_description', 'project_url']);

        if ($request->hasFile('project_image')) {
            $projectData['project_image'] = $request->file('project_image')->store('projects', 'public');
        }

        auth()->user()->projects()->create($projectData);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Project added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'project_url' => 'nullable|url',
            'project_image' => 'nullable|image|max:2048',
        ]);

        $project = auth()->user()->projects()->findOrFail($id);
        $projectData = $request->only(['title', 'short_description', 'project_url']);

        if ($request->hasFile('project_image')) {
            if ($project->project_image) {
                Storage::disk('public')->delete($project->project_image);
            }
            $projectData['project_image'] = $request->file('project_image')->store('projects', 'public');
        }

        $project->update($projectData);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Project updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Project updated successfully!');
    }

    public function deleteProject($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        if ($project->project_image) {
            Storage::disk('public')->delete($project->project_image);
        }
        $project->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Project deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully!');
    }

    /* ================= GOALS ================= */

    public function storeGoal(Request $request)
    {
        $request->validate([
            'goal_text' => 'required|string',
        ]);

        auth()->user()->goals()->create($request->only(['goal_text']));

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Goal added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Goal added successfully!');
    }

    public function updateGoal(Request $request, $id)
    {
        $request->validate([
            'goal_text' => 'required|string',
        ]);

        $goal = auth()->user()->goals()->findOrFail($id);
        $goal->update($request->only(['goal_text']));

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Goal updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Goal updated successfully!');
    }

    public function deleteGoal($id)
    {
        $goal = auth()->user()->goals()->findOrFail($id);
        $goal->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Goal deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }

    /* ================= EDUCATION ================= */

    public function storeEducation(Request $request)
    {
        $request->validate([
            'institution'     => 'required|string|max:255',
            'degree'          => 'nullable|string|max:255',
            'field_of_study'  => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'nullable|boolean',
            'description'     => 'nullable|string',
            'sort_order'      => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'institution',
            'degree',
            'field_of_study',
            'location',
            'start_date',
            'end_date',
            'description',
            'sort_order',
        ]);

        // checkbox handling
        $data['is_current'] = $request->boolean('is_current');
        $user = auth()->user();
        $data['sort_order'] = $request->input('sort_order', ((int) $user->educations()->max('sort_order')) + 1);

        $user->educations()->create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Education added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Education added successfully!');
    }

    public function updateEducation(Request $request, $id)
    {
        $request->validate([
            'institution'     => 'required|string|max:255',
            'degree'          => 'nullable|string|max:255',
            'field_of_study'  => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'nullable|boolean',
            'description'     => 'nullable|string',
            'sort_order'      => 'nullable|integer|min:0',
        ]);

        $education = auth()->user()->educations()->findOrFail($id);

        $data = $request->only([
            'institution',
            'degree',
            'field_of_study',
            'location',
            'start_date',
            'end_date',
            'description',
            'sort_order',
        ]);

        $data['is_current'] = $request->boolean('is_current');

        $education->update($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Education updated successfully!',
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Education updated successfully!');
    }

    public function reorderEducations(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        $user = auth()->user();
        foreach ($request->order as $index => $id) {
            $user->educations()->where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 'success', 'message' => 'Order saved.']);
    }

    public function deleteEducation($id)
    {
        $education = auth()->user()->educations()->findOrFail($id);
        $education->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Education deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Education deleted successfully!');
    }

    /* ================= EXPERIENCE ================= */

    public function storeExperience(Request $request)
    {
        $request->validate([
            'company'         => 'required|string|max:255',
            'role_title'      => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'nullable|boolean',
            'description'     => 'nullable|string',
            'sort_order'      => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'company',
            'role_title',
            'employment_type',
            'location',
            'start_date',
            'end_date',
            'description',
            'sort_order',
        ]);

        $data['is_current'] = $request->boolean('is_current');
        $user = auth()->user();
        $data['sort_order'] = $request->input('sort_order', ((int) $user->experiences()->max('sort_order')) + 1);

        $user->experiences()->create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Experience added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Experience added successfully!');
    }

    public function updateExperience(Request $request, $id)
    {
        $request->validate([
            'company'         => 'required|string|max:255',
            'role_title'      => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date|after_or_equal:start_date',
            'is_current'      => 'nullable|boolean',
            'description'     => 'nullable|string',
            'sort_order'      => 'nullable|integer|min:0',
        ]);

        $experience = auth()->user()->experiences()->findOrFail($id);

        $data = $request->only([
            'company',
            'role_title',
            'employment_type',
            'location',
            'start_date',
            'end_date',
            'description',
            'sort_order',
        ]);

        $data['is_current'] = $request->boolean('is_current');

        $experience->update($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Experience updated successfully!',
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Experience updated successfully!');
    }

    public function reorderExperiences(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        $user = auth()->user();
        foreach ($request->order as $index => $id) {
            $user->experiences()->where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['status' => 'success', 'message' => 'Order saved.']);
    }

    public function deleteExperience($id)
    {
        $experience = auth()->user()->experiences()->findOrFail($id);
        $experience->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Experience deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Experience deleted successfully!');
    }

    /* ================= CONTACT / THEME ================= */

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_email'   => 'nullable|email',
            'contact_phone'   => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'social_facebook' => 'nullable|url',
            'social_instagram'=> 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_github'   => 'nullable|url',
            'social_twitter'  => 'nullable|url',
        ]);

        auth()->user()->profile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $request->only([
                'contact_email', 'contact_phone', 'location',
                'social_facebook', 'social_instagram', 'social_linkedin',
                'social_github', 'social_twitter'
            ])
        );
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Contact details updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Contact details updated successfully!');
    }

    public function updateTheme(Request $request)
    {
        $request->validate([
            'active_theme_id' => 'required|exists:themes,id',
        ]);

        auth()->user()->update(['active_theme_id' => $request->active_theme_id]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Theme updated successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard.templates')->with('success', 'Theme updated successfully!');
    }





    public function store(Request $request)
    {
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
        ]);

        // Already added?
        $exists = UserBlock::where('user_id', auth()->id())
            ->where('block_id', $request->block_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Block already added.');
        }

        $lastOrder = UserBlock::where('user_id', auth()->id())->max('display_order') ?? 0;

        UserBlock::create([
            'user_id'       => auth()->id(),
            'block_id'      => $request->block_id,
            'is_enabled'    => true,
            'display_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Block added successfully.');
    }
//    gallery

    public function storeGallery(Request $request)
    {
        $request->validate([
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title',
            'description',
            'sort_order',
        ]);

        // Upload Image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $user = auth()->user();
        $data['sort_order'] = $request->input(
            'sort_order',
            ((int) $user->galleries()->max('sort_order')) + 1
        );

        $user->galleries()->create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery added successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Gallery added successfully!');
    }

    public function updateGallery(Request $request, $id)
    {
        $request->validate([
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $gallery = auth()->user()->galleries()->findOrFail($id);

        $data = $request->only([
            'title',
            'description',
            'sort_order',
        ]);

        if ($request->hasFile('image')) {

            // Delete old image
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery updated successfully!',
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Gallery updated successfully!');
    }

    public function reorderGalleries(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer',
        ]);

        $user = auth()->user();

        foreach ($request->order as $index => $id) {
            $user->galleries()
                ->where('id', $id)
                ->update(['sort_order' => $index]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order saved.',
        ]);
    }

    public function deleteGallery($id)
    {
        $gallery = auth()->user()->galleries()->findOrFail($id);

        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery deleted successfully!',
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Gallery deleted successfully!');
    }


    //  certificate

    public function storeCertification(Request $request)
    {
        $request->validate([
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title'          => 'required|string|max:150',
            'organization'   => 'required|string|max:150',
            'issue_date'     => 'nullable|date',
            'credential_url' => 'nullable|url',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer|min:0',
        ]);

        $user = auth()->user();

        $data = $request->only([
            'title',
            'organization',
            'issue_date',
            'credential_url',
            'description',
            'sort_order',
        ]);

        // Image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certifications', 'public');
        }

        // Auto sort order if not provided
        $data['sort_order'] = $request->input(
            'sort_order',
            ((int) $user->certifications()->max('sort_order')) + 1
        );

        $user->certifications()->create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Certification added successfully!',
                'reload'  => true,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Certification added successfully!');
    }


    public function updateCertification(Request $request, $id)
{
    $request->validate([
        'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'title'          => 'required|string|max:150',
        'organization'   => 'required|string|max:150',
        'issue_date'     => 'nullable|date',
        'credential_url' => 'nullable|url',
        'description'    => 'nullable|string',
        'sort_order'     => 'nullable|integer|min:0',
    ]);

    $cert = auth()->user()->certifications()->findOrFail($id);

    $data = $request->only([
        'title',
        'organization',
        'issue_date',
        'credential_url',
        'description',
        'sort_order',
    ]);

    // Replace image if new uploaded
    if ($request->hasFile('image')) {
        if ($cert->image && Storage::disk('public')->exists($cert->image)) {
            Storage::disk('public')->delete($cert->image);
        }

        $data['image'] = $request->file('image')->store('certifications', 'public');
    }

    $cert->update($data);

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Certification updated successfully!',
        ]);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Certification updated successfully!');
}


public function reorderCertifications(Request $request)
{
    $request->validate([
        'order'   => 'required|array',
        'order.*' => 'integer',
    ]);

    $user = auth()->user();

    foreach ($request->order as $index => $id) {
        $user->certifications()
            ->where('id', $id)
            ->update(['sort_order' => $index]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order saved.',
    ]);
}


public function deleteCertification($id)
{
    $cert = auth()->user()->certifications()->findOrFail($id);

    if ($cert->image && Storage::disk('public')->exists($cert->image)) {
        Storage::disk('public')->delete($cert->image);
    }

    $cert->delete();

    if (request()->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Certification deleted successfully!',
            'reload'  => true,
        ]);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Certification deleted successfully!');
}


public function storeTestimonial(Request $request)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'name' => 'required|string|max:150',
        'role' => 'nullable|string|max:150',
        'company' => 'nullable|string|max:150',
        'message' => 'required|string',
        'rating' => 'nullable|integer|min:1|max:5',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $data = $request->only([
        'name',
        'role',
        'company',
        'message',
        'rating',
        'sort_order',
    ]);

    // Image upload
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('testimonials', 'public');
    }

    $user = auth()->user();

    $data['sort_order'] = $request->input(
        'sort_order',
        ((int) $user->testimonials()->max('sort_order')) + 1
    );

    $user->testimonials()->create($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Testimonial added successfully!',
        'reload' => true,
    ]);
}
public function updateTestimonial(Request $request, $id)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'name' => 'required|string|max:150',
        'role' => 'nullable|string|max:150',
        'company' => 'nullable|string|max:150',
        'message' => 'required|string',
        'rating' => 'nullable|integer|min:1|max:5',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $testimonial = auth()->user()->testimonials()->findOrFail($id);

    $data = $request->only([
        'name',
        'role',
        'company',
        'message',
        'rating',
        'sort_order',
    ]);

    // Image update
    if ($request->hasFile('image')) {

        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $data['image'] = $request->file('image')->store('testimonials', 'public');
    }

    $testimonial->update($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Testimonial updated successfully!',
    ]);
}

public function reorderTestimonials(Request $request)
{
    $request->validate([
        'order' => 'required|array',
        'order.*' => 'integer',
    ]);

    $user = auth()->user();

    foreach ($request->order as $index => $id) {
        $user->testimonials()
            ->where('id', $id)
            ->update(['sort_order' => $index]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order updated successfully!',
    ]);
}

public function deleteTestimonial($id)
{
    $testimonial = auth()->user()->testimonials()->findOrFail($id);

    // delete image
    if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
        Storage::disk('public')->delete($testimonial->image);
    }

    $testimonial->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Testimonial deleted successfully!',
        'reload' => true,
    ]);
}


public function storeService(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:150',
        'icon' => 'nullable|string|max:150',
        'description' => 'nullable|string',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $data = $request->only([
        'title',
        'icon',
        'description',
        'sort_order',
    ]);

    $user = auth()->user();

    $data['sort_order'] = $request->input(
        'sort_order',
        ((int) $user->services()->max('sort_order')) + 1
    );

    $user->services()->create($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Service added successfully!',
        'reload' => true,
    ]);
}
public function updateService(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:150',
        'icon' => 'nullable|string|max:150',
        'description' => 'nullable|string',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $service = auth()->user()->services()->findOrFail($id);

    $data = $request->only([
        'title',
        'icon',
        'description',
        'sort_order',
    ]);

    $service->update($data);

    return response()->json([
        'status' => 'success',
        'message' => 'Service updated successfully!',
    ]);
}

public function reorderServices(Request $request)
{
    $request->validate([
        'order' => 'required|array',
        'order.*' => 'integer',
    ]);

    $user = auth()->user();

    foreach ($request->order as $index => $id) {
        $user->services()
            ->where('id', $id)
            ->update(['sort_order' => $index]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order updated successfully!',
    ]);
}

public function deleteService($id)
{
    $service = auth()->user()->services()->findOrFail($id);

    $service->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Service deleted successfully!',
        'reload' => true,
    ]);
}


public function storeAchievement(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:150',
        'organization' => 'nullable|string|max:255',
        'achievement_date' => 'nullable|date',
        'description' => 'nullable|string',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $data = $request->only([
        'title',
        'organization',
        'achievement_date',
        'description',
        'sort_order',
    ]);

    $user = auth()->user();

    $data['sort_order'] = $request->input(
        'sort_order',
        ((int) $user->achievements()->max('sort_order')) + 1
    );

    $user->achievements()->create($data);

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Achievement added successfully!',
            'reload' => true,
        ]);
    }

    return back()->with('success', 'Achievement added successfully!');
}

public function updateAchievement(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:150',
        'organization' => 'nullable|string|max:255',
        'achievement_date' => 'nullable|date',
        'description' => 'nullable|string',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $achievement = auth()->user()
        ->achievements()
        ->findOrFail($id);

    $achievement->update($request->only([
        'title',
        'organization',
        'achievement_date',
        'description',
        'sort_order',
    ]));

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Achievement updated successfully!',
            'reload' => true,
        ]);
    }

    return back()->with('success', 'Achievement updated successfully!');
}

public function reorderAchievements(Request $request)
{
    $request->validate([
        'order' => 'required|array',
        'order.*' => 'integer',
    ]);

    $user = auth()->user();

    foreach ($request->order as $index => $id) {

        $user->achievements()
            ->where('id', $id)
            ->update([
                'sort_order' => $index
            ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order saved.',
    ]);
}

public function deleteAchievement($id)
{
    $achievement = auth()->user()
        ->achievements()
        ->findOrFail($id);

    $achievement->delete();

    if (request()->ajax()) {

        return response()->json([
            'status' => 'success',
            'message' => 'Achievement deleted successfully!',
            'reload' => true,
        ]);
    }

    return back()->with('success', 'Achievement deleted successfully!');
}


public function storeVolunteer(Request $request)
{
    $request->validate([
        'organization_name'       => 'required|string|max:150',
        'role'                    => 'required|string|max:150',
        'location'                => 'nullable|string|max:150',
        'start_date'              => 'nullable|date',
        'end_date'                => 'nullable|date|after_or_equal:start_date',
        'currently_volunteering'  => 'nullable|boolean',
        'description'             => 'nullable|string',
        'sort_order'              => 'nullable|integer|min:0',
    ]);

    $user = auth()->user();

    $data = $request->only([
        'organization_name',
        'role',
        'location',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ]);

    $data['currently_volunteering'] = $request->boolean('currently_volunteering');

    if ($data['currently_volunteering']) {
        $data['end_date'] = null;
    }

    $data['sort_order'] = $request->input(
        'sort_order',
        ((int) $user->volunteers()->max('sort_order')) + 1
    );

    $user->volunteers()->create($data);

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer experience added successfully!',
            'reload' => true,
        ]);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Volunteer experience added successfully!');
}


public function reorderVolunteers(Request $request)
{
    $request->validate([
        'order' => 'required|array',
        'order.*' => 'integer',
    ]);

    $user = auth()->user();

    foreach ($request->order as $index => $id) {
        $user->volunteers()
            ->where('id', $id)
            ->update([
                'sort_order' => $index,
            ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order saved.',
    ]);
}

public function updateVolunteer(Request $request, $id)
{
    $request->validate([
        'organization_name'       => 'required|string|max:150',
        'role'                    => 'required|string|max:150',
        'location'                => 'nullable|string|max:150',
        'start_date'              => 'nullable|date',
        'end_date'                => 'nullable|date|after_or_equal:start_date',
        'currently_volunteering'  => 'nullable|boolean',
        'description'             => 'nullable|string',
        'sort_order'              => 'nullable|integer|min:0',
    ]);

    $volunteer = auth()->user()->volunteers()->findOrFail($id);

    $data = $request->only([
        'organization_name',
        'role',
        'location',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ]);

    $data['currently_volunteering'] = $request->boolean('currently_volunteering');

    if ($data['currently_volunteering']) {
        $data['end_date'] = null;
    }

    $volunteer->update($data);

    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer experience updated successfully!',
        ]);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Volunteer experience updated successfully!');
}

public function deleteVolunteer($id)
{
    $volunteer = auth()->user()->volunteers()->findOrFail($id);

    $volunteer->delete();

    if (request()->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer experience deleted successfully!',
            'reload' => true,
        ]);
    }

    return redirect()->route('dashboard')
        ->with('success', 'Volunteer experience deleted successfully!');
}
}


