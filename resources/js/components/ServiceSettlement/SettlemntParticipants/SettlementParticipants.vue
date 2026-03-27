<script setup>

import TenantCombobox from "./TenantCombobox.vue";
import LandlordCombobox from "./LandlordCombobox.vue";
import PropertyCombobox from "./PropertyCombobox.vue";
import LandlordModal from "./LandlordModal.vue";
import {computed, onMounted, reactive, ref, toRaw, watch} from "vue";
import TenantModal from "./TenantModal.vue";
import PropertyModal from "./PropertyModal.vue";


const props = defineProps({
    properties: {type: Array, required: true},
    landlords: {type: Array, required: true},
    tenants: {type: Array, required: true},
    selectedProperty: {type: [Object, null], default: null, required: true},
    selectedLandlord: {type: [Object, null], default: null, required: true},
    selectedTenant: {type: [Object, null], default: null, required: true},
    modals: {type: Object, required: true},
})

onMounted(() => {
    console.log(props.modals)
})

const emit = defineEmits(
    [
        'update:selectedProperty',
        'update:selectedLandlord',
        'update:selectedTenant',
        'modal-form-submitted',
        'property-form-submitted',
    ]);

const selectedProperty = computed({
    get: () => props.selectedProperty,
    set: value => {
        emit('update:selectedProperty', value)
    },
});

const selectedLandlord = computed({
    get: () => props.selectedLandlord,
    set: value => {
        emit('update:selectedLandlord', value)
    },
});

const selectedTenant = computed({
    get: () => props.selectedTenant,
    set: value => {
        emit('update:selectedTenant', value)
    },
})





watch(selectedProperty, (property) => {

    if(!property) return;

    selectedProperty.value = property;

    selectedTenant.value = property.tenant
        ? structuredClone(toRaw(property.tenant))
        : null;

    selectedLandlord.value = property.landlord
        ? structuredClone(toRaw(property.landlord))
        : null;
})

function showModalWindow(entity) {
    props.modals[entity].show = true;
}

function closeModal(entity) {
    props.modals[entity].show = false;
    props.modals[entity].loading = false;
    props.modals[entity].errors = {};
}



</script>

<template>

    <property-combobox
        :properties="properties"
        search-by="address"
        v-model="selectedProperty"
        @open-modal="showModalWindow"
    />

    <landlord-combobox
        :landlords="landlords"
        search-by="name"
        v-model="selectedLandlord"
        @landlord-selected="selectedLandlord = $event"
        @open-modal="showModalWindow"
    />

    <tenant-combobox
        :tenants="tenants"
        search-by="name"
        v-model="selectedTenant"
        @tenant-selected="selectedTenant = $event"
        @open-modal="showModalWindow"
    />

    <landlord-modal
        :open="props.modals.landlord.show"
        :loading="props.modals.landlord.loading"
        :errors="props.modals.landlord.errors"
        @submitted="(data, url, entity) => $emit('modal-form-submitted', data, url, entity)"
        @close-modal="closeModal"
    />

    <tenant-modal
        :open="props.modals.tenant.show"
        :loading="props.modals.tenant.loading"
        :errors="props.modals.tenant.errors"
        @submitted="(data, url, entity) => $emit('modal-form-submitted', data, url, entity)"
        @close-modal="closeModal"
    />

    <property-modal
        :open="props.modals.property.show"
        :loading="props.modals.property.loading"
        :errors="props.modals.property.errors"
        @submitted="(data, url) => $emit('property-form-submitted', data, url)"
        @close-modal="closeModal"
    />


</template>

<style scoped>

</style>
