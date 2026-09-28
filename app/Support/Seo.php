<?php

namespace App\Support;

use App\Models\Blog;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Seo
{
    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    public static function forPage(string $pageKey, array $overrides = []): array
    {
        $defaults = config('seo.pages.'.$pageKey, []);
        $merged = array_merge([
            'title' => config('seo.default_title'),
            'description' => config('seo.default_description'),
            'keywords' => config('seo.default_keywords'),
            'robots' => config('seo.default_robots'),
            'canonical' => null,
            'og_type' => 'website',
            'og_image' => null,
            'schemas' => ['organization'],
        ], $defaults, $overrides);

        $merged['title'] = self::formatTitle($merged['title']);
        $merged['canonical'] = $merged['canonical'] ?? self::canonicalUrl(request()->path() === '/' ? '/' : '/'.ltrim(request()->path(), '/'));
        $merged['og_image'] = $merged['og_image'] ?? self::ogImageUrl();

        return $merged;
    }

    /**
     * @return array<string, mixed>
     */
    public static function forRoute(?string $routeName = null): array
    {
        $routeName = $routeName ?? optional(request()->route())->getName();

        if (! $routeName) {
            return self::forPage('home');
        }

        if (config()->has('seo.pages.'.$routeName)) {
            return self::forPage($routeName);
        }

        if (str_starts_with($routeName, 'dashboard.') || str_starts_with($routeName, 'admin.')) {
            return self::forPage('dashboard', [
                'title' => Str::headline(str_replace(['dashboard.', 'admin.'], '', $routeName)),
                'robots' => 'noindex, nofollow',
                'schemas' => [],
            ]);
        }

        return self::forPage('home', [
            'robots' => 'noindex, follow',
            'schemas' => ['organization'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function forBlogIndex(): array
    {
        return self::forPage('blog.index', [
            'canonical' => self::canonicalUrl('/blog'),
            'feed_url' => self::canonicalUrl('/blog/feed.xml'),
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => self::siteUrl()],
                ['name' => 'Blog', 'url' => self::canonicalUrl('/blog')],
            ],
            'schemas' => ['organization', 'breadcrumb', 'blog'],
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    /**
     * @param  array<int, array{question: string, answer: string}>  $faqItems
     * @return array<string, mixed>
     */
    public static function forBlogPost(Blog $blog, array $faqItems = []): array
    {
        $description = Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160);
        $canonical = self::canonicalUrl('/blog/'.$blog->slug);
        $image = $blog->image ? self::assetUrl('storage/'.$blog->image) : self::ogImageUrl();
        $schemas = ['article', 'breadcrumb'];

        if ($faqItems !== []) {
            $schemas[] = 'faq';
        }

        $schemaGraph = [
            self::articleSchema($blog, $canonical, $image, $description),
        ];

        if ($faqItems !== []) {
            $schemaGraph[] = self::faqSchemaFromItems($faqItems);
        }

        return [
            'title' => self::formatTitle($blog->title),
            'description' => $description,
            'keywords' => 'resumizo blog, '.$blog->title,
            'robots' => 'index, follow',
            'canonical' => $canonical,
            'og_type' => 'article',
            'og_image' => $image,
            'article_published' => $blog->published_at?->toIso8601String(),
            'article_modified' => $blog->updated_at->toIso8601String(),
            'author' => $blog->user->name ?? 'Resumizo Team',
            'schemas' => $schemas,
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => self::siteUrl()],
                ['name' => 'Blog', 'url' => self::canonicalUrl('/blog')],
                ['name' => $blog->title, 'url' => $canonical],
            ],
            'schema_graph' => $schemaGraph,
            'faq_items' => $faqItems,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function forBlogIndexPagination(int $currentPage, bool $hasMorePages): array
    {
        $seo = self::forBlogIndex();
        $seo['feed_url'] = self::canonicalUrl('/blog/feed.xml');

        if ($currentPage <= 1) {
            return $seo;
        }

        $seo['title'] = self::formatTitle('Blog — Page '.$currentPage);
        $seo['canonical'] = self::canonicalUrl('/blog').'?page='.$currentPage;

        if ($currentPage > 1) {
            $previousPage = $currentPage - 1;
            $seo['pagination_prev'] = $previousPage === 1
                ? self::canonicalUrl('/blog')
                : self::canonicalUrl('/blog').'?page='.$previousPage;
        }

        if ($hasMorePages) {
            $seo['pagination_next'] = self::canonicalUrl('/blog').'?page='.($currentPage + 1);
        }

        return $seo;
    }

    /**
     * @return array<string, mixed>
     */
    public static function forProgrammaticHub(string $hub): array
    {
        $hubConfig = config('seo.programmatic_hubs.'.$hub, []);

        return [
            'title' => self::formatTitle($hubConfig['title'] ?? Str::headline($hub)),
            'description' => $hubConfig['description'] ?? config('seo.default_description'),
            'keywords' => $hubConfig['keywords'] ?? config('seo.default_keywords'),
            'robots' => 'index, follow',
            'canonical' => self::canonicalUrl('/'.$hub),
            'og_type' => 'website',
            'og_image' => self::ogImageUrl(),
            'schemas' => ['organization', 'breadcrumb', 'webpage'],
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => self::siteUrl()],
                ['name' => $hubConfig['h1'] ?? Str::headline($hub), 'url' => self::canonicalUrl('/'.$hub)],
            ],
            'hub' => $hub,
            'hub_config' => $hubConfig,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function forProgrammaticPage(string $hub, string $slug): array
    {
        $page = config('seo.programmatic_pages.'.$hub.'.'.$slug, []);
        $hubConfig = config('seo.programmatic_hubs.'.$hub, []);
        $path = '/'.$hub.'/'.$slug;
        $canonical = self::canonicalUrl($path);

        return [
            'title' => self::formatTitle($page['title'] ?? Str::headline($slug)),
            'description' => $page['description'] ?? config('seo.default_description'),
            'keywords' => $page['keywords'] ?? config('seo.default_keywords'),
            'robots' => 'index, follow',
            'canonical' => $canonical,
            'og_type' => 'article',
            'og_image' => self::ogImageUrl(),
            'schemas' => ['organization', 'breadcrumb', 'webpage'],
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => self::siteUrl()],
                ['name' => $hubConfig['h1'] ?? Str::headline($hub), 'url' => self::canonicalUrl('/'.$hub)],
                ['name' => $page['h1'] ?? Str::headline($slug), 'url' => $canonical],
            ],
            'hub' => $hub,
            'slug' => $slug,
            'page' => $page,
            'hub_config' => $hubConfig,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function forPortfolio(string $name, string $canonicalPath): array
    {
        return [
            'title' => $name.' | Portfolio',
            'description' => 'Professional portfolio and resume for '.$name.' — built with Resumizo.',
            'robots' => 'noindex, follow',
            'canonical' => self::canonicalUrl($canonicalPath),
            'og_type' => 'profile',
            'og_image' => self::ogImageUrl(),
            'schemas' => [],
        ];
    }

    public static function siteUrl(): string
    {
        return config('seo.site_url');
    }

    public static function canonicalUrl(string $path = '/'): string
    {
        $path = '/'.ltrim($path, '/');

        if ($path === '//') {
            $path = '/';
        }

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return config('seo.site_url').$path;
    }

    public static function ogImageUrl(?string $relative = null): string
    {
        return self::assetUrl($relative ?? config('seo.og_image'));
    }

    public static function assetUrl(string $path): string
    {
        $path = ltrim($path, '/');

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return rtrim(self::siteUrl(), '/').'/'.$path;
    }

    public static function formatTitle(string $title): string
    {
        $siteName = config('seo.site_name');
        $separator = config('seo.title_separator');

        if (Str::contains($title, $siteName)) {
            return $title;
        }

        return rtrim($title).$separator.$siteName;
    }

    public static function readingTime(string $html): int
    {
        $words = str_word_count(strip_tags($html));

        return max(1, (int) ceil($words / 200));
    }

    /**
     * @param  array<string, mixed>  $seo
     * @return array<int, array<string, mixed>>
     */
    public static function buildSchemaGraph(array $seo): array
    {
        $graph = [];
        $schemas = $seo['schemas'] ?? [];

        if (in_array('organization', $schemas, true)) {
            $graph[] = self::organizationSchema();
        }

        if (in_array('website', $schemas, true)) {
            $graph[] = self::websiteSchema();
        }

        if (in_array('software', $schemas, true)) {
            $graph[] = self::softwareApplicationSchema();
        }

        if (in_array('faq', $schemas, true)) {
            $faqItems = $seo['faq_items'] ?? config('seo.home_faq', []);
            $graph[] = self::faqSchemaFromItems($faqItems);
        }

        if (in_array('reviews', $schemas, true)) {
            foreach (self::reviewSchemas() as $review) {
                $graph[] = $review;
            }
        }

        if (in_array('breadcrumb', $schemas, true) && ! empty($seo['breadcrumbs'])) {
            $graph[] = self::breadcrumbSchema($seo['breadcrumbs']);
        }

        if (in_array('blog', $schemas, true) && ! empty($seo['blog_posts'])) {
            $graph[] = [
                '@type' => 'Blog',
                'name' => config('seo.site_name').' Blog',
                'url' => self::canonicalUrl('/blog'),
                'publisher' => ['@id' => self::siteUrl().'/#organization'],
                'blogPost' => $seo['blog_posts'],
            ];
        }

        if (in_array('webpage', $schemas, true) && ! empty($seo['canonical'])) {
            $graph[] = [
                '@type' => 'WebPage',
                '@id' => $seo['canonical'].'#webpage',
                'url' => $seo['canonical'],
                'name' => $seo['title'] ?? config('seo.site_name'),
                'description' => $seo['description'] ?? null,
                'isPartOf' => ['@id' => self::siteUrl().'/#website'],
            ];
        }

        if (! empty($seo['schema_graph'])) {
            $graph = array_merge($graph, $seo['schema_graph']);
        }

        return $graph;
    }

    /**
     * @return array<string, mixed>
     */
    public static function organizationSchema(): array
    {
        $org = config('seo.organization');

        return [
            '@type' => 'Organization',
            '@id' => self::siteUrl().'/#organization',
            'name' => $org['name'],
            'url' => self::siteUrl(),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => self::assetUrl($org['logo']),
            ],
            'email' => $org['email'] ?? null,
            'sameAs' => array_values($org['same_as'] ?? []),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function websiteSchema(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => self::siteUrl().'/#website',
            'url' => self::siteUrl(),
            'name' => config('seo.site_name'),
            'description' => config('seo.default_description'),
            'publisher' => ['@id' => self::siteUrl().'/#organization'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function softwareApplicationSchema(): array
    {
        $schema = [
            '@type' => 'SoftwareApplication',
            'name' => config('seo.site_name').' Portfolio Builder',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web',
            'url' => self::siteUrl(),
            'description' => config('seo.default_description'),
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
            ],
        ];

        if (config('seo.include_aggregate_rating')) {
            $schema['aggregateRating'] = array_merge(
                ['@type' => 'AggregateRating'],
                config('seo.aggregate_rating')
            );
        }

        return $schema;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function reviewSchemas(): array
    {
        return collect(config('seo.home_reviews', []))->map(fn (array $review) => [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $review['author'],
            ],
            'reviewBody' => $review['reviewBody'],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $review['ratingValue'] ?? 5,
                'bestRating' => 5,
            ],
            'itemReviewed' => [
                '@type' => 'SoftwareApplication',
                'name' => config('seo.site_name').' Portfolio Builder',
            ],
        ])->all();
    }

    /**
     * @return array<string, mixed>
     */
    public static function faqSchema(): array
    {
        return self::faqSchemaFromItems(config('seo.home_faq', []));
    }

    /**
     * @param  array<int, array{question: string, answer: string}>  $items
     * @return array<string, mixed>
     */
    public static function faqSchemaFromItems(array $items): array
    {
        $entities = collect($items)->map(fn (array $item) => [
            '@type' => 'Question',
            'name' => $item['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['answer'],
            ],
        ])->values()->all();

        return [
            '@type' => 'FAQPage',
            'mainEntity' => $entities,
        ];
    }

    /**
     * @param  array<int, array{name: string, url: string}>  $breadcrumbs
     * @return array<string, mixed>
     */
    public static function breadcrumbSchema(array $breadcrumbs): array
    {
        $items = [];
        foreach ($breadcrumbs as $index => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'],
            ];
        }

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function articleSchema(Blog $blog, string $canonical, string $image, string $description): array
    {
        return [
            '@type' => 'BlogPosting',
            'headline' => $blog->title,
            'image' => [$image],
            'author' => [
                '@type' => 'Person',
                'name' => $blog->user->name ?? 'Resumizo Team',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('seo.organization.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => self::assetUrl(config('seo.organization.logo')),
                ],
            ],
            'datePublished' => $blog->published_at?->toIso8601String(),
            'dateModified' => $blog->updated_at->toIso8601String(),
            'description' => $description,
            'url' => $canonical,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonical,
            ],
            'isPartOf' => [
                '@type' => 'Blog',
                'name' => config('seo.site_name').' Blog',
                'url' => self::canonicalUrl('/blog'),
            ],
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $graph
     */
    public static function jsonLd(array $graph): string
    {
        if (empty($graph)) {
            return '';
        }

        $payload = [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];

        return json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>
     */
    public static function sitemapEntries(): array
    {
        $entries = [
            ['loc' => self::canonicalUrl('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['loc' => self::canonicalUrl('/blog'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => self::canonicalUrl('/privacy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.4'],
            ['loc' => self::canonicalUrl('/terms'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.4'],
        ];

        foreach (array_keys(config('seo.programmatic_hubs', [])) as $hub) {
            $entries[] = [
                'loc' => self::canonicalUrl('/'.$hub),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.85',
            ];

            foreach (array_keys(config('seo.programmatic_pages.'.$hub, [])) as $slug) {
                $entries[] = [
                    'loc' => self::canonicalUrl('/'.$hub.'/'.$slug),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.75',
                ];
            }
        }

        return $entries;
    }
}
