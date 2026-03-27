<script setup>

defineProps({
    loading: {type: Boolean, required: false, default: false},
})

</script>

<template>
    <button
        type="submit"
        class="inline-flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
        :disabled="loading"
        :class="{'opacity-50 cursor-not-allowed': loading}"
    >
        <!-- Spinner -->
        <svg
            v-show="loading"
            class="animate-spin h-4 w-4 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"
            ></circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
            ></path>
        </svg>

        <span v-show="!loading"><slot name="main-label" /></span>
        <span v-show="loading"><slot name="loading-label"/></span>

    </button>
</template>

<style scoped>

</style>
