<script setup>

import ComboBox from "../formsElements/ComboBox.vue";
import {computed, watch} from "vue";
import PlusIcon from "../Icons/PlusIcon.vue";

const props = defineProps({
    tenants: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
});

const emit = defineEmits(['update:modelValue', 'tenant-selected', 'open-modal'])

const selectedTenant = computed({
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
                {{ $t('service-settlement.tenant') }}
            </label>

            <!--button plus-->
            <PlusIcon
                @click="emit('open-modal', 'tenant')"
            />
        </div>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
                    <ComboBox
                        :items="tenants"
                        :search-by="searchBy"
                        v-model="selectedTenant"
                    >
                    </ComboBox>
                    <div class="h-8 w-8 invisible" aria-hidden="true"></div>

                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>

