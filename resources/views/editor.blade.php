<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GrapesJS Demo - Free Open Source Website Page Builder</title>
    <meta content="Best Free Open Source Responsive Websites Builder" name="description">
    <link rel="stylesheet" href="stylesheets/toastr.min.css">
    <link rel="stylesheet" href="stylesheets/grapes.min.css?v0.21.9">
    <link rel="stylesheet" href="stylesheets/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="stylesheets/tooltip.css">
    <link rel="stylesheet" href="stylesheets/demos.css?v3">
    <link href="https://unpkg.com/grapick/dist/grapick.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/toastr.min.js"></script>
    <script src="js/grapes.min.js?v0.21.9"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.2"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5"></script>
    <script src="https://unpkg.com/grapesjs-component-countdown@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-plugin-export@1.0.11"></script>
    <script src="https://unpkg.com/grapesjs-tabs@1.0.6"></script>
    <script src="https://unpkg.com/grapesjs-custom-code@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-touch@0.1.1"></script>
    <script src="https://unpkg.com/grapesjs-parser-postcss@1.0.1"></script>
    <script src="https://unpkg.com/grapesjs-tooltip@0.1.7"></script>
    <script src="https://unpkg.com/grapesjs-tui-image-editor@0.1.3"></script>
    <script src="https://unpkg.com/grapesjs-typed@1.0.5"></script>
    <script src="https://unpkg.com/grapesjs-style-bg@2.0.1"></script>

</head>
<body>
<div style="display: none">
    <div class="gjs-logo-cont">
        <a href="https://grapesjs.com"><img class="gjs-logo" src="img/grapesjs-logo-cl.png"></a>
        <div class="gjs-logo-version"></div>
    </div>
</div>
<div class="ad-cont">
    <!-- <script async type="text/javascript" src="https://cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=grapesjscom" id="_carbonads_js"></script> -->
    <div id="native-carbon"></div>
    <script async type="text/javascript" src="./js/carbon-v2.js"></script>
</div>

<div id="gjs" style="height:0px; overflow:hidden">


</div>

<button onclick="savePageToBackend()" style="z-index: 1000;
  display: block;
  position: fixed;
  bottom: 100px;">Save Page</button>

