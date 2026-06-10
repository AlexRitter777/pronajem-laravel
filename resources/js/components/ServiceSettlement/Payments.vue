<script setup>

import ListOfMonths from "./ListOfMonths.vue";
import ListOfYears from "./ListOfYears.vue";
import TrashIcon from "../Icons/TrashIcon.vue";
import SimpleInput from "../FormsElements/SimpleInput.vue";
import useLineErrors from "../../composables/line-errors.js";

const maxPayments = 20;

const props = defineProps({
    label: {type: String, required: true},
    payments: {type: Array, required: true},
    errors: {type: Object, required: false, default: () =>({})}

})

const paymentErrors = useLineErrors('payments');

defineEmits(['remove-payments-line', 'add-payment-line'])


</script>

<template>
        <label class="block text-sm font-medium text-gray-900 dark:text-white sm:pt-1.5">
            {{ label }}
        </label>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="sm:max-w-2xl w-full space-y-3">

                <div
                    v-for="(payment, index) in payments" :key="payment.id"
                    class="grid grid-cols-[minmax(0,1fr)_2rem] gap-3 items-center"
                >
                    <div class="grid grid-cols-3 gap-3">
                        <ListOfMonths
                            v-model="payment.month"
                            :error="paymentErrors(props.errors, index)?.month"
                        />
                        <ListOfYears
                            v-model="payment.year"
                            :error="paymentErrors(props.errors, index)?.year"
                        />
                        <SimpleInput
                            v-model="payment.amount"
                            :placeholder="$t('service-settlement.amount')"
                            :error="paymentErrors(props.errors, index)?.amount"
                        />
                    </div>
                    <button
                        type="button"
                        @click="$emit('remove-payments-line', payment.id)"
                        :class="[
                                'flex h-8 w-8 items-center justify-center text-indigo-600 shrink-0 hover:cursor-pointer hover:text-indigo-400',
                                index === 0 ? 'invisible pointer-events-none' : ''
                            ]"
                    >
                        <TrashIcon/>
                    </button>
                </div>

                <button
                    type="button"
                    v-if="payments.length < maxPayments"
                    class="text-indigo-600 text-sm hover:cursor-pointer hover:text-indigo-400"
                    @click="$emit('add-payment-line')"
                >
                    ＋ {{ $t('service-settlement.payments.add')}}
                </button>
            </div>
        </div>
</template>
