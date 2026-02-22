<script setup lang="ts">
    import {ref} from "vue";

    const search = ref('');
    const emit = defineEmits(['search'])

</script>

<template>
    <div class="py-2">
        <div class="w-full sm:max-w-xs flex">
            <input
                type="text"
                id="search"
                aria-label="Search"
                v-model="search"
                @input="emit('search', search)"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-400 dark:focus:outline-indigo-500"
                :placeholder="$t('search.placeholder')"
            />
            <svg
                viewBox="0 0 20 20"
                fill="currentColor"
                data-slot="icon"
                aria-hidden="true"
                class="ml-[-30px] pointer-events-none col-start-1 row-start-1 size-5 self-center text-gray-400"
            >
                <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd"></path>
            </svg>
        </div>
    </div>
</template>

<style scoped>

</style>
