import { defineConfig } from 'vite';
import laravel from 'vite-plugin-laravel';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
    plugins: [
        laravel({
            postcss: [
                tailwindcss(),
                autoprefixer(),
            ]
        })
    ]
});