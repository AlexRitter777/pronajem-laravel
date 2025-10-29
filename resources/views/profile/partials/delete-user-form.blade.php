<section class="space-y-6">
    <header>
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
            {{ __('Delete Account') }}
        </h3>

        <p class="mt-2 mb-3 max-w-4xl text-sm text-gray-500 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-auth.danger-button
        x-data=""
        x-on:click="$dispatch('open-dialog')"
    >
        {{ __('Delete Account') }}
    </x-auth.danger-button>

    <x-modal.tw-modal :show="$errors->userDeletion->isNotEmpty()">

        <form method="post" action="{{ route('profile.destroy') }}" >
            @csrf
            @method('delete')
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10 dark:bg-red-500/10">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600 dark:text-red-400">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 id="dialog-title" class="text-base font-semibold text-gray-900 dark:text-white">Delete account</h3>
                    <div class="my-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Are you sure you want to delete your account? All of your data will be permanently removed
                            from our servers forever. This action cannot be undone.') }}
                        </p>
                    </div>
                    <x-auth.input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-auth.text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                        x-ref="focusTarget"
                    />

                    <x-auth.input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
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

{{--    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>--}}
{{--        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">--}}
{{--            @csrf--}}
{{--            @method('delete')--}}

{{--            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">--}}
{{--                {{ __('Are you sure you want to delete your account?') }}--}}
{{--            </h2>--}}

{{--            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">--}}
{{--                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}--}}
{{--            </p>--}}

{{--            <div class="mt-6">--}}
{{--                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />--}}

{{--                <x-text-input--}}
{{--                    id="password"--}}
{{--                    name="password"--}}
{{--                    type="password"--}}
{{--                    class="mt-1 block w-3/4"--}}
{{--                    placeholder="{{ __('Password') }}"--}}
{{--                />--}}

{{--                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />--}}
{{--            </div>--}}

{{--            <div class="mt-6 flex justify-end">--}}



{{--                <x-secondary-button x-on:click="$dispatch('close')">--}}
{{--                    {{ __('Cancel') }}--}}
{{--                </x-secondary-button>--}}

{{--                <x-danger-button class="ms-3">--}}
{{--                    {{ __('Delete Account') }}--}}
{{--                </x-danger-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-modal>--}}
</section>
