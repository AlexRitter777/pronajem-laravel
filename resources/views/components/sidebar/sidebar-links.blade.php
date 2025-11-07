<ul role="list" class="flex flex-1 flex-col gap-y-4">
    <li>
        <ul role="list" class="-mx-2 space-y-1">

            <x-sidebar.sidebar-link
                :title="__('New')"
            >
                <x-icons.icon-plus
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

        </ul>
    </li>


    <li>
        <ul role="list" class="-mx-2 space-y-1">

            <x-sidebar.sidebar-link
                :title="__('Dashboard')"
                href="{{ route('dashboard') }}"
            >
                <x-icons.icon-home
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Settlements')"
            >
                <x-icons.icon-documents
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Landlords')"
                href="{{ route('landlords.index') }}"
            >
                <x-icons.icon-two-users
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Tenants')"
                href="{{ route('tenants.index') }}"
            >
                <x-icons.icon-three-users
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Properties')"
            >
                <x-icons.icon-building
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Building Managers')"
                href="{{ route('building-managers.index') }}"
            >
                <x-icons.icon-briefcase
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Electricity Suppliers')"
            >
                <x-icons.icon-light-bulb
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

        </ul>
    </li>
    <li>
        <ul role="list" class="-mx-2 mt-2 space-y-1">

            <x-sidebar.sidebar-link
                :title="__('Templates')"
            >
                <x-icons.icon-text-document
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Documentation')"
            >
                <x-icons.icon-search-document
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>

            <x-sidebar.sidebar-link
                :title="__('Help')"
            >
                <x-icons.icon-question
                    class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
                />
            </x-sidebar.sidebar-link>


        </ul>
    </li>
    <li class="mt-auto">
        <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-white">
            <x-icons.icon-settings
                class="size-6 text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-white"
            />
            {{__('Settings')}}
        </a>
    </li>
</ul>
