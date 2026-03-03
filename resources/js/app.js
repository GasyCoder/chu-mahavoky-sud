import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';

// Import AOS for scroll animations
import AOS from 'aos';
import 'aos/dist/aos.css';

const appName = import.meta.env.VITE_APP_NAME || 'CHU Mahavoky';

// On ne lance Inertia que si l'élément de montage existe
const el = document.getElementById('app');

if (el) {
    createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            const app = createApp({ render: () => h(App, props) });
            
            // Initialize AOS
            app.config.globalProperties.$aos = AOS;
            
            app.use(plugin);
            app.use(ZiggyVue);
            app.mount(el);
            
            // Initialize AOS after mount
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
            });
            
            return app;
        },
        progress: {
            color: '#2563EB',
        },
    });
}
