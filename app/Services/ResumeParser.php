<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Smalot\PdfParser\Parser as PdfParser;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToText\Pdf;


class ResumeParser
{
    private const SECTION_HEADERS = [
        'summary' =>
'/^(summary|career\s+summary|professional\s+summary|profile|about\s+me|objective)$/i',

        'skills' =>
            '/^(?:technical\s+)?skills$|^core\s+competencies$|^technologies$|^expertise$/i',

        'experience' =>
'/^(work\s+experience|professional\s+experience|employment|career|work\s+history)$/i',

        'education' =>
            '/^education$|^academic$|^qualifications$/i',

        'projects' =>
            '/^(projects?|portfolio|case studies?)$/i',

        'certifications' =>
            '/^(certifications?|certificates?|licenses?)$/i',

        'services' =>
            '/^(?:services|what i offer|offerings|my services)$/i',
    ];

    private const SKILL_KEYWORDS = [
        'PHP', 'Laravel', 'JavaScript', 'TypeScript', 'React', 'Vue', 'Angular', 'Node.js',
        'Python', 'Django', 'Java', 'Spring', 'C#', '.NET', 'SQL', 'MySQL', 'PostgreSQL',
        'MongoDB', 'Redis', 'AWS', 'Docker', 'Kubernetes', 'Git', 'HTML', 'CSS', 'Tailwind',
        'Figma', 'UI/UX', 'REST API', 'GraphQL', 'Linux', 'Agile', 'Scrum', 'CI/CD',
    ];

    private const DEGREE_PATTERN = '/\b(bachelor|master|b\.?\s*s\.?|b\.?\s*a\.?|m\.?\s*s\.?|m\.?\s*a\.?|mba|ph\.?\s*d\.?|diploma|associate|bsc|msc|bachelors?|masters?)\b/i';

    private const INSTITUTION_PATTERN = '/\b(university|college|institute|school|academy|polytechnic)\b/i';

    /**
     * Extract raw text from a PDF, preserving column layout where possible.
     * Uses the `pdftotext` binary configured via POPPLER_PATH env var,
     * falling back to Smalot\PdfParser if the binary call fails.
     */
    public function extractText(string $pdfPath): string
    {
        $binary = config('services.poppler.path', env('POPPLER_PATH', 'pdftotext'));

        try {
            // '-layout' preserves left/right column structure instead of
            // interleaving lines from separate columns.
            $text = Pdf::getText($pdfPath, $binary, ['layout']);

            if (trim($text) === '') {
                throw new \RuntimeException('pdftotext returned empty text');
            }

            return $text;
        } catch (\Throwable $e) {
            Log::warning('pdftotext extraction failed, falling back to Smalot', [
                'error' => $e->getMessage(),
                'path'  => $pdfPath,
            ]);

            $parser = new PdfParser();

            return $parser->parseFile($pdfPath)->getText();
        }
    }

    public function parse(string $text): array
    {
        $text = $this->normalizeText($text);
        logger()->info('experiences', ['data' => $text]);
        $lines = array_values(
            array_filter(
                array_map('trim', explode("\n", $text))
            )
        );

        // foreach ($lines as $i => $line) {
        //     logger()->info("LINE {$i}: {$line}");
        // }

        $sections = $this->splitSections($lines);

        return [
            'name' => $this->extractName($lines),
            'email' => $this->extractEmail($text),
            'phone' => $this->extractPhone($text),
            'location' => $this->extractLocation($lines),
            'tagline' => $this->extractTagline($lines, $sections),
            'about_short' => $this->extractSummary($sections, $lines),
            'skills' => $this->extractSkills($sections, $text),
            'experiences' => $this->extractExperiences($sections),
            'certifications' => $this->extractCertifications($sections),
            'services' => $this->extractServices($sections),
            'educations' => $this->extractEducations($sections),
        ];


    }

