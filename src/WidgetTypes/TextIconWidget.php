<?php namespace Datlv\Layout\WidgetTypes;

/**
 * Class TextIconWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class TextIconWidget extends WidgetType {
    /**
     * @return array
     */
    public function formOptions() {
        return [ 'width' => null ] + parent::formOptions();
    }

    /**
     * @return string
     */
    protected function formView() {
        return 'layout::widgets.text_icon_form';
    }

    protected function title( $widget ) {
        return '';
    }


    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        $title = $widget->title ? "<div class='widget-title'>{$widget->title}</div>" : '';

        return <<<"HTML"
<div class="widget-icon"><i class="fa {$widget->data['icon']}"></i></div>
$title
<div class="widget-text">{$widget->data['text']}</div>
HTML;
    }

    protected function dataAttributes() {
        return [
            [ 'name' => 'icon', 'title' => trans( 'layout::common.widgetTypes.text_icon.icon' ), 'rule' => 'required', 'default' => '' ],
            [ 'name' => 'text', 'title' => trans( 'layout::common.widgetTypes.text_icon.text' ), 'rule' => 'required', 'default' => '' ],
        ];
    }


}