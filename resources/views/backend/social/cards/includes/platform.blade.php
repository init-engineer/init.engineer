<ul>
    @forelse ($cards->platformCards as $platform)
        <li>[{{ $platform->platform->type }} - {{ $platform->platform->action }}] {{ $platform->platform->name }}</li>
    @empty
        <li>沒有</li>
    @endforelse
</ul>
