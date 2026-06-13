<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_returns_indexable_meta_tags(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $user = User::factory()->create();
        Blog::query()->create([
            'user_id' => $user->id,
            'title' => 'How to Build a Portfolio',
            'slug' => 'how-to-build-a-portfolio',
            'content' => '<p>Start with a clear headline and strong project proof.</p>',
            'excerpt' => 'Portfolio tips for job seekers.',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/blog');

        $response->assertOk();
        $response->assertSee('<meta name="robots" content="index, follow">', false);
        $response->assertSee('<link rel="canonical" href="https://resumizo.com/blog">', false);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('Latest updates', false);
        $response->assertSee('How to Build a Portfolio', false);
    }

    public function test_blog_post_renders_content_and_schema_in_html(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $user = User::factory()->create(['name' => 'Alex Writer']);
        Blog::query()->create([
            'user_id' => $user->id,
            'title' => 'ATS Resume Checklist',
            'slug' => 'ats-resume-checklist',
            'content' => '<h2>Formatting</h2><p>Use standard headings and readable fonts.</p>',
            'excerpt' => 'Make your resume ATS friendly.',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        $response = $this->get('/blog/ats-resume-checklist');

        $response->assertOk();
        $response->assertSee('<meta name="robots" content="index, follow">', false);
        $response->assertSee('<link rel="canonical" href="https://resumizo.com/blog/ats-resume-checklist">', false);
        $response->assertSee('itemprop="articleBody"', false);
        $response->assertSee('Use standard headings and readable fonts.', false);
        $response->assertSee('BlogPosting', false);
        $response->assertSee('Alex Writer', false);
    }

    public function test_draft_blog_posts_are_not_public(): void
    {
        $user = User::factory()->create();
        Blog::query()->create([
            'user_id' => $user->id,
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => '<p>Hidden draft</p>',
            'status' => 'draft',
            'published_at' => null,
        ]);

        $this->get('/blog/draft-post')->assertNotFound();
    }

    public function test_sitemap_lists_published_blog_urls(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $user = User::factory()->create();
        Blog::query()->create([
            'user_id' => $user->id,
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => '<p>Published content</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $this->assertStringStartsWith('<?xml version="1.0" encoding="UTF-8"?>', $response->getContent());
        $response->assertSee('https://resumizo.com/blog/published-post', false);
        $response->assertDontSee('draft-post', false);
    }

    public function test_preview_page_is_noindex(): void
    {
        \App\Models\Theme::query()->create([
            'name' => 'Classic',
            'slug' => 'classic',
            'is_active' => true,
        ]);

        $response = $this->get('/preview/1');

        $response->assertOk();
        $response->assertSee('<meta name="robots" content="noindex, nofollow">', false);
        $response->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }

    public function test_robots_txt_allows_blog_and_points_to_canonical_sitemap(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $response = $this->get('/robots.txt');

        $response->assertOk();
        $response->assertSee('Allow: /', false);
        $response->assertSee('Disallow: /preview/', false);
        $response->assertSee('Sitemap: https://resumizo.com/sitemap.xml', false);
        $response->assertDontSee('Disallow: /blog', false);
    }

    public function test_trailing_slash_redirects_to_canonical_path(): void
    {
        $this->followingRedirects()
            ->get('/blog/')
            ->assertOk()
            ->assertSee('Latest updates', false);
    }

    public function test_blog_feed_is_available(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $user = User::factory()->create();
        Blog::query()->create([
            'user_id' => $user->id,
            'title' => 'Feed Post',
            'slug' => 'feed-post',
            'content' => '<p>RSS body</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/blog/feed.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/rss+xml; charset=UTF-8');
        $response->assertSee('https://resumizo.com/blog/feed-post', false);
    }
}
