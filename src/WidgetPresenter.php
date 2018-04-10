<?php namespace Datlv\Layout;

use Laracasts\Presenter\Presenter;
use Html;

/**
 * Class WidgetPresenter
 *
 * @property-read \Datlv\Layout\Widget $entity
 * @package Datlv\Layout
 */
class WidgetPresenter extends Presenter {
    /**
     * @return string
     */
    public function forFrontend() {
        return $this->entity->configured && ( $widgetType = layout()->widgetType( $this->entity->type ) ) ?
            $widgetType->render( $this->entity ) : '';
    }

    /**
     * @return string
     */
    public function titleBackend() {
        $type = $this->entity->typeInstance();
        $title = '<i class="fa fa-' . $type->icon . '"></i> ' . $type->title;
        if ( $this->entity->configured ) {
            $title .= $type->titleBackend( $this->entity );
        } else {
            $title .= ': <code>' . trans( 'layout::widget.not_config' ) . '</code>';
        }

        return $title;
    }

    /**
     * @param string $route_prefix
     *
     * @return string
     */
    public function forBackend( $route_prefix = '' ) {
        $edit = Html::modalLink(
            route( "{$route_prefix}backend.widget.edit", [ 'widget' => $this->entity->id ] ),
            '<i class="fa fa-gear"></i>',
            $this->entity->typeInstance()->formOptions() + [
                'title' => trans( 'layout::widget.edit' ).': '.$this->entity->typeInstance()->title,
                'label' => trans( 'common.save' ),
                'icon'  => 'gear',
                'width' => 'large',
            ],
            [ 'class' => 'edit text-primary' ]
        );
        $delete = '<a href="' .
                  route( "{$route_prefix}backend.widget.destroy", [ 'widget' => $this->entity->id ] ) .
                  '" class="delete text-danger"><i class="fa fa-remove"></i></a>';

        return <<<"HTML"
<div class="item" data-id="{$this->entity->id}">
    <div class="title">
        {$this->titleBackend()}
        <div class="actions">{$edit}{$delete}</div>
    </div>
</div>
HTML;
    }
}