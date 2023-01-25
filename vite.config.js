import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/chatbot/main.css',
                'resources/js/chatbot/main.js',
                'resources/js/forum/showChannel.js',
                'resources/js/notification/get_notifications.js',
                'resources/js/alpine.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,
        }
    },
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
    }
});
