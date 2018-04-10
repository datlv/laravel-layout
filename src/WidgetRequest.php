<?php namespace Datlv\Layout;

use Datlv\Kit\Extensions\Request;

/**
 * Class WidgetRequest
 *
 * @package Datlv\Layout
 */
class WidgetRequest extends Request {
    public $trans_prefix = 'layout::widget';
    public $rules = [
        'type'    => 'required|max:40',
        'sidebar' => 'required|max:40',
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
        $rules = $this->rules;
        $rules['type'] .= '|in:' . implode( ',', layout()->widgetTypes()->keys()->all() );
        $rules['sidebar'] .= '|in:' . implode( ',', layout()->sidebars()->keys()->all() );

        return $rules;
    }
}