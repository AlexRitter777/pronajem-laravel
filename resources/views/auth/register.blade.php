<x-guest-layout-component>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-auth.input-label
                for="name"
                :value="__('Name')"
            />
            <div class="mt-2">
                <x-auth.text-input
                    id="name"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                    value="{{ old('name') }}"
                />
                <x-auth.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-auth.input-label
                for="email"
                :value="__('Email address')"
            />
            <div class="mt-2">
                <x-auth.text-input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autocomplete="email"
                    value="{{ old('email') }}"
                />
                <x-auth.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>


        <div>
            <x-auth.input-label
                for="password"
                :value="__('Password')"
            />
            <div class="mt-2">
                <x-auth.text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-auth.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-auth.input-label
                for="password_confirmation"
                :value="__('Confirm Password')"
            />
            <div class="mt-2">
                <x-auth.text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-auth.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-auth.primary-button class="w-full">
                {{ __('Register') }}
            </x-auth.primary-button>
        </div>

    </form>
    <div class="text-sm/6 mt-6 flex items-center justify-center">
        <a href="{{ route('login') }}"
           class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
        >
            {{ __('Already registered?') }}
        </a>
    </div>
</x-guest-layout-component>
