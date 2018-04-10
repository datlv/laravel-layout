@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($model,['class' => 'form-modal','url' => $url, 'method' => 'put']) !!}
    <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.title'), ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <p class="help-block">{{ $errors->has('title') ? $errors->first('title'): trans('layout::sidebar.title_hint') }}</p>
    </div>
    <div class="form-group{{ $errors->has('subtitle') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.subtitle'), ['class' => 'control-label']) !!}
        {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
        @if($errors->has('subtitle'))
            <p class="help-block">{{ $errors->first('subtitle') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('footer') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.footer'), ['class' => 'control-label']) !!}
        {!! Form::text('footer', null, ['class' => 'form-control']) !!}
        @if($errors->has('footer'))
            <p class="help-block">{{ $errors->first('footer') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('before') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.before'), ['class' => 'control-label']) !!}
        {!! Form::text('before', null, ['class' => 'form-control']) !!}
        @if($errors->has('before'))
            <p class="help-block">{{ $errors->first('before') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('after') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.after'), ['class' => 'control-label']) !!}
        {!! Form::text('after', null, ['class' => 'form-control']) !!}
        @if($errors->has('after'))
            <p class="help-block">{{ $errors->first('after') }}</p>
        @endif
    </div>
    <div class="form-group{{ $errors->has('columns') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.columns'), ['class' => 'control-label']) !!}
        {!! Form::text('columns', null, ['class' => 'form-control']) !!}
        <p class="help-block">{!! $errors->has('columns') ? $errors->first('columns'): trans('layout::sidebar.columns_hint')  !!}</p>
    </div>
    <div class="form-group{{ $errors->has('label') ? ' has-error':'' }}">
        {!! Form::label('label', trans('layout::sidebar.label'), ['class' => 'control-label']) !!}
        {!! Form::text('label', null, ['class' => 'form-control']) !!}
        <p class="help-block">{!! $errors->has('label') ? $errors->first('label'): trans('layout::sidebar.label_hint')  !!}</p>
    </div>
    {!! Form::close() !!}
@stop