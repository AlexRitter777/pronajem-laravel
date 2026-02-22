    <script setup>

    import { onMounted, reactive } from "vue";
    import {useApi} from "../../composables/api.js"
    import Pagination from "./Pagination.vue";
    import TableSearch from "./TableSearch.vue";
    import PerPage from "./PerPage.vue";
    import ConfirmButton from "../UiElements/ConfirmButton.vue";
    import SimpleError from "../UiElements/SimpleError.vue";
    import {useAsyncComponent} from "@/composables/async-component.js";


    const { fetchItems, deleteItem, invalidateCache, pagination, items, links, loading, error } = useApi();

    const params = reactive({
        search: '',
        per_page: '',
        sort: '',
        order: 'asc',
    })

    const props = defineProps({
        component: {type: String, required: true},
        title: {type: String, required: true},
        newButtonTitle: {type: String, required: true},
        url: {type: String, required: true},
        create: {type: String, required: true},
        edit: {type: String, required: true},
        show: {type: String, default: false},
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
        console.log(error.value);
    });

</script>

<template>
    <div>

        <div class="px-4 mb-4 sm:px-6 lg:px-8">
            <SimpleError
                v-if="error"
                class="mb-3"
            >
                {{ $t('errors.common') }}
            </SimpleError>
            <div class="sm:flex sm:items-center mb-4">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-900 dark:text-white">{{ title }}</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        <slot></slot>
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <ConfirmButton
                        :href="create"
                    >
                        {{ newButtonTitle }}
                    </ConfirmButton>
                </div>
            </div>



            <div v-if="items.length">
                <TableSearch @search = "searchItems"/>
                <div class="mt-2 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                            <component
                                :is="innerTableComponent"
                                :items="items"
                                :order="params.order"
                                :show="show"
                                :edit="edit"
                                @toggleSort="toggleSort"
                            />


                            <!--Pagination-->
                            <Pagination v-if="links.first !== links.last" :pagination="pagination" :links="links" @paginate="fetchItems( $event, params)" />
                            <!--End Pagination-->

                        </div>
                    </div>
                </div>
                <PerPage class="mt-2" :per-page="pagination.per_page" @perPage="perPage"/>
            </div>
            <div v-else>
                <h3 class="text-base mt-10 font-semibold text-gray-900 dark:text-white">{{ $t('table.empty')}}</h3>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
