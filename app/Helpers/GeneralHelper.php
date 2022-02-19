<?php

use Carbon\Carbon;

if (! function_exists('appName')) {

    /**
     * @return string
     */
    function appName(): string
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('homeRoute')) {

    /**
     * @return string
     */
    function homeRoute(): string
    {
        if (auth()->check()) {
            if (auth()->user()->can('access admin')) {
                return '/a/dashboard';
            }

            return '/u/home';
        }

        return '/';
    }
}

if (! function_exists('carbon')) {

    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     * @return Carbon
     * @throws Exception
     */
    function carbon($time): Carbon
    {
        return new Carbon($time);
    }
}
