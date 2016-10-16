@extends("layouts.master")

@section("content")        

<?php
//$tropo->sendSMS();
?><section id="pickform">

<?php /**
Referencing passed variables:
	Escaped: {{ $variable }}
	Unescaped: {!! $variable !!}
	NOTE: Use unescaped by default or any script tags will get escaped (and displayed)
**/ ?>

<div class="row">
	<div class="col-md-12">
		<h1 class="page-header"><i class="fa fa-cogs"></i> Week {{ $week }}</h1>
	</div>
</div>

@if (session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{ session('status') }}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Instructions</div>

            <div class="panel-body">
                <p>Super easy pickin':  Just tap or click the team logo that you think will win. You can submit as many or as few picks you want!</p>
                <p><span class="text-danger">WARNING: Games are locked on their scheduled start time, if you don't get your pick in, it will count as a loss. NO EXCEPTIONS</span></p>
            </div>
        </div>
    </div>
</div>


@if (count($picks))
	{!! Form::open(array('action' => array('PicksController@store'))) !!}
	{{ Form::hidden('user_id', $user->id) }}
<?php
$groups = array();
$groupHead = FALSE;
$groupGames = array();
$i = 0;
?>
<?php
dd($picks);
?>

	@foreach ($picks as $pick)
		@if ($groupHead != $pick->day_of_week)
		<?php 
			// Start a new group
			$i++;
			$groupHead = $pick->day_of_week;
			$groupGames = array(); // Reset for next group
		?>
		@endif
		<?php 
			array_push($groupGames,$pick);
			$groups[$i] = $groupGames; 
		?>
	@endforeach

	@foreach ($groups as $group)
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<?php $gameDate = date('F j, Y', strtotime($group[0]->game_datetime)); ?>
				<div class="panel-heading gameday-group clearfix">
					<h4 class="game-day">{{ $group[0]->day_of_week }}</h4>
					<h4 class="game-date">{{ $gameDate }}</h4>
				</div>
				<div class="panel-body">
				<?php $i = 0; ?>
				@foreach ($group as $pick)
					<?php 
						$i++;
						$pickedTeam = isAlreadyPicked($pick->id, $mypicks);
						$gameTime = getGameTime($pick->game_datetime,$user);
						$lockStatus = isGameStarted($pick->game_datetime);
					?>

					<table class="table picks {{ $lockStatus }}">
						<tbody>
						@if ($lockStatus != "locked")
						<input name="pick-{{ $pick->id }}" type="hidden" value="{{ $pickedTeam }}" />
						@endif
						<tr>
							<td class="game-{{ $pick->id }} visitor">
								<div style="position:relative">
									@if ($pick->visitor_team == $pickedTeam)
									<img src="/images/logos/{{ strtolower($pick->visitor_team) }}.png" class="team-picker picked" data-game="{{ $pick->id }}" data-team="{{ $pick->visitor_team }}" />
									@else
									<img src="/images/logos/{{ strtolower($pick->visitor_team) }}.png" class="team-picker" data-game="{{ $pick->id }}" data-team="{{ $pick->visitor_team }}" />
									@endif
									@if ($lockStatus == "locked")
									<div class="lock"><i class="fa fa-lock"></i></div>
									@endif
								</div>
							</td>
							<td class="at">
								<i class="fa fa-at"></i><br />{{ $gameTime }}
								@if ($lockStatus == "locked")
								<br /><span style="color:red">Locked</span>
								@endif
							</td>
							<td class="game-{{ $pick->id }} home">
								<div style="position:relative">
									@if ($pick->home_team == $pickedTeam)
									<img src="/images/logos/{{ strtolower($pick->home_team) }}.png" class="team-picker picked" data-game="{{ $pick->id }}" data-team="{{ $pick->home_team }}" />
									@else
									<img src="/images/logos/{{ strtolower($pick->home_team) }}.png" class="team-picker" data-game="{{ $pick->id }}" data-team="{{ $pick->home_team }}" />
									@endif
									@if ($lockStatus == "locked")
									<div class="lock"><i class="fa fa-lock"></i></div>
									@endif
								</div>
							</td>
						</tr>
						</tbody>
					</table>

					@if ($i < count($group))
					<hr />
					@endif
				@endforeach
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="row">
		<div class="col-md-12">
			<input type="submit" class="btn btn-warning btn-lg btn-block center-block" style="width:80%" value="Enter/Update My Picks" />
		</div>
	</div>

	{!! Form::close() !!}

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>

@endif

</section>

@endsection

@section("scripts")
<script>
    $(function() {
        $(".unlocked .team-picker").click(function() {
            gameId = $(this).attr('data-game');
            pickedTeam = $(this).attr('data-team');
            if ($(this).hasClass('picked')) {
                // $('.game-'+gameId).find('img').removeClass('picked');
                // $('input[name="pick-'+gameId+'"]').val('');
            } else {
                $('.game-'+gameId).find('img').removeClass('picked');
                $(this).addClass('picked');
                // myPick = new Array();
                // myPick.push(gameId);
                // myPick.push(pickedTeam);
                // $('input[name="pick-'+gameId+'"]').val(JSON.stringify(myPick));
                $('input[name="pick-'+gameId+'"]').val(pickedTeam);
            }
        });
    });
</script>

@endsection

<?php
	function getGameTime($gameDateTime, $user) {
		date_default_timezone_set('America/New_York');
		$dayLightSavingsEndDate = env("END_DST", "NULL");
		$dayLightSavingsEndDate = strtotime($dayLightSavingsEndDate);
		$rightNow = strtotime("now");
		$timezone = $user->timezone;

		// Determine timezone offset
		switch ($timezone) {
			case "Pacific":
				$diff = 3;
				break;
			case "Arizona":
				$diff = ($rightNow < $dayLightSavingsEndDate) ? 3 : 2;
				break;
			case "Mountain":
				$diff = 2;
				break;
			case "Central":
				$diff = 1;
				break;
			case "Eastern":
				$diff = 0;
				break;
			default:
				$diff = 0;
		}

		$result = strtotime("-".$diff." hours", strtotime($gameDateTime));
		$gameTime = date("h:i A", $result);
		return $gameTime;
	}

	function isGameStarted($gameDateTime) {
		// Has the game already started (or is basically in the past?)
		date_default_timezone_set('America/New_York');
		$rightNow = strtotime("now");
		$result = ($rightNow < strtotime($gameDateTime)) ? "unlocked" : "locked";
		return $result;
	}

	function isAlreadyPicked($gameId, $myPicks) {
		$result = FALSE;
		foreach ($myPicks as $myPick) {
			if ($myPick->game_id == $gameId) { $result = $myPick->pick; }
		}
		return $result;
	}
?>