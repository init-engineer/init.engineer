@storybook([
    'status' => 'stable',
    'args' => [
        'size' => 'M',
    ],
    'argTypes' => [
        'size' => [
            'options' => ['M', 'L'],
            'control' => [
                'type' => 'radio',
            ]
        ],
    ]
])

<x-buttons.basic :size="$size ?? 'M'">Hello, World!</x-buttons.basic>
