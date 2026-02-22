<script setup>

import ComboBox from "../formsElements/ComboBox.vue";
import {computed} from "vue";

const props = defineProps({
    landlords: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
});

const emit = defineEmits(['update:modelValue', 'landlord-selected', 'open-modal'])

const selectedLandlord = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
        emit('landlord-selected', value)
    },
})
</script>

<template>
    <ComboBox
        :items="landlords"
        :title="$t('service-settlement.landlord')"
        :search-by="searchBy"
        v-model="selectedLandlord"
        @open-modal="emit('open-modal', 'landlord')"
    >
    </ComboBox>
</template>

<style scoped>

</style>
