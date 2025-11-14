<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\UserProfile;
use App\Models\UserSkill;
use App\Models\UserProject;
use App\Models\UserGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->load(['profile', 'skills', 'projects', 'goals', 'activeTheme']);
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

        return redirect()->route('dashboard')->with('success', 'About section updated successfully!');
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);

        auth()->user()->skills()->create($request->only(['name', 'level']));

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

        return redirect()->route('dashboard')->with('success', 'Skill updated successfully!');
    }

    public function deleteSkill($id)
    {
        $skill = auth()->user()->skills()->findOrFail($id);
        $skill->delete();

        return redirect()->route('dashboard')->with('success', 'Skill deleted successfully!');
    }

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

        return redirect()->route('dashboard')->with('success', 'Project updated successfully!');
    }

    public function deleteProject($id)
    {
        $project = auth()->user()->projects()->findOrFail($id);
        if ($project->project_image) {
            Storage::disk('public')->delete($project->project_image);
        }
        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project deleted successfully!');
    }

    public function storeGoal(Request $request)
    {
        $request->validate([
            'goal_text' => 'required|string',
        ]);

        auth()->user()->goals()->create($request->only(['goal_text']));

        return redirect()->route('dashboard')->with('success', 'Goal added successfully!');
    }

    public function updateGoal(Request $request, $id)
    {
        $request->validate([
            'goal_text' => 'required|string',
        ]);

        $goal = auth()->user()->goals()->findOrFail($id);
        $goal->update($request->only(['goal_text']));

        return redirect()->route('dashboard')->with('success', 'Goal updated successfully!');
    }

    public function deleteGoal($id)
    {
        $goal = auth()->user()->goals()->findOrFail($id);
        $goal->delete();

        return redirect()->route('dashboard')->with('success', 'Goal deleted successfully!');
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_github' => 'nullable|url',
            'social_twitter' => 'nullable|url',
        ]);

        auth()->user()->profile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $request->only([
                'contact_email', 'contact_phone', 'location',
                'social_facebook', 'social_instagram', 'social_linkedin',
                'social_github', 'social_twitter'
            ])
        );

        return redirect()->route('dashboard')->with('success', 'Contact details updated successfully!');
    }

    public function updateTheme(Request $request)
    {
        $request->validate([
            'active_theme_id' => 'required|exists:themes,id',
        ]);

        auth()->user()->update(['active_theme_id' => $request->active_theme_id]);

        return redirect()->route('dashboard')->with('success', 'Theme updated successfully!');
    }
}
