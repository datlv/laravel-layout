<?php namespace Datlv\Layout\WidgetTypes;

/**
 * Class ButtonWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class ButtonWidget extends WidgetType {
    /**
     * @param \Datlv\Layout\Widget|string $widget
     *
     * @return string
     */
    public function titleBackend( $widget ) {
        $title = $this->getBtnLabel( $widget );

        return parent::titleBackend( $title ?: $widget );
    }

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
        return 'layout::widgets.button_form';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function getBtnLabel( $widget ) {
        $icon = $widget->data['icon'] ? "<i class='fa {$widget->data['icon']}'></i>" : '';

        return trim( "{$icon} {$widget->data['label']}" );

    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        return "<a href=\"{$widget->data['url']}\" class=\"btn {$widget->data['btn_type']} {$widget->data['btn_size']}\">{$this->getBtnLabel($widget)}</a>";
    }

    /**
     * @return array
     */
    protected function dataAttributes() {
        return [
            [ 'name' => 'url', 'title' => trans( 'layout::common.widgetTypes.button.url' ), 'rule' => 'required', 'default' => '#' ],
            [ 'name' => 'icon', 'title' => trans( 'layout::common.widgetTypes.button.icon' ), 'rule' => 'max:255', 'default' => '' ],
            [ 'name' => 'label', 'title' => trans( 'layout::common.widgetTypes.button.label' ), 'rule' => 'max:255', 'default' => '' ],
            [ 'name' => 'btn_type', 'title' => trans( 'layout::common.widgetTypes.button.btn_type' ), 'rule' => 'required', 'default' => 'btn-default' ],
            [ 'name' => 'btn_size', 'title' => trans( 'layout::common.widgetTypes.button.btn_size' ), 'rule' => 'max:255', 'default' => '' ],
        ];
    }


}