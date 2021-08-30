<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->id }}</strong>
            <span>#{{ base_convert($row->id, 10, 36) }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <gallery-slideshow src="{{ $row->getPicture() }}" width="128" height="72" style="width: 128px; max-width: 128px;"></gallery-slideshow>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <p style="width: 320px; max-width: 320px;">{{ Str::limit($row->content, 191, '...') }}</p>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <review-button></review-button>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->created_at->toDateString() }}</strong>
            <span>{{ $row->created_at->diffForHumans() }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>
