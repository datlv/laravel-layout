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