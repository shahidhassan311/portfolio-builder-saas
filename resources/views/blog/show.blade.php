<x-marketing-layout :seo="$seo" activePage="blog" :show-breadcrumbs="true">
    <main class="max article-wrap">
        <article itemscope itemtype="https://schema.org/BlogPosting">
            <header class="article-header">
                <div class="article-byline">
                    <time datetime="{{ $blog->published_at->toIso8601String() }}" itemprop="datePublished">
                        Published {{ $blog->published_at->format('F d, Y') }}
                    </time>
                    @if($blog->updated_at->gt($blog->published_at))
                        <span aria-hidden="true">·</span>
                        <time datetime="{{ $blog->updated_at->toIso8601String() }}" itemprop="dateModified">
                            Updated {{ $blog->updated_at->format('F d, Y') }}
                        </time>
                    @endif
                    <span aria-hidden="true">·</span>
                    <span>{{ $readingTime }} min read</span>
                    @if($blog->user)
                        <span aria-hidden="true">·</span>
                        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <span itemprop="name">{{ $blog->user->name }}</span>
                        </span>
                    @endif
                </div>
                <h1 class="article-title" itemprop="headline">{{ $blog->title }}</h1>
            </header>

            @if($blog->image)
                <img src="{{ \App\Support\Seo::assetUrl('storage/' . $blog->image) }}"
                     alt="{{ $blog->title }} — featured image"
                     class="article-img"
                     loading="eager"
                     fetchpriority="high"
                     decoding="async"
                     width="720"
                     height="405"
                     itemprop="image">
            @endif

            @if(count($tableOfContents) >= 3)
                <nav class="article-toc" aria-labelledby="toc-heading">
                    <h2 id="toc-heading">Table of contents</h2>
                    <ol>
                        @foreach($tableOfContents as $item)
                            <li class="article-toc-level-{{ $item['level'] }}">
                                <a href="#{{ $item['id'] }}">{{ $item['text'] }}</a>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            <div class="article-content" itemprop="articleBody">
                {!! $contentHtml !!}
            </div>

            <meta itemprop="dateModified" content="{{ $blog->updated_at->toIso8601String() }}">
        </article>

        @if(!empty($faqItems))
            <section class="article-faq" aria-labelledby="faq-heading">
                <h2 id="faq-heading">Frequently asked questions</h2>
                <div class="faq-list">
                    @foreach($faqItems as $faq)
                        <details class="faq-item">
                            <summary>{{ $faq['question'] }}</summary>
                            <p class="faq-answer">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </section>
        @endif

        @if($relatedBlogs->isNotEmpty())
            <section class="related-articles" aria-labelledby="related-posts-heading">
                <h2 id="related-posts-heading">Related articles</h2>
                <div class="blog-grid">
                    @foreach($relatedBlogs as $related)
                        <article class="blog-card">
                            <div class="blog-content">
                                <h3 class="blog-heading" style="font-size:1rem;">
                                    <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                </h3>
                                <p class="blog-excerpt">{{ Str::limit($related->excerpt ?? strip_tags($related->content), 100) }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <a href="{{ route('blog.index') }}" class="article-footer-link">← More articles</a>
    </main>
</x-marketing-layout>
