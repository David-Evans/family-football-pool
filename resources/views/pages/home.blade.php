<?php 
$buffer = date('Y-m-d H:i:s', strtotime('-3 hours')); 
//$rightNow = date('M jS');
$rightNow = getRightNow($user);
?>
@extends("layouts.master")

@section("content")        

@if(strtotime($user->created_at) > strtotime($buffer))
	<div class="row">
		<div class="col-lg-12">
			<div class="jumbotron" style="background-image: url('images/TAFS_Background.png');background-repeat:no-repeat;background-size:cover">
				<div class="row" style="padding:0 2em">
					<div class="col-lg-10 offset-lg-2">
					<h1 style="color:#fff">Boom!</h1>
					<p style="color:#fff;text-shadow:2px 2px #000">Welcome {{ $user->nickname }}! The Family Football Pool is new and improved for the 2016 season.  I've optimized the website to work best on your mobile phone, so enjoy!  Make sure to check out what's new by clicking the "What's New?" button.</p>
					<p><a href="/whats-new" class="btn btn-primary btn-lg" role="button">What's New?</a>
					</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">May I Have Your Attention Please?</div>
                <div class="panel-body">
				<ul>
					<li>Last year's champion was Jude (Joker), so you have to do better this year if you want to win!</li>
					<li>There's an interest in "making it interesting" this year.  Care to <a href="https://www.paypal.me/jalapenodave/20">throw in $20 to the pot?</a></li>
					<li>The site is mostly under construction, but still functional.  If you find any bugs, <a href="/chat">lay down some smack</a>
					<li>Reminder: Games will automatically lock right about the time they start, so be vigilant</li>
					<li>Have fun everyone!</li>
				</ul>
				</div>
			</div>	
		</div>
	</div>
@else
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-home fa-fw"></i> Home
            </h1>
        </div>
    </div>
@endif

@if (count($standings))
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Standings as of {{ $rightNow }}</div>

                <div class="panel-body">
<table class="table">
	<tbody>
	<tr><th>Rank</th><th>Player</th><th>W</th><th>L</th><th>%</th><th>GB</th></tr>
<?php $i=0; ?>
@foreach ($standings as $ranking)
<?php 
	$i++; 
	if ($i == 1) { $mostWins = $ranking->wins; }
?>
	<tr>
		<td>{{ $i }}</td>
		<td>{{ $ranking->nickname }}</td>
		<td>{{ $ranking->wins }}</td>
		<td></td>
		<td></td>
		<td>{{ intval($ranking->wins) - intval($mostWins) }}</td>
	</tr>
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
<?php
function getRightNow($user) {
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

	$result = date('M jS - g:i A', strtotime("-".$diff." hours"));
	return $result;
}
?> 