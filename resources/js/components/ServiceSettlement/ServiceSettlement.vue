<script setup>

import {onMounted, reactive, ref, toRaw} from "vue";
import {getArrayOfItems, getItems} from "../../utilites/api.js";
import PropertyCombobox from "./PropertyCombobox.vue";
import TenantCombobox from "./TenantCombobox.vue";
import LandlordCombobox from "./LandlordCombobox.vue";
import LandlordModal from "./LandlordModal.vue";


const properties = ref([]);
const tenants = ref([]);
const landlords = ref([]);

const selectedProperty = ref(null);
const selectedTenant = ref(null);
const selectedLandlord = ref(null);
const showModal = ref(false);

const data = ref({
    landlord: {
        name: '',
        address: '',
        email: ''
    }
});

onMounted(async () => {
    // await fetchItems('/api/properties-list');
    properties.value = await getArrayOfItems('/api/properties-list');
    tenants.value = await getArrayOfItems('/api/tenants-list');
    landlords.value = await getArrayOfItems('/api/seznam-pronajimatelu');

    // console.log(properties.value);
    // console.log(tenants.value);
    // console.log(landlords.value);
    // console.log(error.value);
    // console.log(items.value);
});

function onPropertySelected(property) {
    // console.log(property);
    if(!property) return;

    selectedProperty.value = property;

    selectedTenant.value = property.tenant
        ? structuredClone(toRaw(property.tenant))
        : null;

    selectedLandlord.value = property.landlord
        ? structuredClone(toRaw(property.landlord))
        : null;

}

function showModalWindow(arg) {
    console.log(arg);
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
}

function createAndInsertEntity(arg1, arg2) {
    console.log(arg1, arg2);

}
function getProperty(arg) {
    console.log(arg);
}


</script>

<template>
    <div>
        <form>
            <div class="space-y-12 sm:space-y-16">
                <div>

                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">{{ $t('service-settlement.title')}}</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('service-settlement.subtitle')}}</p>

                    <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">



                    <property-combobox
                        :properties="properties"
                        search-by="address"
                        v-model="selectedProperty"
                        @property-selected="onPropertySelected"
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
                    />


                    </div>
                </div>
            </div>
        </form>
    </div>


<landlord-modal
    :open="showModal"
    @submitted="createAndInsertEntity"
    @close-modal="closeModal"
 />


</template>

<style scoped>

</style>
