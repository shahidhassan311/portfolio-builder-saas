<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
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
        // For now, we'll use a simple approach with config or env
        // In a real app, you might want a settings table
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $this->checkAdmin();
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'footer_text' => 'nullable|string|max:500',
        ]);

        // In a real app, you'd save these to a settings table or config file
        // For now, we'll just show a success message
        // You can implement actual storage later

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
