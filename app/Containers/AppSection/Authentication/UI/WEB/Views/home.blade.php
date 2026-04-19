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
    @include('appSection@authentication::partials.site-header', [
        'headerBrand' => $heroNickname,
        'activeNav' => 'home',
    ])

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
                        <a href="{{ route('portfolio.index') }}" class="btn-primary">Смотреть портфолио проектов</a>
                        @if($contactUrl)
                            <a href="{{ $contactUrl }}" class="btn-secondary" target="_blank" rel="noreferrer">Обсудить проект</a>
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
                    <h2 class="section-title">Избранные проекты</h2>
                    <p class="section-subtitle">Ключевые backend-кейсы с акцентом на архитектуру, API и производительность.</p>
                    @if(count($projects) > 0)
                        <div class="mt-5 grid gap-4 md:grid-cols-3">
                            @foreach($projects as $project)
                                <article class="project-card">
                                    <h3 class="project-title">{{ $project['title'] }}</h3>
                                    <p class="project-description">{{ $project['description'] }}</p>
                                    <span class="project-stack">{{ $project['stack'] }}</span>
                                    <a href="{{ route('portfolio.show', ['slug' => $project['slug']]) }}" class="mt-3 inline-flex text-sm font-medium text-violet-200/90 hover:text-violet-100">
                                        Подробнее
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state mt-5">
                            Проекты пока не опубликованы. Добавьте карточки в админке Filament и включите публикацию.
                        </div>
                    @endif
                </div>
        </section>

        <section id="about" class="anchor-section relative z-10 mx-auto w-full max-w-6xl px-4 pb-8 sm:px-6 lg:px-8">
            <div class="section-shell">
                <h2 class="section-title">Обо мне</h2>
                @if($aboutText)
                    <p class="about-text">{{ $aboutText }}</p>
                @else
                    <p class="about-text">Краткая информация о профиле пока не заполнена.</p>
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
                @php
                    $availableContacts = array_values(array_filter(
                        $contacts,
                        static fn (array $contactItem): bool => !empty($contactItem['value']) && !empty($contactItem['url'])
                    ));
                @endphp

                @if(count($availableContacts) > 0)
                    <div class="mt-3 grid gap-2">
                        @foreach($availableContacts as $contactItem)
                            <a
                                href="{{ $contactItem['url'] }}"
                                target="_blank"
                                rel="noreferrer"
                                class="contact-link"
                            >
                                <span class="text-white/65">{{ $contactItem['label'] }}</span>
                                <span class="font-medium">{{ $contactItem['value'] }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state mt-3">
                        Контакты пока не заполнены. Добавьте email или Telegram в настройках профиля.
                    </div>
                @endif
            </div>
        </section>
    </main>
</body>
</html>
