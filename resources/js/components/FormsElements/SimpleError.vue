<script setup>

    defineProps({
        error: {type: Array, default: null}
    })

</script>

<template>
    <span
        v-if="error"
        class="text-red-600 text-sm dark:text-red-400 scroll-message">{{ error[0] }}</span>
</template>
