<script setup>

import Listbox from "../FormsElements/Listbox.vue";
import {computed, ref, watch} from "vue";


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
        return  years;
    }

);

console.log(years.value.currentYear)

const emit = defineEmits(['update:modelValue'])


const selectedInvoicingYear = computed({
    get: () =>props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    }
});


</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6">
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label }}
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
<!--                    <div aria-hidden="true"></div>-->
                    <Listbox
                        v-model="selectedInvoicingYear"
                        :items="years"
                    />
                </div>
                <div class="h-8 w-8 invisible" aria-hidden="true"></div>
            </div>
        </div>
    </div>
</template>

