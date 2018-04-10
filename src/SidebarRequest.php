<?php namespace Datlv\Layout;

use Datlv\Kit\Extensions\Request;

/**
 * Class SidebarRequest
 *
 * @package Datlv\Layout
 */
class SidebarRequest extends Request {
    public $trans_prefix = 'layout::sidebar';
    public $rules = [
        'title'    => 'max:255',
        'subtitle' => 'max:255',
        'footer'   => 'max:255',
        'before'   => 'max:255',
        'after'    => 'max:255',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return $this->rules;
    }
}