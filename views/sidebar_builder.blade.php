<div class="ibox ibox-sidebar">
    <div class="ibox-title">
        <h5><i class="fa fa-window-maximize"></i> {{$sidebar['title']}}</h5>
        <div class="ibox-tools">
            {!! Html::modalLink(
                route("{$route_prefix}backend.sidebar.edit", ['sidebar' => $sidebar['name']]),
                '<i class="fa fa-pencil"></i>',
                [
                    'title' => trans('layout::sidebar.edit'),
                    'icon' => 'window-maximize',
                    'label' => trans('common.save')
                ],
                [
                    'data-toggle' => 'tooltip',
                    'data-title' => trans('layout::sidebar.edit')
                ]
            )!!}
            <a class="collapse-link" data-name="{{$sidebar['name']}}">
                <i class="fa fa-chevron-{{$sidebar['collapsed'] ? 'down' : 'up'}}"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content" style="{{$sidebar['collapsed'] ? 'display:none;' : ''}}">
        <div class="description">
            <small>{{$sidebar['description']}}</small>
        </div>
        <div class="widgets widgets-sidebar" data-name="{{$sidebar['name']}}">
            @foreach($sidebar['widgets'] as $widget)
                {!! $widget->present()->forBackend($route_prefix) !!}
            @endforeach
        </div>
    </div>
</div>