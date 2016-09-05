@extends("layouts.master")

@section("content")        

<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron" style="background-image:url('/images/football-background.jpg');background-repeat:no-repeat;background-size:cover">
            <div class="row">
                <div class="col-md-12" style="text-align:center">
                    <img src="/images/ffp-banner.png" style="width:80%"><br />
                </div>
                <div class="col-md-12" style="text-align:center">
                    <h2 style="color:#fff;text-shadow:2px 2px 5px #000">Private pick 'em style football competition for the 2016 NFL season</h2>                
                </div>
                <div class="col-md-12" style="text-align:center;margin-top:2em">
                    <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login to play</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row text-center">
    <div class="col-md-4">
        <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading">Full NFL Season</h4>
        <p class="text-muted" style="color:#000">The entire 17-week NFL schedule is wrapped up in the competition.  Winner has the most overall wins and the losers have to suck it!</p>
    </div>
    <div class="col-md-4">
        <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading">Responsive Design</h4>
        <p class="text-muted" style="color:#000">The football pool has re-built from the ground up to be used primarily from your mobile device.  Works best on phones and tablets.</p>
    </div>
    <div class="col-md-4">
        <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-cogs fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading">Automation</h4>
        <p class="text-muted" style="color:#000">New improved automation is now part of the game!  All picks are now lock right at game time.  Miss your pick?  Tough shit!  You get a loss for that bud.</p>
    </div>
</div>
@endsection


