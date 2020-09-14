@extends("layouts.scoreboard")

@section("content")        
<p>&nbsp;</p>
<div class="row">

@foreach ($games as $game)
	<div class="col-xs-6 col-md-3">
		<div class="game-detail">
			<h4>$game->day_of_week</h4>
			<div class="row visitor">
				<?php $img = strtolower($game->visitor_team).".png"; ?>
				<div class="logo col-xs-4"><img src="/images/logos/{{$img}}" /></div>
				<div class="team-name col-xs-4">{{$game->visitor_team_short}}</div>
				<div class="score col-xs-4">{{$game->visitor_score}}</div>
			</div>
			<div class="row home">
				<?php $img = strtolower($game->home_team).".png"; ?>
				<div class="logo col-xs-4"><img src="/images/logos/{{$img}}" /></div>
				<div class="team-name col-xs-4">{{$game->home_team_short}}</div>
				<div class="score col-xs-4">{{$game->home_score}}</div>
			</div>
		</div>
	</div>
@endforeach

</div>

@endsection
