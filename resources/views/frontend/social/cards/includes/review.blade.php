<x-livewire-tables::bs5.table.cell class="cell-datetime">
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            {{-- 文章編號 --}}
            <strong>{{ $row->id }}</strong>
            {{-- 36 進位編號 --}}
            <span>#{{ base_convert($row->id, 10, 36) }}</span>
        </div>
    </a>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{-- 投稿縮圖 --}}
    <img class="rounded mx-0 d-block w-100 thumb gallery-slideshow"
        style="min-width: 128px;"
        height="128"
        src="{{ $row->getPicture() }}"
        alt="{{ Str::limit($row->content, 32, '...') }}">
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell style="width: 480px; min-width: 480px;">
    {{-- 文章內容 --}}
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <p class="mb-0">{{ Str::limit($row->content, 300, '...') }}</p>
    </a>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell style="width: 160px; min-width: 160px;">
    {{-- 投票 Vue 元件 --}}
    @if ($logged_in_user->isAdmin())
    <admin-review-button
        :cid="{{ $row->id }}">
    </admin-review-button>
    @else
    <review-button
        :cid="{{ $row->id }}">
    </review-button>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="cell-datetime">
    {{-- 投稿時間 --}}
    <a href="{{ route('frontend.social.cards.show', ['id' => $row->id]) }}">
        <div>
            <strong>{{ $row->created_at->toDateString() }}</strong>
            <span>{{ $row->created_at->diffForHumans() }}</span>
        </div>
    </a>
</x-livewire-tables::bs5.table.cell>
