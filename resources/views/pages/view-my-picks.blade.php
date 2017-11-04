@extends("layouts.master")

@section("content")        
<?php date_default_timezone_set('America/New_York'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-cog fa-fw"></i> My Week {{ $week }} Picks
            </h1>
        </div>
    </div>

@if ($issues)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">Looks like you haven't made all of your picks for this week!</div>
                @foreach ($issues as $issue)
                    <p>{{$issue->visitor_team}} @ {{$issue->home_team}}</p>
                @endforeach
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">My picks for week {{ $week }}</div>

                <div class="panel-body">
}
<table id="view-picks" class="my-picks"><tbody>
<tr><th>Match Up</th><th>Pick</th><th>Status</th></tr>
@foreach ($picks as $pick)
<tr>
    <td style="text-align:center;vertical-align:middle">{{$pick->visitor_team}}<br />@<br />{{$pick->home_team}}</td>
    <?php 
        $now = date('Y-m-d H:i:s');
        $gameDate = $pick->game_datetime;
        //if ($gameDate <= $now) {
            $myPick = $pick->pick;
            $class = '';
            if ($myPick == $pick->winner) { $class="won"; }
            $img = ($myPick == "") ? "" : '<img src="/images/logos/'.strtolower($myPick).'.png" />'; 
            echo '<td class="'.$class.'">'.$img.'</td>';
        //} else {
        //    echo '<td><img src="/images/logos/not-started.png" /></td>';
        //}
    ?>
    <td style="text-align:center;vertical-align:middle">
    <?php
        $gameStatus = $pick->game_status;
        if ($gameStatus == "Final" || $gameStatus == "Final OT") {
            echo "Final<br />".$pick->visitor_score."-".$pick->home_score;
        } else {
            $gameDay = $pick->day_of_week;
            $gameTime = date('g:iA', strtotime($pick->game_datetime));
            if ($gameStatus != "Pregame") {
                echo $gameStatus.'<br />'.$pick->visitor_score."-".$pick->home_score; 
            } else {
                echo $gameDay.'<br />'.$gameTime.' (ET)';
            }
        }
    ?>
    </td>
</tr>
@endforeach

</tbody></table>
				</div>
			</div>
		</div>
	</div>
@endsection

<?php
    function userPick ($gameId, $userId, $picks) {
        $result = "";
        foreach ($picks as $pick) {
            if ($pick->game_id == $gameId && $pick->user_id == $userId) {
                return $pick->pick;
            }
        }
        return $result;
    }
?>