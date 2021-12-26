<?php

namespace App\Helper;

use App\Models\SiteSetting;

class SettingHelper
{
    public static function loadOptions()
    {
        $data = [];
        $options = SiteSetting::get();
        foreach ($options as $option) {
            $data[$option->key] = $option->value;
        }
        session(['site_settings' => $data]);
    }

    public static function setting($key)
    {
        $option = [];
        $data = '';
        if (session()->exists('site_settings')) {
            $option = session()->get('site_settings');
        }
        if (array_key_exists($key, $option)) {
            $data = $option[$key];
        }
        return $data;
    }
}
