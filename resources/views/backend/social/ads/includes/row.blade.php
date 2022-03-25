<x-livewire-tables::bs5.table.cell>
    {{ __($row->type) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 24px; color: #597a96; display: inherit;">{{ number_format($row->probability / 100, 2) }}%</strong>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.ads.includes.active', ['ads' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.ads.includes.render', ['ads' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.ads.includes.payment', ['ads' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $row->starts_at->toDateString() }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ $row->starts_at->diffForHumans() }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $row->ends_at->toDateString() }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ $row->ends_at->diffForHumans() }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.ads.includes.actions', ['ads' => $row])
</x-livewire-tables::bs5.table.cell>
