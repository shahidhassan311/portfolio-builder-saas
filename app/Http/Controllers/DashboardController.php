<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\UserProfile;
use App\Models\UserSkill;
use App\Models\UserProject;
use App\Models\UserGoal;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $user->load([
            'profile',
            'skills',
            'projects',
            'goals',
            'educations',
            'experiences',
            'activeTheme'
        ]);


        $themes = Theme::where('is_active', true)->get();

        return view('dashboard.index', compact('user', 'themes'));
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

        auth()->user()->educations()->create($data);

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
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Education updated successfully!');
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

        auth()->user()->experiences()->create($data);

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
                'reload' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Experience updated successfully!');
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

        return redirect()->route('dashboard')->with('success', 'Theme updated successfully!');
    }
}
