@php
    $brand = $headerBrand ?? 'Backend Portfolio';
    $active = $activeNav ?? null;
@endphp

<header class="site-header">
    <div class="mx-auto flex h-16 w-full max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="text-sm font-semibold tracking-[0.08em] text-white/90">{{ $brand }}</a>

        <nav class="hidden items-center gap-6 md:flex" aria-label="Основная навигация">
            <a href="{{ url('/') }}" class="site-nav-link {{ $active === 'home' ? 'text-white' : '' }}">Главная</a>
            <a href="{{ route('portfolio.index') }}" class="site-nav-link {{ $active === 'portfolio' ? 'text-white' : '' }}">Портфолио</a>
            <a href="{{ url('/#about') }}" class="site-nav-link">Обо мне</a>
            <a href="{{ url('/#contacts') }}" class="site-nav-link">Контакты</a>
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
            <a href="{{ url('/') }}" class="mobile-nav-link">Главная</a>
            <a href="{{ route('portfolio.index') }}" class="mobile-nav-link">Портфолио</a>
            <a href="{{ url('/#about') }}" class="mobile-nav-link">Обо мне</a>
            <a href="{{ url('/#contacts') }}" class="mobile-nav-link">Контакты</a>
        </div>
    </nav>
</header>
