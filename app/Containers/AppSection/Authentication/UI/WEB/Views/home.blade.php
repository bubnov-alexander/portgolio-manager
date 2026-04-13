<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфолио</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home-hero.js', 'resources/js/home-header.js'])
</head>
<body class="hero-page text-slate-100 antialiased">
    <header class="site-header">
        <div class="mx-auto flex h-16 w-full max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="#" class="text-sm font-semibold tracking-[0.08em] text-white/90">{{ $heroNickname }}</a>

            <nav class="hidden items-center gap-6 md:flex" aria-label="Основная навигация">
                <a href="#projects" class="site-nav-link">Текущая разработка</a>
                <a href="#about" class="site-nav-link">Обо мне</a>
                <a href="#contacts" class="site-nav-link">Контакты</a>
            </nav>

            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-white/15 bg-white/5 text-white md:hidden"
                aria-label="Открыть меню"
                aria-expanded="false"
                aria-controls="mobile-nav"
                data-nav-toggle
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>

        <nav id="mobile-nav" class="mx-auto hidden w-full max-w-6xl px-4 pb-4 sm:px-6 md:hidden" aria-label="Мобильная навигация">
            <div class="rounded-xl border border-white/15 bg-slate-950/65 p-2 backdrop-blur-md">
                <a href="#projects" class="mobile-nav-link">Текущая разработка</a>
                <a href="#about" class="mobile-nav-link">Обо мне</a>
                <a href="#contacts" class="mobile-nav-link">Контакты</a>
            </div>
        </nav>
    </header>

    <main class="relative min-h-screen overflow-hidden">
        <canvas id="neural-bg" aria-hidden="true"></canvas>

        <div class="hero-noise"></div>
        <div class="hero-glow hero-glow-a"></div>
        <div class="hero-glow hero-glow-b"></div>

        <section class="relative z-10 mx-auto flex min-h-screen w-full max-w-6xl items-center px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid w-full gap-6 lg:grid-cols-[1.25fr_0.75fr] lg:items-end">
                <div class="space-y-5">
                    <p class="hero-kicker">Портфолио / Приветствие</p>

                    <div class="space-y-2">
                        <h1 class="hero-title">{{ $heroName }}</h1>
                        <p class="hero-nickname">{{ $heroNickname }}</p>
                        <p class="text-sm font-medium text-white/75 sm:text-base">{{ $heroJobTitle }}</p>
                    </div>

                    <p class="hero-subtitle">{{ $heroShortBio }}</p>

                    <div class="flex flex-wrap gap-3">
                        <a href="#projects" class="btn-primary">Смотреть текущую разработку</a>
                        @if($contactUrl)
                            <a href="{{ $contactUrl }}" class="btn-secondary" target="_blank" rel="noreferrer">Связаться</a>
                        @endif
                    </div>
                </div>

                <aside class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                    <article class="hero-card">
                        <p class="hero-card-label">Фокус</p>
                        <p class="hero-card-value">{{ $heroFocus }}</p>
                    </article>
                    <article class="hero-card">
                        <p class="hero-card-label">Подход</p>
                        <p class="hero-card-value">{{ $heroApproach }}</p>
                    </article>
                </aside>
            </div>
        </section>

        <section id="projects" class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="section-shell">
                <h2 class="section-title">Текущая разработка</h2>
                <p class="section-subtitle">Текущие направления разработки и ключевые модули портфолио.</p>
                <div class="mt-5 grid gap-4 md:grid-cols-3">
                    @foreach($projects as $project)
                        <article class="project-card">
                            <h3 class="project-title">{{ $project['title'] }}</h3>
                            <p class="project-description">{{ $project['description'] }}</p>
                            <span class="project-stack">{{ $project['stack'] }}</span>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="about" class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="section-shell">
                <h2 class="section-title">Обо мне</h2>
                @if($aboutText)
                    <p class="about-text">{{ $aboutText }}</p>
                @endif
                <ul class="skills-list">
                    <li class="skills-item">
                        <span class="skills-dot"></span>
                        <span>Проектирование backend-архитектуры и модульных сервисов</span>
                    </li>
                    <li class="skills-item">
                        <span class="skills-dot"></span>
                        <span>Разработка API и интеграций с акцентом на надёжность</span>
                    </li>
                    <li class="skills-item">
                        <span class="skills-dot"></span>
                        <span>Оптимизация производительности и качества кода</span>
                    </li>
                    <li class="skills-item">
                        <span class="skills-dot"></span>
                        <span>Поддержка CI/CD и инженерных практик команды</span>
                    </li>
                </ul>
            </div>
        </section>

        <section id="contacts" class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="section-shell">
                <h2 class="section-title">Контакты</h2>
                <div class="mt-3 grid gap-2">
                    @foreach($contacts as $contactItem)
                        @if($contactItem['value'] && $contactItem['url'])
                            <a
                                href="{{ $contactItem['url'] }}"
                                target="_blank"
                                rel="noreferrer"
                                class="contact-link"
                            >
                                <span class="text-white/65">{{ $contactItem['label'] }}</span>
                                <span class="font-medium">{{ $contactItem['value'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</body>
</html>
