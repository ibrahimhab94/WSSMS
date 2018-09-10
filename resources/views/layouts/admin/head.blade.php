<head>
    <meta charset="utf-8">
    <title> @yield('page_title') </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- #CSS Links -->
    <!-- Basic Styles -->

    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/demo.min.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/smartadmin-skins.min.css">
    <link rel="stylesheet" href="/assets/css/selectize.css">
    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/smartadmin-rtl.min.css">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/custom.css">
    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    @section('customhead')
        @show

</head>