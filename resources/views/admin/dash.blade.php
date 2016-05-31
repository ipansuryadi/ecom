<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{!! asset('/src/public/images/slider/fav-icon.png') !!}" />

    <title>Store Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/css/bootstrap.min.css">
    <!-- Bootstrap core mdb.css -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/css/mdb.css">
    <!-- Include admin.less file -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/less/admin.css">
    <link rel="stylesheet" href="{{ url('/') }}/src/public/less/app.css">
    <!-- Include app.scss file -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/sass/app-sass.css">
    <!-- Include sweet alert file -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/css/sweetalert.css">
    <!-- Include typeahead file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/typeahead.css">
    <!-- Include lity light-tbox file -->
    <link rel="stylesheet" href="{{ url('/') }}/src/public/css/lity.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/src/public/css/custom-admin.css">
    <!-- Include drop-zone file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <!-- Include Froala Editor style. -->
    <link href="{{ url('/') }}/src/public/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="{{ url('/') }}/src/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
    @yield('header')
    <script>
        // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        //             (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        //         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        // ga('create', 'UA-78225711-1', 'auto');
        // ga('send', 'pageview');
    </script>

</head>
<body>

@include('admin.pages.partials.nav')
@include('admin.pages.partials.side-nav')

@yield('content')

<!-- jQuery -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/jquery.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/mdb.js"></script>
<!-- Include sweet-alert.js file -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/sweetalert.js"></script>
<!-- Include typeahead.js file -->
    <script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/typeahead.js"></script>
<!-- Include main app.js file -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/app.js"></script>
<!-- Include lity light-box js file -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/lity.js"></script>
<!-- Include moment.js for chart.js -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/moment.js"></script>
<!-- Chart.js plugin -->
<script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/Chart.js"></script>

@yield('footer')

<script>
    // (function(w,d,s,g,js,fs){
    //     g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
    //     js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
    //     js.src='https://apis.google.com/js/platform.js';
    //     fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    // }(window,document,'script'));
</script>
<script>
    // gapi.analytics.ready(function() {
    //     /**
    //      * Authorize the user immediately if the user has already granted access.
    //      * If no access has been created, render an authorize button inside the
    //      * element with the ID "embed-api-auth-container".
    //      */
    //     gapi.analytics.auth.authorize({
    //         container: 'embed-api-auth-container',
    //         clientid: '1046537984016-nit4kaonusm9c4rrphpnve9dmu51ulp7.apps.googleusercontent.com'
    //     });
    //     /**
    //      * Create a new ViewSelector instance to be rendered inside of an
    //      * element with the id "view-selector-container".
    //      */
    //     var viewSelector = new gapi.analytics.ViewSelector({
    //         container: 'view-selector-container'
    //     });
    //     // Render the view selector to the page.
    //     viewSelector.execute();
    //     *
    //      * Create a new DataChart instance with the given query parameters
    //      * and Google chart options. It will be rendered inside an element
    //      * with the id "chart-container".
         
    //     var dataChart = new gapi.analytics.googleCharts.DataChart({
    //         query: {
    //             metrics: 'ga:sessions',
    //             dimensions: 'ga:date',
    //             'start-date': '30daysAgo',
    //             'end-date': 'yesterday'
    //         },
    //         chart: {
    //             container: 'chart-container',
    //             type: 'LINE',
    //             options: {
    //                 width: '100%'
    //             }
    //         }
    //     });
    //     /**
    //      * Render the dataChart on the page whenever a new view is selected.
    //      */
    //     viewSelector.on('change', function(ids) {
    //         dataChart.set({query: {ids: ids}}).execute();
    //     });
    // });
</script>

@include('partials.flash')

</body>
</html>
