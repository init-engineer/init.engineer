<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->id }}</strong>
            <span>#{{ base_convert($row->id, 10, 36) }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <gallery-slideshow
        _class="rounded mx-0 d-block w-100"
        _style="min-width: 128px;"
        height="128"
        src="{{ $row->getPicture() }}">
    </gallery-slideshow>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <p style="width: 320px; max-width: 320px;">{{ Str::limit($row->content, 191, '...') }}</p>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <review-button
        :cid="{{ $row->id }}">
    </review-button>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->created_at->toDateString() }}</strong>
            <span>{{ $row->created_at->diffForHumans() }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>
