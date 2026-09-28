<?php

namespace Tests\Unit;

use App\Services\ResumeParser;
use PHPUnit\Framework\TestCase;

class ResumeParserTest extends TestCase
{
    public function test_parses_experience_and_education_without_bullets_as_titles(): void
    {
        $parser = new ResumeParser();
        $text = <<<'TEXT'
Jane Developer
jane@example.com

EXPERIENCE
Senior Software Engineer | Acme Technologies
Karachi, Pakistan
05/2023 - Present
• Led API development for billing platform
• Mentored junior developers

Software Developer - Beta Solutions
01/2020 - 04/2023
Built internal tools with Laravel

EDUCATION
Bachelor of Science in Computer Science
University of Karachi
2012 - 2016
TEXT;

        $parsed = $parser->parse($text);

        $this->assertGreaterThanOrEqual(1, count($parsed['experiences']));
        $first = $parsed['experiences'][0];
        $this->assertStringContainsString('Senior', $first['role_title']);
        $this->assertStringContainsString('Acme', $first['company']);
        $this->assertFalse(str_starts_with($first['role_title'], '•'));

        $this->assertGreaterThanOrEqual(1, count($parsed['educations']));
        $edu = $parsed['educations'][0];
        $this->assertMatchesRegularExpression('/bachelor|science/i', (string) $edu['degree']);
        $this->assertStringContainsString('University', (string) $edu['institution']);
    }
}
