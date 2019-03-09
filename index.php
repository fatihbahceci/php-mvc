<?php
//Deploy ederken bu ayarları kaldır
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//Notice hariç tüm uyarıları göster
error_reporting(E_ALL ^ E_NOTICE);

//System
define('_root', __DIR__); // Root
define('_core', _root . '/core'); // Çekirdek dizini
//Eğer model, view, ve controller klasörleri başka yerde tutulursa
// _app değişkenini ona göre ayarlamak için
define('_app', _root);
define('_controllers', _app . '/controllers'); // Controller dizini
define('_views', _app . '/views'); // Views dizini
define('_models', _app . '/models'); //Models dizini

//10 minutes
define('_session_timeout', 600);

//database
define('_db_connection_string', 'mysql:host=localhost;dbname=YOUR_DATABASE_NAME;charset=utf8');
define('_db_user_name', 'USER_NAME');
define('_db_password', 'PASSWORD');


require_once _core . "/app.php";

class handler_test implements iapp_event_handler
{
    public function on_app_created($app)
    {
        //Eğer standardın dışında bir route yapmak istiyorsan burayuı kullanabilirsin
        //Örnek:
        /*
       if (!in_array($app->controller, ["home", "admin"])) {
        $app->params = $app->controller;
        $app->controller = "home";
        $app->action = "get";
       }
       */
        
    }
    public function render_header()
    {
        $app_name = "MVC App";
        require_once _views."/_layout/header.php";
    }
    public function render_footer()
    {
        $app_name = "MVC App";
        require_once  _views."/_layout/footer.php";

    }

}

$app = new app(new handler_test());
$app->run();

