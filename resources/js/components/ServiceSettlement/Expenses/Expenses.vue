<script setup lang="ts">

import ExpenseCombobox from "./ExpenseCombobox.vue";
import TrashIcon from "../../Icons/TrashIcon.vue";
import SimpleInput from "../../FormsElements/SimpleInput.vue";
import PlusIcon from "../../Icons/PlusIcon.vue";
import {ref} from "vue";
import ExpenseModal from "./ExpenseModal.vue";
import LandlordModal from "../SettlemntParticipants/LandlordModal.vue";

const maxExpenses = 10;

const props = defineProps({
    label: {type: String, required: true},
    expenses: {type: Array, required: true},
    expensesTypes: {type: Array, required: true},
    modal: {type: Object, required: true},
})


const emit = defineEmits([
    'add-expense-line',
    'remove-expense-line',
    'open-modal',
    'modal-form-submitted'
]);

function closeModal() {
    props.modal.show = false;
    props.modal.errors = {};
}


</script>

<template>
    <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:py-6 border-b border-gray-900/10 dark:border-white/10">

        <div class="flex items-center">
            <label class="block text-sm font-medium text-gray-900 dark:text-white">
                {{ label }}
            </label>
            <!--button plus-->
            <PlusIcon
                @click="modal.show = true"
            />
        </div>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-3">

                <div class="flex justify-between mb-6">
                    <div class="w-full rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
                        <p class="font-medium">
                            {{ $t('service-settlement.enter-expenses') }}
                        </p>
                        <p class="mt-1">
                            {{ $t('service-settlement.enter-expenses-description') }}
                        </p>
                        <p class="mt-1">
                            <a class="underline " href=""> {{ $t('service-settlement.enter-expenses-link') }} </a>
                        </p>
                    </div>
                    <div class="h-8 w-12 invisible" aria-hidden="true"></div>

                </div>


                <div v-for="(expense, index) in expenses"  :key="expense.id" class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center">
                    <div class="grid grid-cols-2 gap-3">


                        <ExpenseCombobox
                            :model-value="{
                                id: expense.expenseTypeId,
                                name: expense.expenseTypeName,
                            }"
                            @update:model-value=" val => {
                                expense.expenseTypeId = val?.id ?? null;
                                expense.expenseTypeName = val?.name ?? null;
                            }"
                            search-by="name"
                            :expenses="expensesTypes"
                        />


                        <SimpleInput
                            type="number"
                            v-model="expense.amount"
                            :placeholder="$t('service-settlement.amount')"
                        />


                    </div>
                    <button
                        @click="$emit('remove-expense-line', expense.id)"
                        :class="[
                                'flex h-8 w-8 items-center justify-center text-indigo-600 shrink-0 hover:cursor-pointer hover:text-indigo-400',
                                index === 0 ? 'invisible pointer-events-none' : ''
                            ]"
                    >
                        <TrashIcon/>
                    </button>
                </div>

                <button
                    v-if="expenses.length < maxExpenses"
                    class="text-indigo-600 text-sm hover:cursor-pointer hover:text-indigo-400"
                    @click="$emit('add-expense-line')"
                >
                    ＋ {{ $t('expenses.add')}}
                </button>
            </div>
        </div>
        <ExpenseModal
            :open="modal.show"
            :errors="modal.errors"
            :loading="modal.loading"
            @close-modal="closeModal"
            @submitted="(data, url) => $emit('modal-form-submitted', data, url)"
        />
    </div>

</template>

<style scoped>

</style>
