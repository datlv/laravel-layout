<?php namespace Datlv\Layout;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WidgetDataRequest
 *
 * @property-read \Datlv\Layout\Widget $widget
 * @package Datlv\Layout
 */
class WidgetDataRequest extends FormRequest {
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
        return $this->widget && ( $widgetType = $this->widget->typeInstance() ) ? $widgetType->dataRules : [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return $this->widget && ( $widgetType = $this->widget->typeInstance() ) ? $widgetType->dataAttributes : [];
    }
}