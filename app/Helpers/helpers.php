<?php

use App\Helpers\Settings;
use App\Models\Menu;

if (!function_exists("menu")) {
    function menu(string $menu = "")
    {
        return Menu::menu($menu);
    }
}

if (!function_exists("formatEmailLink")) {
    function formatEmailLink(?string $address): string
    {
        if ($address == "" || $address === null) {
            return "";
        }
        return '<a href="mailto:'.$address.'">'. $address.'</a>';
    }
}

if (!function_exists("icon")) {
    function icon($icon, $size = 16, $title = null, $class = null)
    {
        return view('components.icon', ['slot' => $icon, 'size' => $size, 'class' => $class, 'title' => $title]);
    }
}

if (!function_exists("menu_icon")) {
    function menu_icon($icon, $size = 16)
    {
        return icon($icon, $size, null, 'm-1');
    }
}

/**
 * Helper function for the Settings wrapper of the ValueStore object from Spatie
 *
 * @param   null|string $key      Optional key to read from Settings
 * @param   null|string $default  Optional default value if key is not present
 *
 * @return  mixed           Returns the stored value for key, or the default value
 *                          If no key is given, it returns the settings object
 */
if (!function_exists("settings")) {
    function settings($key = null, $default = null)
    {
        $path = storage_path('app/settings.json');
        if ($key === null) {
            return Settings::make($path);
        }

        return Settings::make($path)->get($key, $default);
    }
}

if (!function_exists("delete_button")) {
    function delete_button($route, $text, $button_class = "btn btn-danger")
    {
        return '<form method="POST" action="'.$route.'">'.csrf_field().method_field('DELETE').'<button type="submit" class="'.$button_class.'">'.$text.'</button></form>';
    }
}
