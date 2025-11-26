<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PortfolioController extends Controller
{
    public function show($id, $username)
    {
        $user = User::where('id', $id)
            ->where('username', $username)
            ->with(['profile', 'skills', 'projects', 'goals', 'activeTheme'])
            ->firstOrFail();

        if (!$user->activeTheme) {
            abort(404, 'User has no active theme');
        }

        $theme = $user->activeTheme;

        // Ensure profile exists
        if (!$user->profile) {
            $user->profile()->create([]);
            $user->refresh();
        }

        return view('themes.' . $theme->slug, compact('user', 'theme'));
    }



    public function downloadPdf($id, $username)
    {
        $user = User::where('id', $id)
            ->where('username', $username)
            ->with(['profile', 'skills', 'projects', 'goals', 'educations', 'experiences'])
            ->firstOrFail();

        $pdf = Pdf::loadView('themes.freelance-cv-pdf', ['user' => $user])
            ->setPaper('a4', 'portrait');

        return $pdf->download($user->username . '_cv.pdf');
    }

}
