
<x-layout-component>

    <form
        method="POST"
        action="{{ route('properties.store') }}"
    >
        @csrf
        @method('POST')
        <div class="space-y-12 sm:space-y-16">
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white"> @lang('New property')</h2>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-600 dark:text-gray-400"> @lang('Enter details for the new property.')</p>

                <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:border-t-gray-900/10 sm:pb-0 dark:border-white/10 dark:sm:divide-white/10 dark:sm:border-t-white/10">

                    <x-forms.input-text
                        type="text"
                        id="address"
                        name="address"
                        autocomplete="street-address"
                        {{--                        required="required"--}}
                        value="{{ old('address')}}"
                        placeholder="Rybná 123/2, 110 00 Praha 1"
                    >
                        {{ __('Address') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="text"
                        id="type"
                        name="type"
                        {{--                        required="required"--}}
                        value="{{ old('type') }}"
                        placeholder="Byt 1kk"
                    >
                        {{ __('Property Type') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="description"
                        id="description"
                        name="description"
                        value="{{ old('description') }}"
                        placeholder="Číslo jednotky 2231, sklep S81, garažové stání P123"
                    >
                        {{ __('Description') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="number"
                        step="1"
                        id="rent_amount"
                        name="rent_amount"
                        value="{{ old('rent_amount') }}"
                    >
                        {{ __('Rent') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="number"
                        step="1"
                        id="service_charge"
                        name="service_charge"
                        value="{{ old('service_charge') }}"
                    >
                        {{ __('Advance payment for services') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="number"
                        step="1"
                        id="electricity_charge"
                        name="electricity_charge"
                        value="{{ old('electricity_charge') }}"
                    >
                        {{ __('Advance payment for electricity') }}
                    </x-forms.input-text>

                    <x-forms.input-text
                        type="number"
                        step="1"
                        id="deposit_amount"
                        name="deposit_amount"
                        value="{{ old('deposit_amount') }}"
                    >
                        {{ __('Security Deposit') }}
                    </x-forms.input-text>

                    <x-forms.input-combobox
                        :selected-item="old('landlord_name')"
                        :selected-item-id="old('landlord_id')"
                        :url="route('api.landlords.light.list')"
                        component-name="forms.landlord-form-alpine"
                        item-name="landlord_name"
                        item-id="landlord_id"
                    >
                        {{ __('Landlord') }}
                    </x-forms.input-combobox>

                    <x-forms.input-combobox
                        :selected-item="old('tenant_name')"
                        :selected-item-id="old('tenant_id')"
                        :url="route('api.tenants.light.list')"
                        component-name="forms.tenant-form-alpine"
                        item-name="tenant_name"
                        item-id="tenant_id"
                    >
                        {{ __('Tenant') }}
                    </x-forms.input-combobox>

                    <x-forms.input-combobox
                        :selected-item="old('building_manager_name')"
                        :selected-item-id="old('building_manager_id')"
                        :url="route('api.building-managers.light.list')"
                        component-name="forms.building-manager-form-alpine"
                        item-name="building_manager_name"
                        item-id="building_manager_id"
                    >
                        {{ __('Building Manager') }}
                    </x-forms.input-combobox>

                    <x-forms.input-combobox
                        :selected-item="old('electricity_supplier_name')"
                        :selected-item-id="old('electricity_supplier_id')"
                        :url="route('api.electricity-suppliers.light.list')"
                        component-name="forms.electricity-supplier-form-alpine"
                        item-name="electricity_supplier_name"
                        item-id="electricity_supplier_id"
                    >
                        {{ __('Electricity Supplier') }}
                    </x-forms.input-combobox>



                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('properties.index') }}" class="text-sm/6 font-semibold text-gray-900 dark:text-white">{{ __('Back') }}</a>
            <input
                type="submit"
                value="{{ __('Save') }}"
                class="inline-flex justify-center rounded-md cursor-pointer bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
            >



        </div>
    </form>

</x-layout-component>