    private function normalizeText(string $text): string
    {
        $text = preg_replace("/\r\n?/", "\n", $text) ?? $text;
        $text = preg_replace("/[ \t]+/", ' ', $text) ?? $text;
        $text = preg_replace("/\n{3,}/", "\n\n", $text) ?? $text;
        // Fix PDF bullets glued to text
        $text = preg_replace('/([a-zA-Z0-9])•/', "$1\n•", $text) ?? $text;
        $text = preg_replace('/•\s*/', "\n• ", $text) ?? $text;
        $text = preg_replace('/([a-z])([A-Z]{3,})/', "$1\n$2", $text);
        $text = preg_replace('/(SKILLS|EXPERIENCE|EDUCATION|PROJECTS|CERTIFICATIONS)/i', "\n$1\n", $text);

        $text = preg_replace('/\x{200B}|\x{200C}|\x{200D}|\x{FEFF}/u', '', $text);
        $text = str_replace("\xC2\xA0", ' ', $text);

        return trim($text);
    }

    private function splitSections(array $lines): array
    {
        logger()->info('LINES RECEIVED', $lines);

        $sections = [
            'summary'        => [],
            'skills'         => [],
            'experience'     => [],
            'education'      => [],
            'projects'       => [],
            'certifications' => [],
            'services'       => [],
        ];

        $knownHeaders = [
            'SUMMARY'                  => 'summary',
            'PROFILE'                  => 'summary',
            'ABOUT ME'                 => 'summary',
            'OBJECTIVE'                => 'summary',

            'SKILLS'                   => 'skills',
            'TECHNICAL SKILLS'         => 'skills',

            'WORK EXPERIENCE' => 'experience',
'PROFESSIONAL EXPERIENCE' => 'experience',
'EMPLOYMENT' => 'experience',
'WORK HISTORY' => 'experience',

            'EDUCATION'                => 'education',
            'ACADEMIC'                 => 'education',

            'PROJECTS'                 => 'projects',
            'PORTFOLIO'                => 'projects',

            'CERTIFICATIONS'           => 'certifications',
            'CERTIFICATES'             => 'certifications',

            'SERVICES'                 => 'services',
        ];

        /*
        |--------------------------------------------------------------------------
        | Merge split headers (WORK + EXPERIENCE => WORK EXPERIENCE)
        |--------------------------------------------------------------------------
        */
        $fixedLines = [];

        for ($i = 0; $i < count($lines); $i++) {

            if (
                strtoupper(trim($lines[$i])) === 'WORK' &&
                isset($lines[$i + 1]) &&
                strtoupper(trim($lines[$i + 1])) === 'EXPERIENCE'
            ) {
                $fixedLines[] = 'WORK EXPERIENCE';
                $i++;
                continue;
            }

            $fixedLines[] = $lines[$i];
        }

        $lines = $fixedLines;

        $headers = [];

        /*
        |--------------------------------------------------------------------------
        | Detect Headers
        |--------------------------------------------------------------------------
        */
        foreach ($lines as $i => $line) {

            $line = preg_replace(
                '/\x{200B}|\x{200C}|\x{200D}|\x{FEFF}/u',
                '',
                $line
            );

            $line = trim($line);

            if ($line === '') {
                continue;
            }

            $normalizedLine = strtoupper($line);

            // Exact Header Match
            if (isset($knownHeaders[$normalizedLine])) {

                $headers[] = [
                    'section' => $knownHeaders[$normalizedLine],
                    'index'   => $i,
                    'line'    => $line,
                ];

                continue;
            }

            // Guard: a single common word (e.g. a stray "experience" from a
            // wrapped sentence like "...with experience in...") should never
            // be treated as a section header on its own. Only multi-word
            // known headers or lines that are clearly full header phrases
            // are eligible for the regex match below.
            if (str_word_count($normalizedLine) === 1 && !isset($knownHeaders[$normalizedLine])) {
                continue;
            }

            // Regex Header Match
            foreach (self::SECTION_HEADERS as $section => $pattern) {

                if (preg_match($pattern, $normalizedLine)) {

                    logger()->info('HEADER FOUND', [
                        'section' => $section,
                        'index'   => $i,
                        'line'    => $line,
                    ]);

                    $headers[] = [
                        'section' => $section,
                        'index'   => $i,
                        'line'    => $line,
                    ];

                    continue 2;
                }
            }
        }

        if (empty($headers)) {
            return $sections;
        }

        usort($headers, function ($a, $b) {
            return $a['index'] <=> $b['index'];
        });

        /*
        |--------------------------------------------------------------------------
        | Split Content Between Headers
        |--------------------------------------------------------------------------
        */
        foreach ($headers as $idx => $header) {

            $section = $header['section'];
            $start   = $header['index'] + 1;
            $end     = $headers[$idx + 1]['index'] ?? count($lines);

            $content = [];

            for ($j = $start; $j < $end; $j++) {

                $line = trim($lines[$j]);

                if ($line === '') {
                    continue;
                }

                $content[] = $line;
            }

            $sections[$section] = array_merge(
                $sections[$section] ?? [],
                $content
            );
        }

        logger()->info('HEADERS FOUND', [
            'headers' => $headers,
        ]);

        logger()->info('ALL SECTIONS', $sections);

        return $sections;
    }

