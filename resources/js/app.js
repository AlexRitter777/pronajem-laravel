import './bootstrap';
import '@tailwindplus/elements'
import { createApp } from 'vue';

async function mountAsync(selector, importFn) {
    const el = document.querySelector(selector);
    if (el) {
        const module = await import(importFn);
        createApp(module.default, el.dataset).mount(el);
    }
}


mountAsync('#tenants-table', './components/TenantsTable.vue');
