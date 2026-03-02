<script setup>

import {onMounted, reactive, ref, toRaw, watchEffect} from "vue";
import {getArrayOfItems, getItems} from "../../utilites/api.js";
import SettlementParticipants from "./SettlementParticipants.vue";
import useSaveItem from "../../composables/saveItem.js";
import Meters from "./Meters.vue";

const {saveItem, loading, errors} = useSaveItem();

const properties = ref([]);
const tenants = ref([]);
const landlords = ref([]);
const meterTypes=ref([]);

//use snapshots for displaying entities, id is only reference, for editing

const settlement = reactive({
    landlord: {id : null, name : null},
    tenant: {id : null, name : null},
    property: {id : null, address : null, tenant : null, landlord : null},
    meters: []
    // add all data


});

watchEffect(()=> console.log(settlement.property, settlement.landlord, settlement.tenant, settlement.meters));

onMounted(async () => {
    // error handling
    properties.value = await getArrayOfItems('/api/properties-list');
    tenants.value = await getArrayOfItems('/api/tenants-list');
    landlords.value = await getArrayOfItems('/api/seznam-pronajimatelu');
    meterTypes.value = await getArrayOfItems('/api/meter-types-list');
    console.log(meterTypes.value)
});


async function createAndInsertPerson(data, url, entity) {

    const res = await saveItem(url, data)

    settlement[entity] = {
        id: res.data.data.id,
        name: res.data.data.name,
    };

}


async function createAndInsertProperty(data, url) {

    const res = await saveItem(url, data)

    settlement.property = {
        id: res.data.data.id,
        address: res.data.data.address,
    }
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


                        <settlement-participants
                            v-model:selected-property="settlement.property"
                            v-model:selected-landlord="settlement.landlord"
                            v-model:selected-tenant="settlement.tenant"
                            :properties="properties"
                            :landlords="landlords"
                            :tenants="tenants"
                            @modal-form-submitted="createAndInsertPerson"
                            @property-form-submitted="createAndInsertProperty"
                        />

                        <meters/>

                    </div>
                </div>
            </div>
        </form>
    </div>





</template>

<style scoped>

</style>
