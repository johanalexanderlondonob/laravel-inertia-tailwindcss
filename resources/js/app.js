import './bootstrap';
import '../css/app.css';

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import { InertiaProgress } from "@inertiajs/progress";

InertiaProgress.init({
    color: '#e3a822'
})

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => pages[`./Pages/${name}.vue`].default,
            },
        }),
}).$mount(app);
