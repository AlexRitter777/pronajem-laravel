<script setup>

const props = defineProps({
    href: {type: String, required: true}
})

</script>

<template>
    <a
        :href="href"
        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm
                               font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2
                               focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500
                               dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500 hover:cursor-pointer"
    >
        <slot>Button</slot>
    </a>
</template>

<style scoped>

</style>
