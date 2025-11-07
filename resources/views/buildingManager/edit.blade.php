
<x-layout-component>
    @session('error')
    <x-alerts.simple-error>{{ session('error') }}</x-alerts.simple-error>
    @endsession
    <form
        method="POST"
        action="{{ route('building-managers.update', ['buildingManager' => $buildingManager]) }}"
    >
        @csrf
        @method('PUT')
        <div class="space-y-12 sm:space-y-16">
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $buildingManager->name }}</h2>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ __('Edit landlord details.') }}</p>

                <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">

                    <x-forms.input-text
                        type="text"
                        id="name"
                        name="name"
                        autocomplete="name"
                        {{--                        required="required"--}}
                        value="{{ old('name', $buildingManager->name) }}"
                        placeholder="Property Facility s.r.o."
                    >
                        {{ __('Name') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="text"
                        id="phone"
                        name="phone"
                        autocomplete="tel"
                        value="{{ old('phone',  $buildingManager->phone) }}"
                        placeholder="+420 777 888 999"
                    >
                        {{ __('Phone number') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="email"
                        id="email"
                        name="email"
                        autocomplete="email"
                        value="{{ old('email', $buildingManager->email) }}"
                        placeholder="email@example.cz"
                    >
                        {{ __('Email') }}
                    </x-forms.input-text>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="javascript:void(0)" onclick="window.history.back()" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
            <input
                type="submit"
                value="{{ __('Save') }}"
                class="inline-flex justify-center rounded-md cursor-pointer bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
            >
            <x-buttons.danger-button
                href="javascript:void(0)"
                x-data=""
                x-on:click.prevent="$dispatch('open-dialog')"
            >
                {{ __('Delete') }}
            </x-buttons.danger-button>


        </div>
    </form>
    <x-modal.tw-modal>

        <form method="post" action="{{ route('building-managers.destroy', $buildingManager) }}" >
            @csrf
            @method('delete')
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10 dark:bg-red-500/10">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600 dark:text-red-400">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 id="dialog-title" class="text-base font-semibold text-gray-900 dark:text-white">{{ __('Delete Building Manager') }}</h3>
                    <div class="my-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {!! __('Are you sure you want to delete this building manager: ') .'<b> '. $buildingManager->name . '</b>?' !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6">

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto dark:bg-red-500 dark:shadow-none dark:hover:bg-red-400"
                    >
                        {{__('Delete')}}
                    </button>
                    <button
                        type="button"
                        @click="$dispatch('close-dialog')"
                        @click.away="$dispatch('close-dialog')"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20"
                    >
                        {{__('Cancel')}}
                    </button>
                </div>
        </form>
    </x-modal.tw-modal>

</x-layout-component>


