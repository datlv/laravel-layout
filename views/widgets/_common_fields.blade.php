<div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
    {!! Form::label('label', trans('layout::widget.title'), ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'disabled' => isset($disabled_title) && $disabled_title ?'disabled': null]) !!}
    <p class="help-block">{!! $errors->has('title') ? $errors->first('title'): trans('layout::widget.title_hint')  !!}</p>
</div>
<div class="form-group{{ $errors->has('subtitle') ? ' has-error':'' }}">
    {!! Form::label('label', trans('layout::widget.subtitle'), ['class' => 'control-label']) !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    @if($errors->has('subtitle'))
        <p class="help-block">{{ $errors->first('subtitle') }}</p>
    @endif
</div>
<div class="form-group{{ $errors->has('css') ? ' has-error':'' }}">
    {!! Form::label('label', trans('layout::widget.css'), ['class' => 'control-label']) !!}
    {!! Form::text('css', null, ['class' => 'form-control']) !!}
    @if($errors->has('css'))
        <p class="help-block">{{ $errors->first('css') }}</p>
    @endif
</div>