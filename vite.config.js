import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/scss/common/reset.scss',
              'resources/scss/index.scss',
              'resources/scss/diary/create.scss',
              'resources/scss/diary/edit.scss',
            ],
            refresh: true,
        }),
    ],
});
