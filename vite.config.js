import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                //booking
                'resources/js/booking/create.js',
                'resources/js/booking/edit.js'
            ],
            refresh: true,
        }),
    ],
});
