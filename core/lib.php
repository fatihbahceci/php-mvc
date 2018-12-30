<?
class str
{
    public static function isNullOrEmpty($str)
    {
        return (!isset($str) || empty($str) || trim($str) === '');
    }

    public static function toUpper($str)
    {
        return mb_strtoupper($str, "UTF-8");
    }

}

class srv
{
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

class convert
{
    public static function toInt($val)
    {
        return intval($val, 10);
    }
}

class arrays
{
    public static function keyExists($array, $key)
    {
        return array_key_exists($key, $array);
    }

    public static function isNullOrEmpty(array $a)
    {
        return $a == null || count($a) <= 0;
    }
}

class tags
{
    public static function pre($s, $return = false)
    {
        if ($return) {
            return "<pre>" . print_r($s, true) . "</pre>";
        } else {
            echo ("<pre>" . print_r($s,true) . "</pre>");
        }
    }
}

class sys
{
    public static function microtimenormal()
    {
        return str_replace(".", "", microtime(true));
    }

    public static function microtimehigh()
    {
        $t = explode(" ", microtime(false));
        //0.21385600 1546067709
        return $t[1] . substr($t[0], 2);

    }
}
