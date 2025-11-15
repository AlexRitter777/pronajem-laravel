@props([
    'dt' => '',
    'route' => '',
    'entity' => null
])

<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
    <dt class="text-sm/6 font-medium text-gray-900 dark:text-gray-100">{{ $dt }}</dt>
    <dd class="mt-1 sm:col-span-2 sm:mt-0 ">
        <a href="{{ route($route, $entity) }}"
           class="inline-block rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700
                hover:bg-gray-200 hover:text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
        >
            {{ $entity->name }}
        </a>
    </dd>
</div>
