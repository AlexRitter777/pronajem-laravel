<script setup>

import Listbox from "../FormsElements/Listbox.vue";
import {computed} from "vue";
import SimpleError from "../FormsElements/SimpleError.vue";


const props = defineProps({
    label: {type: String, required: false},
    modelValue: {type: [Number, null], required: true},
    error: {type: [Array, null], default: null, required: false},
});


const years = computed(
    () => {
        const currentYear = new Date().getFullYear();
        const years = [];
        const difference = currentYear - 5;
        for (let year = currentYear; year >= difference; year--) {
            years.push({id: year, name: year.toString()});
        }
        return years;
    }

);

const emit = defineEmits(['update:modelValue', 'year-selected'])


const selectedInvoicingYear = computed({
    get: () => {
        return years.value.find(year => year.id === props.modelValue) ?? null;
    },
    set: value => {
        emit('update:modelValue', value?.id ?? null)
    }
});


</script>

<template>

    <Listbox
        @update:modelValue="emit('year-selected')"
        v-model="selectedInvoicingYear"
        :items="years"
        :placeholder="$t('service-settlement.placeholder-year')"
        :error="error"
    />

</template>