    private function extractServices(array $sections): array
    {
        if (empty($sections['services'])) {
            return [];
        }

        $services = [];

        foreach ($sections['services'] as $line) {

            $line = trim($line);

            if ($line === '') {
                continue;
            }

            $services[] = [
                'title' => $line,
                'icon' => null,
                'description' => null,
                'sort_order' => 0,
            ];
        }

        return array_slice($services, 0, 10);
    }

    private function extractName(array $lines): ?string
    {
        foreach (array_slice($lines, 0, 8) as $line) {
            if (strlen($line) < 3 || strlen($line) > 50) {
                continue;
            }
            if (preg_match('/@|https?:|linkedin|github|phone|email|\d{3}/i', $line)) {
                continue;
            }
            if (preg_match('/^[A-Z][a-z]+(?:\s+[A-Z][a-z]+){1,3}$/', $line)) {
                return $line;
            }
            if (preg_match('/^[A-Z][A-Z\s]{2,40}$/', $line) && substr_count($line, ' ') <= 3) {
                return ucwords(strtolower($line));
            }
        }

        return null;
    }

    private function extractCertifications(array $sections): array
    {
        $lines = $sections['certifications'] ?? [];

        $certifications = [];

        foreach ($lines as $line) {

            $line = trim($line);

            if ($line === '') {
                continue;
            }

            if (!mb_check_encoding($line, 'UTF-8')) {
                $line = mb_convert_encoding($line, 'UTF-8', 'auto');
            }

            $line = str_replace("\xC2\xA0", ' ', $line);
            $line = preg_replace('/\s+/u', ' ', $line);

            $certifications[] = [
                'title' => $line,
                'organization' => null,
                'issue_date' => null,
                'credential_url' => null,
                'description' => null,
            ];
        }

        return $certifications;
    }

