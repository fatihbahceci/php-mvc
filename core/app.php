<?php

require_once __DIR__ . "/controller.php";
//require_once __DIR__."/view.php";
require_once __DIR__ . "/lib.php";

interface iapp_event_handler
{
    public function on_app_created($app);
    public function render_header();
    public function render_footer();
}

class app
{
    public $area, $controller, $action, $params;
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

        $endoffolders = false;
        $areaPath = "";
        $checkpath = _controllers;
        /**   AREA CHECK   */
        while (!$endoffolders && (count($url)) > 0) {
            $checkpath .= "/" . $url[0];
            if (sys::isFolderExists($checkpath)) {
                $areaPath .= "/" . $url[0];
                array_shift($url); //ilk elemanı uçur
            } else {
                $endoffolders = true;
            }
        }
        if (!str::isNullOrEmpty($areaPath)) {
            $this->area = $areaPath;
        }
        /** EOF AREA CHECK */
        $this->controller = "home";
        $this->action = "index";
        if (!str::isNullOrEmpty($url[0])) {
            $this->controller = $url[0];
            array_shift($url); //ilk elemanı uçur
        }
        if (!str::isNullOrEmpty($url[0])) {
            $this->action = $url[0];
            array_shift($url); //ilk elemanı uçur
        }
        //şimdi kalanı parametreye ekle;
        $this->params = array_merge($url, $get);
        if ($handler != null) {
            $this->handler = $handler;
            $handler->on_app_created($this);
        }
    }
    public function run()
    {
        $controllerpath = _controllers;
        //Eğer area boş ise veya dolu ve klasör mevcut ise 
        if (
            str::isNullOrEmpty($this->area) ||
            !str::isNullOrEmpty($this->area) && sys::isFolderExists($controllerpath .= "/$this->area")
        ) {
            // Eğer Controller dosyası varsa $file değişkenini yol olarak belirle
            if (file_exists($file = $controllerpath . "/{$this->controller}Controller.php")) {
                // Dosyayı sistemimize dahil edelim
                require_once $file;
                $controllerName = $this->controller . "Controller";
                if (class_exists($controllerName)) {
                    $controller = new $controllerName;
                    if (method_exists($controller, $this->action)) {
                        $controller->setHandler($this->handler);
                        $controller->init($this->area, $this->controller, $this->action);
                        // controller ve metodu çağırıyoruz
                        //call_user_func_array her bir elemanı bir parametre olarak gönder
                        //call_user_func: tüm elemanları tek bir complex olarak gönder
                        //call_user_func_array([$controller, $this->action], $this->params);
                        call_user_func([$controller, $this->action], $this->params);
                    } else {
                        exit("Method not found: {$this->action}");
                    }
                } else {
                    exit("Class not found: {$this->controller}");
                }
            } else { }
        } else {
            exit("Area not found: {$this->area}.php");
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
