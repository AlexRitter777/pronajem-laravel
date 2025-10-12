<script setup>

    import {onMounted, reactive} from "vue";
    import {useApi} from "../composables/api.js"
    import Pagination from "./Pagination.vue";
    import TableSearch from "./TableSearch.vue";
    import PerPage from "./PerPage.vue";
    import TenantsTable from "./TenantsTable.vue";

    const { fetchItems, deleteItem, invalidateCache, pagination, items, links, loading } = useApi();

    const params = reactive({
        search: '',
        per_page: '',
        sort: 'name',
        order: 'asc',
    })

    let searchTimeout = null;

    async function searchItems(arg) {
        params.search = arg;
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(async () => {
            await invalidateCache();
            await fetchItems('api/najemnici', params);
        }, 400);
    }

    async function perPage(arg) {
        params.per_page = arg;
        await invalidateCache();
        await fetchItems('api/najemnici', params);
    }

    async function toggleSort(col) {
        params.sort = col;
        params.order = params.order === 'asc' ? 'desc' : 'asc';
        await invalidateCache();
        await fetchItems('api/najemnici', params);
    }


    onMounted(async () => {
        await fetchItems('/api/najemnici', params);
    });

</script>

<template>
    <div>
        <div class="px-4 mb-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center mb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-900 dark:text-white">Nájemníci</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Spravujte nájemníky jednoduše a přehledně. Přidejte nové nebo upravte stávající.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        @click = "deleteTenant(5)"
                        type="button"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm
                               font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2
                               focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500
                               dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500 hover:cursor-pointer"
                    >
                        Nový nájemník
                    </button>
                </div>
            </div>

            <TableSearch @search = "searchItems"/>

            <div class="mt-2 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <TenantsTable
                            :order="params.order"
                            :tenants="items"
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
