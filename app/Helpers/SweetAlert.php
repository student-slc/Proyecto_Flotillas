<?php

namespace App\Helpers;

class SweetAlert
{

    private function SweetAlert(string $text, string $title, string $icon)
    {
        return 
        [
            'SweetAlert' => 
            [
                'icon' => "{$icon}",
                'title' => "{$title}",
                'text' => "{$text}"

            ]
            ];
    }
    public static function success(String $text)
    {
        return (new Self)->SweetAlert($text, 'Correcto', 'success');
    }

    public static function info(String $text)
    {
        return (new Self)->SweetAlert($text, 'Atención', 'info');
    }

    public static function warning(String $text)
    {
        return (new Self)->SweetAlert($text, 'Atención', 'warning');
    }

    public static function error(String $text)
    {
        return (new Self)->SweetAlert($text, 'Error', 'error');
    }
}