<script setup>

import ComboBox from "../formsElements/ComboBox.vue";
import {computed} from "vue";

const props = defineProps({
    tenants: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
});

const emit = defineEmits(['update:modelValue', 'tenant-selected'])

const selectedTenant = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
        emit('tenant-selected', value)
    },
})
</script>

<template>
    <ComboBox
        :items="tenants"
        :title="$t('service-settlement.tenant')"
        :search-by="searchBy"
        v-model="selectedTenant"
    >
    </ComboBox>
</template>

<style scoped>

</style>
