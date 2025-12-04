<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('resumizo-logo-white.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terms & Conditions - Resumizo</title>
    <meta name="description" content="Read the terms and conditions for using Resumizo portfolio builder platform.">
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
        <h1>Terms & Conditions</h1>
        <p class="last-updated">Last Updated: December 4, 2025</p>

        <section>
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using Resumizo ("the Service"), you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to these terms, please do not use the Service.</p>
        </section>

        <section>
            <h2>2. Description of Service</h2>
            <p>Resumizo provides an online platform for creating professional portfolios and resumes. The Service includes access to templates, customization tools, and portfolio hosting.</p>
        </section>

        <section>
            <h2>3. User Accounts</h2>
            <h3>3.1 Registration</h3>
            <p>To use certain features of the Service, you must register for an account. You agree to:</p>
            <ul>
                <li>Provide accurate and complete information</li>
                <li>Maintain the security of your password</li>
                <li>Notify us immediately of any unauthorized use</li>
                <li>Be responsible for all activities under your account</li>
            </ul>

            <h3>3.2 Account Termination</h3>
            <p>We reserve the right to suspend or terminate your account if you violate these terms or engage in fraudulent or illegal activities.</p>
        </section>

        <section>
            <h2>4. User Content</h2>
            <h3>4.1 Your Content</h3>
            <p>You retain all rights to the content you upload to your portfolio. By using the Service, you grant us a license to host, display, and distribute your content as necessary to provide the Service.</p>

            <h3>4.2 Content Guidelines</h3>
            <p>You agree not to upload content that:</p>
            <ul>
                <li>Violates any laws or regulations</li>
                <li>Infringes on intellectual property rights</li>
                <li>Contains malicious code or viruses</li>
                <li>Is defamatory, obscene, or offensive</li>
                <li>Violates the privacy of others</li>
            </ul>
        </section>

        <section>
            <h2>5. Intellectual Property</h2>
            <p>The Service, including all templates, designs, code, and branding, is owned by Resumizo and protected by copyright and other intellectual property laws. You may not copy, modify, or distribute our intellectual property without permission.</p>
        </section>

        <section>
            <h2>6. Payment and Subscriptions</h2>
            <h3>6.1 Free and Paid Plans</h3>
            <p>We offer both free and paid subscription plans. Paid plans are billed on a recurring basis until canceled.</p>

            <h3>6.2 Refunds</h3>
            <p>Refunds are handled on a case-by-case basis. Please contact support for refund requests.</p>

            <h3>6.3 Price Changes</h3>
            <p>We reserve the right to change our pricing. We will notify you in advance of any price changes.</p>
        </section>

        <section>
            <h2>7. Prohibited Uses</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the Service for any illegal purpose</li>
                <li>Attempt to gain unauthorized access to our systems</li>
                <li>Interfere with or disrupt the Service</li>
                <li>Use automated tools to access the Service</li>
                <li>Resell or redistribute the Service</li>
                <li>Impersonate others or provide false information</li>
            </ul>
        </section>

        <section>
            <h2>8. Disclaimer of Warranties</h2>
            <p>The Service is provided "as is" without warranties of any kind, either express or implied. We do not guarantee that the Service will be uninterrupted, secure, or error-free.</p>
        </section>

        <section>
            <h2>9. Limitation of Liability</h2>
            <p>To the maximum extent permitted by law, Resumizo shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of the Service.</p>
        </section>

        <section>
            <h2>10. Indemnification</h2>
            <p>You agree to indemnify and hold harmless Resumizo from any claims, damages, or expenses arising from your use of the Service or violation of these terms.</p>
        </section>

        <section>
            <h2>11. Changes to Terms</h2>
            <p>We reserve the right to modify these terms at any time. We will notify users of significant changes. Continued use of the Service after changes constitutes acceptance of the new terms.</p>
        </section>

        <section>
            <h2>12. Governing Law</h2>
            <p>These terms shall be governed by and construed in accordance with the laws of the jurisdiction in which Resumizo operates.</p>
        </section>

        <section>
            <h2>13. Contact Information</h2>
            <p>If you have questions about these terms, please contact us:</p>
            <ul>
                <li>Email: legal@resumizo.com</li>
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
