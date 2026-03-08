<script setup>

    defineProps({
        type: {type: String, required: false, default: 'text'},
        modelValue: {type: String, required: false},
    })

    defineEmits(['update:modelValue'])

</script>

<template>

    <input
        :type="type"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-md bg-white py-1.5 pr-3 pl-3 text-base text-gray-900 outline-1 -outline-offset-1
                     outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-
                     600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500"
    />

</template>

<style scoped>

</style>
