<x-layout-component>

    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
            {{ __('Profile settings') }} - {{ $user->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @session('status')
            <x-alerts.simple-success>
                {{ session('status') }}
            </x-alerts.simple-success>
            @endsession


            <div class="p-4 sm:p-8 border border-gray-200 shadow bg-white dark:bg-gray-800 dark:border-gray-600 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 border border-gray-200 shadow bg-white dark:bg-gray-800 dark:border-gray-600 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 border border-gray-200 shadow bg-white dark:bg-gray-800 dark:border-gray-600 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-layout-component>
