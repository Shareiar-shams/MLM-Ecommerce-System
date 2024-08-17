<?php

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = 'active')
    {
        return Route::currentRouteName() == $routeName ? $output : '';
    }
}

if (!function_exists('isActiveUrl')) {
    function isActiveUrl($url, $output = 'active')
    {
        return Request::url() == $url ? $output : '';
    }
}
