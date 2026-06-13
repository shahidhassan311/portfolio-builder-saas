<x-marketing-layout :seo="$seo" activePage="blog" :show-breadcrumbs="true">
    <main class="max">
        <header class="blog-header">
            <span class="section-label">Blog</span>
            <h1>Latest updates</h1>
            <p>Insights, tutorials, and tips to build a portfolio that gets you hired.</p>
        </header>

        <div class="blog-grid">
            @forelse($blogs as $blog)
                <article class="blog-card">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog-img">
                        @if($blog->image)
                            <img src="{{ \App\Support\Seo::assetUrl('storage/' . $blog->image) }}"
                                 alt="{{ $blog->title }} — Resumizo blog"
                                 loading="lazy"
                                 decoding="async"
                                 width="400"
                                 height="200">
                        @else
                            <div class="blog-img-placeholder" aria-hidden="true">R</div>
                        @endif
                    </a>
                    <div class="blog-content">
                        <time class="blog-date" datetime="{{ $blog->published_at->toIso8601String() }}">
                            {{ $blog->published_at->format('M d, Y') }}
                        </time>
                        <h2 class="blog-heading">
                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h2>
                        <p class="blog-excerpt">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 140) }}</p>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link">Read article <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @empty
                <div class="blog-empty">
                    <p>No blog posts published yet. Check back soon for portfolio tips and updates.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to home</a>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <nav class="blog-pagination" aria-label="Blog pagination">
                {{ $blogs->links() }}
            </nav>
        @endif
    </main>
</x-marketing-layout>
