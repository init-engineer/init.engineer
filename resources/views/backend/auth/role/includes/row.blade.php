<x-livewire-tables::bs5.table.cell>
    @if ($row->type === \App\Domains\Auth\Models\User::TYPE_ADMIN)
        {{ __('Administrator') }}
    @elseif ($row->type === \App\Domains\Auth\Models\User::TYPE_USER)
        {{ __('User') }}
    @else
        N/A
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {!! $row->permissions_label !!}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->users_count }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @include('backend.auth.role.includes.actions', ['model' => $row])
</x-livewire-tables::bs5.table.cell>
