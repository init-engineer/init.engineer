<x-livewire-tables::bs5.table.cell>
    @if($row->getLogo() !== null)
        <img src="{{ $row->getLogo() }}" alt="{{ $row->name }}" class="rounded" style="width: 24px; heigth: 24px;">
    @else
        <img src="/img/default/512x512.png" alt="Default Logo" class="rounded" style="width: 24px; heigth: 24px;">
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p>{{ $row->name }}</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p>{{ $row->area }}</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p style="width: 320px; max-width: 320px;">{{ Str::limit($row->description, 191, '...') }}</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('frontend.companie.includes.actions', ['companie' => $row])
</x-livewire-tables::bs5.table.cell>
