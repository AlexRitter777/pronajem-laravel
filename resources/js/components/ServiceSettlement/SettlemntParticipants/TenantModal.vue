<script setup>

import Modal from "../../UiElements/Modal.vue";
import LightInputGroup from "../../FormsElements/LightInput/LightInputGroup.vue";
import LightLabel from "../../FormsElements/LightInput/LightLabel.vue";
import LightInput from "../../FormsElements/LightInput/LightInput.vue";
import {computed, ref, watch} from "vue";
import SubmitButton from "../../UiElements/SubmitButton.vue";
import SimpleError from "../../FormsElements/SimpleError.vue";


const props = defineProps({
    open: {type: Boolean, required: true},
    loading: {type: Boolean, required: true},
    errors: {type: Object, required: true},
})


const formData = ref({
    'name': '',
    'address': '',
    'email': '',
    'birthday': '',
    'phone': '',
    'account_number': '',
})


function submitForm() {
    emit('submitted', formData.value, '/api/najemnici', 'tenant')
}


const emit = defineEmits(['update:modelValue', 'submitted', 'close-modal'])

</script>

<template>
    <Teleport to="body">
        <modal :open="open" @close-modal="emit('close-modal', 'tenant')">


        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $t('form.modal.tenant.title')}}</h2>
        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('form.modal.tenant.subtitle') }}</p>

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
                    :class="{'outline-red-500': errors.name}"

                />
                <SimpleError
                    :error="errors.name ?? null"
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
                    :class="{'outline-red-500': errors.address}"
                />
                <SimpleError
                    :error="errors.address ?? null"
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
                    :class="{'outline-red-500': errors.email}"
                />
                <SimpleError
                    :error="errors.email ?? null"
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
                    :class="{'outline-red-500': errors.birthday}"
                />
                <SimpleError
                    :error="errors.birthday ?? null"
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
                    :class="{'outline-red-500': errors.phone}"
                />
                <SimpleError
                    :error="errors.phone ?? null"
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
                        :class="{'outline-red-500': errors.account_number}"
                    />
                    <SimpleError
                        :error="errors.account_number ?? null"
                    />
                </light-input-group>

            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="button"
                    @click="emit('close-modal', 'tenant')"
                    class="text-sm/6 font-semibold text-gray-900 dark:text-white"
                >
                    {{ $t('form.cancel') }}

                </button>
                <SubmitButton
                    :loading="loading"
                >
                    <template #main-label>
                        {{ $t('form.save') }}
                    </template>
                    <template #loading-label>
                        {{ $t('form.loading') }}
                    </template>
                </SubmitButton>
            </div>
        </form>
    </modal>
    </Teleport>
</template>

<style scoped>

</style>
