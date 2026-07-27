<script setup>

import UtilitiesLine from "./UtilitiesLine.vue";
import {watch} from "vue";

const props = defineProps({
    label: {type: String, required: true},
    utilityRates: {type: Object, required: true},
    showHotWaterRates: {type: Boolean, required: true},
    showHeatingRates: {type: Boolean, required: true},
    showColdWaterRates: {type: Boolean, required: true},
    errors: {type: Object, required: false, default: () =>({})}

})


watch(() => props.showHotWaterRates, value => {
    if (!value) {
        props.utilityRates.hotWaterRate.fixedAmount = null;
        props.utilityRates.hotWaterRate.unitPrice = null;
        props.utilityRates.coldWaterForHotRate.unitPrice = null;
    }
})

watch(() => props.showHeatingRates, value => {
    if (!value) {
        props.utilityRates.heatingRate.fixedAmount = null;
        props.utilityRates.heatingRate.unitPrice = null;
    }
})

watch(() => props.showColdWaterRates, value => {
    if (!value) {
        props.utilityRates.coldWaterRate.unitPrice = null;
    }
})

</script>

<template>
    <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
        {{ label }}
    </label>

    <div class="mt-2 sm:col-span-2 sm:mt-0">
        <div class="sm:max-w-2xl w-full space-y-6">

            <div class="flex justify-between">
                <div class="w-full rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
                    <p class="font-medium">
                        {{ $t('service-settlement.enter-utility-costs') }}
                    </p>
                    <p class="mt-1">
                        {{ $t('service-settlement.enter-utility-costs-description') }}
                    </p>
                </div>
                <div class="h-8 w-12 invisible" aria-hidden="true"></div>
            </div>

            <!-- Horká voda -->
            <div v-if="showHotWaterRates" class="space-y-3" >
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $t('service-settlement.hot-water') }}
                </h3>
                <UtilitiesLine
                    v-model="props.utilityRates.hotWaterRate.fixedAmount"
                    :utility-type="$t('service-settlement.fixed-part')"
                    :error="errors['utility_hot_water']"
                />
                <UtilitiesLine
                    v-model="props.utilityRates.hotWaterRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['utility_hot_water']"
                />
                <UtilitiesLine
                    v-model="props.utilityRates.coldWaterForHotRate.unitPrice"
                    :utility-type="$t('service-settlement.cold-water-hot')"
                    :error="errors['utility_cold_water_for_hot']"
                />
            </div>

            <!-- Topení -->
            <div v-if="showHeatingRates" class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $t('service-settlement.heating') }}
                </h3>
                <UtilitiesLine
                    v-model="props.utilityRates.heatingRate.fixedAmount"
                    :utility-type="$t('service-settlement.fixed-part')"
                    :error="errors['utility_heating']"
                />
                <UtilitiesLine
                    v-model="props.utilityRates.heatingRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['utility_heating']"
                />
            </div>

            <!-- Studená voda -->
            <div v-if="showColdWaterRates" class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $t('service-settlement.cold-water') }}
                </h3>
                <UtilitiesLine
                    v-model="props.utilityRates.coldWaterRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['utility_cold_water']"
                />
            </div>

        </div>
    </div>

</template>

<style scoped>

</style>
