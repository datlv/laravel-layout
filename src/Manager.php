<?php namespace Datlv\Layout;

use Illuminate\Support\Collection;

/**
 * Class Manager
 *
 * @package Datlv\Layout
 */
class Manager
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $widgetTypes;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $sidebars;

    protected $sidebarGroup = [];

    public function __construct()
    {
        $this->widgetTypes = new Collection();
        $this->sidebars = new Collection();
    }

    /**
     * @param string|array $group
     * @return string
     */
    public function sidebarGroup($group = null)
    {
        if (! $group) {
            return $this->sidebarGroup;
        }
        if (is_array($group)) {
            foreach ($group as $name => $info) {
                $this->sidebarGroup[$name] = [];
                foreach ($info as $key => $value) {
                    $this->sidebarGroup[$name][$key] = mb_fn_str($value);
                }
            }
        } else {
            return array_get($this->sidebarGroup, $group);
        }
    }

    /**
     * Đăng ký một Sidebar
     *
     * @param $name
     * @param $title
     * @param $description
     * @param string $group
     * @param int $priority
     */
    public function registerSidebar($name, $title, $description, $group, $priority = 0)
    {
        $priority = $priority ?: $this->sidebars->count() + 1;
        $this->sidebars->put($name, [
            'name' => $name,
            'title' => mb_fn_str($title),
            'description' => mb_fn_str($description),
            'group' => $group,
            'priority' => $priority,
        ]);
    }

    /**
     * @param array $sidebars
     */
    public function registerSidebars($sidebars)
    {
        foreach ($sidebars as $name => $sidebar) {
            $this->registerSidebar($name, $sidebar['title'], $sidebar['description'], $sidebar['group']);
        }
    }

    /**
     * @param string $group
     *
     * @return \Illuminate\Support\Collection
     */
    public function sidebars($group = null)
    {
        $sidebars = $group ? $this->sidebars->filter(function ($sidebar) use ($group) {
            return $sidebar['group'] == $group;
        }) : $this->sidebars;

        return $sidebars->sortBy('priority');
    }

    /**
     * Lấy các active sidebars có label, ['name' => 'label',...]
     *
     * @param string $group
     *
     * @return array
     */
    public function activeSidebarLabels($group = null)
    {
        $labels = [];
        if ($actived = array_keys(Widget::getAllActive())) {
            $hasLabel = Sidebar::whereNotNull('label')->whereIn('name', $actived)->pluck('label', 'name')->all();
            foreach ($this->sidebars($group)->keys() as $name) {
                if (isset($hasLabel[$name])) {
                    $labels[$name] = $hasLabel[$name];
                }
            }
        }

        return $labels;
    }

    /**
     * Đăng ký một Widget Type
     *
     * @param string $name
     * @param string $title
     * @param string $description
     * @param string $icon
     * @param string $class
     */
    public function registerWidgetType($name, $title, $description, $icon, $class)
    {
        $this->widgetTypes->put($name, new $class($name, mb_fn_str($title), mb_fn_str($description), $icon));
    }

    /**
     * @param array $widgetTypes
     * @param array $disabled
     */
    public function registerWidgetTypes($widgetTypes, $disabled = [])
    {
        foreach ($widgetTypes as $name => $widgetType) {
            if (! in_array($name, $disabled)) {
                $this->registerWidgetType($name, $widgetType['title'], $widgetType['description'], $widgetType['icon'], $widgetType['class']);
            }
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function widgetTypes()
    {
        return $this->widgetTypes;
    }

    /**
     * @param string $name
     * @param string $attribute
     *
     * @return string|\Datlv\Layout\WidgetTypes\WidgetType
     */
    public function widgetType($name, $attribute = null)
    {
        $widgetType = $this->widgetTypes->get($name);

        return $attribute ? ($widgetType ? $widgetType->$attribute : null) : $widgetType;
    }

    /**
     * Render $sidebar
     *
     * @param string $sidebar
     *
     * @return string
     */
    public function renderSidebar($sidebar)
    {
        $option = Sidebar::firstOrNew(['name' => $sidebar]);
        $widgets = Widget::whereSidebar($sidebar)->orderBy('position')->get()->all();

        return view('layout::sidebar_output', compact('sidebar', 'option', 'widgets'))->render();
    }

    /**
     * Render group of sidebars
     *
     * @param string $group
     *
     * @return string
     */
    public function renderSidebarGroup($group)
    {
        return $this->sidebars($group)->keys()->map(function ($name) {
            return $this->renderSidebar($name);
        })->implode('');
    }
}