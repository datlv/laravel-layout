<?php namespace Datlv\Layout;

use Datlv\Kit\Extensions\Model;

/**
 * Class Sidebar
 *
 * @package Datlv\Layout
 * @property int $id
 * @property string $name
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $footer
 * @property string|null $before
 * @property string|null $after
 * @property string|null $columns
 * @property string|null $label
 * @property int $collapsed
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model except( $ids = null )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model findText( $columns, $text )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereAfter( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Kit\Extensions\Model whereAttributes( $attributes )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereBefore( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereFooter( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereSubtitle( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereTitle( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereColumns( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereLabel( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\Datlv\Layout\Sidebar whereCollapsed( $value )
 * @mixin \Eloquent
 */
class Sidebar extends Model {
    protected $table = 'sidebars';
    protected $fillable = [ 'name', 'title', 'subtitle', 'footer', 'before', 'after', 'columns', 'label'];
    public $timestamps = false;
}