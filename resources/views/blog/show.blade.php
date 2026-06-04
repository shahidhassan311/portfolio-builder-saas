<x-marketing-layout :seo="$seo" activePage="blog" :show-breadcrumbs="true">
    <main class="max article-wrap">
        <article itemscope itemtype="https://schema.org/Article">
            <header class="article-header">
                <div class="article-byline">
                    <time datetime="{{ $blog->published_at->toIso8601String() }}" itemprop="datePublished">
                        {{ $blog->published_at->format('F d, Y') }}
                    </time>
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
                <img src="{{ asset('storage/' . $blog->image) }}"
                     alt="{{ $blog->title }} — featured image"
                     class="article-img"
                     loading="eager"
                     fetchpriority="high"
                     decoding="async"
                     width="720"
                     height="405"
                     itemprop="image">
            @endif

            <div class="article-content" itemprop="articleBody">
                {!! $blog->content !!}
            </div>
        </article>

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
