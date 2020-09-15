@extends("layouts.scoreboard")

@section("content")        
<p>&nbsp;</p>
<div class="container">
<h1>NFL Scores for Week {{$week}}</h1>
<?php $i=0; ?>
@foreach ($games as $game)
	<?php $i++; ?>
	@if($i>12)
	</div>
	<div class="container">
		<?php $i=0; ?>
	@endif
	<div class="col-xs-6 col-md-3" id="game-{{$i}}">
		<div class="game-detail">
			<?php $gameTime = date('g:iA', strtotime($game->game_date)); ?>
			<h4 class="text-center">{{$game->day_of_week}} - {{$gameTime}} (ET)</h4>
			<div class="row visitor">
				<?php $img = strtolower($game->visitor_team).".png"; ?>
				<div class="logo col-xs-4">
					@if($game->pos_team == $game->visitor_team_short)
					<i class="fa fa-play"></i>
					@endif
					<img src="/images/logos/{{$img}}" />
				</div>
				<div class="team-name col-xs-4">
					{{$game->visitor_team_short}}<br>
					<span class="record">(1-0-0)</span>
				</div>
				<div class="score col-xs-4 text-center">{{$game->visitor_score}}</div>
			</div>
			<div class="row game-status">
				<div class="col-xs-4"></div>
				<div class="col-xs-4"></div>
				<div class="status col-xs-4 text-center">{{$game->game_status}}</div>
			</div>
			<div class="row home">
				<?php $img = strtolower($game->home_team).".png"; ?>
				<div class="logo col-xs-4">
					@if($game->pos_team == $game->home_team_short)
					<i class="fa fa-play"></i>
					@endif
					<img src="/images/logos/{{$img}}" />					
				</div>
				<div class="team-name col-xs-4">
					{{$game->home_team_short}}<br>
					<span class="record">(1-0-0)</span>
				</div>
				<div class="score col-xs-4 text-center">{{$game->home_score}}</div>
			</div>
			<div class="row stadium text-center">
				<div class="col-md-12">{{$game->stadium}}</div>
			</div>
		</div>
	</div>
@endforeach

</div>

@endsection
