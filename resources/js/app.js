import './bootstrap';
import '@tailwindplus/elements'
import { createApp } from 'vue';
import ItemsTable from "./components/ItemsTable.vue";
import TenantsTable from "./components/TenantsTable.vue";
import modal from "./alpine-components/modal.js";
import scrollIntoView from "./utilites/srcroll-into-view.js";
import { i18nVue} from "laravel-vue-i18n";


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('modal', modal);

Alpine.start();


const el = document.getElementById('app');
if(el){
    const app = createApp({});
    app.component('items-table', ItemsTable);
    app.use(i18nVue, {
        resolve: async lang => {
            const langs = import.meta.glob('../../lang/vue/*.json');
            return await langs[`../../lang/vue/${lang}.json`]();
        }
    })
    app.mount(el);
}

scrollIntoView();
