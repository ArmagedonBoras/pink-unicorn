<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Fortnox\Fortnox;
use App\Http\Controllers\Controller;
use App\Models\Fortnox\FortnoxArticle;

class SettingsController extends Controller
{
    public function edit()
    {
        $fn = new Fortnox();
        $this->authorize('settings-update');
        return view('settings', [
            'settings' => settings(),
            'fortnoxURL' => $fn->generateAuthURL(now()->timestamp),
            'articles' => FortnoxArticle::get(),
            'menus' => Menu::get()->pluck('full_link', 'full_link'),
        ]);
    }

    public function update(Request $request)
    {
        $this->authorize('settings-update');
        $settings = settings();
        foreach ($request->all() as $key => $value) {
            if (Str::startsWith($key, '_')) {
                continue;
            }
            $settings->$key = $value;
        }

        return $this->edit()->with('alert-message', 'Inställningarna är sparade.')->with('alert-type', 'success');
    }
}
