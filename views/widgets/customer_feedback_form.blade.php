@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal form-widget-image','url' => $url, 'method' => 'put']) !!}
    <div class="row">
        <div class="col-xs-6">
            @include('layout::widgets._common_fields')
        </div>
        <div class="col-xs-6">
            <?php /** @var \Datlv\Layout\Widget $widget */ ?>
            <div id="preview" class="preview" style="background-image: url('{!! $widget->typeInstance()->imageSrc($widget) !!}')"></div>
            <div class="form-group text-right {{ $errors->has('image_id') ? ' has-error':'' }}">
                {!! Form::browseImage('image_id', 'parent', 'selectImageConfirm') !!}
                @if($errors->has('image_id'))
                    <p class="help-block">{{ $errors->first('image_id') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group {{ $errors->has("name") ? ' has-error':'' }}">
                {!! Form::label("name", $labels['name'], ['class' => "control-label"]) !!}
                {!! Form::text("name", null, ['class' => 'form-control']) !!}
                @if($errors->has('name'))
                    <p class="help-block">{{ $errors->first('name') }}</p>
                @endif
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group {{ $errors->has("office") ? ' has-error':'' }}">
                {!! Form::label("office", $labels['office'], ['class' => "control-label"]) !!}
                {!! Form::text("office", null, ['class' => 'form-control']) !!}
                @if($errors->has('office'))
                    <p class="help-block">{{ $errors->first('office') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has("content") ? ' has-error':'' }}">
        {!! Form::label("content", $labels['content'], ['class' => "control-label"]) !!}
        {!! Form::textarea("content", null, ['class' => 'form-control', 'rows' => 3]) !!}
        @if($errors->has('content'))
            <p class="help-block">{{ $errors->first('content') }}</p>
        @endif
    </div>
    {!! Form::close() !!}
@stop

@push('scripts')
    <script type="text/javascript">
        $(function () {
            var selectedImage;
            window.parent.$.fn.mbHelpers.imageBrowserChange = function (images) {
                selectedImage = images;
            };
            window.selectImageConfirm = function () {
                if (selectedImage.length) {
                    $('input[name="image_id"]').val(selectedImage[0]['id']);
                    $('#preview').css('background-image', 'url(' + selectedImage[0]['thumb_4x'] + ')');
                }
            };
        });
    </script>
@endpush