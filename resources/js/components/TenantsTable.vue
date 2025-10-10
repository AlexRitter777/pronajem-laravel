<script setup lang="ts">
    import {onMounted, ref} from "vue";
    import axios from "axios";
    import Axios from 'axios';
    import { setupCache } from 'axios-cache-interceptor/dev';
    import {computed} from "vue";

    import Pagination from "./Pagination.vue";
    import TableSearch from "./TableSearch.vue";
    import PerPage from "./PerPage.vue";

    import { ChevronDownIcon } from '@heroicons/vue/20/solid';
    import { ChevronUpIcon } from '@heroicons/vue/20/solid';
    import { TrashIcon } from "@heroicons/vue/24/outline"

    const tenants = ref([]);
    const pagination = ref({});
    const links = ref([]);
    const search = ref('');
    const perPageValue = ref('');
    const sort = ref('name');
    const sortDirection = ref('asc');

    let searchTimeout = null;

    const api = setupCache(Axios.create(), {
        debug: console.log,
        interpretHeader: false,
        ttl: 1000 * 60 * 5
    });

    async function fetchTenants(url = '/api/najemnici') {

        const res = await api.get(url, {
            params: {
                search: search.value,
                per_page: perPageValue.value,
                sort: sort.value,
                order: sortDirection.value,
            },

        });
        tenants.value = res.data.data;
        pagination.value = res.data.meta;
        links.value = res.data.links;

        console.log(res);
    }




    function searchTenants(arg) {
        search.value = arg;
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchTenants();
        }, 400);
    }

    function perPage(arg) {
        perPageValue.value = arg;
        fetchTenants();
    }

    function toggleSort(col) {
        sort.value = col;
        sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
        fetchTenants();
    }

    const properties = computed(() => {
        let properties = [];
        tenants.value.forEach(tenant => {

            let propertiesCount = tenant.properties.length;
            if(propertiesCount > 1){
               properties[tenant.id] = 'Více nemovitostí';
            } else if (propertiesCount === 1){
               properties[tenant.id] = tenant.properties[0].address;
            } else {
               properties[tenant.id] = '\u2014';
            }

        })

        return properties;
    })

    onMounted(fetchTenants);





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

            <TableSearch @search = "searchTenants"/>

            <div class="mt-2 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
                            <thead>
                                <tr>
                                    <!--Name-->
                                    <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                                        <a href="#"
                                           @click.prevent="toggleSort('name')"
                                           class="group inline-flex"
                                        >
                                            Jméno
                                            <span
                                                class="ml-2 flex-none rounded-sm bg-gray-100 text-gray-900
                                                 group-hover:bg-gray-200 dark:bg-gray-800 dark:text-white
                                                  dark:group-hover:bg-gray-700"
                                            >
                                                <ChevronDownIcon
                                                    v-if="sortDirection === 'desc'"
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                                <ChevronUpIcon
                                                    v-if="sortDirection === 'asc'"
                                                    class="size-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </a>
                                    </th>
                                    <!--End Name-->

                                    <!--Address-->
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        Adresa
                                    </th>
                                    <!--End Address-->

                                    <!--Property-->
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        Nemovitost
                                    </th>
                                    <!--End Property-->

                                    <!--Actions -->
                                    <th scope="col" class="py-3.5 pr-0 pl-3">
                                        <span class="sr-only">Akce</span>
                                    </th>
                                    <!--End Actions-->
                                </tr>

                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-white/10 dark:bg-gray-900">
                            <tr
                                v-for="tenant in tenants"
                                :key="tenant.id"
                                @click="goToTenant(tenant.id)"
                                class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                            >
                                <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0 dark:text-white">
                                    {{ tenant.name }}
                                </td>
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ tenant.address }}
                                </td>
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ properties[tenant.id] }}
                                </td>
                                <td class="py-4 pr-4 pl-3 text-right text-sm whitespace-nowrap sm:pr-0">
                                    <a
                                        href="#"
                                        class="text-gray-500 hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        @click.stop="deleteTenant(tenant.id)"
                                    >
                                        <TrashIcon class="size-5" />
                                    </a>
                                </td>
                            </tr>
                            </tbody>

                        </table>

                        <!--Pagination-->
                        <Pagination :pagination="pagination" :links="links" @paginate="fetchTenants" />
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
