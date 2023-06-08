import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/vendor/**', '**/storage/**', '**/test/**', '**/routes/**', '**/node_modules/**', '**/app/**', '**/bootstrap/**']
        },
    },
});
