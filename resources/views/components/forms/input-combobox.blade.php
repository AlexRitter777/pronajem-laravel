@props([
    'itemName' => '',
    'itemId' => '',
    'componentName' => '',
    'selectedItem' => '',
    'url' => ''
])

<div
    x-data="combobox({
        selectedItem: @js($selectedItem),
        selectedItemId: @js($selectedItemId),
        url: @js($url)
        })"
    class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6">
    <div class="flex items-center  sm:pt-1.5  ">
        <label
            for="autocomplete"
            class="block text-sm/6 font-medium mr-2 text-gray-900 dark:text-white"
        >
            {{ $slot }}
        </label>
        <x-buttons.plus-button
            @click.stop="openModal"
            class="hover: cursor-pointer"
        />
    </div>
    <div class="mt-2 sm:col-span-2 sm:mt-0">

        <el-autocomplete class="relative mt-2 block sm:max-w-md">
            <input
                id="autocomplete"
                type="text"
                class="block w-full rounded-md bg-white py-1.5 pr-12 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500"
                x-model="selectedItem"
                @focus="showItems=true"
                @focusout="refreshInput"
                x-bind:disabled="disabled"
                x-bind:placeholder="disabled ? '{{ __('There are no items yet') }}' : '{{ __('Select an item') }}'"
            />
            <template x-if="selectedItem">
                <button
                    type="button"
                    @click="deleteItem"
                    class="absolute inset-y-0 right-7 flex items-center rounded-r-md px-2 hover:cursor-pointer"
                >
                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 text-gray-400">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 1 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414Z" />
                    </svg>
                </button>
            </template>

            {{-- Modifying this button (adding attributes, listeners, etc.) may break the suggestion search feature --}}
            <button
                type="button"
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2"
            >
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 text-gray-400">
                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </button>

            <el-options
                x-show="showItems"
                anchor="bottom end" popover class="max-h-60 w-(--input-width) overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline outline-black/5 transition-discrete [--anchor-gap:--spacing(1)] data-leave:transition data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">

                <template
                    x-for="item in items"
                    :key="item.id"
                >
                    <el-option
                        :value="item.id"
                        x-text="item.name"
                        @click="selectItem(item)"
                        class="block truncate px-3 py-2 text-gray-900 select-none aria-selected:bg-indigo-600 aria-selected:text-white dark:text-gray-300 dark:aria-selected:bg-indigo-500"
                    ></el-option>
                </template>
            </el-options>

        </el-autocomplete>
        <input type="hidden" name="{{ $itemName }}" x-model="selectedItem" />
        <input type="hidden" name="{{ $itemId }}" x-model="selectedItemId" />
        @error($itemName)
        <p
            class="mt-2 text-sm text-red-600 dark:text-red-400"
        >
            {{ $message }}
        </p>
        @enderror
        @error($itemId)
        <p
            class="mt-2 text-sm text-red-600 dark:text-red-400"
        >
            {{ $message }}
        </p>
        @enderror


        <template x-if="isModalOpen" >
            <x-modal.combobox-modal>
                <x-dynamic-component
                    :component="$componentName"
                />
            </x-modal.combobox-modal>
        </template>

    </div>
</div>
