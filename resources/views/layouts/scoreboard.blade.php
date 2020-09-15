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
            margin-top: 1em;
            padding: .5em;
            border: 1px solid #555;
        }
        .game-detail h4 {
            font-size: 100%;
            height: 2em;
            border-bottom: 1px solid #555;
            text-transform: uppercase;
        }
        .game-detail .logo img {
            width: 90%;
            padding: .25em;
        }
        .game-detail .team-name {
            font-size: 150%;
            line-height: 80%;
            padding: .25em;
        }
        .game-detail .score {
            font-size: 250%;
            font-weight: bold;
            line-height: 2em;
            background: -webkit-linear-gradient(#fff, #333);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
        }
        .game-detail .team-name .record {
            font-size: 60%;
            color:#666;         
        }
        .game-detail .status {
            font-size: 100%;
            text-transform: uppercase;
            color:#666;         
        }
        .game-detail .stadium {
            font-size: 80%;
            text-transform: uppercase;
            color:#666;
        }
        @media (min-width: 768px) {
            .game-detail .logo img { width: 120%; }
            .game-detail h4 { font-size: 140%; }
            .game-detail .team-name {
                font-size: 200%;
                padding: .5em;
            }
        }
        @media (min-width: 992px) {
            .game-detail .logo img { width: 120%; }
            .game-detail .team-name { font-size: 140%; }
            .game-detail .score { font-size: 200%; }
        }
        @media (min-width: 1200px) {
            .game-detail .logo img {
                width: 120%;
                padding: .25em;
            }
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
