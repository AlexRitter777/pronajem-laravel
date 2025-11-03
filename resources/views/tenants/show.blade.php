<x-layout-component>


    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $tenant->name }}</h3>
            <p class="mt-1 max-w-2xl text-sm/6 text-gray-500 dark:text-gray-400">{{ __('Tenant details.') }}</p>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-white/10">
            <dl class="divide-y divide-gray-100 dark:divide-white/10">

                <x-lists.dl-item
                    :dt="__('Name')"
                    :dd="$tenant->name"
                />

                <x-lists.dl-item
                    :dt="__('Address')"
                    :dd="$tenant->address"
                />

                @if($tenant->email)
                <x-lists.dl-item
                    :dt="__('Email')"
                    :dd="$tenant->email"
                />
                @endif

                @if($tenant->birthday)
                    <x-lists.dl-item
                        :dt="__('Date of birth')"
                        :dd="$tenant->birthday->format('d.m.Y')"
                    />
                @endif

                @if($tenant->email)
                    <x-lists.dl-item
                        :dt="__('Phone number')"
                        :dd="$tenant->phone"
                    />
                @endif

                @if($tenant->email)
                    <x-lists.dl-item
                        :dt="__('Bank account number')"
                        :dd="$tenant->account_number"
                    />
                @endif

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('tenants.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
                    <a href="{{ route('tenants.edit', $tenant) }}" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">{{ __('Edit') }}</a>
                </div>
            </dl>
        </div>
    </div>


</x-layout-component>
