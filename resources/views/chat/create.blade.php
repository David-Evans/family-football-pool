@extends("layouts.master")

@section("content")        

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Chat</div>

                <div class="panel-body">
                    {!! Form::open(['url' => 'chat']) !!}
                    {!! Form::hidden('user_id', $user->id) !!}
                    <div class="form-group">
                        {!! Form::label('message','What smack you got?: ') !!}
                        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Lay down some smack!', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
<script>
</script>
@endsection