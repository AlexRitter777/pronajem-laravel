@props([
    'name' => '',
    'phone' => '',
    'email' => ''

])


<div
    x-data = "{
        form: {
            name: @js($name),
            phone: @js($phone),
            email: @js($email)
        }
    }"

    class="space-y-12 sm:space-y-16">
    <div
        x-bind:class="{ 'opacity-50': isLoading }"
    >
        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{__('New tenant')}}</h2>
        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ __('Enter the new tenant’s details.') }}</p>

        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">
            <form>

                {{--Name--}}
                <x-forms.light-input-group>
                    <x-forms.light-label name="name">
                        @lang('Name') *
                    </x-forms.light-label>
                    <x-forms.light-input-text
                        name="name"
                        id="name"
                        type="text"
                        placeholder="Property Company s.r.o."
                        autocomplete="name"
                        x-model="form.name"
                        x-bind:class="{ 'outline-red-500': errors.name }"
                    />
                </x-forms.light-input-group>
                <x-forms.light-error
                    x-show="errors.name"
                    x-text="errors.name"
                />

                {{--Email--}}
                <x-forms.light-input-group>
                    <x-forms.light-label>
                        @lang('Email')
                    </x-forms.light-label>
                    <x-forms.light-input-text
                        name="email"
                        id="email"
                        type="email"
                        placeholder="email@example.com"
                        autocomplete="email"
                        x-model="form.email"
                        x-bind:class="{ 'outline-red-500': errors.email }"
                    />
                </x-forms.light-input-group>
                <x-forms.light-error
                    x-show="errors.email"
                    x-text="errors.email"
                />

                {{--Phone--}}
                <x-forms.light-input-group>
                    <x-forms.light-label>
                        @lang('Phone number')
                    </x-forms.light-label>
                    <x-forms.light-input-text
                        name="phone"
                        id="phone"
                        type="text"
                        autocomplete="bday"
                        x-model="form.phone"
                        placeholder="+420 777 888 999"
                        x-bind:class="{ 'outline-red-500': errors.phone }"
                    />
                </x-forms.light-input-group>
                <x-forms.light-error
                    x-show="errors.phone"
                    x-text="errors.phone"
                />

            </form>
        </div>

        {{--Buttons--}}
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a
                @click="closeModal"
                href="javascript:void(0)"
                class="text-sm/6 font-semibold text-gray-900 dark:text-white"
                x-bind:class="{ 'opacity-50 cursor-not-allowed pointer-events-none': isLoading }"
            >
                {{ __('Back') }}
            </a>
            <button
                type="button"
                @click.prevent="save(form, 'spravci')"
                x-bind:disabled="isLoading"
                x-bind:class="{ 'opacity-50 cursor-not-allowed': isLoading }"
                class="inline-flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
            >
                <!-- Spinner -->
                <svg
                    x-show="isLoading"
                    class="animate-spin h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>
                </svg>

                <!-- Normal text -->
                <span x-show="!isLoading">{{ __('Save') }}</span>

                <!-- Loading text -->
                <span x-show="isLoading">Saving...</span>
            </button>
        </div>

    </div>
</div>
