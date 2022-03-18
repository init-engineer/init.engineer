{{-- @if (Breadcrumbs::has() && !Route::is('frontend.index')) --}}
@if (Breadcrumbs::has())
    <nav class="position-fixed w-100" style="top: 54px;" aria-label="breadcrumb">
        <ol class="breadcrumb">
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
