<?php namespace Datlv\Layout\WidgetTypes;

/**
 * Class TextWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class TextWidget extends WidgetType {
    /**
     * @param \Datlv\Layout\Widget|string $widget
     *
     * @return string
     */
    public function titleBackend( $widget ) {
        $title = $widget->title ? $widget->title : mb_string_limit( $widget->data['content'], 20 );

        return parent::titleBackend( $title );
    }

    /**
     * @return string
     */
    protected function formView() {
        return 'layout::widgets.text_form';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        return $widget->data['content'];
    }

    protected function dataAttributes() {
        return [
            [ 'name' => 'content', 'title' => trans( 'layout::common.widgetTypes.text.content' ), 'rule' => 'required', 'default' => '' ],
        ];
    }


}