<script type="text/javascript">
    var lp = './img/';
    var plp = 'https://via.placeholder.com/350x250/';
    var images = [
        lp + 'team1.jpg',
        lp + 'team2.jpg',
        lp + 'team3.jpg',
        plp + '78c5d6/fff',
        plp + '459ba8/fff',
        plp + '79c267/fff',
        plp + 'c5d647/fff',
        plp + 'f28c33/fff',
        plp + 'e868a2/fff',
        plp + 'cc4360/fff',
        lp + 'work-desk.jpg',
        lp + 'phone-app.png',
        lp + 'bg-gr-v.png'
    ];

    var editor  = grapesjs.init({
        height: '100%',

        container : '#gjs',

        fromElement: true,
        showOffsets: true,

        assetManager: {
            embedAsBase64: true,
            assets: images
        },
        selectorManager: { componentFirst: true },
        styleManager: {
            sectors: [{
                name: 'General',
                properties:[
                    {
                        extend: 'float',
                        type: 'radio',
                        default: 'none',
                        options: [
                            { value: 'none', className: 'fa fa-times'},
                            { value: 'left', className: 'fa fa-align-left'},
                            { value: 'right', className: 'fa fa-align-right'}
                        ],
                    },
                    'display',
                    { extend: 'position', type: 'select' },
                    'top',
                    'right',
                    'left',
                    'bottom',
                ],
            }, {
                name: 'Dimension',
                open: false,
                properties: [
                    'width',
                    {
                        id: 'flex-width',
                        type: 'integer',
                        name: 'Width',
                        units: ['px', '%'],
                        property: 'flex-basis',
                        toRequire: 1,
                    },
                    'height',
                    'max-width',
                    'min-height',
                    'margin',
                    'padding'
                ],
            },{
                name: 'Typography',
                open: false,
                properties: [
                    'font-family',
                    'font-size',
                    'font-weight',
                    'letter-spacing',
                    'color',
                    'line-height',
                    {
                        extend: 'text-align',
                        options: [
                            { id : 'left',  label : 'Left',    className: 'fa fa-align-left'},
                            { id : 'center',  label : 'Center',  className: 'fa fa-align-center' },
                            { id : 'right',   label : 'Right',   className: 'fa fa-align-right'},
                            { id : 'justify', label : 'Justify',   className: 'fa fa-align-justify'}
                        ],
                    },
                    {
                        property: 'text-decoration',
                        type: 'radio',
                        default: 'none',
                        options: [
                            { id: 'none', label: 'None', className: 'fa fa-times'},
                            { id: 'underline', label: 'underline', className: 'fa fa-underline' },
                            { id: 'line-through', label: 'Line-through', className: 'fa fa-strikethrough'}
                        ],
                    },
                    'text-shadow'
                ],
            },{
                name: 'Decorations',
                open: false,
                properties: [
                    'opacity',
                    'border-radius',
                    'border',
                    'box-shadow',
                    'background', // { id: 'background-bg', property: 'background', type: 'bg' }
                ],
            },{
                name: 'Extra',
                open: false,
                buildProps: [
                    'transition',
                    'perspective',
                    'transform'
                ],
            },{
                name: 'Flex',
                open: false,
                properties: [{
                    name: 'Flex Container',
                    property: 'display',
                    type: 'select',
                    defaults: 'block',
                    list: [
                        { value: 'block', name: 'Disable'},
                        { value: 'flex', name: 'Enable'}
                    ],
                },{
                    name: 'Flex Parent',
                    property: 'label-parent-flex',
                    type: 'integer',
                },{
                    name: 'Direction',
                    property: 'flex-direction',
                    type: 'radio',
                    defaults: 'row',
                    list: [{
                        value: 'row',
                        name: 'Row',
                        className: 'icons-flex icon-dir-row',
                        title: 'Row',
                    },{
                        value: 'row-reverse',
                        name: 'Row reverse',
                        className: 'icons-flex icon-dir-row-rev',
                        title: 'Row reverse',
                    },{
                        value: 'column',
                        name: 'Column',
                        title: 'Column',
                        className: 'icons-flex icon-dir-col',
                    },{
                        value: 'column-reverse',
                        name: 'Column reverse',
                        title: 'Column reverse',
                        className: 'icons-flex icon-dir-col-rev',
                    }],
                },{
                    name: 'Justify',
                    property: 'justify-content',
                    type: 'radio',
                    defaults: 'flex-start',
                    list: [{
                        value: 'flex-start',
                        className: 'icons-flex icon-just-start',
                        title: 'Start',
                    },{
                        value: 'flex-end',
                        title: 'End',
                        className: 'icons-flex icon-just-end',
                    },{
                        value: 'space-between',
                        title: 'Space between',
                        className: 'icons-flex icon-just-sp-bet',
                    },{
                        value: 'space-around',
                        title: 'Space around',
                        className: 'icons-flex icon-just-sp-ar',
                    },{
                        value: 'center',
                        title: 'Center',
                        className: 'icons-flex icon-just-sp-cent',
                    }],
                },{
                    name: 'Align',
                    property: 'align-items',
                    type: 'radio',
                    defaults: 'center',
                    list: [{
                        value: 'flex-start',
                        title: 'Start',
                        className: 'icons-flex icon-al-start',
                    },{
                        value: 'flex-end',
                        title: 'End',
                        className: 'icons-flex icon-al-end',
                    },{
                        value: 'stretch',
                        title: 'Stretch',
                        className: 'icons-flex icon-al-str',
                    },{
                        value: 'center',
                        title: 'Center',
                        className: 'icons-flex icon-al-center',
                    }],
                },{
                    name: 'Flex Children',
                    property: 'label-parent-flex',
                    type: 'integer',
                },{
                    name: 'Order',
                    property: 'order',
                    type: 'integer',
                    defaults: 0,
                    min: 0
                },{
                    name: 'Flex',
                    property: 'flex',
                    type: 'composite',
                    properties  : [{
                        name: 'Grow',
                        property: 'flex-grow',
                        type: 'integer',
                        defaults: 0,
                        min: 0
                    },{
                        name: 'Shrink',
                        property: 'flex-shrink',
                        type: 'integer',
                        defaults: 0,
                        min: 0
                    },{
                        name: 'Basis',
                        property: 'flex-basis',
                        type: 'integer',
                        units: ['px','%',''],
                        unit: '',
                        defaults: 'auto',
                    }],
                },{
                    name: 'Align',
                    property: 'align-self',
                    type: 'radio',
                    defaults: 'auto',
                    list: [{
                        value: 'auto',
                        name: 'Auto',
                    },{
                        value: 'flex-start',
                        title: 'Start',
                        className: 'icons-flex icon-al-start',
                    },{
                        value   : 'flex-end',
                        title: 'End',
                        className: 'icons-flex icon-al-end',
                    },{
                        value   : 'stretch',
                        title: 'Stretch',
                        className: 'icons-flex icon-al-str',
                    },{
                        value   : 'center',
                        title: 'Center',
                        className: 'icons-flex icon-al-center',
                    }],
                }]
            }
            ],
        },
        plugins: [
            'gjs-blocks-basic',
            'grapesjs-plugin-forms',
            'grapesjs-component-countdown',
            'grapesjs-plugin-export',
            'grapesjs-tabs',
            'grapesjs-custom-code',
            'grapesjs-touch',
            'grapesjs-parser-postcss',
            'grapesjs-tooltip',
            'grapesjs-tui-image-editor',
            'grapesjs-typed',
            'grapesjs-style-bg',
            'grapesjs-preset-webpage',
        ],
        pluginsOpts: {
            'gjs-blocks-basic': { flexGrid: true },
            'grapesjs-tui-image-editor': {
                script: [
                    // 'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.min.js',
                    'https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js',
                    'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.js',
                    'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.js'
                ],
                style: [
                    'https://uicdn.toast.com/tui-color-picker/v2.2.7/tui-color-picker.min.css',
                    'https://uicdn.toast.com/tui-image-editor/v3.15.2/tui-image-editor.min.css',
                ],
            },
            'grapesjs-tabs': {
                tabsBlock: { category: 'Extra' }
            },
            'grapesjs-typed': {
                block: {
                    category: 'Extra',
                    content: {
                        type: 'typed',
                        'type-speed': 40,
                        strings: [
                            'Text row one',
                            'Text row two',
                            'Text row three',
                        ],
                    }
                }
            },
            'grapesjs-preset-webpage': {
                modalImportTitle: 'Import Template',
                modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
                modalImportContent: function(editor) {
                    return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
                },
            },
        },
        storageManager: {
            id: 'gjs-', // Prefix for storage key
            type: 'remote', // Use remote storage
            autosave: true,
            autoload: true,
            stepsBeforeSave: 1,
            urlStore: '/campaigns/{{$campaign->id}}/save-html'  , // Endpoint to save page
            contentTypeJson: true,
            beforeSend: function(xhr, options) {
                // Add any headers if needed
                // xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },

            options: {
                remote: {
                    // Enrich the store call
                    onStore: (data, editor) => {
                        const pagesHtml = editor.Pages.getAll().map(page => {
                            const component = page.getMainComponent();
                            return {
                                html: editor.getHtml({ component }),
                                css: editor.getCss({ component })
                            }
                        });
                        return { id: 'gjs-', data, pagesHtml };
                    },
                    // If on load, you're returning the same JSON from above...
                    onLoad: result => result.data,
                }
            },
        },
    });

    editor.I18n.addMessages({
        en: {
            styleManager: {
                properties: {
                    'background-repeat': 'Repeat',
                    'background-position': 'Position',
                    'background-attachment': 'Attachment',
                    'background-size': 'Size',
                }
            },
        }
    });

    var pn = editor.Panels;
    var modal = editor.Modal;
    var cmdm = editor.Commands;

    // Update canvas-clear command
    cmdm.add('canvas-clear', function() {
        if(confirm('Are you sure to clean the canvas?')) {
            editor.runCommand('core:canvas-clear')
            setTimeout(function(){ localStorage.clear()}, 0)
        }
    });

    // Add info command
    var mdlClass = 'gjs-mdl-dialog-sm';
    var infoContainer = document.getElementById('info-panel');

    cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
            mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
    });

    pn.addButton('options', {
        id: 'open-info',
        className: 'fa fa-question-circle',
        command: function() { editor.runCommand('open-info') },
        attributes: {
            'title': 'About',
            'data-tooltip-pos': 'bottom',
        },
    });


    // Simple warn notifier
    var origWarn = console.warn;
    toastr.options = {
        closeButton: true,
        preventDuplicates: true,
        showDuration: 250,
        hideDuration: 150
    };
    console.warn = function (msg) {
        if (msg.indexOf('[undefined]') == -1) {
            toastr.warning(msg);
        }
        origWarn(msg);
    };


    // Add and beautify tooltips
    [['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
        ['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
        ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
        .forEach(function(item) {
            pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
        });
    [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
        .forEach(function(item) {
            pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
        });
    var titles = document.querySelectorAll('*[title]');

    for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
            break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
    }


    // Store and load events
    editor.on('storage:load', function(e) { console.log('Loaded ', e) });
    editor.on('storage:store', function(e) { console.log('Stored ', e) });


    // Do stuff on load
    editor.on('load', function() {
        var $ = grapesjs.$;

        // Show borders by default
        pn.getButton('options', 'sw-visibility').set('active', 1);

        // Show logo with the version
        var logoCont = document.querySelector('.gjs-logo-cont');
        document.querySelector('.gjs-logo-version').innerHTML = 'v' + grapesjs.version;
        var logoPanel = document.querySelector('.gjs-pn-commands');
        logoPanel.appendChild(logoCont);


        // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        // Remove trait view
        pn.removeButton('views', 'open-tm');

        // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">'+
            '<div class="gjs-sm-sector-title"><span class="icon-settings fa fa-cog"></span> <span class="gjs-sm-sector-label">Settings</span></div>' +
            '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-traits-cs'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-sector-title').on('click', function(){
            var traitStyle = traitsProps.get(0).style;
            var hidden = traitStyle.display == 'none';
            if (hidden) {
                traitStyle.display = 'block';
            } else {
                traitStyle.display = 'none';
            }
        });

        // Open block manager
        var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);

        // Move Ad
        $('#gjs').append($('.ad-cont'));
    });


    function savePageToBackend() {
        const htmlContent = editor.toHTML(); // Get HTML content from GrapesJS

        axios.post('/campaigns/1/save-html', { htmlContent })
            .then(response => {
                console.log('Page saved successfully:', response.data);
            })
            .catch(error => {
                console.error('Error saving page:', error);
            });
    }
</script>
</body>
</html>
