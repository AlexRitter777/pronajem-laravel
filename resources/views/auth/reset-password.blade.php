<x-guest-layout-component>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-auth.primary-button class="w-full">
                {{ __('Reset Password') }}
            </x-auth.primary-button>
        </div>
    </form>
</x-guest-layout-component>
