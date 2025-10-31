<section>
    <header>
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
            {{ __('Profile Information') }}
        </h3>

        <p class="mt-2 mb-3 max-w-4xl text-sm text-gray-500 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{--    Send verification email form. Submit is down below--}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-auth.input-label
                for="name"
                :value="__('Name')"
            />
            <x-auth.text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-auth.input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        <div>
            <x-auth.input-label
                for="email"
                :value="__('Email')"
            />
            <x-auth.text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="email"
            />
            <x-auth.input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="rounded-md mt-3 bg-yellow-50 p-4 mb-3 dark:bg-yellow-500/10 dark:outline dark:outline-yellow-500/15">
                    <p class="text-sm font-medium text-yellow-700 dark:text-yellow-100/80">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="font-medium text-yellow-700 underline hover:text-yellow-600 dark:text-yellow-300 dark:hover:text-yellow-200">
                            {{ __('Click here to send the verification email.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-auth.primary-button>
                {{ __('Save') }}
            </x-auth.primary-button>
        </div>
    </form>
</section>
