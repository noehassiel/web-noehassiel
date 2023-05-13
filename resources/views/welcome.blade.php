<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>noehassiel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            padding: 0:
        }

        .loader {
            background: #DF5A3A;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        #wrap {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            overflow: hidden;
        }

        #wrap canvas {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 500px;
            height: 500px;
            margin: -250px 0 0 -250px;
            -outline: 1px solid #fff;
        }

        .info {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 12px;
            color: #ccc;
            line-height: 2em;
            text-align: center;
        }
    </style>
</head>

<body class="antialiased">

    @include('partials.sam')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r77/three.min.js"></script>

    <script>
        window.onload = function() {

            var pageTitle = 'noehassiel';
            var attentionMessage = 'Zzzz...';

            document.addEventListener('visibilitychange', function(e) {
                var isPageActive = !document.hidden;

                if (!isPageActive) {
                    document.title = attentionMessage;
                } else {
                    document.title = pageTitle;
                }
            });
        };
    </script>


    @stack('scripts')

    <script src="{{ mix('js/app.js') }}"></script>


</body>

</html>
