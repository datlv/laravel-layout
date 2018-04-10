<?php
/**
 * @var \Datlv\Layout\Widget $widget
 * @var string[] $socials
 */
$socials = $widget->typeInstance()->socials();
?>
@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal form-widget-social-button','url' => $url, 'method' => 'put']) !!}
    @include('layout::widgets._common_fields')

    @foreach($socials as $social)
    <div class="form-group{{ $errors->has($social) ? ' has-error':'' }}">
        <div class="input-group">
            <span class="input-group-addon social-icon"><i class="fa fa-{{$social}}"></i></span>
            {!! Form::text($social, null, ['class' => 'form-control', 'placeholder' => $labels[$social].'...']) !!}
        </div>
        @if($errors->has($social))
            <p class="help-block">{{ $errors->first($social) }}</p>
        @endif
    </div>
    @endforeach

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