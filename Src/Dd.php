<?php
/*
 * Created by danidoble 2021
 */

namespace Danidoble\GF;

use Danidoble\Translation\Translation as tr;

class Dd implements IDd
{
    /**
     * @param string $index
     * @param null $default
     * @return mixed|null
     */
    public static function env(string $index, $default = null): mixed
    {
        return $_ENV[$index] ?? $default;
    }

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumans($date): string
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

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumansMonth($date): string
    {
        $dia = explode("-", $date, 3);
        $month = (string)(int)$dia[1];
        $months = array("", tr::__("January"), tr::__("February"), tr::__("March"), tr::__("April"), tr::__("May"), tr::__("June"), tr::__("July"), tr::__("August"), tr::__("September"), tr::__("October"), tr::__("November"), tr::__("December"));

        return $months[$month];
    }

    /**
     * @param $date
     * @return string
     */
    public static function diffForHumansComplete($date): string
    {
        return self::diffForHumans($date) . ' ' . tr::__('at') . ' ' . date('H:i', strtotime($date));
    }

    /**
     * @param int $length
     * @param string $str
     * @return string
     */
    public static function randStr(int $length = 60, string $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        return substr(str_shuffle($str), 0, $length);
    }

    /**
     * @param null $date
     * @param false $sum
     * @param false $res
     * @param int $num
     * @return object
     */
    public static function dateFormats($date = null, bool $sum = false, bool $res = false, int $num = 0): object
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
        $time["formatted"] = self::diffForHumans(date("Y-m-d H:i:s", $str));
        $time["formatted_complete"] = self::diffForHumansComplete(date("Y-m-d H:i:s", $str));
        $time["custom"] = (object)[
            "date" => date("Y-m-d", $str),
            "year" => date("Y", $str),
            "time" => date("H:i:s", $str),
            "month" => self::diffForHumansMonth(date("Y-m-d H:i:s", $str)),
        ];

        return (object)$time;
    }

    /**
     * @param string $dir
     * @return array
     */
    public static function recursiveScanDir(string $dir): array
    {
        $dir = realpath(rtrim($dir, '/')) . '/';
        $aux = [];
        $arr = array_values(array_diff(scandir($dir), array('..', '.')));

        foreach ($arr as $val) {
            if (file_exists($dir . $val) && is_dir($dir . $val)) {
                $aux[$val] = self::recursiveScanDir(($dir . $val));
            } else if (file_exists($dir . $val)) {
                $aux[$val] = true;
            }
        }
        return $aux;
    }
}