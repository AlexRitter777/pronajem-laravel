<div class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col dark:bg-gray-900">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4 dark:border-white/10 dark:bg-black/10">
        <div class="flex h-16 shrink-0 items-center">
            <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Vyuctovano logo" class="h-8 w-auto dark:hidden" />
            <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Vyuctovano logo" class="h-8 w-auto not-dark:hidden" />
            <h2 class="ml-1 text-2xl font-bold tracking-normal text-indigo-900 dark:text-white">Vyúčtováno!</h2>
        </div>
        <nav class="flex flex-1 flex-col">
            <x-sidebar.sidebar-links/>
        </nav>
    </div>
</div>
