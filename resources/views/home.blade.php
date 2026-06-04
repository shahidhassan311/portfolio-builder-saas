<x-marketing-layout :seo="$seo" activePage="home">
@php
    $templatesCount = isset($themes) ? $themes->count() : 5;
@endphp
    <main>
        <section class="hero" id="hero">
            <div class="hero-glow" aria-hidden="true"></div>
            <div class="max hero-content">
                <div>
                    <p class="badge badge--highlight">
                        <x-marketing-icon name="spark" />
                        Portfolio + PDF · No code required
                    </p>
                    <h1 class="hero-title">
                        The fastest way to ship a <em>hire-ready portfolio</em>
                    </h1>
                    <p class="hero-sub">
                        Pick a polished template, add your story, and publish a live site plus matching PDF — built for recruiters, not designers.
                    </p>
                    <div class="hero-badges">
                        <span class="badge"><x-marketing-icon name="check" /> Unlimited edits</span>
                        <span class="badge"><x-marketing-icon name="preview" /> Live preview</span>
                        <span class="badge"><x-marketing-icon name="pdf" /> One-click PDF</span>
                    </div>
                    <div class="nav-actions">
                        <a href="#themes" class="btn btn-primary btn-lg">Browse templates</a>
                        <a href="{{ route('register') }}" class="btn btn-outline btn-lg">Start free</a>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="browser">
                        <div class="browser-chrome">
                            <div class="browser-dots"><span></span><span></span><span></span></div>
                            <div class="browser-url">you.resumizo.com</div>
                        </div>
                        <div class="browser-body">
                            <div class="mock-profile">
                                <div class="mock-avatar" aria-hidden="true"></div>
                                <div class="mock-info">
                                    <h4>Your Name</h4>
                                    <p>Product Designer · Open to work</p>
                                </div>
                            </div>
                            <div class="mock-tags">
                                <span class="mock-tag">Live portfolio</span>
                                <span class="mock-tag">PDF export</span>
                                <span class="mock-tag">Mobile ready</span>
                            </div>
                            <div class="mock-blocks" style="margin-top:20px;">
                                <div class="mock-block"></div>
                                <div class="mock-block"></div>
                                <div class="mock-block"></div>
                                <div class="mock-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-card">
                        <x-marketing-icon name="check" />
                        PDF exported
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span>Users</span>
                            <strong>12K+</strong>
                        </div>
                        <div class="hero-stat">
                            <span>Templates</span>
                            <strong>{{ $templatesCount }}+</strong>
                        </div>
                        <div class="hero-stat">
                            <span>Exports</span>
                            <strong>48K</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="trust-bar">
            <div class="max">
                <p>Built for people who need a professional presence — fast</p>
                <div class="trust-chips">
                    <span class="trust-chip">Fresh graduates</span>
                    <span class="trust-chip">Freelancers</span>
                    <span class="trust-chip">Designers</span>
                    <span class="trust-chip">Developers</span>
                    <span class="trust-chip">Career switchers</span>
                </div>
            </div>
        </section>

        <section id="features" class="section--alt">
            <div class="max">
                <div class="section-head">
                    <span class="section-label">Product</span>
                    <h2>Everything you need to get hired</h2>
                    <p class="section-sub">A focused portfolio builder — no bloated page builders, no code. Ship a recruiter-ready site in one afternoon.</p>
                </div>
                <div class="features-grid">
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="templates" /></div>
                        <h3>Premium templates</h3>
                        <p>Professional layouts tuned for screen and PDF — switch themes without rewriting content.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="preview" /></div>
                        <h3>Live preview</h3>
                        <p>Edit your story and see changes instantly. What you build is what recruiters see.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="pdf" /></div>
                        <h3>PDF export</h3>
                        <p>Download a matching PDF for applications. Web portfolio and resume stay in sync.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="link" /></div>
                        <h3>Shareable link</h3>
                        <p>One link for email, LinkedIn, and applications — always up to date.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="lock" /></div>
                        <h3>Your data, your control</h3>
                        <p>Update anytime from your dashboard. No lock-in on a single design.</p>
                    </article>
                    <article class="feature-card">
                        <div class="feature-icon"><x-marketing-icon name="mobile" /></div>
                        <h3>Mobile-ready</h3>
                        <p>Every theme looks sharp on phones — where many recruiters first look.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="how">
            <div class="max">
                <div class="section-head">
                    <span class="section-label">Process</span>
                    <h2>How it works</h2>
                    <p class="section-sub">Three steps and you’re portfolio-ready. Students, freshers, freelancers — anyone can launch.</p>
                </div>
                <div class="steps">
                    <div class="step-card">
                        <div class="step-num">01</div>
                        <h3>Pick a template</h3>
                        <p>Choose from clean, PDF-friendly layouts for designers, developers, or fresh graduates.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-num">02</div>
                        <h3>Add your story</h3>
                        <p>Fill simple sections — about, skills, projects, experience — no complicated settings.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-num">03</div>
                        <h3>Publish & export</h3>
                        <p>Share your live link and download a matching PDF whenever you update.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="themes" class="section--alt">
            <div class="max">
                <div class="section-head">
                    <span class="section-label">Templates</span>
                    <h2>Choose your theme</h2>
                    <p class="section-sub">Switch anytime — your content stays intact across every layout.</p>
                </div>

                @if(isset($themes) && $themes->count())
                    <div class="themes-grid">
                        @foreach($themes as $theme)
                            @php
                                $preview = $theme->preview_image;
                                if ($preview) {
                                    $isUrl = filter_var($preview, FILTER_VALIDATE_URL);
                                    $previewUrl = $isUrl ? $preview : asset('storage/' . $preview);
                                } else {
                                    $previewUrl = 'https://colorlib.com/wp/wp-content/uploads/sites/2/rezume-free-template-353x278.jpg.avif';
                                }
                            @endphp

                            <article class="theme-card">
                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank">
                                    <div class="theme-preview">
                                        <img src="{{ $previewUrl }}" 
                                             alt="{{ $theme->name }} - Professional portfolio template preview" 
                                             loading="lazy"
                                             width="400"
                                             height="300">
                                    </div>
                                </a>
                                <h4>{{ $theme->name }}</h4>
                                <span class="theme-desc">{{ $theme->description ?? 'A clean, modern portfolio layout.' }}</span>

                                <div class="theme-actions">
                                    {{-- Preview button --}}
                                    <a class="pill" href="{{ route('preview.theme', $theme->id) }}" target="_blank">
                                        Preview
                                    </a>

                                    {{-- Use / Get started with this theme --}}
                                    @auth
                                        <form method="GET" action="{{ route('select.theme', $theme->id) }}" style="flex:1;">
                                            @csrf
                                            <button type="submit" class="pill primary" style="width:100%; cursor:pointer;">
                                                Use this theme
                                            </button>
                                        </form>
                                    @else
                                        <a class="pill primary" href="{{ route('select.theme', $theme->id) }}">
                                            Get started
                                        </a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="section-sub">No themes are available yet. Please check back soon — new layouts are coming.</p>
                @endif
            </div>
        </section>

        <section id="about">
            <div class="max about-panel">
                <div class="about-content">
                    <div>
                        <span class="section-label">About</span>
                        <h2>Portfolio builder for real careers</h2>
                        <p class="section-sub" style="margin-bottom:28px;">Designed for people who want a polished presence without hiring designers or writing code.</p>
                        <div class="point">
                            <div class="point-icon"><x-marketing-icon name="templates" /></div>
                            <div>
                                <strong>Template driven</strong>
                                <p style="margin:6px 0 0; color:var(--text-muted); font-size:14px;">Modern layouts optimized for PDF and responsive web.</p>
                            </div>
                        </div>
                        <div class="point">
                            <div class="point-icon"><x-marketing-icon name="swap" /></div>
                            <div>
                                <strong>Switch anytime</strong>
                                <p style="margin:6px 0 0; color:var(--text-muted); font-size:14px;">Update once, publish everywhere. Theme changes keep content aligned.</p>
                            </div>
                        </div>
                        <div class="point">
                            <div class="point-icon"><x-marketing-icon name="target" /></div>
                            <div>
                                <strong>Built for job hunts</strong>
                                <p style="margin:6px 0 0; color:var(--text-muted); font-size:14px;">Share a live link in emails, export PDF for HR — both stay in sync.</p>
                            </div>
                        </div>
                    </div>
                    <div class="about-card">
                        <h3 style="font-family:var(--font-display); margin:0 0 12px;">Ship once, reuse everywhere</h3>
                        <p style="color:var(--text-muted); margin:0 0 24px; font-size:15px;">Live site, downloadable PDF, and share-ready profile link.</p>
                        <div class="stats-row">
                            <div>
                                <span style="color:var(--text-dim); font-size:12px;">Live portfolios</span>
                                <strong>24k</strong>
                            </div>
                            <div>
                                <span style="color:var(--text-dim); font-size:12px;">Avg. build time</span>
                                <strong>12 min</strong>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%; margin-top:28px;">Start your free portfolio</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="section--alt">
            <div class="max">
                <div class="section-head">
                    <span class="section-label">Social proof</span>
                    <h2>Loved by people building their careers</h2>
                    <p class="section-sub">Real outcomes from a simple workflow — pick a template, fill your story, share your link.</p>
                </div>
                <div class="testimonials-grid">
                    @foreach([
                        ['quote' => 'I had a portfolio live in under 20 minutes. The PDF export saved me when HR asked for a resume attachment.', 'initials' => 'AK', 'name' => 'Aisha Khan', 'role' => 'UX Designer · Freelance'],
                        ['quote' => 'As a fresher I didn\'t know where to start. The templates made me look professional without hiring anyone.', 'initials' => 'RM', 'name' => 'Rahul Mehta', 'role' => 'Software Engineer · Graduate'],
                        ['quote' => 'Switching themes without losing my projects was huge. I tested two looks before sending applications.', 'initials' => 'SL', 'name' => 'Sofia Lopez', 'role' => 'Product Manager'],
                    ] as $t)
                    <article class="testimonial-card">
                        <div class="stars" aria-hidden="true">
                            @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote>“{{ $t['quote'] }}”</blockquote>
                        <div class="testimonial-author">
                            <div class="author-avatar">{{ $t['initials'] }}</div>
                            <div class="author-meta">
                                <strong>{{ $t['name'] }}</strong>
                                <span>{{ $t['role'] }}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="pricing">
            <div class="max">
                <div class="section-head" style="margin:0 auto; text-align:center; max-width:560px;">
                    <span class="section-label">Pricing</span>
                    <h2>Start free, upgrade when you need more</h2>
                    <p class="section-sub" style="margin-left:auto; margin-right:auto;">No credit card to begin. Build and publish your portfolio today.</p>
                </div>
                <div class="pricing-grid">
                    <article class="pricing-card">
                        <h3>Free</h3>
                        <p class="pricing-desc">Perfect to launch your first portfolio</p>
                        <div class="pricing-price">$0 <small>/ forever</small></div>
                        <ul class="pricing-features">
                            <li>All portfolio templates</li>
                            <li>Live portfolio link</li>
                            <li>PDF export</li>
                            <li>Unlimited content edits</li>
                            <li>Theme switching</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%;">Get started free</a>
                    </article>
                    <article class="pricing-card featured">
                        <span class="pricing-badge">Coming soon</span>
                        <h3>Pro</h3>
                        <p class="pricing-desc">For serious job hunts & client work</p>
                        <div class="pricing-price" style="font-size:1.75rem;">Launching soon</div>
                        <ul class="pricing-features">
                            <li>Everything in Free</li>
                            <li>Custom domain support</li>
                            <li>Priority PDF quality</li>
                            <li>Remove branding</li>
                            <li>Priority email support</li>
                        </ul>
                        <a href="{{ url('/') }}#contact" class="btn btn-primary" style="width:100%;">Join waitlist</a>
                    </article>
                    <article class="pricing-card">
                        <h3>Teams</h3>
                        <p class="pricing-desc">Bootcamps, agencies & career centers</p>
                        <div class="pricing-price" style="font-size:2rem;">Custom</div>
                        <ul class="pricing-features">
                            <li>Bulk student accounts</li>
                            <li>Shared template library</li>
                            <li>Admin dashboard</li>
                            <li>Onboarding support</li>
                        </ul>
                        <a href="{{ url('/') }}#contact" class="btn btn-outline" style="width:100%;">Contact sales</a>
                    </article>
                </div>
            </div>
        </section>

        <section id="why" class="section--alt">
            <div class="max">
                <div class="section-head">
                    <span class="section-label">Benefits</span>
                    <h2>Why people like using it</h2>
                    <p class="section-sub">Straightforward steps, recruiter-friendly exports, no hidden paywalls.</p>
                </div>
                <div class="why-grid">
                    <div class="why-card">
                        <h3>Designed for clarity</h3>
                        <ul>
                            <li>No complicated settings — just the fields recruiters expect.</li>
                            <li>Modern typography tuned for screen and PDF.</li>
                            <li>Themes handle the polish; you focus on content.</li>
                        </ul>
                    </div>
                    <div class="why-card">
                        <h3>Built for speed</h3>
                        <ul>
                            <li>Live preview updates instantly.</li>
                            <li>One-click PDF export for every theme.</li>
                            <li>Keep everything in sync across devices.</li>
                        </ul>
                    </div>
                    <div class="why-card">
                        <h3>Ready to get hired</h3>
                        <ul>
                            <li>Share a link recruiters skim faster than attachments.</li>
                            <li>Look professional on first impression.</li>
                            <li>Update once — site and PDF stay aligned.</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%; margin-top:24px;">Start free</a>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="max">
                <div class="cta-banner">
                    <h2>Your next role starts with a better portfolio</h2>
                    <p>Join thousands who ship a professional site and PDF in minutes — not weeks.</p>
                    <div class="cta-actions">
                        <a href="{{ route('register') }}" class="btn btn-primary">Create free account</a>
                        <a href="#themes" class="btn btn-outline">Browse templates</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="faq-section section--alt">
            <div class="max">
                <div class="section-head" style="margin:0 auto; text-align:center; max-width:560px;">
                    <span class="section-label">FAQ</span>
                    <h2>Frequently asked questions</h2>
                    <p class="section-sub">Quick answers about building your portfolio and resume with Resumizo.</p>
                </div>
                <div class="faq-list">
                    @foreach(config('seo.home_faq', []) as $faq)
                        <details class="faq-item">
                            <summary>{{ $faq['question'] }}</summary>
                            <p class="faq-answer">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="max">
                <div class="section-head" style="margin:0 auto; text-align:center; max-width:520px;">
                    <span class="section-label">Support</span>
                    <h2>Get in touch</h2>
                    <p class="section-sub" style="margin-left:auto; margin-right:auto;">
                        Questions or feedback? Email <a href="mailto:support@resumizo.com" style="color:var(--cyan);">support@resumizo.com</a> or use the form below.
                    </p>
                </div>
                <div class="contact-container">
                    <div class="contact-form-wrapper">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-error">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Your full name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a topic</option>
                                    <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="billing" {{ old('subject') == 'billing' ? 'selected' : '' }}>Billing Question</option>
                                    <option value="feature" {{ old('subject') == 'feature' ? 'selected' : '' }}>Feature Request</option>
                                    <option value="bug" {{ old('subject') == 'bug' ? 'selected' : '' }}>Report a Bug</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="5" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-marketing-layout>

