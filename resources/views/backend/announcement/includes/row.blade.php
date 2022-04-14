<x-livewire-tables::bs5.table.cell>
    @include('backend.announcement.includes.message', ['announcement' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.announcement.includes.area', ['announcement' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.announcement.includes.status', ['announcement' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ isset($row->starts_at)? $row->starts_at->toDateString() : '-' }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ isset($row->starts_at)? $row->starts_at->toDateString() : '' }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ isset($row->ends_at)? $row->ends_at->toDateString() : '-' }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ isset($row->ends_at)? $row->ends_at->diffForHumans() : '' }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.announcement.includes.actions', ['announcement' => $row])
</x-livewire-tables::bs5.table.cell>
