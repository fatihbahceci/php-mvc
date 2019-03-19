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

    public static function postData(){
        return $_POST;
    }

    public static function postValue($name) {
        return static::postData()[$name];
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

    public static function isNullOrEmpty(array $a = null)
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
            echo ("<pre>" . print_r($s, true) . "</pre>");
        }
    }

    public static function h($s, $level = 1, $return = false)
    {
        if ($return) {
            return "<h$level>" . print_r($s, true) . "</h$level>";
        } else {
            echo ("<h$level>" . print_r($s, true) . "</h$level>");
        }
    }

    public static function raw($s, $return = false)
    {
        if ($return) {
            return print_r($s, true);
        } else {
            echo (print_r($s, true));
        }
    }

    //TODO: Daha sonra "" gibi işaretler için önlem alınıp alınmayucağına bakılacak
    /**
     * input için value üretir
     */
    public static function inputValue($s , $return = false) {
        if ($return) {
            return print_r($s, true);
        } else {
            echo (print_r($s, true));
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

    public static function isFolderExists($path)
    {
        return file_exists($path) && is_dir($path);
    }
}


class session
{
    //10 DK
    //public static $TIMEOUT = 10 * 60;
    private static function checkTimeout()
    {
        if (defined('_session_timeout')) {
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > _session_timeout)) {
                // last request was more than [_session_timeout] seconds ago
                session_unset(); // unset $_SESSION variable for the run-time
                session_destroy(); // destroy session data in storage
            }
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        }

        //You can also use an additional time stamp to regenerate the session ID periodically to avoid attacks on sessions like session fixation:
        /*
    if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true); // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time(); // update creation time
    }
     */
    }
    public static function get(string $key)
    {
        static::checkTimeout();
        session_start();
        return $_SESSION[$key];
    }

    public static function getAndDelete(String $key) {
        static::checkTimeout();
        $r = static::get($key);
        static::set($key,null);
        return $r;
    }

    public static function set(string $key, $value)
    {
        static::checkTimeout();
        session_start();
        $_SESSION[$key] = $value;
    }
}
 