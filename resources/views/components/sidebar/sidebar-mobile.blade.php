<div class="relative flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 dark:bg-gray-900 dark:ring dark:ring-white/10 dark:before:pointer-events-none dark:before:absolute dark:before:inset-0 dark:before:bg-black/10">
    <div class="relative flex h-16 shrink-0 items-center">
        <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Your Company" class="h-8 w-auto dark:hidden" />
        <img src="{{ asset('img/logo/logo_transparent.png') }}" alt="Your Company" class="h-8 w-auto not-dark:hidden" />
        <h2 class="ml-1 text-2xl font-bold tracking-normal text-indigo-900 dark:text-white">Vyúčtováno!</h2>
    </div>
    <nav class="relative flex flex-1 flex-col">
        <x-sidebar.sidebar-links/>
    </nav>
</div>
