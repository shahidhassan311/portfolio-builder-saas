<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Smalot\PdfParser\Parser as PdfParser;

class ResumeParser
{
    private const SECTION_HEADERS = [
        'experience' => '/^(?:work\s+)?experience$|^employment$|^professional\s+experience$|^career$|^work\s+history$/i',
        'education' => '/^education$|^academic$|^qualifications$/i',
        'skills' => '/^(?:technical\s+)?skills$|^core\s+competencies$|^technologies$|^expertise$/i',
        'summary' => '/^(?:professional\s+)?summary$|^profile$|^about\s+me$|^objective$/i',
    ];

    private const SKILL_KEYWORDS = [
        'PHP', 'Laravel', 'JavaScript', 'TypeScript', 'React', 'Vue', 'Angular', 'Node.js',
        'Python', 'Django', 'Java', 'Spring', 'C#', '.NET', 'SQL', 'MySQL', 'PostgreSQL',
        'MongoDB', 'Redis', 'AWS', 'Docker', 'Kubernetes', 'Git', 'HTML', 'CSS', 'Tailwind',
        'Figma', 'UI/UX', 'REST API', 'GraphQL', 'Linux', 'Agile', 'Scrum', 'CI/CD',
    ];

    private const DEGREE_PATTERN = '/\b(bachelor|master|b\.?\s*s\.?|b\.?\s*a\.?|m\.?\s*s\.?|m\.?\s*a\.?|mba|ph\.?\s*d\.?|diploma|associate|bsc|msc|bachelors?|masters?)\b/i';

    private const INSTITUTION_PATTERN = '/\b(university|college|institute|school|academy|polytechnic)\b/i';

    public function extractText(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        return match ($extension) {
            'pdf' => $this->extractFromPdf($file->getRealPath()),
            'txt' => trim(file_get_contents($file->getRealPath()) ?: ''),
            default => throw new \InvalidArgumentException('Unsupported file type. Please upload PDF or TXT.'),
        };
    }

    public function parse(string $text): array
    {
        $text = $this->normalizeText($text);
        $lines = array_values(array_filter(array_map('trim', explode("\n", $text))));

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
            'educations' => $this->extractEducations($sections),
        ];
    }

    private function extractFromPdf(string $path): string
    {
        $parser = new PdfParser();
        $pdf = $parser->parseFile($path);

        return trim($pdf->getText());
    }

    private function normalizeText(string $text): string
    {
        $text = preg_replace("/\r\n?/", "\n", $text) ?? $text;
        $text = preg_replace("/[ \t]+/", ' ', $text) ?? $text;
        $text = preg_replace("/\n{3,}/", "\n\n", $text) ?? $text;
        // Fix PDF bullets glued to text
        $text = preg_replace('/([a-zA-Z0-9])•/', "$1\n•", $text) ?? $text;
        $text = preg_replace('/•\s*/', "\n• ", $text) ?? $text;

        return trim($text);
    }

    private function splitSections(array $lines): array
    {
        $sections = ['summary' => [], 'skills' => [], 'experience' => [], 'education' => [], 'other' => []];
        $current = 'other';

        foreach ($lines as $line) {
            $matched = false;
            foreach (self::SECTION_HEADERS as $key => $pattern) {
                if (preg_match($pattern, $line) && strlen($line) < 60) {
                    $current = $key;
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $sections[$current][] = $line;
            }
        }

        return $sections;
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
            $parts = preg_split('/[,|•·\|\/]/', $blob) ?: [];
            foreach ($parts as $part) {
                $name = trim($part);
                if (strlen($name) >= 2 && strlen($name) <= 40 && !isset($seen[strtolower($name)])) {
                    $seen[strtolower($name)] = true;
                    $skills[] = ['name' => $name, 'level' => $this->guessSkillLevel($name)];
                }
            }
        }

        foreach (self::SKILL_KEYWORDS as $keyword) {
            if (stripos($text, $keyword) !== false && !isset($seen[strtolower($keyword)])) {
                $seen[strtolower($keyword)] = true;
                $skills[] = ['name' => $keyword, 'level' => 'Intermediate'];
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
        $lines = $sections['experience'];
        if (empty($lines)) {
            return [];
        }

        $experiences = [];
        foreach ($this->splitEntryBlocks($lines, 'experience') as $block) {
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

        // Merge orphan bullets or date-only lines into previous block
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

        // Two-line header: role then company (or reverse)
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

        // Assign remaining lines
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
            if ($this->isPrimarilyDateLine($left)) {
                return ['role' => null, 'company' => null];
            }
            if ($this->isPrimarilyLocationLine($right)) {
                return ['role' => $left, 'company' => null];
            }

            return ['role' => $left, 'company' => $right];
        }

        foreach ([' at ', ' @ ', ' | '] as $sep) {
            if (str_contains($line, $sep)) {
                [$role, $company] = array_map('trim', explode($sep, $line, 2));

                return ['role' => $role, 'company' => $company];
            }
        }

        if (preg_match('/^(.+?)\s*[-–—]\s*(.+)$/', $line, $m) && !$this->isPrimarilyDateLine($line)) {
            $left = trim($m[1]);
            $right = trim($m[2]);
            if (!$this->hasDateRange($right) && strlen($right) < 80) {
                return ['role' => $left, 'company' => $right];
            }
        }

        return ['role' => $line, 'company' => null];
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

        // MM/YYYY - MM/YYYY or Present
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

        // Jan 2023 - Dec 2024 / Present
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

        // 2012 – 2016 or 2012 - Present
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

        // Line is mostly years/dates
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
