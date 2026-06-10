<script setup>

import Listbox from "../FormsElements/Listbox.vue";
import {computed} from "vue";
import { useMonths } from "../../composables/months.js";

const {months} = useMonths();

const props = defineProps({
    label: {type: String, required: false},
    modelValue: {type: [Number, null], required: true},
    error: {type: [Array, null], default: null, required: false},
});


const emit = defineEmits(['update:modelValue'])

const selectedPaymentMonth = computed({
    get: () => {
        return months.value.find(month => month.id === props.modelValue) ?? null;
    },
    set: value => {
        emit('update:modelValue', value?.id ?? null)
    }
})


</script>

<template>

    <Listbox
        v-model="selectedPaymentMonth"
        :items="months"
        :placeholder="$t('service-settlement.placeholder-month')"
        :error="error"
    />

</template>

