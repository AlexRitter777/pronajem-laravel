<script setup>

    import SimpleError from "./SimpleError.vue";

    defineOptions({
        inheritAttrs: false
    })

    defineProps({
        type: {type: String, required: false, default: 'text'},
        modelValue: {type: String, required: false},
        error: {type: [Array, null], required: false, default: null},
        showError: {type: Boolean, required: false, default: true}
    })

    defineEmits(['update:modelValue'])

</script>

<template>

    <div>
        <input
            v-bind="$attrs"
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="block w-full rounded-md bg-white py-1.5 pr-3 pl-3 text-base text-gray-900 outline-1 -outline-offset-1
                         placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2
                         sm:text-sm/6 dark:bg-white/5 dark:text-white dark:placeholder:text-gray-500"
            :class="error
                ? 'outline-red-500 focus:outline-red-500 dark:outline-red-500 dark:focus:outline-red-500'
                : 'outline-gray-300 focus:outline-indigo-600 dark:outline-white/10 dark:focus:outline-indigo-500'"
        />
        <SimpleError v-if="error && showError" :error="error"/>
    </div>

</template>

<style scoped>

</style>
