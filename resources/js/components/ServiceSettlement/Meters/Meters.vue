<script setup>

import {computed, watch, watchEffect} from "vue";
import TrashIcon from "../../Icons/TrashIcon.vue";
import MetersLine from "./MetersLine.vue";
import SimpleError from "../../FormsElements/SimpleError.vue";
import useLineErrors from "../../../composables/line-errors.js";

const props = defineProps({
    label: {type: String, required: true},
    invoicingYear: {type: [Number, null], required: true},
    occupancyStartDate: {type: [String, null], required: false},
    occupancyEndDate: {type: [String, null], required: false},
    meterTypes: {type: Array, required: true},
    meters: {type: Array, required: true},
    errors: {type: Object, required: false, default: () =>({})}
})

const meterErrors = useLineErrors('meters');

const emit = defineEmits(['add-meter-line', 'remove-meter-line','has-meters']);

const showMeters = computed(() => {

    if(!props.invoicingYear) return true;

    if(props.occupancyStartDate === `${props.invoicingYear.toString()}-01-01` && props.occupancyEndDate === `${props.invoicingYear.toString()}-12-31`) {
        return false;
    }

    return true;
})

watch(
    showMeters,
    value =>
        emit('has-meters', value),
    {immediate: true}
)

const maxMeters = 6;

const canAddMeters = computed(() => {
    return props.meters.length < maxMeters;
})



</script>

<template>

        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label}}
        </label>

        <div v-if="showMeters" class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-10">

                <!-- row -->
                <template v-for="(meter, index) in meters" :key="meter.id">
                    <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                        <div class="grid grid-cols-2 gap-3">
                            <MetersLine
                                :meter="meter"
                                :meter-types="meterTypes"
                                :errors="meterErrors(props.errors, index)"
                            />

                        </div>
                        <button
                            type="button"
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
                    type="button"
                    v-if="canAddMeters"
                    class="text-indigo-600 text-sm hover:cursor-pointer hover:text-indigo-400"
                    @click="$emit('add-meter-line')"
                >
                    ＋ {{ $t('service-settlement.add-meter') }}
                </button>
            </div>
        </div>

        <div v-else class="rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
            <p class="font-medium">
                {{ $t('service-settlement.meter-not-required-title')}}
            </p>
            <p class="mt-1">
                {{ $t('service-settlement.meter-not-required-description')}}
            </p>
        </div>


</template>

<style scoped>

</style>
