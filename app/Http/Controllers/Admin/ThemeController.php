<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    protected function checkAdmin()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $themes = Theme::all();
        return view('admin.themes.index', compact('themes'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('admin.themes.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'name'               => 'required|string|max:255',
            'slug'               => 'required|string|max:255|unique:themes,slug',
            'preview_image'      => 'nullable|string|max:255',   // manual path / URL
            'preview_image_file' => 'nullable|image|max:2048',   // uploaded file
            'is_active'          => 'nullable|boolean',
        ]);

        // start with whatever text the user typed
        $previewPath = $request->preview_image;

        // if a file is uploaded, store it and override the path
        if ($request->hasFile('preview_image_file')) {
            // stores in storage/app/public/themes => "themes/xxxx.png"
            $previewPath = $request->file('preview_image_file')->store('themes', 'public');
        }

        Theme::create([
            'name'          => $request->name,
            'slug'          => $request->slug,
            'preview_image' => $previewPath,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.themes.index')
            ->with('success', 'Theme created successfully!');
    }

    public function show(string $id)
    {
        $this->checkAdmin();
        $theme = Theme::findOrFail($id);
        return view('admin.themes.show', compact('theme'));
    }

    public function edit(string $id)
    {
        $this->checkAdmin();
        $theme = Theme::findOrFail($id);
        return view('admin.themes.edit', compact('theme'));
    }

    public function update(Request $request, string $id)
    {
        $this->checkAdmin();

        $theme = Theme::findOrFail($id);

        $request->validate([
            'name'               => 'required|string|max:255',
            'slug'               => 'required|string|max:255|unique:themes,slug,' . $id,
            'preview_image'      => 'nullable|string|max:255',    // manual URL or stored path
            'preview_image_file' => 'nullable|image|max:2048',     // uploaded file
            'is_active'          => 'nullable|boolean',
        ]);

        // Default preview path is the text input
        $previewPath = $request->preview_image;

        // If a new file was uploaded, override preview path
        if ($request->hasFile('preview_image_file')) {

            // Delete OLD IMAGE only if it exists and is a local stored file
            if ($theme->preview_image && Storage::disk('public')->exists($theme->preview_image)) {
                Storage::disk('public')->delete($theme->preview_image);
            }

            // Save new file
            $previewPath = $request->file('preview_image_file')->store('themes', 'public');
        }

        $theme->update([
            'name'          => $request->name,
            'slug'          => $request->slug,
            'preview_image' => $previewPath,
            'is_active'     => (bool) $request->is_active,
        ]);

        return redirect()
            ->route('admin.themes.index')
            ->with('success', 'Theme updated successfully!');
    }



    public function destroy(string $id)
    {
        $this->checkAdmin();
        $theme = Theme::findOrFail($id);

        // Check if theme is in use
        if ($theme->users()->count() > 0) {
            return redirect()->route('admin.themes.index')->with('error', 'Cannot delete theme that is in use!');
        }

        $theme->delete();

        return redirect()->route('admin.themes.index')->with('success', 'Theme deleted successfully!');
    }
}
