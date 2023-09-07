import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // css
                'resources/sass/master.scss',
                'resources/sass/admin/pages/auth/style.scss',
                'resources/sass/admin/pages/travel_agencies/style.scss',
                'resources/sass/admin/pages/store/style.scss',
                'resources/sass/admin/pages/store/style.scss',
                'resources/sass/common/image_upload.scss',
                'resources/sass/admin/pages/course_registration/style.scss',
                'resources/sass/admin/image_upload.scss',
                'resources/sass/admin/message/_chat.scss',
                'resources/sass/admin/message/_admin-tabpanel.scss',
                'resources/sass/admin/pages/reservation/detail.scss',
                'resources/sass/admin/pages/reservation/style.scss',

                'resources/sass/admin/pages/reservation/style.scss',
                // js
                'resources/js/master.js',
                'resources/js/admin/auth/script.js',
                'resources/js/admin/auth/custom.js',
                'resources/js/admin/Store/index.js',
                'resources/js/admin/users/index.js',
                'resources/js/admin/course_registration/index.js',
                'resources/js/message.js',
                'resources/js/admin/Reservation/index.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
    }
});
