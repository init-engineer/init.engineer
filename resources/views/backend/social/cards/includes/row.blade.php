<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $row->id }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">#{{ base_convert($row->id, 10, 36) }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a href="{{ route('admin.auth.user.show', ['user' => $row->model]) }}" class="d-flex text-muted">
        <img src="{{ $row->model->avatar }}" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

        <div class="pl-2 pt-1 mb-0 w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">{{ $row->model->name }}</strong>
            </div>
            <span class="d-block">{{ $row->model->email }}</span>
        </div>
    </a>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <img src="{{ $row->getPicture() }}" width="128" height="72" class="img-fluid rounded" style="max-width: 128px; max-height: 72px; object-fit: cover;" alt="{{ $row->content }}">
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p style="max-width: 320px;">{{ Str::limit($row->content, 191, '...') }}</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.cards.includes.platform', ['cards' => $row])
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div style="position: inherit;">
        <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">{{ $row->created_at->toDateString() }}</strong>
        <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">{{ $row->created_at->diffForHumans() }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.cards.includes.actions', ['cards' => $row])
</x-livewire-tables::bs5.table.cell>
