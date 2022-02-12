<button @class([
    'text-gray-900 bg-gray-200 rounded-lg font-dos',
    'px-4 py-1 text-base' => $size == 'M',
    'px-8 py-2 text-xl' => $size == 'L',
])>{{ $slot }}</button>
