import './bootstrap';
import '../sass/app.scss'
import 'vue-final-modal/style.css'
import {createApp, h} from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import 'vue-select/dist/vue-select.css';
import { createVfm } from 'vue-final-modal';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Universal Sports Academy';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const vfm = createVfm();

        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vfm)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
