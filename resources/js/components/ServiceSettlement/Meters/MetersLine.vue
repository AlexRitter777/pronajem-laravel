<script setup>


import Listbox from "../../FormsElements/Listbox.vue";
import {ref, watch} from "vue";
import SimpleInput from "../../FormsElements/SimpleInput.vue";


const props = defineProps({
    meterTypes: {type: Array, required: true},
    meter: {type: Object, required: false},
    errors: {type: Object, required: false},
})

const selectedMeterType = ref(null);
const selectedMeterNumber = ref(null);
const selectedStartValue = ref(null);
const selectedEndValue = ref(null);
const selectedStartYearValue = ref(null);
const selectedEndYearValue = ref(null);

watch(
    () => props.meter,
    value => {
        if( !value?.typeId) {
            selectedMeterType.value = null;
            return;
        }

        selectedMeterType.value = props.meterTypes.find(
            item => String(item.id) === String(props.meter.typeId)
        ) ?? null

        selectedMeterNumber.value = props.meter.meterNumber ?? null

        selectedStartValue.value = props.meter.startValue ?? null

        selectedEndValue.vale = props.meter.endValue ?? null

        selectedStartYearValue.value = props.meter.startYearValue ?? null

        selectedEndYearValue.vale = props.meter.endYearValue ?? null

    },
    { immediate: true }
)

watch(selectedMeterType, (value) => {

    props.meter.typeId = value?.id ?? null;
    props.meter.typeName = value?.name ?? null;

})

watch(selectedMeterNumber, (value) => {

    props.meter.meterNumber = (value && value !=='') ? value : null;

})

watch(selectedStartValue, (value) => {

    props.meter.startValue = (value && value !=='') ? value : null;

})

watch(selectedEndValue, (value) => {

    props.meter.endValue = (value && value !=='') ? value : null;

})

watch(selectedStartYearValue, (value) => {

    props.meter.startYearValue = (value && value !=='') ? value : null;

})

watch(selectedEndYearValue, (value) => {

    props.meter.endYearValue = (value && value !=='') ? value : null;

})



</script>

<template>

    <Listbox
        :items="meterTypes"
        v-model="selectedMeterType"
        :placeholder="$t('service-settlement.meter-type')"
        :error="errors.typeId"
    />
    <SimpleInput
        v-model="selectedMeterNumber"
        :placeholder="$t('service-settlement.meter-number')"
        :error="errors.meterNumber"
    />
    <SimpleInput
        v-model="selectedStartValue"
        :placeholder="$t('service-settlement.meter-start')"
        :error="errors.startValue"
    />
    <SimpleInput
        v-model="selectedEndValue"
        :placeholder="$t('service-settlement.meter-end')"
        :error="errors.endValue"

    />
    <SimpleInput
        v-model="selectedStartYearValue"
        :placeholder="$t('service-settlement.meter-start-year')"
        :error="errors.startYearValue"
    />
    <SimpleInput
        v-model="selectedEndYearValue"
        :placeholder="$t('service-settlement.meter-end-year')"
        :error="errors.endYearValue"
    />

</template>
