<?php

namespace Tests\Unit;

use App\Support\Seo;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SeoTest extends TestCase
{
    #[Test]
    public function canonical_url_normalizes_paths(): void
    {
        config(['seo.site_url' => 'https://www.example.com']);

        $this->assertSame('https://www.example.com/', Seo::canonicalUrl('/'));
        $this->assertSame('https://www.example.com/blog', Seo::canonicalUrl('/blog/'));
    }

    #[Test]
    public function reading_time_returns_at_least_one_minute(): void
    {
        $this->assertSame(1, Seo::readingTime('<p>Hello world</p>'));
        $this->assertGreaterThan(1, Seo::readingTime('<p>'.str_repeat('word ', 500).'</p>'));
    }

    #[Test]
    public function sitemap_includes_programmatic_hubs(): void
    {
        config(['seo.site_url' => 'https://www.example.com']);

        $locs = array_column(Seo::sitemapEntries(), 'loc');

        $this->assertContains('https://www.example.com/resume-templates', $locs);
        $this->assertContains('https://www.example.com/job-resumes/software-engineer-resume', $locs);
    }

    #[Test]
    public function asset_url_uses_canonical_site_url(): void
    {
        config(['seo.site_url' => 'https://resumizo.com']);

        $this->assertSame(
            'https://resumizo.com/resumizo-logo.png',
            Seo::assetUrl('resumizo-logo.png')
        );
    }
}
