{{-- @if (Breadcrumbs::has() && !Route::is('frontend.index')) --}}
@if (Breadcrumbs::has())
    <nav id="breadcrumbs" class="position-fixed w-100" aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 py-2 px-3">
            @foreach (Breadcrumbs::current() as $crumb)
                @if ($crumb->url() && !$loop->last)
                    <li class="breadcrumb-item">
                        <x-utils.link :href="$crumb->url()" :text="$crumb->title()" />
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb->title() }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
