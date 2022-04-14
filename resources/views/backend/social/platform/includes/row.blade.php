<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <img src="{{ asset('img/icon/' . $row->type . '.png') }}" class="img-fluid" style="width: 32px;" alt="{{ ucfirst($row->type) }}" />
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->action }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.platform.includes.active', ['platform' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.platform.includes.actions', ['platform' => $row])
</x-livewire-tables::bs5.table.cell>
