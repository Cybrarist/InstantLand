<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Expose API
    |--------------------------------------------------------------------------
    |
    | This will expose the editor variable.
    | It can be accessed via a window.gjsEditor
    |
    */

    'expose_api' => true,

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    | Routes Settings
    |
    */

    'routes' => [
        'middleware' => [
            'web', 'auth',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Force Class
    |--------------------------------------------------------------------------
    |
    | @See https://github.com/artf/grapesjs/issues/546
    |
    */

    'force_class' => false,

    /*
    |--------------------------------------------------------------------------
    | Global Styles
    |--------------------------------------------------------------------------
    |
    | Global Styles for the editor blade file.
    */

    'styles' => [
        'vendor/laravel-grapesjs/assets/editor.css'
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Scripts
    |--------------------------------------------------------------------------
    |
    | Global scripts for the editor blade file.
    */

    'scripts' => [
        'vendor/laravel-grapesjs/assets/modify-config.js',
        'vendor/laravel-grapesjs/assets/editor.js',
        'vendor/laravel-grapesjs/assets/blocks.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Canvas styles and scripts
    |--------------------------------------------------------------------------
    |
    | The styles and scripts for the editor content.
    | You need to add these also to your layout.
    | e.g the bootstrap files, etc
    |
    */

    'canvas' => [
        'styles' => [],
        'scripts' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Assets Manager
    |--------------------------------------------------------------------------
    |
    | Here you can configure the disk and custom upload URL for your asset
    | manager.
    |
    */

    'assets' => [
        'disk' => 'public', //Default: local
        'path' => null, //Default: 'laravel-grapesjs/media',
        'upload_url' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Style Manager
    |--------------------------------------------------------------------------
    |
    | Enable/Disable selectors.
        | @see https://grapesjs.com/docs/api/style_manager.html#stylemanager
    |
    */

    'style_manager' => [
        'limited_selectors' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Manager
    |--------------------------------------------------------------------------
    |
    | Enable/Disable the autosave function for your editor.
    |
    */

    'storage_manager' => [
        'autosave' => true,
        'steps_before_save' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Manager
    |--------------------------------------------------------------------------
    |
    | You can enable/disable built-in plugins or can add any custom plugin from
    | this config. Formats for custom plugins are as below.
    |
    | 1. Simplest way
    |   'plugin-name' => 'https://url_to_plugin_script.com'
    |
    | 2. Simple with options (Plugin script will be added to global scrips above)
    |   'plugin-name' => [
    |       //plugin options goes here
    |     ]
    |
    | 3. Advanced way
    |   [
    |       'enabled => true,
    |       'name' => 'plugin-name',
    |       'styles' => [
    |           'https://url_to_plugin_styles.com',
    |       ],
    |       'scripts' => [
    |           'https://url_to_plugin_script.com',
    |       ],
    |       'options' => [
    |           //plugin options goes here
    |       ],
    |   ]
    |
    */

    'plugins' => [
        'default' => [
            'basic_blocks' => true,
            'bootstrap4_blocks' => true,
            'code_editor' => true,
            'image_editor' => true,
            'custom_fonts' => [],
            'templates' => true,
        ],
        'custom' => [
            'grapesjs-custom-code' => 'https://unpkg.com/grapesjs-custom-code',
//            [
//                'enabled' => true,
//                'name' => 'gjs-plugin-ckeditor',
//                'scripts' => [
//                    'https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js',
//                    'https://unpkg.com/grapesjs-plugin-ckeditor',
//                ],
//                'options' => [
//                    'position' => 'left',
//                    /**
//                     * Config options for CKeditor
//                     * Available options can be found here https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
//                     * Or you can use config builder https://cdn.ckeditor.com/4.14.0/full-all/samples/toolbarconfigurator/index.html
//                     */
//                    'options' => [
//                        'toolbarGroups' => [
//                            [ "name" => "document", "groups" => [ "mode", "document", "doctools" ] ],
//                            [ "name" => "clipboard", "groups" => [ "clipboard", "undo" ] ],
//                            [ "name" => "editing", "groups" => [ "find", "selection", "spellchecker", "editing" ] ],
//                            [ "name" => "forms", "groups" => [ "forms" ] ],
//                            [ "name" => "basicstyles", "groups" => [ "basicstyles", "cleanup" ] ],
//                            [ "name" => "styles", "groups" => [ "styles" ] ],
//                            [ "name" => "paragraph", "groups" => [ "list", "indent", "blocks", "align", "bidi", "paragraph" ] ],
//                            [ "name" => "links", "groups" => [ "links" ] ],
//                            [ "name" => "insert", "groups" => [ "insert" ] ],
//                            [ "name" => "colors", "groups" => [ "colors" ] ],
//                            [ "name" => "tools", "groups" => [ "tools" ] ],
//                            [ "name" => "others", "groups" => [ "others" ] ],
//                            [ "name" => "about", "groups" => [ "about" ] ]
//                        ],
//                        'removeButtons' => 'Save,NewPage,Preview,Print,Templates,Source,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Table,About'
//                    ],
//                ],
//            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-plugin-forms',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-plugin-forms',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-navbar',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-navbar',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-tabs',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-tabs',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-blocks-flexbox',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-blocks-flexbox',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-style-bg',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-style-bg',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-tui-image-editor',
                'options' => [
                    "includeUI"=>[
                            "initMenu"=> 'filter',
                    ]
                ],
                'scripts' => [
                    'https://unpkg.com/grapesjs-tui-image-editor',
                ],
            ],
            [
                'enabled' => true,
                'name' => 'grapesjs-component-countdown',
                'options' => [],
                'scripts' => [
                    'https://unpkg.com/grapesjs-component-countdown',
                ],
            ],
        ],
    ],
];
