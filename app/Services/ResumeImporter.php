<?php

namespace App\Services;

use App\Models\User;

class ResumeImporter
{
    public function apply(User $user, array $parsed): array
    {
        $stats = [
            'profile' => false,
            'skills' => 0,
            'experiences' => 0,
            'educations' => 0,
        ];

        if (!empty($parsed['name']) || !empty($parsed['email']) || !empty($parsed['tagline'])) {
            if (!empty($parsed['name'])) {
                $user->update(['name' => $parsed['name']]);
            }

            $profileData = array_filter([
                'tagline' => $parsed['tagline'] ?? null,
                'about_short' => $parsed['about_short'] ?? null,
                'contact_email' => $parsed['email'] ?? $user->email,
                'contact_phone' => $parsed['phone'] ?? null,
                'location' => $parsed['location'] ?? null,
            ]);

            if (!empty($profileData)) {
                $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);
                $stats['profile'] = true;
            }
        }

        $existingSkills = $user->skills()->pluck('name')->map(fn ($n) => strtolower($n))->toArray();

        foreach ($parsed['skills'] ?? [] as $skill) {
            $name = trim($skill['name'] ?? '');
            if ($name === '' || in_array(strtolower($name), $existingSkills, true)) {
                continue;
            }
            $user->skills()->create([
                'name' => $name,
                'level' => $skill['level'] ?? 'Intermediate',
            ]);
            $existingSkills[] = strtolower($name);
            $stats['skills']++;
        }

        $expOrder = (int) $user->experiences()->max('sort_order');
        foreach ($parsed['experiences'] ?? [] as $exp) {
            $user->experiences()->create([
                'company' => $exp['company'],
                'role_title' => $exp['role_title'],
                'location' => $exp['location'] ?? null,
                'start_date' => $exp['start_date'] ?? null,
                'end_date' => $exp['end_date'] ?? null,
                'is_current' => $exp['is_current'] ?? false,
                'description' => $exp['description'] ?? null,
                'sort_order' => ++$expOrder,
            ]);
            $stats['experiences']++;
        }

        $eduOrder = (int) $user->educations()->max('sort_order');
        foreach ($parsed['educations'] ?? [] as $edu) {
            $user->educations()->create([
                'institution' => $edu['institution'],
                'degree' => $edu['degree'] ?? null,
                'field_of_study' => $edu['field_of_study'] ?? null,
                'location' => $edu['location'] ?? null,
                'start_date' => $edu['start_date'] ?? null,
                'end_date' => $edu['end_date'] ?? null,
                'is_current' => $edu['is_current'] ?? false,
                'description' => $edu['description'] ?? null,
                'sort_order' => ++$eduOrder,
            ]);
            $stats['educations']++;
        }

        return $stats;
    }

    public function buildMessage(array $stats): string
    {
        $parts = [];
        if ($stats['profile']) {
            $parts[] = 'profile';
        }
        if ($stats['skills'] > 0) {
            $parts[] = $stats['skills'] . ' skill(s)';
        }
        if ($stats['experiences'] > 0) {
            $parts[] = $stats['experiences'] . ' experience(s)';
        }
        if ($stats['educations'] > 0) {
            $parts[] = $stats['educations'] . ' education(s)';
        }

        if (empty($parts)) {
            return 'Resume processed, but we could not detect much structured data. Please review and fill sections manually.';
        }

        return 'Imported from resume: ' . implode(', ', $parts) . '. Please review each section.';
    }
}
