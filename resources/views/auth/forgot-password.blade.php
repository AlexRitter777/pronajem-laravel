<x-guest-layout-component>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
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
                    autofocus
                    autocomplete="email"
                    value="{{ old('email') }}"
                />
                <x-auth.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-auth.primary-button class="w-full">
                {{ __('Email Password Reset Link') }}
            </x-auth.primary-button>
        </div>
    </form>
</x-guest-layout-component>
