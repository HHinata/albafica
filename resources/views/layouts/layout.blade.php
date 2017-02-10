<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-red">
<div id="app">
    @yield('content')
</div>
<!-- Custom Js -->
<script src="{{ mix('js/app.js') }}"></script>
{{--<!-- Jquery Core Js -->--}}
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Core Js -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<!-- Select Plugin Js -->
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- Morris Plugin Js -->
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>
<!-- ChartJs -->
<script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

<!-- Input Mask Plugin Js -->
<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
<!-- Flot Charts Plugin Js -->
{{--<script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/flot-charts/jquery.flot.time.js') }}"></script>--}}

<!-- Sparkline Chart Plugin Js -->
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('js/admin.js') }}"></script>
{{--<script src="{{ asset('js/pages/index.js') }}"></script>--}}

<!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>

</body>

</html>