@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal','url' => $url, 'method' => 'put']) !!}
    <div class="form-group {{ $errors->has("icon") ? ' has-error':'' }}">
        {!! Form::label("icon", $labels['icon'], ['class' => "control-label"]) !!}
        <div class="input-group">
            {!! Form::text("icon", null, ['data-placement' =>'bottomRight', 'class' => 'form-control icp icp-auto']) !!}
            <span class="input-group-addon"></span>
        </div>
        @if($errors->has('icon'))
            <p class="help-block">{{ $errors->first('icon') }}</p>
        @endif
    </div>
    @include('layout::widgets._common_fields')
    <div class="form-group {{ $errors->has("text") ? ' has-error':'' }}">
        {!! Form::label("text", $labels['text'], ['class' => "control-label"]) !!}
        {!! Form::textarea("text", null, ['class' => 'form-control']) !!}
        @if($errors->has('text'))
            <p class="help-block">{{ $errors->first('text') }}</p>
        @endif
    </div>
    {!! Form::close() !!}
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                $('.icp-auto').iconpicker();
            });
        });
    </script>
@endpush