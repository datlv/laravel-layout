<?php namespace Datlv\Layout;

use Laracasts\Presenter\PresentableTrait;
use Datlv\Kit\Extensions\Model;

/**
 * Class WidgetModel
 *
 * @package Datlv\Layout
 * @property int $id
 * @property string|null $title
 * @property string|null $subtitle
 * @property string $type
 * @property string $sidebar
 * @property int $position
 * @property array $data
 * @property string|null $css
 * @property int $configured
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget active()
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model except($ids = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model findText($column, $text)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model whereAttributes($attributes)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereConfigured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereSidebar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Widget whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Widget extends Model
{
    use PresentableTrait;

    protected $table = 'widgets';

    protected $fillable = ['title', 'subtitle', 'type', 'sidebar', 'css'];

    protected $presenter = WidgetPresenter::class;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['data' => 'array'];

    /**
     * @return array
     */
    public static function getAllActive()
    {
        return self::active()->orderBy('position')->get()->groupBy('sidebar')->all();
    }

    /**
     * Getter $widget->data
     * - Thứ tự ưu tiên thuộc tính: fixed > db > default
     *
     * @param string $value
     *
     * @return array
     */
    public function getDataAttribute($value)
    {
        $typeInstance = $this->typeInstance();

        return $typeInstance->dataFixed() + (array) json_decode($value, true) + $typeInstance->dataDefault;
    }

    /**
     * @return \Datlv\Layout\WidgetTypes\WidgetType
     */
    public function typeInstance()
    {
        return layout()->widgetType($this->type);
    }

    /**
     * @param \Datlv\Layout\WidgetDataRequest $request
     */
    public function updateData(WidgetDataRequest $request)
    {
        $typeInstance = $this->typeInstance();
        $default = $typeInstance->dataDefault;
        $data = [];
        foreach (array_keys($typeInstance->dataAttributes) as $attr) {
            $data[$attr] = $request->get($attr, $default[$attr]);
        }
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->typeInstance()->render($this);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('sidebar', 'inactive');
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('sidebar', '<>', 'inactive');
    }

    public function fillNextPosition()
    {
        $latest = static::where('sidebar', $this->sidebar)->orderBy('position', 'desc')->first();
        $this->position = $latest ? ($latest->position + 1) : 1;
    }
}