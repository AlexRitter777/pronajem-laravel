<script setup>

import {ref} from "vue";
import Modal from "../../UiElements/Modal.vue";
import LightInputGroup from "../../FormsElements/LightInput/LightInputGroup.vue";
import LightLabel from "../../FormsElements/LightInput/LightLabel.vue";
import LightInput from "../../FormsElements/LightInput/LightInput.vue";

const props = defineProps({
    open: {type: Boolean, required: true},
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
                        v-model="formData.type"
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
