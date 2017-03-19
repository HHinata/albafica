<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <style>
        /* http://meyerweb.com/eric/tools/css/reset/
           v2.0 | 20110126
           License: none (public domain)
        */

        html, body{
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
</head>

<body class="theme-red">
<div id="app">
    @yield('content')
</div>

<script src="js/sonic.js"></script>
<script src="js/lazyload.js"></script>

<script>
    var square = new Sonic({
        width: document.body.scrollWidth,
        height: 400,
        fillColor: '#000',
        path: [
            ['line', 10, 10, 90, 10],
            ['line', 90, 10, 90, 90],
            ['line', 90, 90, 10, 90],
            ['line', 10, 90, 10, 10]
        ]
    });

    square.play();
    document.body.appendChild(square.canvas);

    LazyLoad.js("{{ mix('js/app.js') }}", function () {
        square.stop();
        document.body.removeChild(square.canvas);
    });
</script>

</body>

</html>