<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
class LangueOrchidController extends Controller
{
    public function __invoke(string $lang): RedirectResponse
    {
        $languages = config('langue-orchid.languages');

        if (!array_key_exists($lang, $languages))
        {
            Toast::error(__('Localization not found'));

            return redirect()->back();
        }

        $key = auth()->guard(config('platform.guard'))->id() . '.locale';
        Cache::forever($key, $lang);
        app()->setLocale($lang);

        Toast::success(__('Localization changed'));

        return redirect()->back();
    }
}
