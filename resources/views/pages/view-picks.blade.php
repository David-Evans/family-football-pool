@extends("layouts.master")

@section("content")        
<?php date_default_timezone_set('America/New_York'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-cog fa-fw"></i> Week {{ $week }} Picks
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Leaderboard for week {{ $week }}</div>
                <div class="panel-body">
<?php
    $openGameCount = count($gamesInProgress);
    $finishedGameCount = $gameCount - $openGameCount;
?>
<h5>With {{ $openGameCount }} games remaining, here is the current leaderboard for week {{ $week }}</h5>
<table class="leaderboard"><tbody>
<tr><th>Wins</th><th>Players</th></tr>
@foreach ($winCounts as $winCount)
    <tr>
        <td class="wins">{{ $winCount }}</td>
@foreach ($leaders as $leader)
    <?php if($leader->wins == $winCount) { ?>
        <td><img src="/images/avatars/{{ strtolower($leader->avatar) }}" class="avatar" /></td>
    <?php } ?>
@endforeach
    </tr>
@endforeach
<?php
//print_r($leaders);
//print_r($gamesInProgress);
?>
</tbody></table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Picks for week {{ $week }}</div>

                <div class="panel-body">
<table id="view-picks"><tbody>
<tr>
    <th>Player</th>
@for($i=1;$i<=$gameCount;$i++)
    <th><strong>{{ $i }}</strong></th>
@endfor
</tr>

@foreach ($users as $user)
    <tr>
        <td><img src="/images/avatars/{{ strtolower($user->avatar) }}" class="avatar" /></td>
    @foreach ($games as $game)
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
    @endforeach
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