<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('resumizo-logo-white.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Privacy Policy - Resumizo</title>
    <meta name="description" content="Learn how Resumizo collects, uses, and protects your personal information. Your privacy is important to us.">
    <meta name="robots" content="noindex, nofollow">

    @vite(['resources/js/app.js'])
    <style>
        :root {
            --bg: #050914;
            --card: rgba(8,12,26,0.9);
            --text: #f3f6ff;
            --text-muted: rgba(243,246,255,0.7);
            --accent: #5d6bff;
            --accent-2: #9c5bff;
            --accent-3: #31c9ff;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 15% -20%, rgba(134,118,255,0.4), transparent 45%),
                radial-gradient(circle at 85% -10%, rgba(49,201,255,0.35), transparent 45%),
                #030711;
            color: var(--text);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .page { min-height: 100vh; display: flex; flex-direction: column; }
        .max { max-width: 1180px; margin: 0 auto; padding: 0 24px; }
        header.nav {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(3,7,17,0.85);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .nav-content { height: 74px; display: flex; align-items: center; justify-content: space-between; }
        .logo img { height: 200px; width: 200px; display: block; }
        .btn {
            border: none; border-radius: 999px;
            padding: 12px 24px; font-size: 14px;
            font-weight: 600; cursor: pointer; transition: all .2s ease;
        }
        .btn-primary {
            background: linear-gradient(130deg, var(--accent), var(--accent-2));
            color: #fff; box-shadow: 0 15px 40px rgba(93,107,255,0.4);
        }
        .legal-page {
            max-width: 900px;
            margin: 60px auto 80px;
            padding: 0 24px;
        }
        .legal-page h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #f3f6ff;
        }
        .last-updated {
            font-size: 14px;
            color: rgba(243, 246, 255, 0.5);
            margin-bottom: 48px;
        }
        .legal-page section {
            margin-bottom: 40px;
        }
        .legal-page h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #f3f6ff;
            margin-top: 32px;
        }
        .legal-page h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            margin-top: 24px;
            color: #f3f6ff;
        }
        .legal-page p {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(243, 246, 255, 0.7);
            margin-bottom: 16px;
        }
        .legal-page ul {
            margin: 16px 0;
            padding-left: 24px;
        }
        .legal-page li {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(243, 246, 255, 0.7);
            margin-bottom: 8px;
        }
        .legal-page a {
            color: #31c9ff;
            text-decoration: none;
        }
        .legal-page a:hover {
            text-decoration: underline;
        }
        footer { border-top: 1px solid rgba(255,255,255,0.08); padding: 40px 0; margin-top: auto; color: var(--text-muted); }
        .footer-content { display: flex; flex-direction: column; align-items: center; gap: 12px; text-align: center; }
        .footer-content p { margin: 0; }
        .footer-links { display: flex; align-items: center; gap: 12px; font-size: 14px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--accent-3); }
        .footer-links .separator { color: rgba(255,255,255,0.3); }
    </style>
</head>
<body>
<div class="page">
    <header class="nav">
        <div class="max nav-content">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('resumizo-logo-white.png') }}" alt="Resumizo Logo">
                </a>
            </div>
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </header>

    <main class="legal-page">
        <h1>Privacy Policy</h1>
        <p class="last-updated">Last Updated: December 4, 2025</p>

        <section>
            <h2>1. Introduction</h2>
            <p>Welcome to Resumizo ("we," "our," or "us"). We respect your privacy and are committed to protecting your personal data. This privacy policy explains how we collect, use, and safeguard your information when you use our portfolio builder platform.</p>
        </section>

        <section>
            <h2>2. Information We Collect</h2>
            <h3>2.1 Information You Provide</h3>
            <ul>
                <li>Account information (name, email, password)</li>
                <li>Portfolio content (bio, projects, skills, experience, education)</li>
                <li>Contact information</li>
                <li>Payment information (if applicable)</li>
            </ul>

            <h3>2.2 Automatically Collected Information</h3>
            <ul>
                <li>Usage data and analytics</li>
                <li>Device and browser information</li>
                <li>IP address and location data</li>
                <li>Cookies and similar technologies</li>
            </ul>
        </section>

        <section>
            <h2>3. How We Use Your Information</h2>
            <p>We use your information to:</p>
            <ul>
                <li>Provide and improve our services</li>
                <li>Create and manage your portfolio</li>
                <li>Communicate with you about updates and support</li>
                <li>Analyze usage patterns and improve user experience</li>
                <li>Prevent fraud and ensure security</li>
                <li>Comply with legal obligations</li>
            </ul>
        </section>

        <section>
            <h2>4. Information Sharing</h2>
            <p>We do not sell your personal information. We may share your data with:</p>
            <ul>
                <li>Service providers (hosting, analytics, payment processing)</li>
                <li>Legal authorities when required by law</li>
                <li>Business partners with your consent</li>
            </ul>
        </section>

        <section>
            <h2>5. Data Security</h2>
            <p>We implement industry-standard security measures to protect your data, including encryption, secure servers, and regular security audits. However, no method of transmission over the internet is 100% secure.</p>
        </section>

        <section>
            <h2>6. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal data</li>
                <li>Correct inaccurate information</li>
                <li>Delete your account and data</li>
                <li>Export your data</li>
                <li>Opt-out of marketing communications</li>
                <li>Object to data processing</li>
            </ul>
        </section>

        <section>
            <h2>7. Cookies</h2>
            <p>We use cookies to enhance your experience, analyze usage, and remember your preferences. You can control cookies through your browser settings.</p>
        </section>

        <section>
            <h2>8. Children's Privacy</h2>
            <p>Our service is not intended for users under 13 years of age. We do not knowingly collect information from children.</p>
        </section>

        <section>
            <h2>9. Changes to This Policy</h2>
            <p>We may update this privacy policy periodically. We will notify you of significant changes via email or through our platform.</p>
        </section>

        <section>
            <h2>10. Contact Us</h2>
            <p>If you have questions about this privacy policy, please contact us:</p>
            <ul>
                <li>Email: privacy@resumizo.com</li>
                <li>Contact Form: <a href="{{ url('/#contact') }}">{{ url('/#contact') }}</a></li>
            </ul>
        </section>
    </main>

    <footer>
        <div class="max">
            <div class="footer-content">
                <p>&copy; 2025 Resumizo. All rights reserved.</p>
                <div class="footer-links">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <span class="separator">•</span>
                    <a href="{{ route('terms') }}">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
