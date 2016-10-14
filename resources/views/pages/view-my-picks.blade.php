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

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">My picks for week {{ $week }}</div>

                <div class="panel-body">
<table id="view-picks"><tbody>
<tr><th>Match Up</th><th>Pick</th><th>Status</th></tr>
@foreach ($games as $game)
<tr>
    <td style="text-align:center">{{$game->visitor_team}}<br />@<br />{{$game->home_team}}</td>
    <?php 
        $now = date('Y-m-d H:i:s');
        $gameDate = $game->game_datetime;
        if ($gameDate <= $now) {
            $myPick = userPick($game->id, $user->id, $picks);
            $class = '';
            if ($myPick == $game->winner) { $class="won"; }
            $img = ($myPick == "") ? "" : '<img src="/images/logos/'.strtolower($myPick).'.png" />'; 
            echo '<td class="'.$class.'">'.$img.'</td>';
        } else {
            echo '<td><img src="/images/logos/not-started.png" /></td>';
        }
    ?>
    <td></td>
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
        // cache-buster
        foreach ($picks as $pick) {
            if ($pick->game_id == $gameId && $pick->user_id == $userId) {
                return $pick->pick;
            }
        }
        return $result;
    }
?>