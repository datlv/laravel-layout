<?php
/** @var string $sidebar */
/** @var \Datlv\Layout\Sidebar $option */
/** @var \Datlv\Layout\Widget[] $widgets */
/** @var array $columns */
?>
@if($widgets)
    <section id="{{$sidebar}}" class="sidebar">
        {!! $option->before !!}
        @if($option->title)
            <div class="sidebar-title">{!! Html::twoPart($option->title, '', true, '|') !!}</div>
        @endif
        @if($option->subtitle)
            <div class="sidebar-subtitle">{!! $option->subtitle !!}</div>
        @endif
        @if($option->columns)
            <div class="sidebar-content row">
                <?php $j = 0;?>
                @foreach ( explode('|', $option->columns) as $column )
                    @if(isset($widgets[$j]))
                        <?php $col = explode( ':', $column . ":::" ); ?>
                        <div class="{{$col[0]}}">
                            @for($i = 0; $i<(int)$col[1] && isset($widgets[$j]); $i++, $j++)
                                {!! $widgets[$j]->render() !!}
                            @endfor
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="sidebar-content">
                @foreach ( $widgets as $widget )
                    {!! $widget->render() !!}
                @endforeach
            </div>
        @endif

        @if($option->footer)
            <div class="sidebar-footer">{!! $option->footer !!}</div>
        @endif
        {!! $option->after !!}
    </section>
@endif