<script setup>

    import { onMounted, reactive } from "vue";
    import {useApi} from "../composables/api.js"
    import Pagination from "./Pagination.vue";
    import TableSearch from "./TableSearch.vue";
    import PerPage from "./PerPage.vue";
    import ConfirmButton from "./ConfirmButton.vue";
    import SimpleError from "./SimpleError.vue";
    import {useAsyncComponent} from "@/composables/async-component.js";


    const { fetchItems, deleteItem, invalidateCache, pagination, items, links, loading, error } = useApi();

    const params = reactive({
        search: '',
        per_page: '',
        sort: 'name',
        order: 'asc',
    })

    const props = defineProps({
        component: {type: String, required: true},
        title: {type: String, required: true},
        newButtonTitle: {type: String, required: true},
        url: {type: String, required: true},
    });

    const url = `api${props.url}`;

    let searchTimeout = null;

    async function searchItems(arg) {
        params.search = arg;
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(async () => {
            await invalidateCache();
            await fetchItems(url, params);
        }, 400);
    }

    async function perPage(arg) {
        params.per_page = arg;
        await invalidateCache();
        await fetchItems(url, params);
    }

    async function toggleSort(col) {
        params.sort = col;
        params.order = params.order === 'asc' ? 'desc' : 'asc';
        await invalidateCache();
        await fetchItems(url, params);
    }

    const innerTableComponent = useAsyncComponent(props.component);

    onMounted(async () => {
        await fetchItems(url, params);
    });

</script>

<template>
    <div>

        <div class="px-4 mb-4 sm:px-6 lg:px-8">
            <SimpleError
                v-show="error"
                class="mb-3">Něco se pokazilo. Zkuste to prosím znovu později.
            </SimpleError>
            <div class="sm:flex sm:items-center mb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-900 dark:text-white">{{ title }}</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        <slot></slot>
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <ConfirmButton>{{ newButtonTitle }}</ConfirmButton>
                </div>
            </div>

            <TableSearch @search = "searchItems"/>

            <div class="mt-2 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                        <component
                            :is="innerTableComponent"
                            :items="items"
                            :order="params.order"
                            @toggleSort="toggleSort"
                        />

                        <!--Pagination-->
                        <Pagination :pagination="pagination" :links="links" @paginate="fetchItems( $event, params)" />
                        <!--End Pagination-->

                    </div>
                </div>
            </div>
        </div>
        <PerPage @perPage="perPage"/>
    </div>
</template>

<style scoped>

</style>
