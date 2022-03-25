<x-livewire-tables::bs5.table.cell>
    {{ $row->id }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex text-muted">
        <img src="{{ asset('img/icon/' . $row->platform->type . '.png') }}" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

        <div class="pl-2 pt-1 mb-0 w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">{{ $row->platform->name }}</strong>
            </div>
            <span class="d-block">{{ ucfirst($row->platform->type) }}</span>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex text-muted">
        <img src="{{ $row->user_avatar }}" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

        <div class="pl-2 pt-1 mb-0 w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">{{ $row->user_name }}</strong>
            </div>
            <span class="d-block">{{ $row->user_id }}</span>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p style="max-width: 320px;" data-toggle="tooltip" data-placement="bottom" title="{{ $row->content }}">{{ Str::limit($row->content, 72, '...') }}</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.social.comments.includes.actions', ['comments' => $row])
</x-livewire-tables::bs5.table.cell>
