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
