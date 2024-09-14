import './bootstrap'
import '../css/app.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { NDialogProvider, NMessageProvider } from 'naive-ui'
import naive from 'naive-ui'

// Fix Naive UI + Tailwind CSS issue
const meta = document.createElement('meta')
meta.name = 'naive-ui-style'
document.head.appendChild(meta)

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(NMessageProvider, { placement: "top" }, () => h(NDialogProvider, () => h(App, props))) })
            .use(plugin)
            .use(ZiggyVue)
            .use(createPinia())
            .use(naive)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
})
