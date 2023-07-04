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

</head>

<body class="antialiased">

    @include('partials.sam')

    <h1>hello</h1>

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
