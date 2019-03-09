<?
//TODO Örnek çalışma sonra değiştirilecek
class C
{
    const LOGIN_DATA = "afdthrtfhgsdf";
    public const DEFAULT_PASSWORD = "admin";
    public static function isLoggedIn()
    {
        return session::get(self::LOGIN_DATA) != null;
    }

    public static function login($password)
    {
        static::logOut();
        if (config::getPassword() == $password) {
            session::set(self::LOGIN_DATA, $password);
        }
        return static::isLoggedIn();
    }

    public static function logOut()
    {
        session::set(self::LOGIN_DATA, null);
    }

    /**
     * Eğer login değilse login sayfasına yönlendir. 
     */
    public static function checkLoggedIn()
    {
        if (!static::isLoggedIn()) {
            header("Location: /admin/login");
            die();
        }
    }
}
