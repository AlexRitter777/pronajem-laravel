<script setup>

    defineProps({
        label: {type: String, required: true},
    })

</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 py-6">
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label }}
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

