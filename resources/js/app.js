import './bootstrap';
import '@tailwindplus/elements'
import { createApp } from 'vue';
import ItemsTable from "./components/ItemsTable.vue";
import TenantsTable from "./components/TenantsTable.vue";

// async function mountAsync(selector, importFn) {
//     const el = document.querySelector(selector);
//     if (el) {
//         const module = await import(importFn);
//         createApp(module.default, el.dataset).mount(el);
//     }
// }
//
//
// mountAsync('#tenants-table', './components/ItemsTable.vue');


const el = document.getElementById('app');
if(el){

    const app = createApp({});

    app.component('items-table', ItemsTable);
    app.component('tenants-table', TenantsTable);


    app.mount(el);

}
