<?php

if(!function_exists('returnOnlyNumbers')) {
    /**
     * @param string $value
     * @return string|string[]|null
     */
    function returnOnlyNumbers(string $value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
