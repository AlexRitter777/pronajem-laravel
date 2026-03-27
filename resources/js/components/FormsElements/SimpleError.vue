<script setup>

    defineProps({
        error: {type: Array, default: null}
    })

</script>

<template>
    <span
        v-if="error"
        class="text-red-500 text-xs italic">{{ error[0] }}</span>
</template>
