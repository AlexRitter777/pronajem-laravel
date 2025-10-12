<script setup>

import {ChevronDownIcon, ChevronUpIcon} from "@heroicons/vue/20/solid/index.js";
import Pagination from "./Pagination.vue";
import {TrashIcon} from "@heroicons/vue/24/outline/index.js";
import {computed} from "vue";
import {useProperties} from "../composables/properties.js";


const props = defineProps({
    tenants: {type: Array, required: true},
    order: {type: String, required: true},
});


const properties = useProperties(props.tenants);

const emit = defineEmits(['delete', 'toggleSort']);

</script>

<template>

<table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
    <thead>
        <tr>
            <!--Name-->
            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                <a href="#"
                   @click.prevent="emit('toggleSort', 'name')"
                   class="group inline-flex"
                >
                    Jméno
                    <span
                        class="ml-2 flex-none rounded-sm bg-gray-100 text-gray-900
                                     group-hover:bg-gray-200 dark:bg-gray-800 dark:text-white
                                      dark:group-hover:bg-gray-700"
                    >
                                    <ChevronDownIcon
                                        v-if="order === 'desc'"
                                        class="size-5"
                                        aria-hidden="true"
                                    />
                                    <ChevronUpIcon
                                        v-if="order === 'asc'"
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
                <TrashIcon class="size-5"/>
            </a>
        </td>
    </tr>
    </tbody>

</table>

</template>

<style scoped>

</style>
