<x-layout-component>
    <form
        method="POST"
        action="{{ route('electricity-suppliers.store') }}"
    >
        @csrf
        <div class="space-y-12 sm:space-y-16">
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{__('New electricity supplier')}}</h2>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400">{{ __('Enter the new electricity supplier’s details.') }}</p>

                <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">

                    <x-forms.input-text
                        type="text"
                        id="name"
                        name="name"
                        autocomplete="name"
                        {{--                        required="required"--}}
                        value="{{ old('name') }}"
                        placeholder="PRE a.s."
                    >
                        {{ __('Name') }} *
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="text"
                        id="description"
                        name="description"
                        value="{{ old('description') }}"
                        placeholder="popis ..."
                    >
                        {{ __('Description') }}
                    </x-forms.input-text>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('electricity-suppliers.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
            <input
                type="submit"
                value="{{ __('Save') }}"
                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
            >
        </div>
    </form>


</x-layout-component>
