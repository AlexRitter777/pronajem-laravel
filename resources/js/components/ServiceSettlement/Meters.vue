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
    meters: {type: Array, required: true},
})


defineEmits(['add-meter-line', 'remove-meter-line']);

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

const maxMeters = 6;

const canAddMeters = computed(() => {
    return props.meters.length < maxMeters;
})

</script>

<template>

    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6 border-b border-gray-900/10 dark:border-white/10">
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            Meters
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-7">

                <!-- row -->
                <template v-for="(meter, index) in meters" :key="meter.id">
                    <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                        <div class="grid grid-cols-2 gap-3">
                            <MetersLine :meter="meter" :meter-types="meterTypes"/>
                        </div>
                        <button
                            :class="[
                                'flex h-8 w-8 items-center justify-center text-indigo-600 shrink-0 hover:cursor-pointer hover:text-indigo-400',
                                index === 0 ? 'invisible pointer-events-none' : ''
                            ]"
                            @click="$emit('remove-meter-line', meter.id)"
                        >
                            <TrashIcon/>
                        </button>
                    </div>
                </template>

                <button
                    v-if="canAddMeters"
                    class="text-indigo-600 text-sm hover:cursor-pointer hover:text-indigo-400"
                    @click="$emit('add-meter-line')"
                >
                    ＋ {{ $t('service-settlement.add-meter') }}
                </button>
            </div>
        </div>
    </div>


</template>

<style scoped>

</style>
