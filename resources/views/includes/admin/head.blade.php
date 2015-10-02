<meta charset="UTF-8">
    <title>Certified Comments | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSS -->
    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- FontAwesome 4.3.0 -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
    <!-- Ionicons 2.0.0 -->
    <link href="{{ asset('vendor/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Datatables -->
    <link href="{{ asset('vendor/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- Theme style -->
    <link href="{{ asset('vendor/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" >

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('vendor/admin-lte/dist/css/skins/skin-green.css') }}" rel="stylesheet" type="text/css" />

    <!-- Dashboard css-->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
            /* does main namespace exists? */
        if (!cc) {
            var cc = {};
        }

        /*set variables and "constants"*/
        cc.ver = "0.0.1";
        cc.baseUrl = "{{url()}}/";
        cc._token = '{{ csrf_token() }}';
        cc.id = {{ Auth::id() }};
        cc.pusher_key = "{{ env('PUSHER_KEY') }}";
    </script>
