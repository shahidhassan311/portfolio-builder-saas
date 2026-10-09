<?php

namespace App\Support;

use App\Models\Theme;
use Illuminate\Http\Request;

class RegistrationDraft
{
    public const SESSION_KEY = 'register.draft';

    /** @return array{profession_id?: int, theme_id?: int, name?: string, username?: string, email?: string} */
    public static function get(Request $request): array
    {
        $draft = $request->session()->get(self::SESSION_KEY, []);

        return is_array($draft) ? $draft : [];
    }

    public static function forget(Request $request): void
    {
        $request->session()->forget(self::SESSION_KEY);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function merge(Request $request, array $data): void
    {
        $draft = self::get($request);

        if (array_key_exists('profession_id', $data) && $data['profession_id'] !== null && $data['profession_id'] !== '') {
            $draft['profession_id'] = (int) $data['profession_id'];
        }

        if (array_key_exists('theme_id', $data) && $data['theme_id'] !== null && $data['theme_id'] !== '') {
            $draft['theme_id'] = (int) $data['theme_id'];
        }

        foreach (['name', 'username', 'email'] as $field) {
            if (! array_key_exists($field, $data)) {
                continue;
            }

            $value = is_string($data[$field]) ? trim($data[$field]) : $data[$field];

            if ($value === null || $value === '') {
                unset($draft[$field]);
            } else {
                $draft[$field] = $value;
            }
        }

        $request->session()->put(self::SESSION_KEY, $draft);
    }

    public static function resolvedProfessionId(Request $request): ?int
    {
        $fromOld = old('profession_id');
        if ($fromOld !== null && $fromOld !== '') {
            return (int) $fromOld;
        }

        $id = self::get($request)['profession_id'] ?? null;

        return $id ? (int) $id : null;
    }

    public static function resolvedThemeId(Request $request): ?int
    {
        $fromOld = old('theme_id');
        if ($fromOld !== null && $fromOld !== '') {
            return (int) $fromOld;
        }

        $id = self::get($request)['theme_id'] ?? null;

        return $id ? (int) $id : null;
    }

    public static function isActiveTheme(int $themeId): bool
    {
        return Theme::query()
            ->whereKey($themeId)
            ->where('is_active', true)
            ->exists();
    }
}
