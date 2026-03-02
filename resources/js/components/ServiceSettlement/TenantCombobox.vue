<script setup>

import ComboBox from "../formsElements/ComboBox.vue";
import {computed, watch} from "vue";

const props = defineProps({
    tenants: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
});

const emit = defineEmits(['update:modelValue', 'tenant-selected', 'open-modal'])

const selectedTenant = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    },
})

</script>

<template>
    <ComboBox
        :items="tenants"
        :title="$t('service-settlement.tenant')"
        :search-by="searchBy"
        v-model="selectedTenant"
        @open-modal="$emit('open-modal', 'tenant')"
    >
    </ComboBox>
</template>

<style scoped>

</style>
