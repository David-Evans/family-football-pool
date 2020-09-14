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
        .game-detail {
            padding: .5em;
            border: 1px solid #555;
        }
        .game-detail h4 {
            font-size: 50%;
            text-align: center;
        }
    </style>

</head>

<body id="scoreboard" class="index">
    <div id="wrapper" class="container-fluid">
        @yield('content')
        @include('layouts.partials._scoreboard-footer')
    </div> <!-- /#wrapper -->
</body>

</html>
