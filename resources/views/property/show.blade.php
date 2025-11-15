<x-layout-component>

    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base/7 font-semibold text-gray-900 dark:text-white"> {{ $property->address }}</h3>
            <p class="mt-1 max-w-2xl text-sm/6 text-gray-500 dark:text-gray-400">{{ __('Property details.') }}</p>
        </div>
        <div class="mt-6 border-t border-gray-100 dark:border-white/10">
            <dl class="divide-y divide-gray-100 dark:divide-white/10">

                <x-lists.dl-item
                    :dt="__('Address')"
                    :dd="$property->address"
                />

                <x-lists.dl-item
                    :dt="__('Property Type')"
                    :dd="$property->type"
                />

                @if($property->description)
                    <x-lists.dl-item
                        :dt="__('Description')"
                        :dd="$property->description"
                    />
                @endif

                @if($property->rent_amount)
                    <x-lists.dl-item
                        :dt="__('Rent')"
                        :dd="$property->rent_amount"
                    />
                @endif

                @if($property->service_charge)
                    <x-lists.dl-item
                        :dt="__('Advance payment for services')"
                        :dd="$property->service_charge"
                    />
                @endif

                @if($property->electricity_charge)
                    <x-lists.dl-item
                        :dt="__('Advance payment for electricity')"
                        :dd="$property->electricity_charge"
                    />
                @endif


                @if($property->deposit_amount)
                    <x-lists.dl-item
                        :dt="__('Security Deposit')"
                        :dd="$property->deposit_amount"
                    />
                @endif

                @if($property->landlord)

                    <x-lists.dl-item-link
                        :dt="__('Landlord')"
                        route="landlords.show"
                        :entity="$property->landlord"
                    />
                @endif

                @if($property->tenant)

                    <x-lists.dl-item-link
                        :dt="__('Tenant')"
                        route="tenants.show"
                        :entity="$property->tenant"
                    />
                @endif

                @if($property->buildingManager)

                    <x-lists.dl-item-link
                        :dt="__('Building Manager')"
                        route="building-managers.show"
                        :entity="$property->buildingManager"
                    />
                @endif

                @if($property->electricitySupplier)

                    <x-lists.dl-item-link
                        :dt="__('Electricity Supplier')"
                        route="electricity-suppliers.show"
                        :entity="$property->electricitySupplier"
                    />
                @endif

                @if($property->contract_finished_at)
                    <x-lists.dl-item
                        :dt="__('Contract End Date')"
                        :dd="$property->contract_finished_at->format('d.m.Y')"
                    />
                @endif


                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('properties.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
                    <a href="{{ route('properties.edit', $property) }}" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">{{ __('Edit') }}</a>
                </div>
            </dl>
        </div>
    </div>


</x-layout-component>
