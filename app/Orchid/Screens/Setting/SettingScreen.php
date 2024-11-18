<?php

namespace App\Orchid\Screens\Setting;

use Orchid\Screen\Screen;
use App\Models\Setting;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use App\Orchid\Setting\SettingLayout;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
class SettingScreen extends Screen
{

    public function query(): array
    {
        return [
            'settings' => Setting::get()
        ];
    }

    public function name(): ?string
    {
        return __('Setting');
    }


    public function commandBar(): iterable
    {
        return [
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate'),
        ];
    }

    public function layout(): iterable
    {
        
        return [
            Layout::view('admin.setting')
        ];
    }
    public function createOrUpdate(Request $request)
    {
        //$test = [];
        //dd($request->get('setting'));
        foreach ($request->get('setting') as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        $title_operation =  __("You have successfully completed the record changes."); 
        Toast::info($title_operation);
        return redirect()->route('platform.setting.list');

    }
}
