import './bootstrap';

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import vuetify from '@/Plugins/vuetify';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);

const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

const app = document.getElementById('app');

new Vue({
    vuetify,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => pages[`./Pages/${name}.vue`].default,
            },
        }),
}).$mount(app);
