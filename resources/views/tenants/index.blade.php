<x-vue-layout-component>
    <items-table
        title="{{ __('Tenants') }}"
        new-button-title="{{__('New tenant')}}"
        component="TenantsTable"
        url="/najemnici"
        create="{{ route('tenants.create') }}"
        edit="{{ route('tenants.edit', ':id') }}"
        show="{{ route('tenants.show', ':id') }}"
    >
        {{ __('Manage tenants — view the list, search, add or edit records.') }}
    </items-table>

</x-vue-layout-component>
