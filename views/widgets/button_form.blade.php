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
    <div class="form-group{{ $errors->has('label') ? ' has-error':'' }}">
        {!! Form::label('label', $labels['label'], ['class' => 'control-label']) !!}
        {!! Form::text('label', null, ['class' => 'form-control']) !!}
        @if($errors->has('label'))
            <p class="help-block">{{ $errors->first('label') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('url') ? ' has-error':'' }}">
        {!! Form::label('label', $labels['url'], ['class' => 'control-label']) !!}
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
        @if($errors->has('url'))
            <p class="help-block">{{ $errors->first('url') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('btn_type') ? ' has-error':'' }}">
        {!! Form::label('btn_type', $labels['btn_type'], ['class' => 'control-label']) !!}
        {!! Form::select('btn_type', [
            'btn-default' => 'Default',
            'btn-primary' => 'Primary',
            'btn-success' => 'Success',
            'btn-info' => 'Info',
            'btn-warning' => 'Warning',
            'btn-danger' => 'Danger',
            'btn-link' => 'Link',
        ],null, ['class' => 'form-control']) !!}
        @if($errors->has('btn_type'))
            <p class="help-block">{{ $errors->first('btn_type') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('btn_size') ? ' has-error':'' }}">
        {!! Form::label('btn_size', $labels['btn_size'], ['class' => 'control-label']) !!}
        {!! Form::select('btn_size', [
            'btn-lg' => 'Large',
            '' => 'Default',
            'btn-sm' => 'Small',
            'btn-xs' => 'Extra small'
        ],null, ['class' => 'form-control']) !!}
        @if($errors->has('btn_size'))
            <p class="help-block">{{ $errors->first('btn_size') }}</p>
        @endif
    </div>
    @include('layout::widgets._common_fields')
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