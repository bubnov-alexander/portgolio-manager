<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->getTitle() }} | Портфолио</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home-header.js'])
</head>
<body class="hero-page text-slate-100 antialiased">
    @include('appSection@authentication::partials.site-header', [
        'headerBrand' => $headerBrand,
        'activeNav' => $activeNav,
    ])

    <main class="relative min-h-screen overflow-hidden">
        <div class="hero-noise"></div>
        <div class="hero-glow hero-glow-a"></div>
        <div class="hero-glow hero-glow-b"></div>

        <section class="relative z-10 mx-auto w-full max-w-6xl px-4 pb-8 pt-28 sm:px-6 lg:px-8 lg:pt-32">
            <div class="section-shell">
                <a href="{{ route('portfolio.index') }}" class="btn-secondary">← К проектам</a>

                <h1 class="mt-5 text-2xl font-extrabold text-white sm:text-3xl lg:text-4xl">{{ $project->getTitle() }}</h1>

                <div class="mt-4 flex flex-wrap gap-2">
                    @if($project->getGithubUrl())
                        <a href="{{ $project->getGithubUrl() }}" target="_blank" rel="noreferrer" class="btn-secondary">GitHub</a>
                    @endif
                    @if($project->getPreviewUrl())
                        <a href="{{ $project->getPreviewUrl() }}" target="_blank" rel="noreferrer" class="btn-primary">Preview</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="section-shell space-y-6">
                @if(count($galleryUrls) > 0)
                    <div class="space-y-4">
                        <div class="relative overflow-hidden rounded-xl border border-white/15 bg-slate-950/45">
                            <img
                                id="project-slide"
                                src="{{ $galleryUrls[0] }}"
                                alt="Preview for {{ $project->getTitle() }}"
                                class="h-60 w-full object-cover sm:h-80 lg:h-[26rem]"
                            >

                            <button
                                type="button"
                                id="slide-prev"
                                aria-label="Previous slide"
                                class="absolute left-3 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/25 bg-slate-950/80 text-slate-100 transition hover:border-white/45 hover:bg-white/[0.12]"
                            >
                                ←
                            </button>

                            <button
                                type="button"
                                id="slide-next"
                                aria-label="Next slide"
                                class="absolute right-3 top-1/2 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/25 bg-slate-950/80 text-slate-100 transition hover:border-white/45 hover:bg-white/[0.12]"
                            >
                                →
                            </button>
                        </div>

                        <div class="flex items-center gap-2" id="slide-dots"></div>
                    </div>
                @elseif($coverUrl !== '')
                    <div class="relative overflow-hidden rounded-xl border border-white/15 bg-slate-950/45">
                        <img
                            src="{{ $coverUrl }}"
                            alt="Preview for {{ $project->getTitle() }}"
                            class="h-60 w-full object-cover sm:h-80 lg:h-[26rem]"
                        >
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
                    <article class="content-card">
                        <h2 class="text-lg font-semibold text-white">Описание проекта</h2>
                        <p class="mt-3 text-sm leading-7 text-white/80 sm:text-base">{{ $project->getFullDescription() ?: $project->getShortDescription() }}</p>

                        <h3 class="mt-6 text-lg font-semibold text-white">Что я сделал</h3>
                        <ul class="mt-3 grid gap-2 text-sm leading-7 text-white/85 sm:text-base">
                            @forelse($project->getFeatures() as $feature)
                                <li class="rounded-xl border border-white/15 bg-white/[0.04] px-3 py-2">{{ $feature->getTitle() }}</li>
                            @empty
                                <li class="rounded-xl border border-white/15 bg-white/[0.04] px-3 py-2 text-white/65">Список задач пока не заполнен.</li>
                            @endforelse
                        </ul>
                    </article>

                    <aside class="content-card">
                        <h3 class="text-lg font-semibold text-white">Стек</h3>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @forelse($project->getTechnologies() as $technology)
                                <span class="project-stack !mt-0">{{ $technology->getName() }}</span>
                            @empty
                                <span class="text-sm text-white/65">Технологии не указаны.</span>
                            @endforelse
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>

    @if(count($galleryUrls) > 1)
        <script>
            (() => {
                const images = @json($galleryUrls);
                const slide = document.getElementById('project-slide');
                const prevButton = document.getElementById('slide-prev');
                const nextButton = document.getElementById('slide-next');
                const dotsContainer = document.getElementById('slide-dots');

                if (!slide || !prevButton || !nextButton || !dotsContainer || !images.length) {
                    return;
                }

                let current = 0;

                const renderDots = () => {
                    dotsContainer.innerHTML = '';
                    images.forEach((_, index) => {
                        const dot = document.createElement('button');
                        dot.type = 'button';
                        dot.className = `h-2.5 w-2.5 rounded-full transition ${index === current ? 'bg-violet-200' : 'bg-white/30 hover:bg-white/50'}`;
                        dot.setAttribute('aria-label', `Slide ${index + 1}`);
                        dot.addEventListener('click', () => {
                            current = index;
                            updateSlide();
                        });
                        dotsContainer.appendChild(dot);
                    });
                };

                const updateSlide = () => {
                    slide.src = images[current];
                    renderDots();
                };

                prevButton.addEventListener('click', () => {
                    current = (current - 1 + images.length) % images.length;
                    updateSlide();
                });

                nextButton.addEventListener('click', () => {
                    current = (current + 1) % images.length;
                    updateSlide();
                });

                updateSlide();
            })();
        </script>
    @endif
</body>
</html>
