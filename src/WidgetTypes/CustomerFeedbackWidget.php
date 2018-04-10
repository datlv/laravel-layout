<?php namespace Datlv\Layout\WidgetTypes;

use Datlv\Image\Image;

/**
 * Class CustomerFeedbackWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class CustomerFeedbackWidget extends WidgetType {
    /**
     * @param \Datlv\Layout\Widget|string $widget
     *
     * @return string
     */
    public function titleBackend( $widget ) {
        return parent::titleBackend( $widget->data['name'] );
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    public function imageSrc( $widget ) {
        return ! empty( $widget->data['image_id'] ) && ( $image = Image::find( $widget->data['image_id'] ) ) ? $image->src : '/images/no-image.png';
    }

    /**
     * @return string
     */
    protected function formView() {
        return 'layout::widgets.customer_feedback_form';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content( $widget ) {
        return <<<"HTML"
<div class="feedback-content">{$widget->data['content']}</div>
<div class="customer-avatar">
    <div class="pull-left"><img src="{$this->imageSrc( $widget )}"/></div>
    <div class="media-body">
        <div class="customer-name">{$widget->data['name']}</div><span>{$widget->data['office']}</span>
    </div>
</div>
HTML;
    }

    /**
     * @return array
     */
    protected function dataAttributes() {
        return [
            [ 'name' => 'content', 'title' => trans( 'layout::common.widgetTypes.customer_feedback.content' ), 'rule' => 'required|max:255', 'default' => '' ],
            [
                'name'    => 'image_id',
                'title'   => trans( 'layout::common.widgetTypes.customer_feedback.image_id' ),
                'rule'    => 'required|integer',
                'default' => null,
            ],
            [ 'name' => 'name', 'title' => trans( 'layout::common.widgetTypes.customer_feedback.name' ), 'rule' => 'required|max:255', 'default' => '' ],
            [ 'name' => 'office', 'title' => trans( 'layout::common.widgetTypes.customer_feedback.office' ), 'rule' => 'required|max:255', 'default' => '' ],
        ];
    }
}