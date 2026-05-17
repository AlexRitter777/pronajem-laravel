<script setup>

import {onMounted, reactive, ref} from "vue";
import {getArrayOfItems, saveItems} from "../../utilites/api.js";
import SettlementParticipants from "./SettlemntParticipants/SettlementParticipants.vue";
import useSaveItem from "../../composables/saveItem.js";
import Meters from "./Meters/Meters.vue";
import DateRange from "../FormsElements/DateRange.vue";
import {getUid} from "../../utilites/uid.js";
import ListOfYears from "./ListOfYears.vue";
import Expenses from "./Expenses/Expenses.vue";
import Utilities from "./Expenses/Utilities.vue";
import OneInputRowWrapper from "./SettlemntParticipants/OneInputRowWrapper.vue";
import Payments from "./Payments.vue";
import {useMonths} from "../../composables/months.js";
import ComponentWrapper from "./ComponentWrapper.vue";
import Coefficients from "./Coefficients.vue";
import dayjs from "dayjs";
import BorderLine from "../UiElements/BorderLine.vue";

const {saveItem, loading, errors} = useSaveItem();
const {months} = useMonths();
const properties = ref([]);
const tenants = ref([]);
const landlords = ref([]);
const meterTypes=ref([]);
const expensesTypes=ref([]);

const showCoefficients = ref(false);

//use snapshots for displaying entities; id is only a reference for editing

