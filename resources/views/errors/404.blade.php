<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Страница не найдена</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hero-page text-slate-100 antialiased">
    <main class="relative min-h-screen overflow-hidden">
        <div class="hero-noise"></div>
        <div class="hero-glow hero-glow-a"></div>
        <div class="hero-glow hero-glow-b"></div>

        <section class="error-shell">
            <article class="error-card">
                <p class="hero-kicker">Ошибка / 404</p>
                <p class="error-code">404</p>
                <h1 class="error-title">Страница не найдена</h1>
                <p class="error-text">
                    Возможно, ссылка устарела или адрес введён с ошибкой. Вернитесь на главную
                    или откройте страницу с проектами.
                </p>

                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ url('/') }}" class="btn-primary">На главную</a>
                    <a href="{{ route('portfolio.index') }}" class="btn-secondary">К проектам</a>
                </div>
            </article>
        </section>
    </main>
</body>
</html>
