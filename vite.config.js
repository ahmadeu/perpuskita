import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                //  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php'
            ],
            refresh: true,
        }),
    ],
});
