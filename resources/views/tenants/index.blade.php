<x-vue-layout-component>
    <items-table
        title="Nájemnici"
        new-button-title="Nový nájemník"
        component="TenantsTable"
        url="/najemnici"
        create="{{ route('tenants.create') }}"
        edit="{{ route('tenants.edit', ':id') }}"
        show="{{ route('tenants.show', ':id') }}"
    >
        Spravujte nájemníky jednoduše a přehledně. Přidejte nové nebo upravte stávající.
    </items-table>

</x-vue-layout-component>
