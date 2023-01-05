<?php
/*
 * Created by danidoble 2023
 */

namespace Danidoble\GF;

interface IDd
{
    /**
     * @param string $index
     * @param $default
     * @return mixed
     */
    public static function env(string $index, $default = null): mixed;

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumans($date): string;

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumansMonth($date): string;

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumansComplete($date): string;

    /**
     * @param int $length
     * @param string $str
     * @return string
     */
    public static function randStr(int $length, string $str): string;

    /**
     * @param $date
     * @param bool $sum
     * @param bool $res
     * @param int $num
     * @return object
     */
    public static function dateFormats($date = null, bool $sum = false, bool $res = false, int $num = 0): object;

    /**
     * @param string $dir
     * @return array
     */
    public static function recursiveScanDir(string $dir): array;
}