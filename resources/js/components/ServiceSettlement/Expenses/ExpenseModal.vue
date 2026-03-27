<script setup>


import {ref} from "vue";
import LightLabel from "../../FormsElements/LightInput/LightLabel.vue";
import LightInputGroup from "../../FormsElements/LightInput/LightInputGroup.vue";
import Modal from "../../UiElements/Modal.vue";
import LightInput from "../../FormsElements/LightInput/LightInput.vue";
import SimpleError from "../../FormsElements/SimpleError.vue";
import SubmitButton from "../../UiElements/SubmitButton.vue";

defineProps({
    open: {type: Boolean, required: true},
    errors: {type: Object, required: true},
    loading: {type: Boolean, required: true},
})

const emit = defineEmits(['submitted', 'close-modal'])

const formData = ref({
    name: '',
})

function submitForm() {
    emit('submitted', formData.value, '/api/expense-types')
}

</script>

<template>
    <modal
        :open="open"
        @close-modal="emit('close-modal', 'expense')"
    >


        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $t('service-settlement.expense.title')}}</h2>
        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ $t('service-settlement.expense.subtitle') }}</p>

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
                        placeholder="Odvoz odpadu"
                        v-model="formData.name"
                        :class="{'outline-red-500': errors.name}"
                    />
                </light-input-group>
                <SimpleError
                    :error="errors.name ?? null"
                />
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button
                    type="button"
                    @click="emit('close-modal', 'expense')"
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

