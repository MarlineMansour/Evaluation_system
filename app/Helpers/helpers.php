<?php



if (!function_exists('toast')) {
    function toast($type, $message)
    {
        session()->flash($type, $message);
    }
}
