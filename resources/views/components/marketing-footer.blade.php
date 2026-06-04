<footer>
    <div class="max">
        <div class="footer-grid">
            <div class="footer-brand">
                <x-brand-logo />
                <p>Build a professional portfolio and resume website in minutes. No code required.</p>
            </div>
            <div class="footer-col">
                <h4>Product</h4>
                <ul>
                    <li><a href="{{ url('/') }}#features">Features</a></li>
                    <li><a href="{{ url('/') }}#themes">Templates</a></li>
                    <li><a href="{{ url('/') }}#pricing">Pricing</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ url('/resume-templates') }}">Resume templates</a></li>
                    <li><a href="{{ url('/resume-examples') }}">Resume examples</a></li>
                    <li><a href="{{ url('/ats-resume') }}">ATS resume guide</a></li>
                    <li><a href="{{ url('/cover-letters') }}">Cover letters</a></li>
                    <li><a href="{{ url('/job-resumes') }}">Job-specific resumes</a></li>
                    <li><a href="{{ url('/') }}#faq">FAQ</a></li>
                    <li><a href="{{ url('/') }}#how">How it works</a></li>
                    <li><a href="{{ url('/') }}#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p style="margin:0;">&copy; {{ date('Y') }} Resumizo. All rights reserved.</p>
            <div class="footer-links">
                <a href="{{ route('privacy') }}">Privacy</a>
                <span class="separator">•</span>
                <a href="{{ route('terms') }}">Terms</a>
            </div>
        </div>
    </div>
</footer>

<x-webchat-widget />
