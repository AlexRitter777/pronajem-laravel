<script setup>

import {ref} from "vue";
import Modal from "../../UiElements/Modal.vue";
import LightInputGroup from "../../FormsElements/LightInput/LightInputGroup.vue";
import LightLabel from "../../FormsElements/LightInput/LightLabel.vue";
import LightInput from "../../FormsElements/LightInput/LightInput.vue";
import SubmitButton from "../../UiElements/SubmitButton.vue";
import SimpleError from "../../FormsElements/SimpleError.vue";

const props = defineProps({
    open: {type: Boolean, required: true},
    loading: {type: Boolean, required: true},
    errors: {type: [Object, null], required: true},
})

const formData = ref({
    'address': '',
    'type': '',
    'description': '',
})

const emit = defineEmits(['update:modelValue', 'submitted', 'close-modal'])

function submitForm() {
    emit('submitted', formData.value, '/api/nemovitosti')
}

</script>

<template>
    <modal :open="open" @close-modal="emit('close-modal', 'property')">


        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $t('form.modal.property.title')}}</h2>
        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('form.modal.property.subtitle') }}</p>

        <form @submit.prevent="submitForm">

            <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0  sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10  dark:sm:border-t-white/10">

                <!--Address-->
                <light-input-group>
                    <light-label name="address">
                        {{ $t('form.address')}} *
                    </light-label>
                    <light-input
                        name="address"
                        id="address"
                        type="text"
                        autocomplete="street-address"
                        placeholder="Rybná 1223/3, 110 00 Praha 1"
                        v-model="formData.address"
                        :class="{'outline-red-500': errors.type}"
                    />
                    <SimpleError
                        :error="errors.address ?? null"
                    />
                </light-input-group>

                <!--Type-->
                <light-input-group>
                    <light-label name="type">
                        {{ $t('form.type')}} *
                    </light-label>
                    <light-input
                        name="type"
                        id="type"
                        type="text"
                        autocomplete="on"
                        placeholder="Byt 1kk"
                        v-model="formData.type"
                        :class="{'outline-red-500': errors.type}"
                    />
                    <SimpleError
                        :error="errors.type ?? null"
                    />
                </light-input-group>


                <!--Type-->
                <light-input-group>
                    <light-label name="description">
                        {{ $t('form.description')}}
                    </light-label>
                    <light-input
                        name="description"
                        id="description"
                        type="text"
                        autocomplete="on"
                        placeholder="Číslo jednotky 2231, sklep S81, garažové stání P123"
                        v-model="formData.description"
                        :class="{'outline-red-500': errors.description}"
                    />
                    <SimpleError
                        :error="errors.description ?? null"
                    />
                </light-input-group>

            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="button"
                    @click="emit('close-modal', 'property')"
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
</template>

<style scoped>

</style>
