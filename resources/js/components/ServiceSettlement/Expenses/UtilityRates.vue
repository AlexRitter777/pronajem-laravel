<script setup>

import UtilitiesLine from "./UtilitiesLine.vue";
import {ref, watch} from "vue";
import SimpleInput from "../../FormsElements/SimpleInput.vue";

const props = defineProps({
    label: {type: String, required: true},
    utilityRates: {type: Object, required: true},
    showHotWaterRates: {type: Boolean, required: true},
    showHeatingRates: {type: Boolean, required: true},
    showColdWaterRates: {type: Boolean, required: true},
    heatingCoefficients: {type: Object, required: true},
    hasHeatingCoefficients: {type: Boolean, required: true},
    hasAnnualConsumptionComponent: {type: Boolean, required: true},
    annualConsumptionComponent: {type: Object, required: true},
    errors: {type: Object, required: false, default: () =>({})}

})

const hasHeatingCoefficientsValue = ref();
const hasAnnualConsumptionComponentValue = ref();

defineEmits(['hasHeatingCoefficientsUpdated', 'hasAnnualConsumptionComponentUpdated']);

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

watch(() => props.hasHeatingCoefficients, value => {
    hasHeatingCoefficientsValue.value = value;
    if (!value) {
        props.heatingCoefficients.firstCoefficient = null;
        props.heatingCoefficients.secondCoefficient = null;
        props.heatingCoefficients.thirdCoefficient = null;
    }
},
    {immediate: true}
)

