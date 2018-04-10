@extends($layout)
@section('content')
    <div id="layout-editor" class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary panel-widgets">
                <div class="panel-heading">
                    <i class="fa fa-cubes"></i> {{trans('layout::common.widget_types')}}
                </div>
                <div class="panel-body">
                    <div class="widgets-description">
                        <small>{!! trans('layout::common.widget_types_description') !!}</small>
                    </div>
                    <div id="widget-types" class="row widgets widget-types">
                        @foreach($widget_types as $type)
                            <?php /** @var \Datlv\Layout\WidgetTypes\WidgetType $type */?>
                            <div class="item col-md-6" data-name="{{$type->name}}">
                                <div class="title"><i class="fa fa-{{$type->icon}}"></i> {{$type->title}}</div>
                                <div class="description">
                                    <small>{{$type->description}}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-widgets">
                <div class="panel-heading">
                    <i class="fa fa-cubes"></i> {{trans('layout::common.inactive_widgets')}}
                </div>
                <div class="panel-body">
                    <div class="widgets-description">
                        <small>{!! trans('layout::common.inactive_widgets_description') !!}</small>
                    </div>
                    <div id="inactive-widgets" class="widgets widgets-inactive" data-name="inactive">
                        @if(isset($inactive_widgets))
                            @foreach($inactive_widgets as $widget)
                                {!! $widget->present()->forBackend($route_prefix) !!}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6" id="sidebars">
            @each('layout::sidebar_builder', $sidebars, 'sidebar')
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () {
            var url_store = "{{route($route_prefix.'backend.widget.store')}}",
                url_sync = "{{route($route_prefix.'backend.widget.sync')}}";

            $.fn.mbHelpers.reloadPage = function () {
                document.location.reload(true);
            };

            $('#sidebars').find('.collapse-link').click(function () {
                var url = '{{route("{$route_prefix}backend.sidebar.collapse", ['sidebar' => '__SIDEBAR__'])}}';
                $.ajax(url.replace('__SIDEBAR__', $(this).data('name')));
            });

            $('#widget-types').find('.item').draggable({
                connectToSortable: '.ibox-sidebar .widgets',
                revert: 'invalid',
                helper: function () {
                    return $('<div class="item"></div>').append(
                        $(this).find('.title').clone()
                            .append(': <code>{{trans("layout::widget.not_config")}}<code>')
                            .append(
                                $('<div class="actions"></div>')
                                    .append('<a href="#" class="edit text-primary"><i class="fa fa-gear"></i></a>')
                                    .append('<a href="#" class="delete text-danger"><i class="fa fa-remove"></i></a>')
                            )
                    );
                },
                start: function (event, ui) {
                    ui.helper.animate({width: $('.ibox-sidebar .ibox-title').innerWidth()});
                },
                stop: function (event, ui) {
                    var item = $(ui.helper),
                    sidebar = item.parent().data('name');
                    if(sidebar) {
                        item.attr('style', '');
                        $.post(url_store, {type: $(this).data('name'), sidebar: sidebar, _token: window.Laravel.csrfToken}, function (data) {
                            $.fn.mbHelpers.showMessage(data.type, data.content);
                            $.fn.mbHelpers.reloadPage();
                        }, 'json');
                    }
                },
            });

            function getWidgets(sidebar) {
                return $.map(sidebar.find('.item'), function (item) {
                    return $(item).data('id');
                }).join(',');
            }

            function getSyncData(sidebar, i) {
                var data = {};
                if (sidebar) {
                    var newWidgets = getWidgets(sidebar);
                    if (newWidgets != sidebar.data('widgets')) {
                        data['sidebar' + i] = sidebar.data('name');
                        data['widgets' + i] = newWidgets;
                    }
                }
                return data;
            }

            function syncSidebar(sidebar1, sidebar2) {
                var syncData = $.extend({}, getSyncData(sidebar1, 1), getSyncData(sidebar2, 2));
                if (!$.isEmptyObject(syncData)) {
                    syncData['_token'] = window.Laravel.csrfToken;
                    $.post(url_sync, syncData, function (data) {
                        $.fn.mbHelpers.showMessage(data.type, data.content);
                        if (data.type == 'error') {
                            $.fn.mbHelpers.reloadPage();
                        }
                    }, 'json');
                }
            }

            $('.ibox-sidebar .widgets, #inactive-widgets').sortable({
                revert: true,
                connectWith: '.ibox-sidebar .widgets, #inactive-widgets',
                stop: function (event, ui) {
                    var sidebar1 = $(this),
                        sidebar2 = ui.item.parent();
                    syncSidebar(sidebar1, sidebar2.is(sidebar1) ? false : sidebar2);
                }
            });

            $('#layout-editor').on('click', 'a.delete', function (e) {
                e.preventDefault();
                var item = $(this).closest('.item'),
                    url = $(this).attr('href');
                window.bootbox.confirm({
                    message: '<div class="text-danger text-center"><strong>{!! trans('layout::common.delete_widget_confirm') !!}</strong></div>',
                    title: "{{trans('layout::common.delete_widget')}}",
                    buttons: {
                        cancel: {label: "{{trans('common.cancel')}}", className: "btn-default btn-white"},
                        confirm: {label: "{{trans('common.ok')}}", className: "btn-danger"}
                    },
                    callback: function (ok) {
                        if (ok) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                dataType: 'json',
                                data: {_token: window.Laravel.csrfToken},
                                success: function (message) {
                                    $.fn.mbHelpers.showMessage(message.type, message.content);
                                    item.remove();
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush