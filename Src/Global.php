<?php
/*
 * Created by danidoble 2021
 */

use Danidoble\GF\Dd as ddx;

if (!function_exists('env') && !defined('bypass_env')) {
    /**
     * @param $index
     * @param null $default
     * @return mixed|null
     */
    function env($index, $default = null): mixed
    {
        return $_ENV[$index] ?? $default;
    }
}

if (!function_exists('diffForHumans')) {
    /**
     * @param $date
     * @return string
     */
    function diffForHumans($date): string
    {
        return ddx::diffForHumans($date);
    }
}

if (!function_exists('diffForHumansMonth')) {
    /**
     * @param $date
     * @return string
     */
    function diffForHumansMonth($date): string
    {
        return ddx::diffForHumansMonth($date);
    }
}

if (!function_exists('diffForHumansComplete')) {
    /**
     * @param $date
     * @return string
     */
    function diffForHumansComplete($date): string
    {
        return ddx::diffForHumansComplete($date);
    }
}

if (!function_exists('randStr')) {
    /**
     * @param int $length
     * @return string
     */
    function randStr(int $length = 60, $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        return ddx::randStr($length, $str);
    }
}

if (!function_exists('dateFormats')) {
    /**
     * @param null $date
     * @param false $sum
     * @param false $res
     * @param int $num
     * @return object
     */
    function dateFormats($date = null, bool $sum = false, bool $res = false, int $num = 0): object
    {
        return ddx::dateFormats($date, $sum, $res, $num);
    }
}

if (!function_exists('dateFormats')) {
    /**
     * @param string $dir
     * @return array
     */
    function recursiveScanDir(string $dir): array
    {
        return ddx::recursiveScanDir($dir);
    }
}