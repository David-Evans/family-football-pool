@extends("layouts.master")

@section("content")        
<?php date_default_timezone_set('America/New_York'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-cog fa-fw"></i> My Week-by-Week Picks Summary
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Season Summary</div>

                <div class="panel-body">
<table id="view-picks" class="my-picks"><tbody>
<tr><th>Week</th><th>Wins</th><th>Losses</th><th>%</th></tr>
@foreach ($picks as $pick)
<tr>
    <td style="text-align:center;vertical-align:middle">{{$pick->week_id}}</td>
    <td style="text-align:center;vertical-align:middle">{{$pick->wins}}</td>
    <td style="text-align:center;vertical-align:middle">{{$pick->losses}}</td>
    <td style="text-align:center;vertical-align:middle">{{$pick->pct}}</td>
</tr>
@endforeach

</tbody></table>
				</div>
			</div>
		</div>
	</div>
@endsection
