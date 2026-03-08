<script setup >

import {computed, reactive, ref, watchEffect} from "vue";
import TrashIcon from "../Icons/TrashIcon.vue";
import Listbox from "../FormsElements/Listbox.vue";
import MetersLine from "./MetersLine.vue";

const props = defineProps({
    invoicingStartDate: {type: [String, null], required: true},
    invoicingEndDate: {type: [String, null], required: false},
    occupancyStartDate: {type: [String, null], required: false},
    occupancyEndDate: {type: [String, null], required: false},
    meterTypes: {type: Array, required: true},
    // modelValue: {type: Array, required: true},
})


const emits = defineEmits(['update:modelValue'])

const needMeters = computed(() => {

    if (!props.invoicingStartDate || !props.invoicingEndDate || !props.occupancyStartDate || !props.occupancyEndDate) {
        return false;
    }

    if (
        (props.invoicingStartDate === props.occupancyStartDate &&
        props.invoicingEndDate === props.occupancyEndDate) ||
        props.occupancyStartDate > props.occupancyEndDate ||
        props.invoicingStartDate > props.invoicingEndDate
    ) {
        return false;
    }

    return true;

})


const meter = ref({
    id: null,
    typeId: null,
    typeName: null,
    startValue: null,
    endValue: null,
    number: null,
});


</script>

<template>

    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6 border-b border-gray-900/10 dark:border-white/10">
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            Meters
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-3">

                <!-- row -->
                <div class="flex gap-3 items-center">
                    <div class="flex-1 grid grid-cols-2 gap-3">
                        <MetersLine :meter="meter" :meter-types="meterTypes"/>
                    </div>
                    <button class="text-indigo-600 shrink-0 hover:cursor-pointer hover:text-indigo-400">
                        <TrashIcon/>
                    </button>
                </div>


                <button class="text-indigo-600 text-sm hover:cursor-pointer hover:text-indigo-400">＋ Add meter</button>
            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
