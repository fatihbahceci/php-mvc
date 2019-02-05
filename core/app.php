<?php

require_once __DIR__."/controller.php";
//require_once __DIR__."/view.php";
require_once __DIR__."/lib.php";

interface iapp_event_handler
{
    public function on_app_created($app);
    public function render_header();
    public function render_footer();

    
}

class app
{
    //TODO: ileride area özelliği eklenebilir.
    public $controller, $action, $params;
    private $handler;

    public function __construct(iapp_event_handler $handler = null)
    {
        $get = $_GET;
        $url = "home/index";
        //mod_rewirte yapıldığında url/x/y/z şeklindeki değerler q ya gelir.
        //yani ?q=/x/y/z olur yapılmasa da biz yapalım
        if (isset($get["q"])) {
            if (!empty($get["q"])) {
                $url = trim($get["q"], "/");
            }
            //Değerleri aldıktan sonra buradan sil.
            unset($get["q"]);
        }
        $url = explode("/", $url);
        $this->controller = !str::isNullOrEmpty($url[0]) ? $url[0] : 'home';
        $this->action = !str::isNullOrEmpty($url[1]) ? $url[1] : 'index';
        //ilk iki parametreyi yoket
        array_shift($url);
        array_shift($url);
        //şimdi kalanı parametreye ekle;
        $this->params = array_merge($url, $get);
        if ($handler != null) {
            $this->handler = $handler;
            $handler->on_app_created($this);
        }
    }
    public function run()
    {
        // Eğer Controller dosyası varsa $file değişkenini yol olarak belirle
        if (file_exists($file = _controllers . "/{$this->controller}Controller.php")) {
            // Dosyayı sistemimize dahil edelim
            require_once $file;
            $controllerName = $this->controller . "Controller";
            if (class_exists($controllerName)) {

                $controller = new $controllerName;
                $controller->setHandler($this->handler);
                if (method_exists($controller, $this->action)) {
                    // controller ve metodu çağırıyoruz
                    //call_user_func_array her bir elemanı bir parametre olarak gönder
                    //call_user_func: tüm elemanları tek bir complex olarak gönder
                    //call_user_func_array([$controller, $this->action], $this->params);
                    call_user_func([$controller, $this->action], $this->params);
                } else {
                    exit("Method not found: {$this->action}");
                }
            } else {
                exit("Class not found: $this->controller");
            }
        } else {
            exit("Controller file not found: {$this->controller}.php");
        }
    }

}

/*
print_r($_GET);
http://www.kelle.com/a/b/c/d
Array ( [q] => /a/b/c/d )
http://www.kelle.com/index.php?/a/b/c/d
Array ( [/a/b/c/d] => )
http://www.kelle.com/index.php?url=/a/b/c/d
Array ( [url] => /a/b/c/d )
http://www.kelle.com/index.php?url=/a/b/c/d&kelle=pa%C3%A7a
Array ( [url] => /a/b/c/d [kelle] => paça )
http://www.kelle.com/a/b/c/d?kelle=pa%C3%A7a
Array ( [q] => /a/b/c/d [kelle] => paça )
http://www.kelle.com/a/b/c/d/?kelle=pa%C3%A7a
Array ( [q] => /a/b/c/d/ [kelle] => paça )
mod rewrite açık ya da kapalı olsa da vaziyet yukarıdaki gibidir. Tabi modrwerite kapalı ise /... olanlar öalışmaz :)
http://www.kelle.com/?url=/a/b/c/d&kelle=pa%C3%A7a
Array ( [url] => /a/b/c/d [kelle] => paça )
 */

