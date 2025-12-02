<x-vue-layout-component>
    <items-table
        title="{{ __('Properties') }}"
        new-button-title="{{__('New property')}}"
        component="PropertiesTable"
        url="/nemovitosti"
        create="{{ route('properties.create') }}"
        edit="{{ route('properties.edit', ':id') }}"
        show="{{ route('properties.show', ':id') }}"
    >
        {{ __('Manage properties — view the list, search, add or edit records.') }}
    </items-table>

</x-vue-layout-component>
