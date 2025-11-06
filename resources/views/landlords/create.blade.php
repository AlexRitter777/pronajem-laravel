<x-layout-component>
    @session('error')
    <x-alerts.simple-error>{{ session('error') }}</x-alerts.simple-error>
    @endsession
    <form
        method="POST"
        action="{{ route('landlords.store') }}"
    >
        @csrf
        <div class="space-y-12 sm:space-y-16">
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{__('New landlord')}}</h2>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ __('Enter the new landlord’s details.') }}</p>

                <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">

                    <x-forms.input-text
                        type="text"
                        id="name"
                        name="name"
                        autocomplete="name"
                        {{--                        required="required"--}}
                        value="{{ old('name') }}"
                        placeholder="Jan Novák"
                    >
                        {{ __('Name') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="text"
                        id="address"
                        name="address"
                        autocomplete="street-address"
                        {{--                        required="required"--}}
                        value="{{ old('address') }}"
                        placeholder="Rybná 1223/3, 110 00 Praha 1"
                    >
                        {{ __('Address') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="email"
                        id="email"
                        name="email"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        placeholder="email@example.cz"
                    >
                        {{ __('Email') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="date"
                        id="birthday"
                        name="birthday"
                        autocomplete="bday"
                        value="{{ old('birthday') }}"
                    >
                        {{ __('Date of birth') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="text"
                        id="phone"
                        name="phone"
                        autocomplete="tel"
                        value="{{ old('phone') }}"
                        placeholder="+420 777 888 999"
                    >
                        {{ __('Phone number') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="account_number"
                        id="account_number"
                        name="account_number"
                        autocomplete="on"
                        value="{{ old('account_number') }}"
                        placeholder="1234567890/2010"
                    >
                        {{ __('Bank account number') }}
                    </x-forms.input-text>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('landlords.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
            <input
                type="submit"
                value="{{ __('Save') }}"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
            >
        </div>
    </form>


</x-layout-component>