watch(() => props.hasAnnualConsumptionComponent, value => {
        hasAnnualConsumptionComponentValue.value = value;
        if (!value) {
            props.annualConsumptionComponent.meterStartYearValue = null;
            props.annualConsumptionComponent.meterEndYearValue = null;
            props.annualConsumptionComponent.annualConsumption = null;
        }
    },
    {immediate: true}
)

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
                    v-model="utilityRates.hotWaterRate.fixedAmount"
                    :utility-type="$t('service-settlement.fixed-part')"
                    :error="errors['hotWaterRate.fixedAmount']"
                />
                <UtilitiesLine
                    v-model="utilityRates.hotWaterRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['hotWaterRate.unitPrice']"
                />
                <UtilitiesLine
                    v-model="utilityRates.coldWaterForHotRate.unitPrice"
                    :utility-type="$t('service-settlement.cold-water-hot')"
                    :error="errors['coldWaterForHotRate.unitPrice']"
                />
            </div>


            <!-- Studená voda -->
            <div v-if="showColdWaterRates" class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $t('service-settlement.cold-water') }}
                </h3>
                <UtilitiesLine
                    v-model="utilityRates.coldWaterRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['coldWaterRate.unitPrice']"
                />
            </div>


            <!-- Topení -->
            <div v-if="showHeatingRates" class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $t('service-settlement.heating') }}
                </h3>
                <UtilitiesLine
                    v-model="utilityRates.heatingRate.fixedAmount"
                    :utility-type="$t('service-settlement.fixed-part')"
                    :error="errors['heatingRate.fixedAmount']"
                />
                <UtilitiesLine
                    v-model="utilityRates.heatingRate.unitPrice"
                    :utility-type="$t('service-settlement.unit-price')"
                    :error="errors['heatingRate.unitPrice']"
                />

                <!-- Heating coefficients-->

                <div class="flex justify-between">
                    <div class="w-full rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
                        <p class="font-medium">
                            {{ $t('heating-coefficients-title') }}
                        </p>
                        <p class="mt-1">
                            {{ $t('heating-coefficients-description') }}
                            <a class="underline" href=""  target="_blank">{{ $t('heating-coefficients-link') }}</a>
                        </p>
                    </div>
                    <div class="h-8 w-12 invisible" aria-hidden="true"></div>
                </div>

                <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">

                    <div class="flex items-center justify-between">
                        <span class="flex grow flex-col">
                          <label class="text-sm/6 font-medium text-gray-900 dark:text-white" id="availability-label">{{ $t('coefficients.use') }}</label>
                        </span>

                        <div class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2 dark:bg-white/5 dark:inset-ring-white/10 dark:outline-indigo-500 dark:has-checked:bg-indigo-500">
                            <span class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
                            <input
                                type="checkbox"
                                class="absolute inset-0 size-full appearance-none focus:outline-hidden"
                                v-model="hasHeatingCoefficientsValue"
                                @change="$emit('hasHeatingCoefficientsUpdated', hasHeatingCoefficientsValue)"
                                id="show-coefficients"
                                aria-labelledby="coefficients-label"
                                aria-describedby="coefficients-description"
                            />
                        </div>
                    </div>
                </div>

                <template v-if="hasHeatingCoefficients">
                    <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                        <div class="grid grid-cols-2 gap-3">
                            <SimpleInput
                                v-model="heatingCoefficients.firstCoefficient"
                                type="number"
                                :placeholder="$t('coefficient') + ' 1'"
                                :error="errors['firstCoefficient']"
                            />
                            <SimpleInput
                                v-model="heatingCoefficients.secondCoefficient"
                                type="number"
                                :placeholder="$t('coefficient') + ' 2'"
                                :error="errors['secondCoefficient']"
                            />
                        </div>

                    </div>

                    <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">

                        <div class="grid grid-cols-2 gap-3">
                            <SimpleInput
                                v-model="heatingCoefficients.thirdCoefficient"
                                type="number"
                                :placeholder="$t('coefficient') + ' 3'"
                                :error="errors['thirdCoefficient']"
                            />
                        </div>
                    </div>
                </template>
                <!-- End Heating coefficients-->

                <!-- Corrected unit price-->

                <div class="flex justify-between">
                    <div class="w-full rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
                        <p class="font-medium">
                            {{ $t('manual-consumption-title') }}
                        </p>
                        <p class="mt-1">
                            {{ $t('manual-consumption-description') }}
                            <a class="underline" href=""  target="_blank">{{ $t('manual-consumption-link') }}</a>
                        </p>
                    </div>
                    <div class="h-8 w-12 invisible" aria-hidden="true"></div>
                </div>
                <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">

                    <div class="flex items-center justify-between">
                        <span class="flex grow flex-col">
                          <label class="text-sm/6 font-medium text-gray-900 dark:text-white" id="availability-label">{{ $t('manual-consumption-toggle') }}</label>
                        </span>

                        <div class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2 dark:bg-white/5 dark:inset-ring-white/10 dark:outline-indigo-500 dark:has-checked:bg-indigo-500">
                            <span class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
                            <input
                                type="checkbox"
                                class="absolute inset-0 size-full appearance-none focus:outline-hidden"
                                v-model="hasAnnualConsumptionComponentValue"
                                @change="$emit('hasAnnualConsumptionComponentUpdated', hasAnnualConsumptionComponentValue)"
                                id="show-coefficients"
                                aria-labelledby="coefficients-label"
                                aria-describedby="coefficients-description"
                            />
                        </div>
                    </div>
                </div>

                <template
                    v-if="hasAnnualConsumptionComponent"
                >
                    <UtilitiesLine
                        v-model="annualConsumptionComponent.meterStartYearValue"
                        :utility-type="$t('service-settlement.meter-start-year')"
                        :placeholder="$t('service-settlement.value')"
                        :error="errors['meterStartYearValue']"
                    />
                    <UtilitiesLine
                        v-model="annualConsumptionComponent.meterEndYearValue"
                        :utility-type="$t('service-settlement.meter-end-year')"
                        :placeholder="$t('service-settlement.value')"
                        :error="errors['meterEndYearValue']"
                    />
                    <UtilitiesLine
                        v-model="annualConsumptionComponent.annualConsumption"
                        :utility-type="$t('service-settlement.annual.unit.amount')"
                        :error="errors['annualConsumption']"
                    />
                </template>
                <!-- End Corrected unit price-->

            </div>



        </div>
    </div>

</template>

<style scoped>

</style>
