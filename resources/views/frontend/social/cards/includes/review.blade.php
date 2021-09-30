<x-livewire-tables::bs4.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            {{-- 文章編號 --}}
            <strong>{{ $row->id }}</strong>
            {{-- 36 進位編號 --}}
            <span>#{{ base_convert($row->id, 10, 36) }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- 投稿縮圖 --}}
    <img class="rounded mx-0 d-block w-100 thumb gallery-slideshow"
        style="min-width: 128px;"
        height="128"
        src="{{ $row->getPicture() }}"
        alt="{{ Str::limit($row->content, 64, '...') }}">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- 文章內容 --}}
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <p style="width: 320px; max-width: 320px;">{{ Str::limit($row->content, 191, '...') }}</p>
    </a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- 投票 Vue 元件 --}}
    <review-button
        :cid="{{ $row->id }}">
    </review-button>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="cell-datetime">
    {{-- 投稿時間 --}}
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->created_at->toDateString() }}</strong>
            <span>{{ $row->created_at->diffForHumans() }}</span>
        </div>
    </a>
</x-livewire-tables::bs4.table.cell>
