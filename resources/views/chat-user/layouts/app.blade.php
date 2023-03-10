<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/chatvia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Jan 2023 18:14:13 GMT -->
<head>

    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat | Chatvia - Responsive Bootstrap 4 Chat App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive Bootstrap 4 Chat App" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('chat-assets/images/favicon.ico')}}">

    <!-- magnific-popup css -->
    <link href="{{ asset('chat-assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css"/>

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('chat-assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('chat-assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('chat-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset('chat-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('chat-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('chat-assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css"
          integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link type="text/css" rel="stylesheet" href="{{asset('chat-assets/libs/imageUploader/image-uploader.min.css')}}">

    <style type="text/css">
        @keyframes ldio-nywklxxt9jo {
            0% {
                transform: rotate(0deg)
            }
            50% {
                transform: rotate(22.5deg)
            }
            100% {
                transform: rotate(45deg)
            }
        }

        .ldio-nywklxxt9jo > div {
            transform-origin: 100px 100px;
            animation: ldio-nywklxxt9jo 0.2s infinite linear;
        }

        .ldio-nywklxxt9jo > div div {
            position: absolute;
            width: 22px;
            height: 152px;
            background: #7269ef;
            left: 100px;
            top: 100px;
            transform: translate(-50%, -50%);
        }

        .ldio-nywklxxt9jo > div div:nth-child(1) {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }

        .ldio-nywklxxt9jo > div div:nth-child(6) {
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 50%;
        }

        .ldio-nywklxxt9jo > div div:nth-child(3) {
            transform: translate(-50%, -50%) rotate(45deg)
        }

        .ldio-nywklxxt9jo > div div:nth-child(4) {
            transform: translate(-50%, -50%) rotate(90deg)
        }

        .ldio-nywklxxt9jo > div div:nth-child(5) {
            transform: translate(-50%, -50%) rotate(135deg)
        }

        .loadingio-spinner-gear-7dog425091x {
            width: 200px;
            height: 200px;
            display: inline-block;
            overflow: hidden;
            background: #ffffff;
        }

        .ldio-nywklxxt9jo {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0; /* see note above */
        }

        .ldio-nywklxxt9jo div {
            box-sizing: content-box;
        }

        /* generated by https://loading.io/ */
    </style>
    {{--    @vite(['resources/css/app.css'])--}}

</head>

<body>

{{--<div class="loadingio-spinner-gear-7dog425091x" id="loading">--}}
{{--    <div class="ldio-nywklxxt9jo">--}}
{{--        <div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--            <div></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@yield('content')
<!-- JAVASCRIPT -->
<script src="{{ asset('chat-assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('chat-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('chat-assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('chat-assets/libs/node-waves/waves.min.js') }}"></script>

<!-- Magnific Popup-->
<script src="{{ asset('chat-assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

<!-- owl.carousel js -->
<script src="{{ asset('chat-assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>

<!-- page init -->
<script src="{{ asset('chat-assets/js/pages/index.init.js') }}"></script>

<script src="{{ asset('chat-assets/js/app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{asset('chat-assets/libs/imageUploader/image-uploader.min.js')}} "></script>
@vite(['resources/js/app.js'])
<script src="{{ asset('chat-assets/js/load.js') }}" ></script>
@stack('script')

<script>
    function htmlParse(value) {
        return $.parseHTML(value)
    }

    function successMessage(message, title = 'Success') {
        toastr.success(message, title);
    }

    function errorMessage(message, title = 'Error') {
        toastr.error(message, title);
    }

    // $(window).load(function() {
    //     $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    // });



</script>

</body>

<!-- Mirrored from themesbrand.com/chatvia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Jan 2023 18:14:20 GMT -->
</html>
