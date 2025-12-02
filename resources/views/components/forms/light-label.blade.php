@props([
    'name' => ''
])


    <label
        for="{{ $name }}"
        class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5 dark:text-white"
    >
        {{ $slot }}
    </label>
