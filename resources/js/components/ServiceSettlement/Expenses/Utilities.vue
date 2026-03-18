<script setup>

import UtilitiesLine from "./UtilitiesLine.vue";


defineProps({
    label: {type: String, required: true},
    utilities: {type: Object, required: true},

})

</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6 border-b border-gray-900/10 dark:border-white/10">
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label }}
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-3">


                <div class="flex justify-between mb-6">
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

                <UtilitiesLine
                    v-model="utilities.hotWater"
                    :utility-type="$t('service-settlement.hot-water')"
                />

                <UtilitiesLine
                    v-model="utilities.coldWater"
                    :utility-type="$t('service-settlement.cold-water')"
                />

                <UtilitiesLine
                    v-model="utilities.heating"
                    :utility-type="$t('service-settlement.heating')"
                />

                <UtilitiesLine
                    v-model="utilities.coldWaterForHot"
                    :utility-type="$t('service-settlement.cold-water-hot')"
                />
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
