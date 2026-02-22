<script setup>

import Modal from "../UiElements/Modal.vue";
import LightInputGroup from "../FormsElements/LightInput/LightInputGroup.vue";
import LightLabel from "../FormsElements/LightInput/LightLabel.vue";
import LightInput from "../FormsElements/LightInput/LightInput.vue";
import {computed, ref, watch} from "vue";


const props = defineProps({
    open: {type: Boolean, required: true},
    // modelValue: {type: Object, required: true},
})

// const formData = ref({ ...props.modelValue })

const formData = ref({
    'name': '',
    'address': '',
    'email': '',
    'birthday': '',
    'phone': '',
    'account_number': '',
})

// watch(
//     () => props.modelValue,
//     (val) => {
//         formData.value = { ...val }
//     },
//     { deep: true }
// )

function submitForm() {
    // emit('update:modelValue', formData.value)
    emit('submitted', formData.value, 'landlords')
}


const emit = defineEmits(['update:modelValue', 'submitted', 'close-modal'])

</script>

<template>

    <modal :open="open" >


        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $t('form.modal.landlord.title')}}</h2>
        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('form.modal.landlord.subtitle') }}</p>

        <form @submit.prevent="submitForm">


            <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0  sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10  dark:sm:border-t-white/10">

            <!--Name-->
            <light-input-group>
                <light-label name="name">
                    {{ $t('form.name')}}
                </light-label>
                <light-input
                    name="name"
                    id="name"
                    type="text"
                    autocomplete="name"
                    placeholder="Jan Novák"
                    v-model="formData.name"
                />
            </light-input-group>

            <!--Address-->
            <light-input-group>
                <light-label name="address">
                    {{ $t('form.address')}}
                </light-label>
                <light-input
                    name="address"
                    id="address"
                    type="text"
                    autocomplete="street-address"
                    placeholder="Rybná 1223/3, 110 00 Praha 1"
                    v-model="formData.address"
                />
            </light-input-group>

            <!--Email-->
            <light-input-group>
                <light-label name="email">
                    {{ $t('form.email')}}
                </light-label>
                <light-input
                    name="email"
                    id="email"
                    type="email"
                    autocomplete="email"
                    placeholder="email@example.com"
                    v-model="formData.email"
                />
            </light-input-group>

            <!--Birthday-->
            <light-input-group>
                <light-label name="birthday">
                    {{ $t('form.birthday')}}
                </light-label>
                <light-input
                    name="birthday"
                    id="birthday"
                    type="date"
                    autocomplete="bday"
                    v-model="formData.birthday"
                />
            </light-input-group>

            <!--Phone-->
            <light-input-group>
                <light-label name="phone">
                    {{ $t('form.phone')}}
                </light-label>
                <light-input
                    name="phone"
                    id="phone"
                    type="text"
                    autocomplete="phone"
                    placeholder="+420 777 888 999"
                    v-model="formData.phone"
                />
            </light-input-group>

                <!--Bank account number-->
                <light-input-group>
                    <light-label name="account_number">
                        {{ $t('form.account_number')}}
                    </light-label>
                    <light-input
                        name="account_number"
                        id="account_number"
                        type="text"
                        autocomplete="phone"
                        placeholder="1234567890/2010"
                        v-model="formData.account_number"
                    />
                </light-input-group>

            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="button"
                    @click="emit('close-modal')"
                    class="text-sm/6 font-semibold text-gray-900 dark:text-white"
                >
                    {{ $t('form.cancel') }}

                </button>
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
                    ref="cancelButtonRef"
                >
                    {{ $t('form.save') }}
                </button>
            </div>
        </form>
    </modal>

</template>

<style scoped>

</style>
