<?php namespace Datlv\Layout;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * Class Facade
 *
 * @package Datlv\Layout
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'layout';
    }
}
