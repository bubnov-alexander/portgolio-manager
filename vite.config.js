import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/home-hero.js', 'resources/js/home-header.js'],
            refresh: true,
        }),
    ],
});
