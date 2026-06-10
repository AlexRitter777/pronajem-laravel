<script setup>

    import {computed} from "vue";
    import ComboBox from "../../FormsElements/ComboBox.vue";

    const props = defineProps({
        expenses: {type: Array, required: true},
        searchBy: {type: String, required: true},
        modelValue: {type: [Object, null], default: null, required: true},
        error: {type: [Array, null], default: null, required: false},
    })

    const emit = defineEmits(['update:modelValue'])

    const selectedExpense = computed({
        get: () => props.modelValue,
        set: value => {
            emit('update:modelValue', value)
        }
    })


</script>

<template>
    <div class="">

        <div class="sm:col-span-2 ">
            <div class="sm:max-w-2xl w-full  gap-3 items-center">
                <div class="grid grid-cols-1 gap-3">
                    <ComboBox
                        :items="expenses"
                        :search-by="searchBy"
                        :placeholder="$t('service-settlement.placeholder-expense')"
                        v-model="selectedExpense"
                        :error="error"
                    >
                    </ComboBox>

                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
