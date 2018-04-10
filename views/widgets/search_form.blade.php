@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal','url' => $url, 'method' => 'put']) !!}
    <div class="form-group {{ $errors->has("route_result") ? ' has-error':'' }}">
        {!! Form::label("route_result", $labels['route_result'], ['class' => "control-label"]) !!}
        {!! Form::select(
            "route_result", $widget->typeInstance()->getRoutes(), null, ['prompt' => trans('layout::common.select_route'), 'class' => 'form-control selectize'])
        !!}
        @if($errors->has('route_result'))
            <p class="help-block">{{ $errors->first('route_result') }}</p>
        @endif
    </div>
    @include('layout::widgets._common_fields')
    {!! Form::close() !!}
@stop