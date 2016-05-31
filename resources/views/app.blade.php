<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name=description content="{{config('label')->website_description}} />
        <meta name="keywords" content="{{config('label')->website_keyword}}" />
        <meta name="author" content="Ipan Suryadi" />
        <link rel="shortcut icon" href="{!! asset('/src/public/images/slider/fav-icon.png') !!}" />

        <title>{{config('label')->website_title}}</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/bootstrap.min.css">
        <!-- Bootstrap core mdb.css -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/mdb.css">
        <!-- Include app.less file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/less/app.css">
        <!-- Include app.scss file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/sass/app-sass.css">
        <!-- Include sweet alert file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/sweetalert.css">
        <!-- Include typeahead file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/typeahead.css">
        <!-- Include lity ligh-tbox file -->
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/lity.css">
        <!-- Material Design Icons -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
        <link href="{{ url('/') }}/src/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="{{ url('/') }}/src/public/css/custom.css">
        @yield('header')
        <script>
            // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            //             (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            //         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            // ga('create', 'UA-76800406-1', 'auto');
            // ga('send', 'pageview');
        </script>
        

    </head>
<body>

    @include('partials.nav')

    @yield('content')

    <!-- jQuery -->
    <script type="text/javascript" src="{{ url('/') }}/src/public/js/libs/jquery.js"></script>
    <!-- Include main app.js file -->
    <script type="text/javascript" src="{{ url('/') }}/src/public/js/app.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ url('/') }}/src/public/js/libs/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ url('/') }}/src/public/js/libs/mdb.js"></script>
    <!-- Include sweet-alert.js file -->
    <script type="text/javascript" src="{{ url('/') }}/src/public/js/libs/sweetalert.js"></script>
    <!-- Include typeahead.js file -->
    <script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/typeahead.js"></script>
    <!-- Include lity light-box js file -->
    <script type="application/javascript" src="{{ url('/') }}/src/public/js/libs/lity.js"></script>
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
        //         clientid: 'YOUR CLIENT ID'
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
    <script>
        $('#flyer-query').typeahead({
            minLength: 2,
            source: {
                data: [
                    @foreach($search as $query)
                         "{{ $query->product_name }}",
                    @endforeach
                ]
            }
        });
    </script>
    <script>
        new WOW().init();
    </script>

    @include('partials.flash')

    <script type="text/javascript">
        $(document).ready(function(){
            $('#loadProv').change(function() {
                var provinsi = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{url('/profile/kabupaten')}}",
                    data: {provinsi: provinsi, _token:'{{ csrf_token() }}'},
                    success: function(html)
                    {
                    $("#loadKab").html(html);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#loadKab').change(function() {
                var kabupaten = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{url('/profile/kecamatan')}}",
                    data: {kabupaten: kabupaten, _token:'{{ csrf_token() }}'},
                    success: function(html)
                    {
                    $("#loadKec").html(html);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            var $input = $('#refresh');
            $input.val() == 'yes' ? location.reload(true) : $input.val('yes');
        });
    </script>
    <script type="text/javascript">
        // Delete Address
        $(document).on('click', '#delete-address-btn', function(e) {
            e.preventDefault();
            var self = $(this);
            swal({
                    title: "{{config('label')->delete_address}}",
                    text: "{{config('label')->are_you_sure_you_want_to_delete_this_address}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{config('label')->yes_delete_it}}",
                    closeOnConfirm: true
                },
                function(isConfirm){
                    if(isConfirm){
                        swal("{{config('label')->deleted}}","{{config('label')->address_deleted}}", "success");
                        setTimeout(function() {
                            self.parents(".delete_form_address").submit();
                        }, 1000);
                    }
                    else{
                        swal("cancelled","{{config('label')->your_address_is_safe}}", "error");
                    }
                });
        });

        // Verify Payment
        $(document).on('click', '#verify-payment-btn', function(e) {
            e.preventDefault();
            var self = $(this);
            swal({
                    title: "{{config('label')->payment_verification}}",
                    text: "{{config('label')->are_you_sure_you_want_to_verify_this_payment}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{config('label')->yes_verify_it}}",
                    closeOnConfirm: true
                },
                function(isConfirm){
                    if(isConfirm){
                        swal("{{config('label')->verify}}","{{config('label')->payment_verified}}", "success");
                        setTimeout(function() {
                            self.parents(".verify_form_payment").submit();
                        }, 1000);
                    }
                    else{
                        swal("cancelled","{{config('label')->your_payment_is_nothing_changed}}", "error");
                    }
                });
        });
    </script>
</body>
</html>
