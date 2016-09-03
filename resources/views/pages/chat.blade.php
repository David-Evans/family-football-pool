@extends("layouts.master")

@section("content")        

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Family Football Pool Smackdown!</div>
                <div class="panel-body">
                    <div class="row post-message">
                        <div class="col-lg-12">
                            <div class="response-alert"></div>
                            {{ Form::open(['data-remote-on-success' => 'remove','route' => array('postnewchat')]) }}
                            <div class="input-group">
                                {{ Form::hidden('submittedby', $id) }}
                                {{ Form::text('message', null, array('class'=>'form-control input-sm', 'placeholder'=>'Type your message here...','required' => 'required')) }}
                                <span class="input-group-btn">
                                {{ Form::submit('Post', array('class' => 'btn btn-primary btn-sm', 'style' => 'margin-top:2px')) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section("scripts")
<script>
</script>
@endsection