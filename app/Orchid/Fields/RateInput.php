<?php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class RateInput extends Field
{
    /**
     * Blade template
     * 
     * @var string
     */
    protected $view = 'admin.field.rate_input';

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
        'title',
        'haveRated'
    ];
}

?>