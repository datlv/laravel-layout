<?php namespace Datlv\Layout;

use Datlv\Kit\Extensions\BackendController as BaseController;
use Illuminate\Http\Request;

/**
 * Class WidgetController
 *
 * @package Datlv\Layout
 */
class WidgetController extends BaseController
{
    /**
     * @param string $group
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($group)
    {
        abort_unless(layout()->sidebarGroup($group), 404, 'Sidebar Group Not Found!');
        $this->buildHeading([
            trans('common.manage'),
            layout()->sidebarGroup("{$group}.description"),
        ], 'fa-puzzle-piece', ['#' => trans('layout::widget.widget')]);
        $widget_types = layout()->widgetTypes()->all();
        $active_widgets = Widget::getAllActive();
        $inactive_widgets = Widget::inactive()->orderBy('position')->get();
        $sidebars = layout()->sidebars($group)->all();
        foreach ($sidebars as $name => &$sidebar) {
            $sidebar['widgets'] = empty($active_widgets[$name]) ? [] : $active_widgets[$name];
            $sidebar['collapsed'] = Sidebar::firstOrNew(['name' => $name])->collapsed;
        }

        return view('layout::index', compact('widget_types', 'inactive_widgets', 'sidebars'));
    }

    /**
     * @param \Datlv\Layout\WidgetRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WidgetRequest $request)
    {
        $widget = new Widget();
        $widget->fill($request->all());
        $widget->fillNextPosition();
        $widget->configured = 0;
        $widget->data = $widget->typeInstance()->dataDefault;
        $widget->save();

        return response()->json([
            'id' => $widget->id,
            'type' => 'success',
            'content' => trans('layout::widget.save_success'),
        ]);
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Widget $widget)
    {
        return ($widgetType = $widget->typeInstance()) ? $widgetType->form($widget, $this->route_prefix) : view('kit::backend.message', [
            'type' => 'error',
            'content' => trans('layout::widget.type_unregistered'),
        ]);
    }

    /**
     * @param \Datlv\Layout\WidgetDataRequest $request
     * @param \Datlv\Layout\Widget $widget
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(WidgetDataRequest $request, Widget $widget)
    {
        $widget->fill($request->all());
        $widget->updateData($request);
        $widget->configured = 1;
        $widget->save();

        return view('kit::_modal_script', [
            'message' => ['type' => 'success', 'content' => trans('layout::widget.update_success')],
            'reloadPage' => true,
        ]);
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Widget $widget)
    {
        $widget->delete();

        return response()->json([
            'type' => 'success',
            'content' => trans('common.delete_object_success', ['name' => trans('layout::widget.widget')]),
        ]);
    }

    /**
     * Cập nhật các widgets của các sidebar
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync(Request $request)
    {
        $this->doSync($request->get('sidebar1'), $request->get('widgets1'));
        $this->doSync($request->get('sidebar2'), $request->get('widgets2'));

        return response()->json(['type' => 'success', 'content' => trans('layout::widget.sync_success')]);
    }

    /**
     * @param string $sidebar
     * @param string $widgets
     */
    protected function doSync($sidebar, $widgets)
    {
        if ($sidebar && $widgets) {
            foreach (explode(',', $widgets) as $i => $id) {
                Widget::where('id', $id)->update(['sidebar' => $sidebar, 'position' => $i + 1]);
            }
        }
    }
}