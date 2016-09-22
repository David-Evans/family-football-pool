@extends("layouts.master")

@section("content")        

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><i class="fa fa-cog"></i> Administration</h1>
        <h4>Top secret things only the admin can do</h4>
    </div>
</div>

<?php
$password = isset($_GET['password']) ? Hash::make($_GET['password']) : FALSE;
?>
@if($password)
<p>Password:<br>{{ $password }}</p>
@else
@endif

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Update Scoring</div>
                <div class="panel-body">
                	<p><a href="/scoring/update" class="btn btn-primary">Update Scores</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Send a single text message</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'tropo/sendmsg', 'method' => 'get']) !!}
                    <p>Text Number:<br />
                    <select name="numbertodial" class="form-control input-sm">
                        <option value="">Pick a user...</option>
                        @foreach ($users as $user)
                        <option value="{{$user->sms_number}}">{{ $user->nickname }} ({{$user->display_name}})</option>
                        @endforeach
                    </select>
                    <p>Message:<br />
                    {{ Form::text('msg', null, array('class'=>'form-control input-sm', 'placeholder'=>'Enter text message here...','required' => 'required')) }}</p>
                    <p>{{ Form::submit('Send SMS', array('class' => 'btn btn-primary btn-sm', 'style' => '')) }}</p>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Send a text to the entire group</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'tropo/sendgroupmsg', 'method' => 'get']) !!}
                    <p>Message:<br />
                    {{ Form::text('msg', null, array('class'=>'form-control input-sm', 'placeholder'=>'Enter text message here...','required' => 'required')) }}</p>
                    <p>{{ Form::submit('Send SMS', array('class' => 'btn btn-primary btn-sm', 'style' => '')) }}</p>
                    {!! Form::close() !!}
                    <hr />
                    <a href="/admin/sms-test">Send group text</a></p>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Top secret things only the admin can do</div>
                <div class="panel-body">
                    <p><a href="/scoring/update">Update Scoring</a></p>
                    <hr />
                    {!! Form::open(['url' => 'tropo/sendmsg', 'method' => 'get']) !!}
                    <p>Text Number:<br />
                    {{ Form::text('numbertodial', null, array('class'=>'form-control input-sm', 'placeholder'=>'8005551212','required' => 'required')) }}</p>
                    <p>Message:<br />
                    {{ Form::text('msg', null, array('class'=>'form-control input-sm', 'placeholder'=>'Enter text message here...','required' => 'required')) }}</p>
                    <p>{{ Form::submit('Send SMS', array('class' => 'btn btn-primary btn-sm', 'style' => '')) }}</p>
                    {!! Form::close() !!}
                    <hr />
                    <a href="/admin/sms-test">Send a text</a></p>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
<script>
</script>
@endsection
