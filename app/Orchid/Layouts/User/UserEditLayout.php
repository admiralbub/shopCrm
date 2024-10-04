<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.first_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('firstName_title'))
                ->placeholder(__('Name')),

            Input::make('user.last_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('lastName_title'))
                ->placeholder(__('Name')),

            Input::make('user.middle_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('MiddleName_title'))
                ->placeholder(__('Name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('user.phone')
                ->type('text')
                ->required()
                ->title(__('Phone_title'))
                ->mask('+38(999) 999-99-99')
                ->placeholder(__('Phone_title')),
        ];
    }
}
