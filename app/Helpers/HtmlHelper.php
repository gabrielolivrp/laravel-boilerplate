<?php

if (! function_exists('activeClass')) {

    /**
     * @param bool $condition
     * @param string $activeClass
     * @param string $inactiveClass
     * @return string
     */
    function activeClass(bool $condition, string $activeClass = 'active', string $inactiveClass = ''): string
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}
