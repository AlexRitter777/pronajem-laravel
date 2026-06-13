<script setup>

import SimpleInput from "../FormsElements/SimpleInput.vue";
import {computed, ref, watch, watchEffect} from "vue";
import FakeInput from "../FormsElements/FakeInput.vue";
import {trans} from "laravel-vue-i18n";
import SimpleError from "../FormsElements/SimpleError.vue";

const props = defineProps({
    coefficients: {type: Object, required: true},
    errors: {type: Object, required: false, default: () =>({})}
})

watch(() => props.errors, (value) => {
    console.log(value)
},
    {deep: true}
)


const showCoefficients = ref(false);

const coefficient = ref('');

const emit = defineEmits(['coefficients-removed']);

const coefficientRows = computed(() => {
    if(coefficient.value === 'one-coefficient'){
        return [
            {
                label: trans('coefficients.all-costs'),
                model: 'expensesCoefficient',
                group: 'values',
            }
        ]
    }
    if(coefficient.value === 'many-coefficients'){
        return [
            {
                label: trans('coefficients.housing-costs'),
                model: 'expensesCoefficient',
                group: 'values',
            },
            {
                label: trans('coefficients.hot-water'),
                model: 'hotWaterCoefficient',
                group: 'values',
            },
            {
                label: trans('coefficients.heating'),
                model: 'heatingCoefficient',
                group: 'values',
            },
            {
                label: trans('coefficients.cold-water'),
                model: 'coldWaterAndWasteCoefficient',
                group: 'values',
            },
        ]
    }

})


watch(coefficient, (value) => {
    props.coefficients.useOneCoefficient = value === 'one-coefficient';
    props.coefficients.useManyCoefficients = value === 'many-coefficients';
},
    {immediate: true}
);

watch(showCoefficients, (value) => {
    if(value){
        coefficient.value = 'one-coefficient';
    }
})




function showCoefficientsUpdated(){
    if(!showCoefficients.value){
        emit('coefficients-removed')
    }
}

</script>

<template>

    <div  class="rounded-md bg-blue-50 dark:bg-blue-500/10 p-4 text-sm text-blue-800 dark:text-blue-300">
        {{ $t('coefficients.info') }} <a class="underline" href="#" target="_blank"> {{ $t('coefficients.link')}}</a>
    </div>



    <div class="flex items-center justify-between">

        <span class="flex grow flex-col">
          <label class="text-sm/6 font-medium text-gray-900 dark:text-white" id="availability-label">{{ $t('coefficients.use') }}</label>
        </span>

        <div class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2 dark:bg-white/5 dark:inset-ring-white/10 dark:outline-indigo-500 dark:has-checked:bg-indigo-500">
            <span class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
            <input
                type="checkbox"
                class="absolute inset-0 size-full appearance-none focus:outline-hidden"
                v-model="showCoefficients"
                @change="showCoefficientsUpdated"
                id="show-coefficients"
                aria-labelledby="coefficients-label"
                aria-describedby="coefficients-description"
            />
        </div>

    </div>

        <div
            v-if="showCoefficients"
        >
            <fieldset
                class="mb-6"
            >
                <div class="mt-6 space-y-6 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                    <div class="flex items-center">
                        <input
                            id="one-coefficient"
                            v-model="coefficient"
                            :checked="coefficient === 'one-coefficient'"
                            type="radio"
                            value="one-coefficient"
                            class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-indigo-500 dark:checked:bg-indigo-500 dark:focus-visible:outline-indigo-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden"
                        />
                        <label
                            for="one-coefficient"
                            class="ml-3 block text-sm/6 font-medium text-gray-900 dark:text-white"
                        >
                            {{ $t('coefficients.one') }}
                        </label>

                    </div>

                    <div class="flex items-center">
                        <input
                            id="many-coefficients"
                            value="many-coefficients"
                            v-model="coefficient"
                            :checked="coefficient === 'many-coefficients'"
                            type="radio"
                            class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-indigo-500 dark:checked:bg-indigo-500 dark:focus-visible:outline-indigo-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden"
                        />
                        <label
                            for="many-coefficients"
                            class="ml-3 block text-sm/6 font-medium text-gray-900 dark:text-white"
                        >
                            {{ $t('coefficients.many') }}
                        </label>
                    </div>
                </div>
            </fieldset>

            <div class="grid gap-3 items-center mt-4">
                <div
                    v-for="row in coefficientRows"
                    class="grid grid-cols-2 gap-3"
                >

                    <FakeInput>
                        {{ row.label }}
                    </FakeInput>

                    <SimpleInput
                        type="number"
                        :placeholder="$t('coefficients.enter')"
                        v-model="coefficients[row.group][row.model]"
                        :error="errors ? errors[`coefficients.${row.model}`] : null"
                        :show-error="false"
                    />
                    <template v-if="errors[`coefficients.${row.model}`]">
                        <div></div>
                        <SimpleError
                            style="margin-top: -10px"
                            :error="errors ? errors[`coefficients.${row.model}`] : null"
                        />
                    </template>

                </div>

            </div>
        </div>

</template>

<style scoped>

</style>
