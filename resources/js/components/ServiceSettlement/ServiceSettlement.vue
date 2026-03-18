<script setup>

import {onMounted, reactive, ref, toRaw, watchEffect} from "vue";
import {getArrayOfItems, getItems} from "../../utilites/api.js";
import SettlementParticipants from "./SettlemntParticipants/SettlementParticipants.vue";
import useSaveItem from "../../composables/saveItem.js";
import Meters from "./Meters/Meters.vue";
import DateRange from "../FormsElements/DateRange.vue";
import {getUid} from "../../utilites/uid.js";
import TrashIcon from "../Icons/TrashIcon.vue";
import Listbox from "../FormsElements/Listbox.vue";
import ListOfYears from "./ListOfYears.vue";
import ExpenseCombobox from "./Expenses/ExpenseCombobox.vue";
import SimpleInput from "../FormsElements/SimpleInput.vue";
import Expenses from "./Expenses/Expenses.vue";
import Utilities from "./Expenses/Utilities.vue";

const {saveItem, loading, errors} = useSaveItem();

const properties = ref([]);
const tenants = ref([]);
const landlords = ref([]);
const meterTypes=ref([]);
const expensesTypes=ref([]);

//use snapshots for displaying entities, id is only reference, for editing

const settlement = reactive({
    landlord: {id : null, name : null},
    tenant: {id : null, name : null},
    property: {id : null, address : null, tenant : null, landlord : null},
    invoicingYear: null,
    tenantOccupancyStartDate: null,
    tenantOccupancyEndDate: null,
    meters: [
        {
            id : getUid(),
            typeId : null,
            typeName : null,
            startValue : null,
            endValue : null
        },
    ],
    utilities: {
        hotWater: null,
        coldWater: null,
        heating: null,
        coldWaterForHot: null,
    },
    expenses: [
        {
            id : getUid(),
            expenseTypeId : null,
            expenseTypeName : null,
            amount : null,
        }
    ],
    payments: [],
    // add all data


});


onMounted(async () => {
    // error handling
    properties.value = await getArrayOfItems('/api/properties-list');
    tenants.value = await getArrayOfItems('/api/tenants-list');
    landlords.value = await getArrayOfItems('/api/seznam-pronajimatelu');
    meterTypes.value = await getArrayOfItems('/api/meter-types-list');
    expensesTypes.value = await getArrayOfItems('/api/expenses-list');
    console.log(expensesTypes.value)
});


watchEffect(() => {
    console.log(settlement.meters)
})

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

function addMeterLine() {
    settlement.meters.push({
        id : getUid(),
        typeId : null,
        typeName : null,
        startValue : null,
        endValue : null
    });
    console.log(settlement.meters);
}

function removeMeterLine(id) {

    const index = settlement.meters.findIndex(meter => meter.id === id)

    if (index !== -1) {
        settlement.meters.splice(index, 1)
    }
}

function addExpenseLine() {
    settlement.expenses.push(
        {
            id: getUid(),
            expenseTypeId: null,
            expenseTypeName: null,
            amount: null
        }
    )
}


function removeExpenseLine(id) {

    const index = settlement.expenses.findIndex(expense => expense.id === id)

    if (index !== -1) {
        settlement.expenses.splice(index, 1)
    }

}



</script>

<template>

    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">{{ $t('service-settlement.title')}}</h2>
    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('service-settlement.subtitle')}}</p>


    <div class="w-full mt-10 border-t border-gray-900/10 dark:border-white/10">

        <!-- PARTICIPANTS -->
        <SettlementParticipants
            v-model:selected-property="settlement.property"
            v-model:selected-landlord="settlement.landlord"
            v-model:selected-tenant="settlement.tenant"
            :properties="properties"
            :landlords="landlords"
            :tenants="tenants"
            @modal-form-submitted="createAndInsertPerson"
            @property-form-submitted="createAndInsertProperty"
        />

        <!-- INVOICING PERIOD -->
        <ListOfYears
            :label="$t('form.invoicing-period')"
            v-model="settlement.invoicingYear"
        />


        <!-- TENANT OCCUPANCY -->
        <DateRange
            v-model:start-date="settlement.tenantOccupancyStartDate"
            v-model:end-date="settlement.tenantOccupancyEndDate"
            :label="$t('form.tenant.occupancy')"
        />

        <!-- METERS -->
        <Meters
            :invoicing-year="settlement.invoicingYear"
            :occupancy-start-date="settlement.tenantOccupancyStartDate"
            :occupancy-end-date="settlement.tenantOccupancyEndDate"
            :meter-types="meterTypes"
            :meters="settlement.meters"
            @add-meter-line="addMeterLine"
            @remove-meter-line="removeMeterLine"
        />

        <Utilities
            :label="$t('service-settlement.utilities')"
            :utilities="settlement.utilities"
        />


        <!-- COSTS -->
        <Expenses
            :expenses-types="expensesTypes"
            :expenses="settlement.expenses"
            :label="$t('service-settlement.expenses')"
            @add-expense-line="addExpenseLine"
            @remove-expense-line="removeExpenseLine"
        />

        <!-- ADVANCED PAYMENTS -->
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6 border-b border-gray-900/10 dark:border-white/10">
            <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
                Advanced Payments
            </label>

            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <div class="sm:max-w-2xl w-full space-y-3">

                    <div v-for="i in 3" :key="i" class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                        <div class="grid grid-cols-3 gap-3">
                            <input type="date" class="input-style"/>
                            <input type="date" class="input-style"/>
                            <input type="number" placeholder="Amount" class="input-style"/>
                        </div>
                        <button class="flex h-8 w-8 items-center justify-center text-red-500 shrink-0">
                            <TrashIcon/>
                        </button>
                    </div>

                    <button class="text-indigo-600 text-sm">＋ Add payment</button>
                </div>
            </div>
        </div>


        <!-- ACTIONS -->
        <div class="flex justify-end gap-3 py-8">
            <button type="button"
                    class="px-4 py-2 text-sm rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white">
                Back
            </button>

            <button type="button"
                    class="px-4 py-2 text-sm rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white">
                Refresh
            </button>

            <button type="submit"
                    class="px-4 py-2 text-sm rounded-md bg-indigo-600 text-white hover:bg-indigo-500">
                Calculate
            </button>
        </div>

    </div>




<!--    <div>-->
<!--        <form>-->
<!--            <div class="space-y-12 sm:space-y-16">-->
<!--                <div>-->



<!--                    <div class="w-[85%] mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">-->


<!--                        <settlement-participants-->
<!--                            v-model:selected-property="settlement.property"-->
<!--                            v-model:selected-landlord="settlement.landlord"-->
<!--                            v-model:selected-tenant="settlement.tenant"-->
<!--                            :properties="properties"-->
<!--                            :landlords="landlords"-->
<!--                            :tenants="tenants"-->
<!--                            @modal-form-submitted="createAndInsertPerson"-->
<!--                            @property-form-submitted="createAndInsertProperty"-->
<!--                        />-->

<!--                        <settlement-dates/>-->

<!--&lt;!&ndash;                        <meters/>&ndash;&gt;-->

<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->




</template>

<style scoped>

</style>
