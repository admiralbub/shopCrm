<?php
namespace App\Orchid\Fields;

use Orchid\Screen\Field;

class WarehouseNpRef extends Field
{
    /**
     * Blade template
     * 
     * @var string
     */
    protected $view = 'admin.field.warehouse_np_ref';

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