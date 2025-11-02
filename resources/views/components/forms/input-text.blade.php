@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'autocomplete' => 'off',
    'required' => '',
    'disabled' => '',
    'placeholder' => '',
    'value' => '',
    'required' => '',
])

<div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
    <label
        for="{{ $name }}"
        class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5 dark:text-white"
    >
        {{ $slot }}
    </label>
    <div class="mt-2 sm:col-span-2 sm:mt-0">
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            autocomplete="{{ $autocomplete }}"
            {{ $required }}
            placeholder="{{ $placeholder }}"
            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500"
        />
        @error($name)
        <p
            id="{{ $id }}-error"
            class="mt-2 text-sm text-red-600 dark:text-red-400"
        >
            {{ $message }}
        </p>
        @enderror

    </div>
</div>
