<?php
/** @var \Datlv\Layout\Widget $widget */
?>
{!! Form::open(['method' => 'get', 'url' => $url]) !!}
<div class="input-group">
    {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('common.keyword').'...']) !!}
    <span class="input-group-btn"><button class="btn" type="submit"><i class="fa fa-search"></i></button></span>
</div>
{!! Form::close() !!}
