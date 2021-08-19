<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <div>
        <strong>{{ $row->id }}</strong>
        <span>#{{ base_convert($row->id, 10, 36) }}</span>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <img src="{{ $row->getPicture() }}" width="128" height="72" class="img-fluid rounded" style="max-width: 128px; max-height: 72px; object-fit: cover;" alt="{{ $row->content }}">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <p style="max-width: 320px;">{{ Str::limit($row->content, 191, '...') }}</p>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <div>
        <strong>{{ $row->created_at->toDateString() }}</strong>
        <span>{{ $row->created_at->diffForHumans() }}</span>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <div>
        <strong>{{ $row->updated_at->toDateString() }}</strong>
        <span>{{ $row->updated_at->diffForHumans() }}</span>
    </div>
</x-livewire-tables::bs4.table.cell>
