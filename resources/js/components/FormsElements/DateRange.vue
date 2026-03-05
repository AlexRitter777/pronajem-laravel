<script setup>
import SimpleInput from "./SimpleInput.vue";
import {computed} from "vue";


const props = defineProps({
    label: {type: String, required: false},
    startDate: {type: [String, null], required: true},
    endDate: {type: [String, null], required: true},
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

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full">
                <div class="grid grid-cols-2 gap-3">
                    <SimpleInput
                        type="date"
                        v-model="startDate"
                    />
                    <SimpleInput
                        type="date"
                        v-model="endDate"
                    />
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
