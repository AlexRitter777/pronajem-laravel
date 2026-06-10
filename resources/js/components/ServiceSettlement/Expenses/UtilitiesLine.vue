<script setup>

import SimpleInput from "../../FormsElements/SimpleInput.vue";
import {computed} from "vue";


const props = defineProps({
    utilityType: {type: String, required: true},
    modelValue: {type: [String, null], required: true},
    error: {type: [Array, null], default: null, required: false},
});

const emit = defineEmits(['update:modelValue'])

const amount = computed( {
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
    }
});


</script>

<template>

    <div class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
        <div class="grid grid-cols-2 gap-3">
            <SimpleInput
                :model-value="utilityType"
                disabled
            />
            <SimpleInput
                type="number"
                v-model="amount"
                :placeholder="$t('service-settlement.amount')"
                :error="error"
            />

        </div>
        <div class="h-8 w-8 invisible" aria-hidden="true"></div>
    </div>



</template>
