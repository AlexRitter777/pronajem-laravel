<script setup>

import ComboBox from "../../FormsElements/ComboBox.vue";
import {computed, watch} from "vue";
import PlusIcon from "../../Icons/PlusIcon.vue";

const props = defineProps({
    landlords: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
});

const emit = defineEmits(['update:modelValue', 'landlord-selected', 'open-modal'])

const selectedLandlord = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    },
})

</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6">

        <div class="flex items-center">
            <label class="block text-sm font-medium text-gray-900 dark:text-white ">
                {{ $t('service-settlement.landlord') }}
            </label>

            <!--button plus-->
            <PlusIcon
                @click="emit('open-modal', 'landlord')"
            />
        </div>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
                    <ComboBox
                        :items="landlords"
                        :search-by="searchBy"
                        :placeholder="$t('service-settlement.placeholder-landlord')"
                        v-model="selectedLandlord"
                    >
                    </ComboBox>

                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
