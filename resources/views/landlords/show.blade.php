<x-layout-component>


    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $landlord->name }}</h3>
            <p class="mt-1 max-w-2xl text-sm/6 text-gray-500 dark:text-gray-400">{{ __('Landlord details.') }}</p>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-white/10">
            <dl class="divide-y divide-gray-100 dark:divide-white/10">

                <x-lists.dl-item
                    :dt="__('Name')"
                    :dd="$landlord->name"
                />

                <x-lists.dl-item
                    :dt="__('Address')"
                    :dd="$landlord->address"
                />

                @if($landlord->email)
                    <x-lists.dl-item
                        :dt="__('Email')"
                        :dd="$landlord->email"
                    />
                @endif

                @if($landlord->birthday)
                    <x-lists.dl-item
                        :dt="__('Date of birth')"
                        :dd="$landlord->birthday->format('d.m.Y')"
                    />
                @endif

                @if($landlord->phone)
                    <x-lists.dl-item
                        :dt="__('Phone number')"
                        :dd="$landlord->phone"
                    />
                @endif

                @if($landlord->account_number)
                    <x-lists.dl-item
                        :dt="__('Bank account number')"
                        :dd="$landlord->account_number"
                    />
                @endif
                @if(count($landlord->properties) !== 0)
                    <x-lists.dl-slot-item
                        :dt="__('Properties')"
                    >
                        <ul>
                            @foreach($landlord->properties as $property)
                                <li class="mb-2">
                                    <a href="{{ route('properties.show', $property) }}"
                                       class="inline-block rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700
                                        hover:bg-gray-200 hover:text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                                    >
                                        {{ $property->address }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </x-lists.dl-slot-item>
                @endif

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('landlords.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
                    <a href="{{ route('landlords.edit', $landlord) }}" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">{{ __('Edit') }}</a>
                </div>
            </dl>
        </div>
    </div>


</x-layout-component>
