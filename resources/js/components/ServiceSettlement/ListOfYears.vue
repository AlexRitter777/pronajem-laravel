<script setup>

import Listbox from "../FormsElements/Listbox.vue";
import {computed} from "vue";


const props = defineProps({
    label: {type: String, required: false},
    modelValue: {type: [Object, null], required: true},
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
    get: () =>props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    }
});


</script>

<template>

    <Listbox
        @update:modelValue="emit('year-selected')"
        v-model="selectedInvoicingYear"
        :items="years"
        :placeholder="$t('service-settlement.placeholder-year')"
    />

</template>

