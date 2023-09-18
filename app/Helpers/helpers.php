<?php

use App\Helpers\Settings;
use App\Models\Menu;
use Illuminate\Support\Facades\Http;

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

if (!function_exists("swish_qr")) {
    function swish_qr(String $number, Int $amount, String $message, Bool $message_lock = true, Bool $amount_lock = true, String $format = "svg", Int $size = 300): String
    // Based on https://developer.swish.nu/api/qr-codes/v2
    {
        $data = [
           "message" => [
                "value" => $message,
                "editable" => !$message_lock,
           ],
           "amount" => [
                "value" => $amount,
                "editable" => !$amount_lock,

           ],
           "payee" => $number,
        ];

        if ($size < 300) {
            $size = 300;
        }

        switch (Str::upper($format)) {
            case "SVG":
                $data["format"] = "svg";
                $data["transparent"] = true;
                break;
            case "PNG":
                $data["format"] = "png";
                $data["size"] = $size;
                $data["transparent"] = true;
                break;
            case "JPG":
            default:
                $data["format"] = "jpg";
                $data["size"] = $size;
        }
        return Http::post("https://api.swish.nu/qr/v2/prefilled", $data)->body();
    }
}

if (!function_exists(("swish_img_src"))) {
    function swish_img_src(String $number, Int $amount, String $message, Bool $message_lock = true, Bool $amount_lock = true, Int $size = 300): String
    {
        return 'data:image/png;base64,' . base64_encode(swish_qr($number, $amount, $message, $message_lock, $amount_lock, "png", $size));
    }
}
