<?php

use Carbon\Carbon;

if (! function_exists('setAllLocale')) {

    /**
     * @param $locale
     * @return void
     */
    function setAllLocale($locale): void
    {
        setAppLocale($locale);
        setPHPLocale($locale);
        setCarbonLocale($locale);
        setLocaleReadingDirection($locale);
    }
}

if (! function_exists('setAppLocale')) {

    /**
     * @param $locale
     * @return void
     */
    function setAppLocale($locale): void
    {
        app()->setLocale($locale);
    }
}

if (! function_exists('setPHPLocale')) {

    /**
     * @param $locale
     * @return void
     */
    function setPHPLocale($locale): void
    {
        setlocale(LC_TIME, $locale);
    }
}

if (! function_exists('setCarbonLocale')) {

    /**
     * @param $locale
     * @return void
     */
    function setCarbonLocale($locale): void
    {
        Carbon::setLocale($locale);
    }
}

if (! function_exists('setLocaleReadingDirection')) {

    /**
     * @param string $locale
     * @return void
     */
    function setLocaleReadingDirection(string $locale): void
    {
        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('boilerplate.locale.languages')[$locale]['rtl']) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }
    }
}

if (! function_exists('getLocaleName')) {

    /**
     * @param string $locale
     *
     * @return string
     */
    function getLocaleName(string $locale): string
    {
        return config('boilerplate.locale.languages')[$locale]['name'];
    }
}
