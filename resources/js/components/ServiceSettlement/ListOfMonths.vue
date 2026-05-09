<script setup>

import Listbox from "../FormsElements/Listbox.vue";
import {computed} from "vue";
import { useMonths } from "../../composables/months.js";

const {months} = useMonths();

const props = defineProps({
    label: {type: String, required: false},
    modelValue: {type: [Object, null], required: true},
});


const emit = defineEmits(['update:modelValue'])


const selectedInvoicingYear = computed({
    get: () =>props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    }
});


</script>

<template>

    <Listbox
        v-model="selectedInvoicingYear"
        :items="months"
        :placeholder="$t('service-settlement.placeholder-month')"
    />

</template>

