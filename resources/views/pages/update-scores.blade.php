<h1>Update Scores for Week {{ $week }}</h1>
@foreach ($games as $game)
	<h3>Matchup: {{ $game->visitor_team }} at {{ $game->home_team }}</h3>
	<blockquote>
		Game ID: {{ $game->game_id }}<br />
		Game Day: {{ $game->day_of_week }}<br />
		Game Time: {{ $game->game_datetime }}<br />
		Game Status: {{ $game->status }}<br />
		{{ $game->status }} score: {{ $game->visitor_score }} - {{ $game->home_score }}<br />
	</blockquote>
	<hr />
@endforeach
<?php print_r($wins); ?>
