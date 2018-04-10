<?php namespace Datlv\Layout\WidgetTypes;

/**
 * Class SocialButtonWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class SocialButtonWidget extends WidgetType {
    /**
     * @return array
     */
    public function socials() {
        return [ 'facebook', 'twitter', 'google', 'youtube' ];
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
        return 'layout::widgets.social_button_form';
    }

    /**
     * @param string $icon
     * @param string $url
     * @param string $type
     * @param string $size
     *
     * @return string
     */
    protected function btn( $icon, $url, $type, $size ) {
        return $url ? "<li><a href=\"{$url}\" class=\"btn {$type} {$size} social-icon\"><i class=\"fa fa-{$icon}\"></i></a></li>" : '';

    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        $content = '';
        foreach ( $this->socials() as $social ) {
            $content .= "{$this->btn( $social, $widget->data[$social], $widget->data['btn_type'], $widget->data['btn_size'] )}";
        }

        return $content ? "<ul class=\"list-inline\">{$content}</ul>": '';
    }

    /**
     * @return array
     */
    protected function dataAttributes() {
        $attributes = [
            [ 'name' => 'btn_type', 'title' => trans( 'layout::common.widgetTypes.social_button.btn_type' ), 'rule' => 'required', 'default' => 'btn-default' ],
            [ 'name' => 'btn_size', 'title' => trans( 'layout::common.widgetTypes.social_button.btn_size' ), 'rule' => 'max:255', 'default' => '' ],
        ];
        foreach ( $this->socials() as $social ) {
            $attributes[] = [
                'name'    => $social,
                'title'   => trans( "layout::common.widgetTypes.social_button.{$social}" ),
                'rule'    => 'max:255',
                'default' => '',
            ];
        }

        return $attributes;
    }
}