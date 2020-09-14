@extends("layouts.scoreboard")

@section("content")        
<p>&nbsp;</p>
<div class="row">

@foreach ($games as $game)
	<div class="col-xs-6 col-md-3">
		<div class="game-detail">
			<h4>$game->day_of_week</h4>
		{{$game->home_team}}
			<div class="visitor">
				<div class="col-xs-4"><img src="/images/logos/49ers.png" /></div>
				<div class="col-xs-4">$game->visitor_team_short</div>
				<div class="col-xs-4">$game->visitor_score</div>
			</div>
			<div class="home">
				<div class="col-xs-4"><img src="/images/logos/49ers.png" /></div>
				<div class="col-xs-4">$game->home_team_short</div>
				<div class="col-xs-4">$game->home_score</div>
			</div>
		</div>
	</div>
@endforeach

</div>

@endsection
