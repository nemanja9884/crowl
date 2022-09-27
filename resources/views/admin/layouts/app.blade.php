<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crowl</title>


    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
        .switch {
            display: inline-block;
            height: 34px;
            position: relative;
            width: 60px;
        }

        .switch input {
            display:none;
        }

        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transition: .4s;
        }

        .slider:before {
            background-color: #fff;
            bottom: 4px;
            content: "";
            height: 26px;
            left: 4px;
            position: absolute;
            transition: .4s;
            width: 26px;
        }

        input:checked + .slider {
            background-color: #66bb6a;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #holder img {
            margin: 10px;
        }

        .popover {
            top: auto;
            left: auto;
        }

    </style>
</head>
<body>
@include('admin.layouts.left_panel')
@yield('content')
</body>
</html>

<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script src="{{asset('plugins/tinymce/tinymce.min.js?v=2')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
@yield('javascript')
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })

    var editor_config = {
        path_absolute: "/",
        selector: "#textarea-input, #textarea-input1, #textarea-input2, #textarea-input10, #textarea-input11, #textarea-input12, #textarea-input14",
        plugins: 'print preview fullpage searchreplace autolink directionality visualblocks code visualchars fullscreen image link media embedpost template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help contextmenu paste',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media embedpost | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat fullscreen preview paste blockquote',
        relative_urls: false,
        extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align],+script[language|type|src]",
        valid_children: "+body[style],+body[script],+div[link],+body[div],+body[p],+body[blockquote],+body[blockquote]",
        branding: false,
        image_caption: true,
        image_dimensions: false,
        image_class_list: [
            {title: 'Responsive', value: 'img-responsive'}
        ],
        height: 400,
        min_height: 300,
        paste_as_text: true,
        mobile: {
            theme: 'mobile',
        },
        file_picker_types: 'file image media embed',
        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
            /*if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }*/
            cmsURL = cmsURL + "&type=Files";
            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);

    <?php echo \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')); ?>

    var route_prefix = "/laravel-filemanager";

    var lfm = function(id, type, options) {
        let button = document.getElementById(id);

        button.addEventListener('click', function () {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            var target_input = document.getElementById(button.getAttribute('data-input'));
            var target_preview = document.getElementById(button.getAttribute('data-preview'));

            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.value = file_path;
                target_input.dispatchEvent(new Event('change'));

                // clear previous preview
                target_preview.innerHtml = '';

                // set or change the preview image src
                items.forEach(function (item) {
                    let img = document.createElement('img')
                    img.setAttribute('style', 'height: 5rem')
                    img.setAttribute('src', item.thumb_url)
                    target_preview.appendChild(img);
                });

                // trigger change event
                target_preview.dispatchEvent(new Event('change'));
            };
        });
    };

    //
    lfm('lfm2', 'file', {prefix: route_prefix});
    lfm('lfm', 'file', {prefix: route_prefix});
    lfm('lfm3', 'file', {prefix: route_prefix});

</script>
