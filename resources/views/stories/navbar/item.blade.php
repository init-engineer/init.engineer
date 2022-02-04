@storybook([
    'status' => 'stable',
    'args' => [
        'active' => false,
        'item_text' => 'Hello, World!',
        'href' => '#',
    ],
    'argTypes' => [
        'active' => [
            'control' => 'boolean'
        ],
        'item_text' => [
            'control' => 'text'
        ],
        'href' => [
            'control' => 'text'
        ],
    ],
])

<x-navbar.item :href="$href ?? null" :active="$active ?? null">{{ $item_text ?? null }}</x-navbar.item>
