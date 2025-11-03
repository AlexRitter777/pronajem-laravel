<a {{ $attributes->merge(['class' => 'mt-3 inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:mt-0 sm:w-auto
           dark:bg-red-500 dark:text-white dark:shadow-none dark:hover:bg-red-400']) }}>
    {{ $slot }}
</a>