function createInitialSettlement(){

    return {
        landlord: {id : null, name : null},
        tenant: {id : null, name : null},
        property: {id : null, address : null, tenant : null, landlord : null},
        invoicingYear: null,
        tenantOccupancyStartDate: null,
        tenantOccupancyEndDate: null,
        coefficients: {
            oneCoefficient: {
                expensesCoefficient: null,
            },
            manyCoefficients: {
                expensesCoefficient: null,
                hotWaterCoefficient: null,
                heatingCoefficient: null,
                coldWaterAndWasteCoefficient: null,
            },
        },
        hasMeters: true,
        meters: [
            {
                id : getUid(),
                typeId : null,
                typeName : null,
                meterNumber : null,
                startValue : null,
                endValue : null,
                startYearValue : null,
                endYearValue : null,
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
        payments: [
            {
                id : getUid(),
                month : null,
                year : null,
                amount : null,
            }
        ],

    }
}

const settlement = reactive(createInitialSettlement());

function resetSettlement() {
    Object.assign(settlement, createInitialSettlement())
}

const modals = reactive({
    landlord: { show: false, loading: false, errors: {} },
    tenant: { show: false, loading: false, errors: {} },
    property: { show: false, loading: false, errors: {} },
})

const expenseModal = reactive(
{ show: false, loading: false, errors: {} },
)


onMounted(async () => {
    //TODO: error handling for lists fetching..
    properties.value = await getArrayOfItems('/api/properties-list');
    tenants.value = await getArrayOfItems('/api/tenants-list');
    landlords.value = await getArrayOfItems('/api/seznam-pronajimatelu');
    meterTypes.value = await getArrayOfItems('/api/meter-types-list');
    expensesTypes.value = await getArrayOfItems('/api/expenses-list');
});


async function createAndInsertPerson(data, url, entity) {

    modals[entity].loading = true;


    try{
        const res = await saveItem(url, data)

        settlement[entity] = {
            id: res.data.data.id,
            name: res.data.data.name,
        };

        if(entity === 'landlord') { //TODO refactor later, api urls make in english
            landlords.value = await getArrayOfItems('/api/seznam-pronajimatelu');
        }else if(entity === 'tenant') {
            tenants.value = await getArrayOfItems('/api/tenants-list');
        }

        modals[entity].show = false;
        modals[entity].errors = {};
    }catch (e){
        console.log(e)
        modals[entity].errors = e.response.data.errors;
    }finally {
        modals[entity].loading = false;
    }

}


async function createAndInsertProperty(data, url) {

    modals.property.loading = true;

    try {
        const res = await saveItem(url, data);

        settlement.property = {
            id: res.data.data.id,
            address: res.data.data.address,

         }

        properties.value = await getArrayOfItems('/api/properties-list');

        modals.property.show = false;
        modals.property.errors = {};

    }catch (e){
        modals.property.errors = e.response.data.errors;
    }finally {
        modals.property.loading = false;
    }


}


async function createAndInsertExpense(data, url) {
    expenseModal.loading = true;

    try {
        await saveItem(url, data);
        expensesTypes.value = await getArrayOfItems('/api/expenses-list');
        expenseModal.show = false;
        expenseModal.errors = {};
    }catch (e) {
        expenseModal.errors = e.response.data.errors;
    }finally {
        expenseModal.loading = false;
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

function addPaymentLine() {

    const lastPayment = settlement.payments[settlement.payments.length - 1];

    const lastPaymentMonth = lastPayment.month;
    const lastPaymentYear = lastPayment.year;
    const lastPaymentAmount = lastPayment.amount;

    let newPaymentMonth = null;

    if(lastPaymentMonth) {

        if(lastPaymentMonth < 12){
            newPaymentMonth  = lastPaymentMonth + 1;
        } else {
            newPaymentMonth  = 1;
        }

    }

    settlement.payments.push(
        {
            id: getUid(),
            month: newPaymentMonth,
            year: lastPaymentYear,
            amount: lastPaymentAmount
        }
    )
}


function removePaymentLine(id) {
    const index = settlement.payments.findIndex(payment => payment.id === id)

    if (index !== -1) {
        settlement.payments.splice(index, 1)
    }
}

function checkCoefficients() {
    const invoicingYear = settlement.invoicingYear.toString();
    const tenantOccupancyStartDate = settlement.tenantOccupancyStartDate;
    const tenantOccupancyEndDate = settlement.tenantOccupancyEndDate;

    if(!invoicingYear || !tenantOccupancyStartDate || !tenantOccupancyEndDate) {
        return;
    }

    const formattedInvoicingYear = dayjs(invoicingYear, 'YYYY').format('YYYY');
    const formattedTenantOccupancyStartDate = dayjs(tenantOccupancyStartDate).format('YYYY');
    const formattedTenantOccupancyEndDate = dayjs(tenantOccupancyEndDate).format('YYYY');

    if(formattedInvoicingYear !== formattedTenantOccupancyStartDate
        || formattedInvoicingYear !== formattedTenantOccupancyEndDate) {
        showCoefficients.value = true;
    }else {
        showCoefficients.value = false;
    }

}

function clearCoefficients() {
    settlement.coefficients = {
        oneCoefficient: {
            expensesCoefficient: null,
        },
        manyCoefficients: {
            expensesCoefficient: null,
            hotWaterCoefficient: null,
            heatingCoefficient: null,
            coldWaterAndWasteCoefficient: null,
        },
    };

}

function checkMetersPresence(hasMeters){
    settlement.hasMeters = hasMeters;
}

// watch(settlement, (newValue, oldValue) => {
//     console.log('Settlement changed', newValue);
// }, {
//     deep: true
// });


async function calculateServiceSettlement() {
    console.log(settlement)

    try {
        const resp = await saveItems('/api/service-settlement', settlement);
        console.log(resp)
    }catch (e){
        console.log(e)
    }

}


</script>

<template>

    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">{{ $t('service-settlement.title')}}</h2>
    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('service-settlement.subtitle')}}</p>


    <div class="w-full mt-10 border-t border-gray-900/10 dark:border-white/10">

        <form
            @submit.prevent="calculateServiceSettlement"
        >

            <!-- PARTICIPANTS -->
            <SettlementParticipants
                v-model:selected-property="settlement.property"
                v-model:selected-landlord="settlement.landlord"
                v-model:selected-tenant="settlement.tenant"
                :properties="properties"
                :landlords="landlords"
                :tenants="tenants"
                :modals="modals"
                @modal-form-submitted="createAndInsertPerson"
                @property-form-submitted="createAndInsertProperty"
            />

            <BorderLine/>
            <!-- INVOICING PERIOD -->
            <OneInputRowWrapper
                :label="$t('service-settlement.invoicing-period')"
            >
                <ListOfYears
                    @year-selected="
                        $nextTick(() => {
                            checkCoefficients();
                        });
                    "
                    v-model="settlement.invoicingYear"
                />
            </OneInputRowWrapper>


            <!-- TENANT OCCUPANCY -->
            <DateRange
                @update:end-date=" $nextTick(() => {
                            checkCoefficients();
                        });"
                @update:start-date=" $nextTick(() => {
                            checkCoefficients();
                        });"
                v-model:start-date="settlement.tenantOccupancyStartDate"
                v-model:end-date="settlement.tenantOccupancyEndDate"
                :label="$t('service-settlement.tenant-occupancy')"
            />


            <OneInputRowWrapper
                :label="$t('service-settlement.coefficients')"
                v-if="showCoefficients"
            >
                <Coefficients
                    :coefficients="settlement.coefficients"
                    @coefficients-removed="clearCoefficients"
                />
            </OneInputRowWrapper>

            <BorderLine/>

            <!-- METERS -->
            <ComponentWrapper>
                <Meters
                    :label="$t('service-settlement.meters')"
                    :invoicing-year="settlement.invoicingYear"
                    :occupancy-start-date="settlement.tenantOccupancyStartDate"
                    :occupancy-end-date="settlement.tenantOccupancyEndDate"
                    :meter-types="meterTypes"
                    :meters="settlement.meters"
                    @add-meter-line="addMeterLine"
                    @remove-meter-line="removeMeterLine"
                    @has-meters="checkMetersPresence"
                />
            </ComponentWrapper>

            <!-- UTILITIES -->
            <ComponentWrapper>
                <Utilities
                    :label="$t('service-settlement.utilities')"
                    :utilities="settlement.utilities"
                />
            </ComponentWrapper>

            <!-- EXPENSES -->
            <ComponentWrapper>
                <Expenses
                    :expenses-types="expensesTypes"
                    :expenses="settlement.expenses"
                    :label="$t('service-settlement.expenses')"
                    :modal="expenseModal"
                    @add-expense-line="addExpenseLine"
                    @remove-expense-line="removeExpenseLine"
                    @modal-form-submitted="createAndInsertExpense"
                />
            </ComponentWrapper>

            <!-- ADVANCED PAYMENTS -->
            <ComponentWrapper>
                <Payments
                    :payments="settlement.payments"
                    :label="$t('service-settlement.advanced-payments')"
                    @remove-payments-line="removePaymentLine"
                    @add-payment-line="addPaymentLine"
                />
            </ComponentWrapper>

            <!-- ACTIONS -->
            <div class="flex justify-end gap-3 py-8">
                <button type="button"
                        class="px-4 py-2 text-sm rounded-md bg-gray-200 cursor-pointer hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    {{ $t('button.back') }}
                </button>

                <button type="button"
                        @click="resetSettlement"
                        class="px-4 py-2 text-sm rounded-md bg-gray-200 cursor-pointer hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    {{ $t('button.refresh') }}
                </button>

                <button type="submit"
                        class="px-4 py-2 text-sm rounded-md bg-indigo-600 text-white hover:bg-indigo-500">
                    {{ $t('button.calculate') }}
                </button>
            </div>
        </form>
    </div>






</template>

<style scoped>

</style>
