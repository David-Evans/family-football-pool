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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Care to make it interesting?</div>
                <div class="panel-body">
                	<table><tbody>
                	<tr>
                		<td style="width:30%"><a href="https://www.paypal.me/jalapenodave/20"><img src="/images/andrew-jackson.jpg" style="width:70%"></a></td>
                		<td style="width:70%">
                		<p>Let's go for realz this time around!  Everyone <a href="https://www.paypal.me/jalapenodave/20">throw in $20</a> and we'll pay that out to the winner (or possible 1st, 2nd, 3rd).  Let's discuss.</p>
						<p><a href="https://www.paypal.me/jalapenodave/20" role="button" class="btn btn-primary">Put in some dough</a></p>
                		</td>
                	</tr>
                	</tbody></table>
                	<div class="container">
                	<div class="row">
                		<div class="col-md-8">
                		</div>
                		<div class="col-md-4">
                			
                		</div>
                	</div>
                	</div>
				</div>
			</div>
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
		<td><a class="myModal" data-toggle="modal" data-target="#modal" data-user="{{ $ranking->nickname }}" data-displayname="{{ $ranking->display_name}}" data-avatar="{{ $ranking->avatar }}">{{ $ranking->nickname }}</a></td>
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

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="userInfo">
      	<table><tbody>
      		<tr>
	      		<td class="avatar" style="width:20%"></td>
	      		<td class="about" style="padding:1em;width:80%">
	      			<p class="displayName" style="font-weight:bold"></p>
	      			<p class="aka"></p>
	      		</td>
      		</tr>
      	</tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section("scripts")
<script>
//	$('#modal').on('show.bs.modal', function (e) {
//	  console.log('Modal is shown');
//	  user = $(this).attr('data-user');
//	  $("#myModalLabel").html(user);
//	})
	$(".myModal").click(function(){
		console.log('Modal is shown');
		user = $(this).attr('data-user');
		displayName = $(this).attr('data-displayname');
		avatar = $(this).attr('data-avatar');
		console.log(user);
		$("#myModalLabel").text("Who is "+user+"?");
		$("#userInfo .avatar").html('<img src="/images/avatars/' + avatar + '">');
		$("#userInfo .about .displayName").html(displayName);
		$("#userInfo .about .aka").html('a.k.a. "' + user + '"');
	});
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