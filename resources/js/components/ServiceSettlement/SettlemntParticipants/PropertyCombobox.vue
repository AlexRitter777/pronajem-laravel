<script setup>
import ComboBox from "../../FormsElements/ComboBox.vue";
import {computed, onMounted, watch} from "vue";
import {ComboboxLabel} from "@headlessui/vue";
import PlusIcon from "../../Icons/PlusIcon.vue";

const props = defineProps({
    properties: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}
})

const emit = defineEmits(['update:modelValue', 'property-selected', 'open-modal'])


const selectedProperty = computed({
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
                {{ $t('service-settlement.property-address') }}
            </label>

            <!--button plus-->
            <PlusIcon
                @click="emit('open-modal', 'property')"
            />
        </div>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
                    <ComboBox
                        :items="properties"
                        :search-by="searchBy"
                        :placeholder="$t('service-settlement.placeholder-property')"
                        v-model="selectedProperty"
                    >
                    </ComboBox>

                </div>
            </div>
        </div>

    </div>



</template>
