<script setup xmlns="http://www.w3.org/1999/html">
import {computed, ref, watch} from 'vue'
import { CheckIcon, ChevronDownIcon } from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'
import CrossIcon from "../icons/crossIcon.vue";
import PlusIcon from "../icons/PlusIcon.vue";

const props = defineProps({
    title: {type: String, required:true},
    items: {type: Array, required: true},
    searchBy: {type: String, required: true},
    modelValue: {type: [Object, null], default: null, required: true}

})

const emit = defineEmits(['update:modelValue', 'open-modal'])

const selectedItem = computed({
    get: () => props.modelValue,
    set: value => {
        emit('update:modelValue', value)
        isDisabled(value?.id ?? null )
        removeNotCompletedItem(value?.id)
    },
})

watch(
    () => props.modelValue,
    (value) => {
        isDisabled(value?.id ?? null )
    }
)

const disabled = ref(false);

//search
const query = ref('')

const filteredItems = computed(() =>
    query.value === ''
        ? props.items
        : props.items.filter((item) => {
            return item[props.searchBy].toLowerCase().includes(query.value.toLowerCase())
        }),
)

const queryItem = computed(() => {
    return query.value === '' ? null : { id: null, [props.searchBy]: query.value }
})



function removeNotCompletedItem(id) {
    if (id === null) {
        selectedItem.value = null;
    }
}

function clearQuery(){
    query.value = '';
}

function clearInput(){
    selectedItem.value = '';
    emit('update:modelValue', null)
    disabled.value = false;
}

function isDisabled(id){
    disabled.value = id !== null;
}

</script>

<template>
    <Combobox
        as="div"
        v-model="selectedItem"
        class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6"
    >
        <div class="flex items-center sm:pt-1.5">
            <ComboboxLabel
                class="block text-sm/6 font-medium text-gray-900 dark:text-white"
            >
                {{ title }}
            </ComboboxLabel>
             <!--button plus-->
            <PlusIcon
                @click="emit('open-modal')"
            />
        </div>

        <div class="mt-2 sm:col-span-2 sm:mt-0">
            <div class="relative mt-2 block sm:max-w-md">
                <ComboboxInput
                    class="block w-full rounded-md bg-white py-1.5 pr-12 pl-3 text-base text-gray-900 outline-1 -outline-offset-1
                     outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-
                     600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500"
                    @change="query = $event.target.value"
                    @focusout="clearQuery"
                    :display-value="(item) => item?.[searchBy]"
                    :disabled="disabled"
                />
                <ComboboxButton
                    :disabled="disabled"
                    class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-hidden"
                >
                    <ChevronDownIcon class="size-5 text-gray-400" aria-hidden="true" />
                </ComboboxButton>
                <crossIcon
                    @click="clearInput"
                    v-show="disabled"
                ></crossIcon>
                <transition leave-active-class="transition ease-in duration-100" leave-from-class="" leave-to-class="opacity-0">
                <ComboboxOptions v-if="filteredItems.length > 0 || query.length > 0" class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline outline-black/5 sm:text-sm dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <ComboboxOption v-if="queryItem" :value="queryItem" as="template" v-slot="{ active }">
                        <li
                            :class="['relative cursor-default px-3 py-2 select-none', active ? 'bg-indigo-600 text-white outline-hidden dark:bg-indigo-500' : 'text-gray-900 dark:text-white']"

                        >
                          <span class="block truncate">
                            {{ query }}
                          </span>
                        </li>
                    </ComboboxOption>
                    <ComboboxOption v-for="item in filteredItems" :key="item.id" :value="item" as="template" v-slot="{ active }"
                    >
                        <li :class="['relative cursor-default px-3 py-2 select-none', active ? 'bg-indigo-600 text-white outline-hidden dark:bg-indigo-500' : 'text-gray-900 dark:text-white']"
                        >
                          <span class="block truncate">
                            {{ item[searchBy] }}
                          </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </transition>
            </div>
        </div>

    </Combobox>
</template>


