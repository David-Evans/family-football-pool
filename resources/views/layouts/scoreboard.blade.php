<?php $appName = config('app.name'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $appName }} Scoreboard</title>

    <link rel="icon" href="/favicon.ico" />

    <!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color:#000;
            color:#fff;
        }
    </style>

</head>

<body id="scoreboard" class="index">
    <div id="wrapper">
        @yield('content')
        @include('layouts.partials._footer')
    </div> <!-- /#wrapper -->
</body>

</html>
