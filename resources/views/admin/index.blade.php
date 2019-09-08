@extends("layouts.master")
<style>
    img.avatar { width: 75% }
</style>
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
                <div class="panel-heading">Send Reminders</div>
                <div class="panel-body">
                    <p><a href="/send-reminders" class="btn btn-primary">Send Reminders</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Send a single text message</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'nexmo/sendmsg', 'method' => 'get']) !!}
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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Send a text to the entire group</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'nexmo/sendgroupmsg', 'method' => 'get']) !!}
                    <p>Message:<br />
                    {{ Form::text('msg', null, array('class'=>'form-control input-sm', 'placeholder'=>'Enter text message here...','required' => 'required')) }}</p>
                    <p>{{ Form::submit('Send SMS', array('class' => 'btn btn-primary btn-sm', 'style' => '')) }}</p>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Nickname</th>
                                <th>Display Name</th>
                                <th>SMS Number</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><img src="/images/avatars/{{ strtolower($user->avatar) }}" class="avatar" /></td>
                                <td>{{$user->nickname}}</td>
                                <td>{{$user->display_name}}</td>
                                <td>{{$user->sms_number}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body table-responsive">
                    @foreach ($picks as $pick)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Display Name</th>
                                <th>Picks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $pick->name }}</td>
                                <td>{{ $pick->picks }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
<script>
</script>
@endsection
