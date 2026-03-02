<script setup>
import ComboBox from "../formsElements/ComboBox.vue";
import {computed, onMounted, watch} from "vue";

const props = defineProps({
    properties: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
})

const emit = defineEmits(['update:modelValue', 'property-selected', 'open-modal'])


const selectedProperty = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    },
})


</script>

<template>
    <ComboBox
        :items="properties"
        :title="$t('service-settlement.property-address')"
        :search-by="searchBy"
        v-model="selectedProperty"
        @open-modal="$emit('open-modal', 'property')"
    >
    </ComboBox>

</template>

