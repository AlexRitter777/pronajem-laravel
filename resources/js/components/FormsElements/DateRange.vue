<script setup>
import SimpleInput from "./SimpleInput.vue";
import {computed, watch} from "vue";
import SimpleError from "./SimpleError.vue";


const props = defineProps({
    label: {type: String, required: false},
    startDate: {type: [String, null], required: true},
    endDate: {type: [String, null], required: true},
    startDateError: {type: [Array, null], default: null, required: false},
    endDateError: {type: [Array, null], default: null, required: false},
})

const emit = defineEmits(["update:startDate", "update:endDate"])

const startDate = computed({
    get: () => props.startDate,
    set: value => {
        emit("update:startDate", value)
    }
});

const endDate = computed({
    get: () => props.endDate,
    set: value => {
        emit("update:endDate", value)
    }
});



</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6">

        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label }}
        </label>

        <div class="mt-2 mb-4 sm:col-span-2 sm:mt-0 sm:mb-0">
            <div class="sm:max-w-2xl w-full grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                <div class="grid grid-cols-2 gap-3">
                    <SimpleInput
                        type="date"
                        v-model="startDate"
                        :error="startDateError"
                    />
                    <SimpleInput
                        type="date"
                        v-model="endDate"
                        :error="endDateError"
                    />
                </div>
                <div class="h-8 w-8 invisible" aria-hidden="true"></div>
            </div>

        </div>
    </div>

</template>

<style scoped>

</style>
