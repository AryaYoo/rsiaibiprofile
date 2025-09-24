import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [                
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/company.css',
                'resources/js/company.js',
                'resources/css/simrs.css',
                'resources/js/simrs.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
