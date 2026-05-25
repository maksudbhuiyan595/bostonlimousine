<style>
        /* --- PREMIUM CSS VARIABLES --- */
        :root {
            --premium-gold: #C5A059;
            --premium-gold-light: #D4B87A;
            --premium-gold-dark: #A8883E;
            --premium-black: #1A1A1A;
            --premium-dark: #2C2C2C;
            --premium-gray: #6B6B6B;
            --premium-light: #F8F8F8;
            --transition-smooth: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* --- SECTION STYLES --- */
        .premium-blog-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #FFFFFF 0%, var(--premium-light) 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Pattern */
        .premium-blog-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(var(--premium-gold) 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            opacity: 0.04;
            animation: patternMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes patternMove {
            0% { background-position: 0 0; }
            100% { background-position: 40px 40px; }
        }

        /* Floating Shapes */
        .floating-shape {
            position: absolute;
            background: linear-gradient(135deg, var(--premium-gold-light), transparent);
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.1;
            animation: shapeFloat 10s ease-in-out infinite;
            pointer-events: none;
        }

        .shape-1 { width: 300px; height: 300px; top: -100px; right: -100px; }
        .shape-2 { width: 200px; height: 200px; bottom: 50px; left: -80px; animation-delay: 3s; }

        @keyframes shapeFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        /* --- HEADER STYLES --- */
        .blog-header {
            text-align: center;
            margin-bottom: 70px;
            position: relative;
            z-index: 2;
        }

        .blog-badge {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(197, 160, 89, 0.1);
            backdrop-filter: blur(10px);
            padding: 10px 28px;
            border-radius: 60px;
            margin-bottom: 25px;
            border: 1px solid rgba(197, 160, 89, 0.3);
        }

        .blog-badge i { color: var(--premium-gold); font-size: 1rem; }
        .blog-badge span {
            color: var(--premium-gold-light);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .blog-header h2 {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--premium-black) 0%, var(--premium-dark) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gold-text {
            background: linear-gradient(135deg, var(--premium-gold), var(--premium-gold-light), var(--premium-gold));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .blog-header p {
            color: var(--premium-gray);
            font-size: 1.1rem;
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* --- BLOG GRID (MODERN DESIGN) --- */
        .blog-grid-modern {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .blog-card-modern {
            background: #FFFFFF;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            transition: var(--transition-smooth);
            border: 1px solid rgba(197, 160, 89, 0.12);
            position: relative;
            display: flex;
            flex-direction: column;
            opacity: 0;
            animation: cardReveal 0.7s ease forwards;
        }

        @keyframes cardReveal {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Grid Spans */
        .blog-card-modern:nth-child(1),
        .blog-card-modern:nth-child(2),
        .blog-card-modern:nth-child(3) { grid-column: span 4; }
        .blog-card-modern:nth-child(4) { grid-column: span 3; }
        .blog-card-modern:nth-child(5) { grid-column: span 6; }
        .blog-card-modern:nth-child(6) { grid-column: span 3; }

        .blog-card-modern:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(197, 160, 89, 0.15);
            border-color: rgba(197, 160, 89, 0.3);
        }

        .blog-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 240px;
        }

        .blog-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .blog-card-modern:hover .blog-image { transform: scale(1.08); }

        .category-tag {
            position: absolute;
            top: 20px; left: 20px;
            background: linear-gradient(135deg, var(--premium-gold), var(--premium-gold-dark));
            color: #FFFFFF;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 30px;
            text-transform: uppercase;
            z-index: 3;
        }

        .blog-content-modern {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-title-modern {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--premium-black);
            text-decoration: none;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .blog-title-modern:hover { color: var(--premium-gold); }

        .blog-excerpt-modern {
            color: var(--premium-gray);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-meta-modern {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .read-more-modern {
            color: var(--premium-gold);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 45px;
            border: 2px solid var(--premium-gold);
            border-radius: 60px;
            color: var(--premium-gold);
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 50px;
        }

        .view-all-btn:hover {
            background: var(--premium-gold);
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .blog-grid-modern { display: flex; flex-direction: column; }
            .blog-card-modern { width: 100%; }
        }
        @media (max-width: 768px) {
            .blog-header h2 { font-size: 2.2rem; }
        }
    </style>

    @if(isset($blogs) && $blogs->count() > 0)
    <section class="premium-blog-section">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>

        <div class="container text-center">
            <div class="blog-header">
                <div class="blog-badge">
                    <i class="fas fa-plane-arrival"></i>
                    <span>Logan Airport Updates</span>
                    <i class="fas fa-car"></i>
                </div>
                <h2>Latest <span class="gold-text">Car Service</span> Insights</h2>
                <p>Stay updated with expert travel tips, Boston Logan airport news, and premium transportation guides.</p>
                <div class="animated-underline"></div>
            </div>

            <div class="blog-grid-modern text-start">
                @foreach($blogs as $index => $blog)
                    @php
                        $tagData = is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags ?? '');
                        $displayTag = !empty($tagData[0]) ? trim($tagData[0]) : 'Airport Travel';
                        $wordCount = str_word_count(strip_tags($blog->content));
                        $readingTime = max(1, ceil($wordCount / 200));
                    @endphp

                    <div class="blog-card-modern" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="blog-image-wrapper">
                            <span class="category-tag">{{ $displayTag }}</span>
                            <img src="{{ $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/children.webp') }}" alt="{{ $blog->title }}" class="blog-image">
                            <div style="position: absolute; bottom: 15px; right: 20px; color: #fff; font-size: 0.75rem; background: rgba(0,0,0,0.5); padding: 4px 12px; border-radius: 20px;">
                                <i class="far fa-clock"></i> {{ $readingTime }} min read
                            </div>
                        </div>

                        <div class="blog-content-modern">
                            <a href="{{ route('dynamic.route', $blog->slug) }}" class="blog-title-modern">
                                {{ Str::limit($blog->title, 50) }}
                            </a>
                            <p class="blog-excerpt-modern">
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>
                            <div class="blog-meta-modern">
                                <a href="{{ route('dynamic.route', $blog->slug) }}" class="read-more-modern">
                                    Read Full Article <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <span style="font-size: 0.8rem; color: #999;">
                                    {{ \Carbon\Carbon::parse($blog->published_at ?? $blog->created_at)->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('blogs') }}" class="view-all-btn">
                View All Airport Insights <i class="fas fa-long-arrow-alt-right"></i>
            </a>
        </div>
    </section>
    @endif
