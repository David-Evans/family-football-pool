@extends("layouts.scoreboard")

@section("content")        
<p>&nbsp;</p>
<div class="row">

@foreach ($games as $game)
	<div class="game-detail col-xs-6 col-md-3">
		{{$game->home_team}}
	</div>
@endforeach

</div>

@endsection
