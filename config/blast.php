<?php

return [
    'storybook_server_url' =>
        env('STORYBOOK_SERVER_HOST', env('APP_URL')) . '/storybook_preview',

    /**
     * Specify which documentation pages to generate for the Tailwind classes used in your application
     * Defaults to `[]` which will render all
     * Use `php artisan blast:generate-docs` to generate docs stories
     */
    'auto_documentation' => [
        'border-radius',
        'border-width',
        'colors',
        'font-size',
        'font-weight',
        'height',
        'layout',
        'letter-spacing',
        'line-height',
        'max-height',
        'max-width',
        'min-height',
        'min-width',
        'opacity',
        'shadows',
        'spacing',
        'transition',
        'typesets',
        'width',
    ],

    /**
     * Path to tailwind config file to generate documentation.
     */
    'tailwind_config_path' => base_path('tailwind.config.js'),

    /**
     * See https://storybook.js.org/docs/react/essentials/controls Set
     * to true to enable full documentation on the controls tab.
     */
    'storybook_expanded_controls' => true,

    /**
     * See https://storybook.js.org/docs/react/configure/theming for more
     * detail - normal, dark or custom. Normal and dark themes are out
     * of the box from @storybook-theming. To add a custom theme edit
     * values in the 'storybook_custom_theme' array in this file.
     */
    'storybook_theme' => 'normal',

    // Normal, dark or custom
    'storybook_docs_theme' => 'normal',

    'storybook_custom_theme' => [
        'base' => 'light',
        'colorPrimary' => '#FF4785',
        'colorSecondary' => '#1EA7FD',
        'appBg' => '#F6F9FC',
        'appContentBg' => '#FFFFFF',
        'appBorderColor' => 'rgba(0,0,0,.1)',
        'appBorderRadius' => 4,
        'fontBase' =>
            "\"Nunito Sans\", -apple-system, \".SFNSText-Regular\", \"San Francisco\", BlinkMacSystemFont, \"Segoe UI\", \"Helvetica Neue\", Helvetica, Arial, sans-serif",
        'fontCode' =>
            "\"Operator Mono\", \"Fira Code Retina\", \"Fira Code\", \"FiraCode-Retina\", \"Andale Mono\", \"Lucida Console\", Consolas, Monaco, monospace",
        'textColor' => '#333333',
        'textInverseColor' => '#FFFFFF',
        'textMutedColor' => '#666666',
        'barTextColor' => '#999999',
        'barSelectedColor' => '#1EA7FD',
        'barBg' => '#FFFFFF',
        'inputBg' => '#FFFFFF',
        'inputBorder' => 'rgba(0,0,0,.1)',
        'inputTextColor' => '#333333',
        'inputBorderRadius' => 4,
        'brandTitle' => 'Blast - Storybook for blade',
        'brandUrl' => 'https://storybook.js.org',
        // 'brandImage' => \A17\Blast\Traits\StorybookLogo::defaultLogo(),
    ],

    'storybook_global_types' => [],

    // Set a global custom order for stories in the Storybook UI
    // More info - https://storybook.js.org/docs/react/writing-stories/naming-components-and-hierarchy#sorting-stories
    'storybook_sort_order' => [],

    // set the background color of the storybook canvas area
    'canvas_bg_color' => '',

    // Blast will attempt to autoload assets from a mix-manifest if the assets arrays are empty. This option allows you to disable that functionality
    'autoload_assets' => true,

    'assets' => [
        'css' => [
            '/css/tailwind.css'
        ],
        'js' => [],
    ],

    // See https://storybook.js.org/addons/@etchteam/storybook-addon-status/
    'storybook_statuses' => [
        'deprecated' => [
            'background' => '#e02929',
            'color' => '#ffffff',
            'description' =>
                'This component is deprecated and should no longer be used',
        ],
        'wip' => [
            'background' => '#f59506',
            'color' => '#ffffff',
            'description' => 'This component is a work in progress',
        ],
        'readyForQA' => [
            'background' => '#34aae5',
            'color' => '#ffffff',
            'description' => 'This component is complete and ready to qa',
        ],
        'stable' => [
            'background' => '#1bbb3f',
            'color' => '#ffffff',
            'description' => 'This component is stable and released',
        ],
    ],

    'build_timeout' => 300,

    'vendor_path' => 'vendor/area17/blast',

    'components' => [
        'docs-page' => \A17\Blast\Components\DocsPages\DocsPage::class,
        'ui-colors' => \A17\Blast\Components\DocsPages\UiColors::class,
        'ui-spacing' => \A17\Blast\Components\DocsPages\UiSpacing::class,
        'ui-width' => \A17\Blast\Components\DocsPages\UiWidth::class,
        'ui-min-width' => \A17\Blast\Components\DocsPages\UiMinWidth::class,
        'ui-max-width' => \A17\Blast\Components\DocsPages\UiMaxWidth::class,
        'ui-height' => \A17\Blast\Components\DocsPages\UiHeight::class,
        'ui-min-height' => \A17\Blast\Components\DocsPages\UiMinHeight::class,
        'ui-max-height' => \A17\Blast\Components\DocsPages\UiMaxHeight::class,
        'ui-border-width' =>
            \A17\Blast\Components\DocsPages\UiBorderWidth::class,
        'ui-border-radius' =>
            \A17\Blast\Components\DocsPages\UiBorderRadius::class,
        'ui-opacity' => \A17\Blast\Components\DocsPages\UiOpacity::class,
        'ui-shadows' => \A17\Blast\Components\DocsPages\UiShadows::class,
        'ui-transition' => \A17\Blast\Components\DocsPages\UiTransition::class,
        'ui-font-size' => \A17\Blast\Components\DocsPages\UiFontSize::class,
        'ui-font-weight' => \A17\Blast\Components\DocsPages\UiFontWeight::class,
        'ui-line-height' => \A17\Blast\Components\DocsPages\UiLineHeight::class,
        'ui-letter-spacing' =>
            \A17\Blast\Components\DocsPages\UiLetterSpacing::class,
        'ui-breakpoints' =>
            \A17\Blast\Components\DocsPages\UiBreakpoints::class,
        'ui-columns' => \A17\Blast\Components\DocsPages\UiColumns::class,
        'ui-gutter-inner' =>
            \A17\Blast\Components\DocsPages\UiGutterInner::class,
        'ui-gutter-outer' =>
            \A17\Blast\Components\DocsPages\UiGutterOuter::class,
        'ui-container' => \A17\Blast\Components\DocsPages\UiContainer::class,
        'ui-typesets' => \A17\Blast\Components\DocsPages\UiTypesets::class,
    ],
];
