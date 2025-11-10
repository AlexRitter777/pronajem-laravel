<x-vue-layout-component>
    <items-table
        title="{{ __('Electricity Suppliers') }}"
        new-button-title="{{__('New electricity supplier')}}"
        component="ElectricitySuppliersTable"
        url={{'/' . __('electricity-suppliers') }}
        create="{{ route('electricity-suppliers.create') }}"
        edit="{{ route('electricity-suppliers.edit', ':id') }}"
        show="{{ route('electricity-suppliers.show', ':id') }}"
    >
        {{ __('Manage electricity suppliers — view the list, search, add or edit records.') }}
    </items-table>

</x-vue-layout-component>
