@extends("layouts.master")

@section("content")        

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><i class="fa fa-cog"></i> Administration</h1>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Top secret things only the admin can do</div>
                <div class="panel-body">
                	<p><a href="/scoring/live">Live Scoring</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
<script>
</script>
@endsection
