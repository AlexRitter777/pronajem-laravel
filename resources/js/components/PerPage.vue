<script setup>
    import { ChevronDownIcon } from '@heroicons/vue/16/solid'

    const items = [
        {id:1, name: '5'},
        {id:2, name: '10'},
        {id:3, name: '15'},
    ];

    const emit = defineEmits(['perPage']);


</script>

<template>
    <div class="md:pr-[30px]">
        <label
            for="perPage"
            class="block text-sm/6 font-medium text-gray-900 dark:text-white text-right"
        >
            Per Page
        </label>
        <div class="flex justify-end">
            <div class="mt-1 grid grid-cols-1 w-16 ">
                <select
                    id="perPage"
                    @change="emit('perPage', $event.target.value)"
                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-0.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:*:bg-gray-800 dark:focus-visible:outline-indigo-500"

                >
                    <template  v-for="item in items" :key="item.id">
                        <option :value="item.name" >{{item.name}}</option>
                    </template>
                </select>
                <ChevronDownIcon class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4 dark:text-gray-400" aria-hidden="true" />
            </div>
        </div>
    </div>
</template>


