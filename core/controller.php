<?php
class controller
{
    /**
     * @var iapp_event_handler
     */
    private $handler = null;
    public function setHandler(iapp_event_handler $handler = null)
    {
        $this->handler = $handler;
    }
    /*
    Normalde bu templatei hazırlarken takip ettiğim site
    parametreyi extract() ile dönüştürüp gönderiyordu.
    ancak aşağıdaki linkteki uyarıdan dolayı bunu yapmadım
    http://php.net/manual/en/function.extract.php
    Warning
    Do not use extract() on untrusted data, like user input
    (i.e. $_GET, $_FILES, etc.).
    If you do, for example if you want to temporarily run old code
    that relied on register_globals, make sure you use one of
    the non-overwriting flags values such as EXTR_SKIP and be
    aware that you should extract in the same order that's defined
    in variables_order within the php.ini.
     */
    public function render($controller, $action, $model = null, controllerExt $extra = null)
    {

        /**
         * Eğer dosya varsa
         */
        if (file_exists($file = _views . "/{$controller}/{$action}.php")) {
            /**
             * $params dizesindeki verileri extract fonksiyonu
             * ile değişken haline döndürüyoruz
             */
            //extract($params); //Yukarıdaki açıklamadan dolayı yapmıyoruz.

            /**
             * Çıktı tamponlamasını başlatıyoruz
             */
            ob_start();
            if ($this->handler != null) {
                $this->handler->render_header();
            }

            /**
             * View dosyası içeriğini çağırıyoruz
             */
            require $file;
            if ($this->handler != null) {
                $this->handler->render_footer();
            }

            /**
             * Çıktı tamponun içeriğini döndürüp siliyoruz
             */
            echo ob_get_clean();
        } else {
            exit("View dosyası bulunamadı: /{$controller}/{$action}");
        }
    }

    /**
     * Yönlendirme yapar
     * @param string $path yol
     */
    public function redirect($path)
    {
        header("Location: {$path}");
        /*
        header("Location: $location?message=success");
        And
        if(!empty($_GET['message'])) {
        $message = $_GET['message'];
        // rest of your code
        You could also have a look into sessions

        session_start();
        $_SESSION['message'] = 'success';
        header("Location: $location");
        then in the destination script:

        session_start();
        if(!empty($_SESSION['messsage'])) {
        $message = $_SESSION['message'];
        // rest of your code
         */
        die();
    }

    public function title($title)
    {
        define("_page_title", $title);
    }
    /**
 * @param array buttons [["Text", "/link"],...]
 */
    public function buildErrorMessage($message, array $buttons, $title = "Hata!")
    {
        return
            [
                "type" => "error",
                "title" => $title,
                "message" => $message,
                "buttons" => $buttons,
            ];
        /*
[
"type" => "error",
"title" => "Geçersiz seçim",
"message" => "Hastane seçimi yapılnanış",
"buttons" => [
["Geri git", "/hastane/index"],
["Ana Sayfa", "/"],
],

]
 */
    }
}

class controllerExt
{
    public static function createInstance()
    {
        return new controllerExt;
    }
    public $errors;
    public $warnings;
    public $success;
    public function __construct()
    {
        $this->errors = array();
        $this->warnings = array();
        $this->success = array();
    }
    public function addError($l)
    {
        if (is_array($l)) {
            $this->errors = array_merge($this->errors, $l);
        } else {
            array_push($this->errors, $l);
        }
        // $this->addWarning($l);
        // $this->addSuccess($l);
        return $this;
    }
    public function addWarning($l)
    {
        if (is_array($l)) {
            $this->warnings = array_merge($this->warnings, $l);
        } else {
            array_push($this->warnings, $l);
        }
        return $this;
    }

    public function addSuccess($l)
    {
        if (is_array($l)) {
            $this->success = array_merge($this->success, $l);
        } else {
            array_push($this->success, $l);
        }
        return $this;
    }

    public static function renderBSAlert($m)
    {
        if ($m != null) {
            require_once _root.'/lib/bootstrap4/bsalert.php';
            foreach ($m->errors as $e) bsalert::error($e);
            foreach ($m->warnings as $e) bsalert::warning($e);
            foreach ($m->success as $e) bsalert::success($e);
        }
    }
}
