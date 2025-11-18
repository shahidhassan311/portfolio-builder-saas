<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Theme;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

        $stats = [
            'users_count' => User::count(),
            'active_portfolios' => User::whereNotNull('active_theme_id')->count(),
            'themes_count' => Theme::count(),
        ];

//        dd('sadsa');
        return view('admin.dashboard', compact('stats'));
    }
}
