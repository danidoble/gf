<?php

use Danidoble\Translation\Translation as tr;
use Danidoble\GF\Dd as ddx;

if (!function_exists('env') && !defined('bypass_env')) {
    /**
     * @param $index
     * @param null $default
     * @return mixed|null
     */
    function env($index, $default = null)
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
        $_date = explode("-", $date, 3);
        $year = $_date[0];
        $month = (string)(int)$_date[1];
        $day = (string)(int)$_date[2];

        $days = array(tr::__("sunday"), tr::__("monday"), tr::__("tuesday"), tr::__("wednesday"), tr::__("thursday"), tr::__("friday"), tr::__("saturday"));
        $months = array("", tr::__("January"), tr::__("February"), tr::__("March"), tr::__("April"), tr::__("May"), tr::__("June"), tr::__("July"), tr::__("August"), tr::__("September"), tr::__("October"), tr::__("November"), tr::__("December"));
        $name_day = $days[intval((date("w", mktime(0, 0, 0, $month, $day, $year))))];

        return $name_day . ", " . $day . " " . tr::__('of') . " " . $months[$month] . " " . tr::__('of') . " " . $year;
    }
}

if (!function_exists('diffForHumansMonth')) {
    /**
     * @param $date
     * @return string
     */
    function diffForHumansMonth($date): string
    {
        $date_ = explode("-", $date, 3);
        $month = (string)(int)$date_[1];
        $months = array("", tr::__("January"), tr::__("February"), tr::__("March"), tr::__("April"), tr::__("May"), tr::__("June"), tr::__("July"), tr::__("August"), tr::__("September"), tr::__("October"), tr::__("November"), tr::__("December"));
        return $months[$month];
    }
}

if (!function_exists('diffForHumansComplete')) {
    /**
     * @param $date
     * @return string
     */
    function diffForHumansComplete($date): string
    {
        return ddx::diffForHumans($date) . ' ' . tr::__('at') . ' ' . date('H:i', strtotime($date));
    }
}

if (!function_exists('randStr')) {
    /**
     * @param int $length
     * @return string
     */
    function randStr(int $length = 60): string
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
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
        $time = [];
        if ($date === null) {
            $date = date('Y-m-d H:i:s');
        }
        // sum or rest dates, only days. modify if you want month, year, etc.
        if ($sum === true || $res === true) {
            $symbol = '+';
            if ($res) {
                $symbol = '-';
            }
            $dateOpe = strtotime($symbol . $num . ' day', strtotime($date));
            $date = date('Y-m-d H:i:s', $dateOpe);
        }
        $str = strtotime($date);
        $time["UTC"] = date("Y-m-d\TH:i:s.vP", $str);
        $time["UTCv2"] = date("Y-m-d\TH:i:s.vO", $str);
        $time["mysql"] = date("Y-m-d H:i:s", $str);
        $time["slashes"] = date("d/m/Y", $str);//'26/06/2020'
        $time["formatted"] = ddx::diffForHumans(date("Y-m-d H:i:s", $str));
        $time["formatted_complete"] = ddx::diffForHumansComplete(date("Y-m-d H:i:s", $str));
        $time["custom"] = (object)[
            "date" => date("Y-m-d", $str),
            "year" => date("Y", $str),
            "time" => date("H:i:s", $str),
            "month" => ddx::diffForHumansMonth(date("Y-m-d H:i:s", $str)),
        ];

        return (object)$time;
    }
}