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
                 //'resources/js/booking/cruise.js',

                //callLogs
                'resources/js/callLogs/create.js',

                //AuthEmail
                'resources/js/auth/sendAuth.js',
                //pricing
                'resources/js/booking/pricing.js',
                'resources/js/booking/status-manager.js',
                'resources/js/agent-login.js',
                'resources/js/booking/otherMain.js',
                'resources/js/country-phone.js',
                'resources/js/booking/cruise.js',
                'resources/js/booking/changes.js',
            ],
            refresh: true,
        }),
    ],
});
