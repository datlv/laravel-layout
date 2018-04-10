<?php namespace Datlv\Layout\WidgetTypes;

use Html;
use Validator;

/**
 * Class Widget
 *
 * @property-read string $name
 * @property-read string $title
 * @property-read string $description
 * @property-read string $icon
 * @property-read array $dataRules
 * @property-read array $dataAttributes
 * @property-read array $dataDefault
 *
 * @package Datlv\Layout\WidgetTypes
 */
abstract class WidgetType
{
    /**
     * @var array
     */
    protected $dataAttributes;

    /**
     * @var array
     */
    protected $dataDefault;

    /**
     * @var array
     */
    protected $dataRules;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * Widget Type constructor.
     *
     * @param string $name
     * @param string $title
     * @param string $description
     * @param string $icon
     */
    public function __construct($name, $title, $description, $icon)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;

        $except = array_keys($this->dataFixed());
        $attributes = collect($this->dataAttributes());
        $this->dataAttributes = $attributes->pluck('title', 'name')->except($except)->all();
        $this->dataRules = $attributes->pluck('rule', 'name')->except($except)->all();
        $this->dataDefault = $attributes->pluck('default', 'name')->except($except)->all();
    }

    public function __get($name)
    {
        return in_array($name, [
            'name',
            'title',
            'description',
            'icon',
            'dataRules',
            'dataAttributes',
            'dataDefault',
        ]) ? $this->$name : null;
    }

    /**
     * Các thuộc tính CỐ ĐỊNH giá trị, 'name' => 'value'
     *
     * @return array
     */
    public function dataFixed()
    {
        return [];
    }

    /**
     * Form chỉnh sữa widget trong backend
     *
     * @param \Datlv\Layout\Widget $widget
     * @param string $route_prefix
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form($widget, $route_prefix = '')
    {
        $url = route("{$route_prefix}backend.widget.update", ['widget' => $widget->id]);
        $data = (array) $widget->data + [
                'title' => $widget->title,
                'subtitle' => $widget->subtitle,
                'css' => $widget->css,
            ];
        $labels = $widget->typeInstance()->dataAttributes;

        return view($this->formView(), compact('widget', 'url', 'data', 'labels'));
    }

    /**
     * Tham số cho modal form
     *
     * @return array
     */
    public function formOptions()
    {
        return [];
    }

    /**
     * Render widget
     *
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    public function render($widget)
    {
        return $this->visible($widget) ?
            "{$this->before( $widget )}{$this->title( $widget )}{$this->subtitle( $widget )}<div class='widget-content'>{$this->content( $widget )}</div>{$this->after( $widget )}" :
            '';
    }

    /**
     * @param \Datlv\Layout\Widget|string $widget
     *
     * @return string
     */
    public function titleBackend($widget)
    {
        $title = is_string($widget) ? $widget : $widget->title;

        return $title ? ": <span class='text-navy'>{$title}</span>" : '';
    }

    /**
     * Kiểm tra dữ liệu nhập
     *
     * @param array $data
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function validate($data)
    {
        return Validator::make($data, $this->dataRules, [], $this->dataAttributes)->errors();
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     *
     */
    abstract protected function content($widget);

    /**
     * Định nghĩa các attributes của data, định dạng:
     * [
     *      ['name' => string, 'title' => string, 'rule' => string|array, 'default' => mixed],
     *      ...
     * ]
     *
     * @return array
     */
    abstract protected function dataAttributes();

    /**
     * Form View chỉnh sữa widget trong backend
     *
     * @return string
     */
    abstract protected function formView();

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function after($widget)
    {
        return "</div><!--End Widget {$widget->type}-{$widget->id} -->";
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function before($widget)
    {
        return "<!--Begin Widget--><div id=\"{$widget->type}-{$widget->id}\" class=\"widget widget-{$widget->type} {$widget->css}\">";
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function subtitle($widget)
    {
        return $widget->subtitle ? "<div class='widget-subtitle'>{$widget->subtitle}</div>" : '';
    }

    /**
     * @param \Datlv\Layout\Widget $widget
     *
     * @return string
     */
    protected function title($widget)
    {
        $title = is_string($widget) && $widget ? $widget : $widget->title;

        return $title ? "<div class='widget-title'>".Html::twoPart($title, null, false, '|')."</div>" : '';
    }

    /**
     * Widget có được render ở frontend
     *
     * @param \Datlv\Layout\Widget $widget
     *
     * @return bool
     */
    protected function visible($widget)
    {
        return $widget->configured > 0;
    }
}