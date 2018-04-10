<?php namespace Datlv\Layout\WidgetTypes;

use Datlv\Image\Image;

/**
 * Class ImageWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class ImageWidget extends WidgetType {
    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    public function imageSrc( $widget ) {
        return !empty($widget->data['image_id']) && ( $image = Image::find( $widget->data['image_id'] ) ) ? $image->src : '/images/no-image.png';
    }

    /**
     * @return string
     */
    protected function formView() {
        return 'layout::widgets.image_form';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        return "<img src='{$this->imageSrc($widget)}' class='img-responsive' />";
    }

    protected function dataAttributes() {
        return [
            [ 'name' => 'image_id', 'title' => trans( 'layout::common.widgetTypes.image.image_id' ), 'rule' => 'required|integer', 'default' => null ],
        ];
    }
}