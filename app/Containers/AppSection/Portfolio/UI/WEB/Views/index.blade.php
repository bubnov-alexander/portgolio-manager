<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфолио проектов</title>

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
                <p class="hero-kicker">Портфолио / Backend кейсы</p>
                <h1 class="mt-4 text-3xl font-extrabold text-white sm:text-4xl">Проекты и продуктовые кейсы</h1>
                <p class="section-subtitle mt-3">Все проекты на странице подтягиваются из backend и управляются через Filament.</p>
            </div>
        </section>

        <section class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
            @if(count($projects) === 0)
                <div class="section-shell">
                    <p class="section-subtitle">Пока нет опубликованных проектов. Добавьте проекты и включите флаг публикации в админке.</p>
                </div>
            @else
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($projects as $project)
                        <article class="project-card flex h-full flex-col overflow-hidden rounded-xl p-0">
                            @if($project['cover_url'] !== '')
                                <img
                                    src="{{ $project['cover_url'] }}"
                                    alt="{{ $project['title'] }}"
                                    class="h-44 w-full object-cover"
                                >
                            @else
                                <div class="flex h-44 w-full items-center justify-center bg-slate-900/80 text-sm text-white/60">
                                    Нет обложки
                                </div>
                            @endif

                            <div class="flex flex-1 flex-col gap-4 p-4">
                                <div>
                                    <h2 class="project-title">{{ $project['title'] }}</h2>
                                    <p class="project-description mt-2 min-h-12">{{ $project['short_description'] }}</p>
                                </div>

                                <div class="mt-auto space-y-2">
                                    <div class="flex flex-wrap gap-x-2 gap-y-1">
                                        @foreach($project['technologies'] as $technology)
                                            <span class="project-stack !mt-0">{{ $technology }}</span>
                                        @endforeach
                                    </div>

                                    <div class="flex flex-wrap gap-2 pt-1">
                                        @if($project['github_url'])
                                            <a
                                                href="{{ $project['github_url'] }}"
                                                target="_blank"
                                                rel="noreferrer"
                                                class="btn-secondary"
                                            >
                                                GitHub
                                            </a>
                                        @endif

                                        @if($project['preview_url'])
                                            <a
                                                href="{{ $project['preview_url'] }}"
                                                target="_blank"
                                                rel="noreferrer"
                                                class="btn-secondary"
                                            >
                                                Preview
                                            </a>
                                        @endif

                                        <a
                                            href="{{ route('portfolio.show', ['slug' => $project['slug']]) }}"
                                            class="btn-primary"
                                        >
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </main>
</body>
</html>
