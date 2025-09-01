import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    optimizeDeps: {
        include: ['@ckeditor/ckeditor5-build-classic']
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                //booking
                'resources/js/booking/create.js',
                'resources/js/booking/edit.js',

                //callLogs
                'resources/js/callLogs/create.js',

                //AuthEmail
                'resources/js/auth/sendAuth.js',

            ],
            refresh: true,
        }),
    ],
});
