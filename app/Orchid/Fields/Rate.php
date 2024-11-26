<?php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class Rate extends Field
{
    /**
     * Blade template
     * 
     * @var string
     */
    protected $view = 'admin.field.rate';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'count'=>5,
        'step'=>1,
        'readonly'=>false
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'name',
        'title',
        'haveRated'
    ];
}

?>