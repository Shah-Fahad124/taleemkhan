<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="" name="description">
    <meta content="" name="author">
    <meta name="" content="">
    <link rel="icon" href="{{ asset('assets/img/taleemkhan-logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/taleemkhan-logo.png') }}" />
    <title>Taleemkhan</title>


    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!--Style css-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!--Icons css-->
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">

    <!--P-scrollbar css-->
    {{-- <link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" /> --}}

    <!--Sidemenu css-->
    <link rel="stylesheet" href="{{ asset('assets/css/sidemenu.css') }}">

    <!--Chartist css-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/chartist/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/chartist/chartist-plugin-tooltip.css') }}"> --}}

    <!--Full calendar css-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/stylesheet1.css') }}"> --}}

    <!--morris css-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}"> --}}
    <!--mutli css-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/multi/multi.min.css') }}"> --}}
    <!--Select2 css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}">

    <!--mutipleselect css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


    <!--Tempusdominus css-->
    {{-- <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.css') }}"> --}}
    <!--Datatables css-->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/Datatable/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/Datatable/css/buttons.bootstrap4.min.css') }}"> --}}
</head>
<style>
    /* Beautiful form styling */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    select,
    textarea {
        font-family: "Poppins", "Segoe UI", sans-serif;
        font-weight: 500; /* Slightly bold */
        font-size: 15px;
        color: #222;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 10px 12px;
        transition: all 0.3s ease;
        box-shadow: none;
    }

    /* Focus effect */
    input:focus,
    select:focus,
    textarea:focus {
        border-color: #4f46e5; /* Indigo tone */
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    /* Placeholder styling */
    ::placeholder {
        color: #6e6d6d;
        font-weight: 400;
    }

    /* Label styling for consistent look */
    label {
        font-weight: 600;
        font-size: 14px;
        color: #2b2a2a;
        margin-bottom: 5px;
    }

    /* Select2 Dropdown */
    .select2-container--default .select2-selection--single {
        font-family: "Poppins", "Segoe UI", sans-serif;
        font-weight: 500;
        font-size: 15px;
        height: 42px;
        border-radius: 6px;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
    }
</style>


<body class="app ">
    <x-alert-toast />


    <!--Header Style -->
    {{-- <div class="wave -three"></div> --}}

    <!--loader -->
    <div id="spinner"></div>

    <!--app open-->
    <div id="app" class="page">
        <div class="main-wrapper">

            {{-- header  --}}
             @include('partials.header')

            {{-- sidebar  --}}
             @include('partials.sidebar')

            <!--app-content open-->
            @yield('content')
            <!--app-content closed-->
        </div>

        {{-- footer  --}}
        @include('partials.footer')

    </div>
    <!--app closed-->

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    {{-- <!-- Popup-chat -->
    <a href="#" id="addClass"><i class="ti-comment"></i></a> --}}

    <!--Jquery.min js-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!--popper js-->
    {{-- <script src="{{ asset('assets/js/popper.js') }}"></script> --}}

    <!--Bootstrap.min js-->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Tooltip js-->
    <script src="{{ asset('assets/js/tooltip.js') }}"></script>

    <!-- Jquery star rating-->
    {{-- <script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script> --}}

    <!--Jquery.nicescroll.min js-->
    {{-- <script src="{{ asset('assets/plugins/nicescroll/jquery.nicescroll.min.js') }}"></script> --}}

    <!--Scroll-up-bar.min js-->
    {{-- <script src="{{ asset('assets/plugins/scroll-up-bar/dist/scroll-up-bar.min.js') }}"></script> --}}

    <!--Sidemenu js-->
    <script src="{{ asset('assets/plugins/toggle-menu/sidemenu.js') }}"></script>

    <!--p-scrollbar js-->
    {{-- <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/p-scroll/p-scroll.js') }}"></script> --}}

    <!-- jQuery Sparklines -->
    {{-- <script src="{{ asset('assets/plugins/jquery-sparkline/dist/jquery.sparkline.js') }}"></script> --}}

    <!--Jquery.knob js-->
    {{-- <script src="{{ asset('assets/plugins/othercharts/jquery.knob.js') }}"></script> --}}

    <!--Jquery.sparkline js-->
    {{-- <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script> --}}

    <!--Chart js-->
    {{-- <script src="{{ asset('assets/js/chart.min.js') }}"></script> --}}

    <!--Dashboard js-->
    {{-- <script src="{{ asset('assets/js/dashboard4.js') }}"></script> --}}

    <!--Other Charts js-->
    {{-- <script src="{{ asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/othercharts.js') }}"></script> --}}

    <!--Sparkline js-->
    {{-- <script src="{{ asset('assets/js/sparkline.js') }}"></script> --}}

    <!--Showmore js-->
    {{-- <script src="{{ asset('assets/js/jquery.showmore.js') }}"></script> --}}

    <!--Scripts js-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <!--multi js-->
    {{-- <script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>
    <script src="{{ asset('assets/js/formelementadvnced.js') }}"></script> --}}

    <!--Select2 js-->
    <script src="{{ asset('assets/plugins/select2/select2.full.js') }}"></script>
    <!--MutipleSelect js-->
    <script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

    <!--Accordion-Wizard-Form js-->
    {{-- <script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script> --}}

    <!--Tempusdominus js-->
    {{-- <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script> --}}

    <!--DataTables js-->
    {{-- <script src="{{ asset('assets/plugins/Datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/Datatable/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <!--Advanced Froms -->
    <script src="{{ asset('assets/js/advancedform.js') }}"></script>
    <script src="{{ asset('assets/js/forms.js') }}"></script> --}}

    {{-- Page-specific scripts will be injected here --}}
    @stack('scripts')

</body>

</html>
