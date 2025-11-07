<x-vue-layout-component>
    <items-table
        title="{{ __('Building Managers') }}"
        new-button-title="{{__('New building manager')}}"
        component="BuildingManagersTable"
        url={{'/' . __('building-managers') }}
        create="{{ route('building-managers.create') }}"
        edit="{{ route('building-managers.edit', ':id') }}"
        show="{{ route('building-managers.show', ':id') }}"
    >
        {{ __('Manage building managers — view the list, search, add or edit records.') }}
    </items-table>

</x-vue-layout-component>