    private function extractEmail(string $text): ?string
    {
        return preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $m) ? strtolower($m[0]) : null;
    }

    private function extractPhone(string $text): ?string
    {
        if (preg_match('/(?:\+?\d{1,3}[\s.-]?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}/', $text, $m)) {
            return trim($m[0]);
        }

        return null;
    }

    private function extractLocation(array $lines): ?string
    {
        foreach (array_slice($lines, 0, 12) as $line) {
            if ($this->isPrimarilyLocationLine($line)) {
                return $line;
            }
        }

        return null;
    }

    private function extractTagline(array $lines, array $sections): ?string
    {
        foreach (array_slice($lines, 1, 6) as $line) {
            if (strlen($line) > 20 && strlen($line) < 80 && !str_contains($line, '@') && !str_contains($line, '|')) {
                if (preg_match('/developer|engineer|designer|manager|analyst|consultant|freelancer/i', $line)
                    && !preg_match(self::SECTION_HEADERS['experience'], $line)
                    && !$this->hasDateRange($line)) {
                    return $line;
                }
            }
        }

        return null;
    }

    private function extractSummary(array $sections, array $lines): ?string
    {
        $summary = implode(' ', $sections['summary']);
        if (strlen($summary) > 40) {
            return mb_substr($summary, 0, 500);
        }

        foreach (array_slice($lines, 0, 15) as $line) {
            if (strlen($line) > 80 && !str_contains($line, '@') && !$this->isBulletLine($line)) {
                return mb_substr($line, 0, 500);
            }
        }

        return null;
    }

    private function extractSkills(array $sections, string $text): array
    {
        $skills = [];
        $seen = [];

        $skillLines = $sections['skills'];

        if (!empty($skillLines)) {
            $blob = implode(' ', $skillLines);

            $parts = preg_split('/[,|•·\|\/]/u', $blob) ?: [];

            foreach ($parts as $part) {

                $name = iconv('UTF-8', 'UTF-8//IGNORE', $part);
                $name = str_replace("\xEF\xBF\xBD", '', $name);
                $name = str_replace("\xC2\xA0", ' ', $name);
                $name = preg_replace('/[\x00-\x1F\x7F]/u', '', $name);
                $name = preg_replace('/\s+/u', ' ', $name);
                $name = trim($name);

                if (
                    $name !== '' &&
                    mb_strlen($name) >= 2 &&
                    mb_strlen($name) <= 40 &&
                    !isset($seen[mb_strtolower($name)])
                ) {
                    $seen[mb_strtolower($name)] = true;

                    $skills[] = [
                        'name'  => $name,
                        'level' => $this->guessSkillLevel($name),
                    ];
                }
            }
        }

        return array_slice($skills, 0, 20);
    }

    private function guessSkillLevel(string $name): string
    {
        $advanced = ['expert', 'advanced', 'senior', 'proficient'];
        foreach ($advanced as $word) {
            if (stripos($name, $word) !== false) {
                return 'Expert';
            }
        }

        return 'Intermediate';
    }

    private function extractExperiences(array $sections): array
    {
        $lines = $sections['experience'] ?? [];

        if (empty($lines)) {
            return [];
        }

        $lines = array_values(array_filter(array_map(function ($line) {

            if (! is_string($line)) {
                return '';
            }

            $line = preg_replace('/\x{200B}|\x{200C}|\x{200D}|\x{FEFF}/u', '', $line);
            $line = mb_convert_encoding($line, 'UTF-8', 'UTF-8');

            return trim($line);

        }, $lines)));

        $experiences = [];

        $blocks = $this->splitEntryBlocks($lines, 'experience');

        foreach ($blocks as $index => $block) {

            $parsed = $this->parseExperienceBlock($block);

            if ($parsed && $this->isValidExperience($parsed)) {
                $experiences[] = $parsed;
            }
        }

        return array_slice($experiences, 0, 10);
    }

    private function extractEducations(array $sections): array
    {
        $lines = $sections['education'];
        if (empty($lines)) {
            return [];
        }

        $educations = [];
        foreach ($this->splitEntryBlocks($lines, 'education') as $block) {
            $parsed = $this->parseEducationBlock($block);
            if ($parsed && $this->isValidEducation($parsed)) {
                $educations[] = $parsed;
            }
        }

        return array_slice($educations, 0, 8);
    }

    /**
     * Split section lines into logical entries (jobs / degrees), not one line per entry.
     */
    private function splitEntryBlocks(array $lines, string $section = 'experience'): array
    {
        $blocks = [];
        $current = [];

        foreach ($lines as $line) {
            if ($section === 'education') {
                $startsNewEntry = !empty($current) && (
                    ($this->isPrimarilyDateLine($line) && $this->blockHasDateLine($current))
                    || (preg_match(self::DEGREE_PATTERN, $line) && $this->blockHasDegreeLine($current) && $this->blockHasDateLine($current))
                );
            } else {
                $startsNewEntry = !empty($current) && (
                    ($this->isPrimarilyDateLine($line) && $this->blockHasDateLine($current))
                    || ($this->looksLikeJobOrDegreeHeader($line) && $this->blockHasHeaderContent($current) && $this->blockHasDateLine($current))
                );
            }

            if ($startsNewEntry) {
                $blocks[] = $current;
                $current = [$line];
            } else {
                $current[] = $line;
            }
        }

        if (!empty($current)) {
            $blocks[] = $current;
        }

        $merged = [];
        foreach ($blocks as $block) {
            if (!empty($merged)) {
                if (count($block) === 1 && $this->isBulletLine($block[0])) {
                    $merged[array_key_last($merged)][] = $block[0];

                    continue;
                }
                if (count($block) === 1 && $this->isPrimarilyDateLine($block[0])) {
                    $merged[array_key_last($merged)][] = $block[0];

                    continue;
                }
            }
            $merged[] = $block;
        }

        return $merged;
    }

    private function blockHasDateLine(array $lines): bool
    {
        foreach ($lines as $line) {
            if ($this->isPrimarilyDateLine($line)) {
                return true;
            }
        }

        return false;
    }

    private function blockHasDegreeLine(array $lines): bool
    {
        foreach ($lines as $line) {
            if (preg_match(self::DEGREE_PATTERN, $line)) {
                return true;
            }
        }

        return false;
    }

    private function blockHasHeaderContent(array $lines): bool
    {
        foreach ($lines as $line) {
            if (!$this->isBulletLine($line) && !$this->isPrimarilyDateLine($line)) {
                return true;
            }
        }

        return false;
    }

    private function looksLikeJobOrDegreeHeader(string $line): bool
    {
        if ($this->isBulletLine($line) || $this->isPrimarilyDateLine($line)) {
            return false;
        }

        return preg_match('/\b(developer|engineer|manager|analyst|intern|consultant|lead|director|specialist|officer|associate)\b/i', $line)
            || preg_match(self::DEGREE_PATTERN, $line)
            || preg_match(self::INSTITUTION_PATTERN, $line)
            || str_contains(strtolower($line), ' at ')
            || str_contains($line, ' | ');
    }

    private function parseExperienceBlock(array $lines): ?array
    {
        $lines = array_values(array_filter($lines, fn ($l) => trim($l) !== ''));
        if (empty($lines)) {
            return null;
        }

        $role = null;
        $company = null;
        $location = null;
        $descriptionParts = [];
        $dates = ['start' => null, 'end' => null, 'current' => false];
        $headerLines = [];

        foreach ($lines as $line) {
            if ($this->isBulletLine($line)) {
                $descriptionParts[] = $this->cleanBullet($line);

                continue;
            }

            if ($this->isPrimarilyDateLine($line)) {
                $dateParsed = $this->parseDateLine($line);
                $dates = array_merge($dates, $dateParsed);
                if (!empty($dateParsed['location'])) {
                    $location = $dateParsed['location'];
                }

                continue;
            }

            if ($this->isPrimarilyLocationLine($line) && count($headerLines) >= 1) {
                $location = $line;

                continue;
            }

            if (strlen($line) > 150) {
                $descriptionParts[] = $line;

                continue;
            }

            $headerLines[] = $line;
        }

        foreach ($headerLines as $line) {
            if ($this->isPrimarilyLocationLine($line)) {
                $location ??= $line;

                continue;
            }

            $parsed = $this->parseRoleCompanyLine($line);
            if ($parsed['role'] && !$role) {
                $role = $parsed['role'];
            }
            if ($parsed['company'] && !$company) {
                $company = $parsed['company'];
            }
        }

        if ((!$role || !$company) && count($headerLines) >= 2) {
            $a = $headerLines[0];
            $b = $headerLines[1];
            if ($this->looksLikeCompany($b) || !$this->looksLikeCompany($a)) {
                $role ??= $a;
                $company ??= $b;
            } else {
                $role ??= $b;
                $company ??= $a;
            }
        } elseif (count($headerLines) === 1) {
            $parsed = $this->parseRoleCompanyLine($headerLines[0]);
            $role ??= $parsed['role'];
            $company ??= $parsed['company'];
        }

        $role = $this->sanitizeTitle($role);
        $company = $this->sanitizeTitle($company);

        if (!$role && !$company) {
            return null;
        }

        $description = implode("\n", $descriptionParts);
        if (strlen($description) > 2000) {
            $description = mb_substr($description, 0, 2000);
        }

        return [
            'company' => $company ?: 'Company',
            'role_title' => $role ?: 'Role',
            'location' => $location,
            'start_date' => $dates['start'],
            'end_date' => $dates['end'],
            'is_current' => $dates['current'],
            'description' => $description !== '' ? $description : null,
        ];
    }

    private function parseEducationBlock(array $lines): ?array
    {
        $lines = array_values(array_filter($lines, fn ($l) => trim($l) !== ''));
        if (empty($lines)) {
            return null;
        }

        $degree = null;
        $institution = null;
        $field = null;
        $location = null;
        $descriptionParts = [];
        $dates = ['start' => null, 'end' => null, 'current' => false];
        $contentLines = [];

        foreach ($lines as $line) {
            if ($this->isBulletLine($line)) {
                $descriptionParts[] = $this->cleanBullet($line);

                continue;
            }

            if ($this->isPrimarilyDateLine($line)) {
                $dateParsed = $this->parseDateLine($line);
                $dates = array_merge($dates, $dateParsed);

                continue;
            }

            if ($this->isPrimarilyLocationLine($line) && ($degree || $institution)) {
                $location = $line;

                continue;
            }

            $contentLines[] = $line;
        }

        foreach ($contentLines as $line) {
            if ($this->isPrimarilyLocationLine($line) && !$location) {
                $location = $line;

                continue;
            }

            if (preg_match(self::DEGREE_PATTERN, $line) && !$degree) {
                $degree = $line;
                if (preg_match('/\bin\s+(.+)$/i', $line, $m)) {
                    $field = trim($m[1]);
                }

                continue;
            }

            if (preg_match(self::INSTITUTION_PATTERN, $line) && !$institution) {
                $institution = $line;

                continue;
            }
        }

        foreach ($contentLines as $line) {
            if ($this->isPrimarilyLocationLine($line)) {
                continue;
            }
            if ($line === $degree || $line === $institution) {
                continue;
            }
            if (!$degree && !$this->isPrimarilyDateLine($line)) {
                $degree = $line;

                continue;
            }
            if (!$institution) {
                $institution = $line;
            }
        }

        if (str_contains((string) $degree, ' - ')) {
            [$d, $inst] = array_map('trim', explode(' - ', $degree, 2));
            if (preg_match(self::INSTITUTION_PATTERN, $inst)) {
                $degree = $d;
                $institution ??= $inst;
            }
        }

        $degree = $this->sanitizeTitle($degree);
        $institution = $this->sanitizeTitle($institution);

        if ($degree && $institution && strcasecmp($degree, $institution) === 0) {
            $institution = null;
            foreach ($contentLines as $line) {
                if ($line !== $degree && preg_match(self::INSTITUTION_PATTERN, $line)) {
                    $institution = $line;
                    break;
                }
            }
        }

        if ($this->isPrimarilyDateLine((string) $degree) || $this->isPrimarilyLocationLine((string) $degree)) {
            $degree = null;
        }
        if ($this->isPrimarilyDateLine((string) $institution) || ($institution && $this->isPrimarilyLocationLine($institution) && !$degree)) {
            if (!$location && $institution) {
                $location = $institution;
            }
            $institution = null;
        }

        if (!$degree && !$institution) {
            return null;
        }

        return [
            'institution' => $institution ?? 'Institution',
            'degree' => $degree,
            'field_of_study' => $field,
            'location' => $location,
            'start_date' => $dates['start'],
            'end_date' => $dates['end'],
            'is_current' => $dates['current'],
            'description' => !empty($descriptionParts) ? implode("\n", $descriptionParts) : null,
        ];
    }

    private function parseRoleCompanyLine(string $line): array
    {
        $line = trim($line);
        $role = null;
        $company = null;

        if (preg_match('/^(.+?)\s+@\s+(.+)$/i', $line, $m)) {
            $left = trim($m[1]);
            $right = trim($m[2]);

            $right = $this->removeDateFromText($right);

            if ($this->isPrimarilyDateLine($left)) {
                return ['role' => null, 'company' => null];
            }

            if ($this->isPrimarilyLocationLine($right)) {
                return ['role' => $left, 'company' => null];
            }

            return [
                'role' => $left,
                'company' => $right,
            ];
        }

        foreach ([' at ', ' @ ', ' | '] as $sep) {
            if (str_contains($line, $sep)) {

                [$role, $company] = array_map('trim', explode($sep, $line, 2));

                $company = $this->removeDateFromText($company);

                return [
                    'role' => $role,
                    'company' => $company,
                ];
            }
        }

        if (
            preg_match('/^(.+?)\s*[-–—]\s*(.+)$/', $line, $m)
            && !$this->isPrimarilyDateLine($line)
        ) {
            $left = trim($m[1]);
            $right = trim($m[2]);

            $right = $this->removeDateFromText($right);

            if (!$this->hasDateRange($right) && strlen($right) < 80) {
                return [
                    'role' => $left,
                    'company' => $right,
                ];
            }
        }

        return [
            'role' => $line,
            'company' => null,
        ];
    }

    private function removeDateFromText(string $text): string
    {
        $text = preg_replace(
            '/(\d{1,2})\/(\d{4})\s*[-–—]\s*(?:(\d{1,2})\/(\d{4})|(present|current))/i',
            '',
            $text
        );

        $text = preg_replace(
            '/((?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s+\d{4})\s*[-–—]\s*((?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s+\d{4}|present|current)/i',
            '',
            $text
        );

        $text = preg_replace(
            '/\b((?:19|20)\d{2})\b\s*[-–—]\s*\b((?:19|20)\d{2}|present|current)\b/i',
            '',
            $text
        );

        return trim($text, " ,-|–—");
    }

    private function parseDateLine(string $line): array
    {
        $location = null;
        if (preg_match('/@\s*(.+)$/i', $line, $m)) {
            $location = trim($m[1]);
            $line = trim(preg_replace('/\s*@\s*.+$/i', '', $line) ?? $line);
        }

        $dates = $this->parseDatesFromString($line);

        return array_merge($dates, ['location' => $location]);
    }

    private function parseDatesFromString(string $text): array
    {
        $start = null;
        $end = null;
        $current = (bool) preg_match('/\b(present|current|now)\b/i', $text);

        if (preg_match(
            '/(\d{1,2})\/(\d{4})\s*[-–—]\s*(?:(\d{1,2})\/(\d{4})|(present|current))/i',
            $text,
            $m
        )) {
            $start = sprintf('%04d-%02d-01', (int) $m[2], (int) $m[1]);
            if (!empty($m[5])) {
                $current = true;
            } elseif (!empty($m[3]) && !empty($m[4])) {
                $end = sprintf('%04d-%02d-01', (int) $m[4], (int) $m[3]);
            }

            return ['start' => $start, 'end' => $current ? null : $end, 'current' => $current];
        }

        if (preg_match(
            '/((?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s+\d{4})\s*[-–—]\s*((?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s+\d{4}|present|current)/i',
            $text,
            $m
        )) {
            $start = $this->monthYearToDate($m[1]);
            if (preg_match('/present|current/i', $m[2])) {
                $current = true;
            } else {
                $end = $this->monthYearToDate($m[2]);
            }

            return ['start' => $start, 'end' => $current ? null : $end, 'current' => $current];
        }

        if (preg_match('/\b((?:19|20)\d{2})\b\s*[-–—]\s*\b((?:19|20)\d{2}|present|current)\b/i', $text, $m)) {
            $start = $m[1] . '-01-01';
            if (preg_match('/present|current/i', $m[2])) {
                $current = true;
            } else {
                $end = $m[2] . '-12-01';
            }

            return ['start' => $start, 'end' => $current ? null : $end, 'current' => $current];
        }

        if (preg_match_all('/\b((?:19|20)\d{2})\b/', $text, $years)) {
            $found = $years[1];
            if (count($found) >= 1) {
                $start = $found[0] . '-01-01';
            }
            if (count($found) >= 2) {
                $end = $found[1] . '-12-01';
            }
        }

        return ['start' => $start, 'end' => $current ? null : $end, 'current' => $current];
    }

    private function monthYearToDate(string $token): ?string
    {
        $months = [
            'jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4, 'may' => 5, 'jun' => 6,
            'jul' => 7, 'aug' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12,
        ];

        if (preg_match('/([a-z]{3,9})\.?\s+(\d{4})/i', strtolower($token), $m)) {
            $key = substr($m[1], 0, 3);
            $month = $months[$key] ?? 1;

            return sprintf('%04d-%02d-01', (int) $m[2], $month);
        }

        return null;
    }

    private function isBulletLine(string $line): bool
    {
        $t = trim($line);
        if ($t === '') {
            return false;
        }

        return str_starts_with($t, '•')
            || str_starts_with($t, '-')
            || str_starts_with($t, '*')
            || str_starts_with($t, '–')
            || (bool) preg_match('/^[\x{2022}\x{25CF}\x{25E6}\x{25AA}\x{25B8}\x{25BA}]\s*/u', $t);
    }

    private function cleanBullet(string $line): string
    {
        return trim(preg_replace('/^[\s•\-\*●◦▪▸►]+\s*/u', '', $line) ?? $line);
    }

    private function isPrimarilyDateLine(string $line): bool
    {
        $stripped = trim(preg_replace('/\s*@\s*.+$/i', '', $line) ?? $line);

        if ($this->isBulletLine($stripped)) {
            return false;
        }

        if (preg_match(
            '/^(\d{1,2}\/\d{4}|\w{3,9}\.?\s+\d{4}|\d{4})\s*[-–—]\s*(\d{1,2}\/\d{4}|\w{3,9}\.?\s+\d{4}|\d{4}|present|current)/i',
            $stripped
        )) {
            return true;
        }

        if (preg_match('/^\d{4}\s*[-–—]\s*(\d{4}|present|current)/i', $stripped)) {
            return true;
        }

        $withoutDates = preg_replace('/\b((?:19|20)\d{2}|present|current|jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)\b\.?/i', '', $stripped) ?? '';
        $withoutDates = preg_replace('/[\/\-\–—,\s@]/', '', $withoutDates) ?? '';

        return strlen(trim($withoutDates)) < 8 && $this->hasDateRange($stripped);
    }

    private function isPrimarilyLocationLine(string $line): bool
    {
        if ($this->isBulletLine($line) || $this->hasDateRange($line)) {
            return false;
        }

        return (bool) preg_match('/^[A-Za-z][A-Za-z\s\.\-]{2,40},\s*[A-Za-z][A-Za-z\s]{2,}$/', $line)
            || (bool) preg_match('/^[A-Za-z\s]+,\s*(?:Pakistan|USA|UK|India|UAE|Canada|Australia)\b/i', $line);
    }

    private function hasDateRange(string $line): bool
    {
        return (bool) preg_match(
            '/\b(\d{1,2}\/\d{4}|(?:19|20)\d{2})\b|(?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s+\d{4}|present|current/i',
            $line
        );
    }

    private function looksLikeCompany(string $line): bool
    {
        return (bool) preg_match('/\b(inc|ltd|llc|corp|pvt|limited|technologies|solutions|group|company|co\.)\b/i', $line);
    }

    private function sanitizeTitle(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);
        if ($value === '' || $this->isBulletLine($value)) {
            return null;
        }
        if ($this->isPrimarilyDateLine($value)) {
            return null;
        }
        if (strlen($value) > 120) {
            return mb_substr($value, 0, 120);
        }

        return $value;
    }

    private function isValidExperience(array $exp): bool
    {
        $role = $exp['role_title'] ?? '';
        $company = $exp['company'] ?? '';

        if ($this->isBulletLine($role) || str_starts_with($role, '•')) {
            return false;
        }
        if (strlen($role) > 100 && empty($exp['description'])) {
            return false;
        }
        if ($this->isPrimarilyDateLine($role) && $this->isPrimarilyDateLine($company)) {
            return false;
        }

        return true;
    }

    private function isValidEducation(array $edu): bool
    {
        $degree = $edu['degree'] ?? '';
        $inst = $edu['institution'] ?? '';

        if ($this->isPrimarilyDateLine($degree) && $this->isPrimarilyLocationLine($inst)) {
            return false;
        }
        if ($this->isPrimarilyLocationLine($degree) && $this->isPrimarilyDateLine($inst)) {
            return false;
        }
        if (!$degree && $this->isPrimarilyLocationLine($inst) && empty($edu['field_of_study'])) {
            return false;
        }

        return true;
    }
}
