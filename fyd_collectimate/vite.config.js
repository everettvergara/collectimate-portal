import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
    ],
    // Add this to preserve public assets URLs as-is
    base: '/',
    build: {
        assetsDir: '', // so it doesn’t put /build/public/ or similar
    },
});
