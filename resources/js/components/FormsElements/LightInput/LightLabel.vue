<script setup>

    defineProps({
        name: {type: String, required: true}
    })

</script>

<template>
    <label
        for="{{ name }}"
        class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5 dark:text-white"
    >
        <slot></slot>
    </label>
</template>

<style scoped>

</style>
