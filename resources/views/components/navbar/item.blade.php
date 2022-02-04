<a role="button" href="{{ $href }}" @class([
    'px-4',
    'py-1',
    'text-sm',
    'navbar-item',
    'rounded-xl',
    'font-dos',
    'bg-gray-200' => $active,
    'text-gray-900' => $active,
    'text-gray-200' => !$active,
])>
    {{ $slot }}
</a>
