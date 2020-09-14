@extends("layouts.scoreboard")

@section("content")        
<div class="row">

@foreach ($games as $game)
	<div class="col-xs-3">
		{{$game->home_team}}
	</div>
@endforeach

</div>

@endsection
