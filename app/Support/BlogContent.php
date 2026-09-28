<?php

namespace App\Support;

use App\Models\Blog;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BlogContent
{
    public static function injectHeadingIds(string $html): string
    {
        $used = [];

        $result = preg_replace_callback(
            '/<h([2-3])([^>]*)>(.*?)<\/h\1>/is',
            function (array $match) use (&$used): string {
                $text = trim(strip_tags($match[3]));
                $id = Str::slug($text) ?: 'section';
                $base = $id;
                $suffix = 2;

                while (in_array($id, $used, true)) {
                    $id = $base.'-'.$suffix++;
                }

                $used[] = $id;

                if (preg_match('/\sid=["\'][^"\']*["\']/i', $match[2])) {
                    return $match[0];
                }

                return '<h'.$match[1].$match[2].' id="'.$id.'">'.$match[3].'</h'.$match[1].'>';
            },
            $html
        );

        return $result ?? $html;
    }

    /**
     * @return array<int, array{level: int, id: string, text: string}>
     */
    public static function tableOfContents(string $html): array
    {
        if (! preg_match_all(
            '/<h([2-3])[^>]*\sid=["\']([^"\']+)["\'][^>]*>(.*?)<\/h\1>/is',
            $html,
            $matches,
            PREG_SET_ORDER
        )) {
            return [];
        }

        $toc = [];

        foreach ($matches as $match) {
            $text = trim(strip_tags($match[3]));

            if ($text === '') {
                continue;
            }

            $toc[] = [
                'level' => (int) $match[1],
                'id' => $match[2],
                'text' => $text,
            ];
        }

        return $toc;
    }

    /**
     * @return array<int, array{question: string, answer: string}>
     */
    public static function extractFaq(string $html): array
    {
        if (! preg_match(
            '/<h2[^>]*>[^<]*(?:faq|frequently asked)[^<]*<\/h2>(.*?)(?=<h2[^>]*>|$)/is',
            $html,
            $section
        )) {
            return [];
        }

        if (! preg_match_all(
            '/<h3[^>]*>(.*?)<\/h3>\s*(?:<p[^>]*>(.*?)<\/p>|<div[^>]*>(.*?)<\/div>)/is',
            $section[1],
            $matches,
            PREG_SET_ORDER
        )) {
            return [];
        }

        $faq = [];

        foreach ($matches as $match) {
            $question = trim(strip_tags($match[1]));
            $answer = trim(strip_tags($match[2] ?: ($match[3] ?? '')));

            if ($question !== '' && $answer !== '') {
                $faq[] = [
                    'question' => $question,
                    'answer' => $answer,
                ];
            }
        }

        return $faq;
    }

    /**
     * @param  Collection<int, Blog>  $candidates
     * @return Collection<int, Blog>
     */
    public static function relatedPosts(Blog $current, Collection $candidates, int $limit = 3): Collection
    {
        $currentKeywords = self::keywords($current->title.' '.$current->slug);

        return $candidates
            ->reject(fn (Blog $blog) => $blog->id === $current->id)
            ->sortByDesc(function (Blog $blog) use ($currentKeywords): int {
                $keywords = self::keywords($blog->title.' '.$blog->slug);

                return count(array_intersect($currentKeywords, $keywords));
            })
            ->take($limit)
            ->values();
    }

    /**
     * @return array<int, string>
     */
    private static function keywords(string $text): array
    {
        $words = preg_split('/[^a-z0-9]+/i', Str::lower($text), -1, PREG_SPLIT_NO_EMPTY) ?: [];

        return array_values(array_unique(array_filter(
            $words,
            fn (string $word) => strlen($word) > 3 && ! in_array($word, ['with', 'your', 'from', 'that', 'this', 'have', 'will', 'into', 'about'], true)
        )));
    }
}
