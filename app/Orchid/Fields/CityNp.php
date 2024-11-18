<?php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class CityNp extends Field
{
    /**
     * Blade template
     * 
     * @var string
     */
    protected $view = 'admin.field.city_np';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'name',
        'type',
        'placeholder',
        'value'
    ];
}

?>