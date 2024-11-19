<?php


return [
    // Path source
    'base_url' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7',

    // Main file (commonly ace.js)
    'file' => 'ace.js',

    // Default config
    'editor_config' => [
        'useWorker' => false
    ],

    // Default options
    'editor_options' => [
        'mode' => 'ace/mode/php',
        'theme' => 'ace/theme/eclipse',
        'enableBasicAutocompletion' => true,
        'enableLiveAutocompletion' => true,
        'liveAutocompletionDelay' => 0,
        'liveAutocompletionThreshold' => 0,
        'enableSnippets' => true,
        'enableInlineAutocompletion' => true,
        'showPrintMargin' => false,
        'wrap' => 'free'
    ],

    // Dark mode config
    'dark_mode' => [
        'enable' => true,
        'theme' => 'ace/theme/dracula',
    ],

    // Enabled extension
    'enabled_extensions' => [
        'beautify',
        'language_tools',
        'inline_autocomplete',
    ],

    // Extension source
    'extensions' => [
        'beautify' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-beautify.min.js',
        'code_lens' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-code_lens.min.js',
        'command_bar' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-command_bar.min.js',
        'elastic_tabstops_lite' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-elastic_tabstops_lite.min.js',
        'emmet' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-emmet.min.js',
        'error_marker' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-error_marker.min.js',
        'hardwrap' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-hardwrap.min.js',
        'inline_autocomplete' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-inline_autocomplete.min.js',
        'keybinding_menu' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-keybinding_menu.min.js',
        'language_tools' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-language_tools.min.js',
        'linking' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-linking.min.js',
        'modelist' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-modelist.min.js',
        'options' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-options.min.js',
        'prompt' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-prompt.min.js',
        'rtl' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-rtl.min.js',
        'searchbox' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-searchbox.min.js',
        'settings_menu' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-settings_menu.min.js',
        'simple_tokenizer' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-simple_tokenizer.min.js',
        'spellcheck' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-spellcheck.min.js',
        'split' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-split.min.js',
        'static_highlight' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-static_highlight.min.js',
        'statusbar' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-statusbar.min.js',
        'textarea' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-textarea.min.js',
        'themelist' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-themelist.min.js',
        'whitespace' => 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.7/ext-whitespace.min.js',
    ],
];
