@extends("layouts.master")

@section("content")        

<?php /**
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Hi {{ $user->username }}, you are logged in!
                </div>
            </div>
        </div>
    </div>
**/ ?>

	<div class="row">
		<div class="col-lg-12">
			<div class="jumbotron">
				<h1>Boom!</h1>
				<p>The Family Football Pool is new and improved for the 2016 season.  I've optimized the website to work best on your mobile phone, so enjoy!  Make sure to check out what's new by clicking the "what's new?" button.</p>
				<p><a href="/whats-new" class="btn btn-primary btn-lg" role="button">What's New?</a>
				</p>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>



@if (count($standings))
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Standings</div>

                <div class="panel-body">
<table class="table">
	<tbody>
	<tr><th>Rank</th><th>Player</th><th>Wins</th><th>Losses</th></tr>
<?php $i=0; ?>
@foreach ($standings as $ranking)
	<?php $i++; ?>
	<tr><td>{{ $i }}</td><td>{{ $ranking->username }}</td><td>{{ $ranking->wins }}</td><td></td></tr>
@endforeach                    
	</tbody>
</table>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection

@section("scripts")
<script>
</script>
@endsection