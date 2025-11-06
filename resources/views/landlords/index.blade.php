<x-vue-layout-component>
    <items-table
        title="{{ __('Landlords') }}"
        new-button-title="{{__('New landlord')}}"
        component="LandlordsTable"
        url="/pronajimatele"
        create="{{ route('landlords.create') }}"
        edit="{{ route('landlords.edit', ':id') }}"
        show="{{ route('landlords.show', ':id') }}"
    >
        {{ __('Manage landlords — view the list, search, add or edit records.') }}
    </items-table>

</x-vue-layout-component>
