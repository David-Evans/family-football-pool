@extends("layouts.master")

@section("content")        

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-bullhorn fa-fw"></i> Smackdown!
            </h1>
        </div>
    </div>

<!--
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Family Football Pool Smackdown!</div>
                <div class="panel-body">
                    <div class="row post-message">
                        <div class="col-lg-12">
-->


@if (count($chats))
    <div class="row">
        <div class="col-md-12">
                    @if (session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{ session('status') }}
</div>
                    @endif
            <div class="panel panel-default">
                <div class="panel-heading">Lay down some smack, {{ $user->nickname }}!</div>

                <div class="panel-body">
                    {!! Form::open(array('action' => array('ChatsController@store'),'files' => true)) !!}
                    <div class="input-group" style="margin-bottom:10px">
                        {{ Form::hidden('user_id', $user->id) }}
                        {{ Form::text('message', null, array('class'=>'form-control input-sm', 'placeholder'=>'Lay your smack here...','required' => 'required')) }}
                        <span class="input-group-btn">
                        {{ Form::submit('Post', array('class' => 'btn btn-primary btn-sm', 'style' => '')) }}
                        </span>
                    </div>
                    <div class="input-group">
                        {!! Form::file('image', null) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Smacks</div>

                <div class="panel-body">
                    <div class="qa-message-list" id="wallmessages">
                    @foreach ($chats as $chat)
                        <?php
                        $image = $chat->avatar;
                        $ago = humanTiming(strtotime($chat->created_at));
                        $ago = ($ago) ? $ago." ago" : $ago = "just now";
                        ?>

                        <div class="message-item" id="m16">
                            <div class="message-inner">
                                <div class="message-head clearfix">
                                    <div class="avatar pull-left"><img class="avatar" src="/images/avatars/{{ $image }}"></div>
                                    <div class="user-detail">
                                        <h5 class="handle">{{ $chat->nickname }}</h5>
                                        <div class="post-meta">
                                            <div class="asker-meta">
                                                <span class="qa-message-what"></span>
                                                <span class="qa-message-when">
                                                    <span class="qa-message-when-data">{{ $ago }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="qa-message-content">
                                    {{ $chat->message }}
                                @if($chat->image != "")
                                    <br /><img src="/images/smack/{{ $chat->image }}" class="smack"/>
                                @endif
                                </div>
                            </div>
                        </div>
                    @endforeach                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!--
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
-->

@endsection

<?php
function humanTiming ($time) {

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if ($numberOfUnits < 1) {
            return FALSE;
        } else {
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }

}
?>