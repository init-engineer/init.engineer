{{-- @storybook([
    'args' => [
        'active',
    ],
    'argTypes' => [
        'active' => [
            'control' => 'boolean'
        ],
    ],
]) --}}
<x-navbar.item :active="$active ?? false">Hello, World!</x-navbar.item>
