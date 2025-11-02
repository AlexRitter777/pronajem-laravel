<script setup>

import {ChevronDownIcon, ChevronUpIcon} from "@heroicons/vue/20/solid/index.js";
import {PencilIcon} from "@heroicons/vue/24/outline/index.js";
import {EyeIcon} from "@heroicons/vue/24/outline/index.js";
import {toRef} from "vue";
import {useProperties} from "../composables/properties.js";

const props = defineProps({
    items: {type: Array, required: true},
    order: {type: String, required: true},
    show: {type: String, required: true},
    edit: {type: String, required: true},
});

const itemsRef = toRef(props, 'items');

const properties = useProperties(itemsRef);

const emit = defineEmits(['toggleSort']);

function getItemUrl(id, action){
    return props[action].replace(':id', id);
}

</script>

<template>

<table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
    <thead>
        <tr>
            <!--Name-->
            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0 dark:text-white">
                <a href="javascript.void(0)"
                   @click.prevent="emit('toggleSort', 'name')"
                   class="group inline-flex"
                >
                    {{ $t('table.name')}}
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
                {{ $t('table.address')}}
            </th>
            <!--End Address-->

            <!--Property-->
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">
                {{ $t('table.property')}}
            </th>
            <!--End Property-->

            <!--Actions -->
            <th scope="col" class="py-3.5 pr-0 pl-3">
                <span class="sr-only">{{ $t('table.actions') }}</span>
            </th>
            <!--End Actions-->
        </tr>

    </thead>
    <tbody class="divide-y divide-gray-200 bg-white dark:divide-white/10 dark:bg-gray-900">
    <tr
        v-for="tenant in items"
        :key="tenant.id"
        class=" hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
    >
        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0 dark:text-white">
            <a
                :href="getItemUrl(tenant.id, 'show')"
            >
                {{ tenant.name }}
            </a>
        </td>
        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
            {{ tenant.address }}
        </td>
        <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
            {{ properties[tenant.id] }}
        </td>
        <td class=" flex justify-end py-4 pr-4 pl-3 text-sm whitespace-nowrap sm:pr-0">
            <a
                :href="getItemUrl(tenant.id, 'show')"
                class="mr-3 text-gray-500 hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-300"
            >
                <EyeIcon class="size-5"/>
            </a>
            <a
                :href="getItemUrl(tenant.id, 'edit')"
                class="text-gray-500 hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-300"
            >
                <PencilIcon class="size-5"/>
            </a>
        </td>
    </tr>

    </tbody>

</table>
</template>

<style scoped>

</style>
