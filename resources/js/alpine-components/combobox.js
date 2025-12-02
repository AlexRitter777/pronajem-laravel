
import {getItems} from '../utilites/api.js';
import {saveItems} from "../utilites/api.js";

export default (options= {}) => ({

    async init() {
        console.log('Hi from the combobox!');
        const items = await getItems();
        // console.log(items);

        if(items.data.length === 0) {
            this.disabled = true;
            return;
        }

        this.items = items.data;

        this.selectedItemId = options.selectedItemId;

        if(this.selectedItemId){
            this.disabled = true;
            this.selectedItem = options.selectedItem;
        }

        this.$store.errors = {}


    },

    items: null,

    selectedItem: '',

    selectedItemId: null,

    showItems: false,

    isModalOpen: false,

    disabled: false,

    name: 'Test',

    errors: {},

    isLoading: false,

    selectItem(item) {
        this.selectedItem = item.name;
        this.selectedItemId = item.id;
        this.disabled = true;
        this.showItems = false;
    },


    deleteItem() {
        this.selectedItem = '';
        this.selectedItemId = null;
        this.disabled = false;
    },

    refreshInput() {
        if(!this.selectedItemId) {
            this.selectedItem = '';
        }
    },

    openModal() {
        this.isModalOpen = true;
    },

    closeModal() {
        this.errors = {};
        this.isModalOpen = false;
    },

    async save(options = {}){

        this.errors = {};

        const entity = options.entity;

        const formData =  options.form;

        this.isLoading = true;

        const minTime = 500;

        const start = performance.now();

        try {
            const response = await saveItems(`/api/${entity}`, formData);
            const diff = performance.now() - start;

            //console.log(response);

            if(diff < minTime) {
                await this.wait(minTime - diff);
            }

            this.selectedItem = response.data.name;
            this.selectedItemId = response.data.id;
            this.disabled = true;
            this.closeModal();

        } catch (e) {

            const diff = performance.now() - start;
            if(diff < minTime) {
                await this.wait(minTime - diff);
            }

            if(e.response.status === 422) {
                this.errors = e.response.data.errors;
                console.log(this.errors.name[0])

            } else {
                console.error(e);
            }

        } finally {
            this.isLoading = false;
        }


    },

    wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

})
