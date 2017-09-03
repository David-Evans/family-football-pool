<?php $endDST = config('app.end_dst'); ?>
@extends("layouts.master")

@section("content")        

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><i class="fa fa-calendar"></i> NFL Season Schedule</h1>
    </div>
</div>

@if (count($games))
<?php /**
<div class="row">
    <div class="col-md-12">
    <p>
        <strong>Week: </strong>
        <a href="#week1"><button type="button" class="btn btn-outline btn-default btn-xs">1</button></a>
        <a href="#week2"><button type="button" class="btn btn-outline btn-default btn-xs">2</button></a>
        <a href="#week3"><button type="button" class="btn btn-outline btn-default btn-xs">3</button></a>
        <a href="#week4"><button type="button" class="btn btn-outline btn-default btn-xs">4</button></a>
        <a href="#week5"><button type="button" class="btn btn-outline btn-default btn-xs">5</button></a>
        <a href="#week6"><button type="button" class="btn btn-outline btn-default btn-xs">6</button></a>
        <a href="#week7"><button type="button" class="btn btn-outline btn-default btn-xs">7</button></a>
        <a href="#week8"><button type="button" class="btn btn-outline btn-default btn-xs">8</button></a>
        <a href="#week9"><button type="button" class="btn btn-outline btn-default btn-xs">9</button></a>
        <a href="#week10"><button type="button" class="btn btn-outline btn-default btn-xs">10</button></a>
        <a href="#week11"><button type="button" class="btn btn-outline btn-default btn-xs">11</button></a>
        <a href="#week12"><button type="button" class="btn btn-outline btn-default btn-xs">12</button></a>
        <a href="#week13"><button type="button" class="btn btn-outline btn-default btn-xs">13</button></a>
        <a href="#week14"><button type="button" class="btn btn-outline btn-default btn-xs">14</button></a>
        <a href="#week15"><button type="button" class="btn btn-outline btn-default btn-xs">15</button></a>
        <a href="#week16"><button type="button" class="btn btn-outline btn-default btn-xs">16</button></a>
        <a href="#week17"><button type="button" class="btn btn-outline btn-default btn-xs">17</button></a>
    </p>
    </div>
</div>
**/ ?>
    <div class="row">
        <div class="col-md-12">
<?php /**
DWE TODO: There are 17 weeks in the season, go through the results 17 times
**/ ?>
<?php for ($i=1;$i<=17;$i++) { ?>
            <a name="week{{ $i }}">
            <div class="panel panel-yellow">
                <div class="panel-heading"></a><h4>Week {{ $i }}</h4></div>
                <div class="panel-body">
                <table class="table"><tbody>
                <tr><th>Matchup</th><th>Day</th><th>Date/Time (ET)</th><th>Score</th></tr>
@foreach ($games as $game)
    @if ($game->week_id == $i)
    <?php
        $date = date_create($game->game_datetime);
        $gameDate = date_format($date, "M jS").'<br />'.date_format($date, "h:i A"); 
    ?>
    <tr>
        <td>{{ $game->visitor_team }} at {{ $game->home_team }}
        @if ($game->alt_location != '')
        <br>({{ $game->alt_location}})
        @endif
        </td>
        <td>{{ $game->day_of_week }}</td>
        <td>{!! $gameDate !!}</td>
        <td>{{ $game->visitor_score }} - {{ $game->home_score }} </td>
    </tr>
    @endif
@endforeach
                </tbody></table>
                </div>
            </div>

<?php } ?>
        </div>
    </div>
@endif


@endsection

@section("scripts")
<script>
    
</script>
@endsection
