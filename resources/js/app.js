import './bootstrap';
import '@tailwindplus/elements'
import { createApp } from 'vue';
import ItemsTable from "./components/ItemsTable.vue";
import modal from "./alpine-components/modal.js";
import scrollIntoView from "./utilites/srcroll-into-view.js";
import { i18nVue} from "laravel-vue-i18n";
import combobox from "./alpine-components/combobox.js";
import focus from '@alpinejs/focus';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.data('modal', modal);

Alpine.data('combobox', combobox);

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
