<?php namespace Datlv\Layout\WidgetTypes;

use Datlv\Kit\Support\HasRouteAttribute;
use Route;

/**
 * Class SearchWidget
 *
 * @package Datlv\Layout\WidgetTypes
 */
class SearchWidget extends WidgetType
{
    use HasRouteAttribute;

    /**
     * Ẩn widget khi xem trang kết quả tìm kiếm
     *
     * @param \Datlv\Layout\Widget $widget
     *
     * @return bool
     */
    protected function visible($widget)
    {
        return ! Route::currentRouteNamed($widget->data['route_result']) && parent::visible($widget);
    }

    /**
     * @return array
     */
    public function formOptions()
    {
        return ['width' => null] + parent::formOptions();
    }

    /**
     * @return string
     */
    protected function formView()
    {
        return 'layout::widgets.search_form';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function content($widget)
    {
        $url = $this->getRouteUrl($widget->data['route_result']);

        return view('layout::widgets.search_output', compact('widget', 'url'))->render();
    }

    protected function dataAttributes()
    {
        return [
            [
                'name' => 'route_result',
                'title' => trans('layout::common.widgetTypes.search.route_result'),
                'rule' => 'required',
                'default' => '#',
            ],
        ];
    }
}