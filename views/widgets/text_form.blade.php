@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal','url' => $url, 'method' => 'put']) !!}
    @include('layout::widgets._common_fields')
    <div class="form-group {{ $errors->has("content") ? ' has-error':'' }}">
        {!! Form::label("content", $labels['content'], ['class' => "control-label"]) !!}
        {!! Form::textarea("content", null, [
            'class' => 'form-control wysiwyg',
            'data-editor' => 'simple_html',
            'data-height' => 200,
        ]) !!}
        @if($errors->has('content'))
            <p class="help-block">{{ $errors->first('content') }}</p>
        @endif
    </div>

    {!! Form::close() !!}
@stop

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.wysiwyg').mbEditor();
    });
</script>
@endpush