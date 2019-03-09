<? 
class bsalert {
    //success, danger, warning
    public static function alert($msg, $type = "success", $dismissable = true) {
    ?>
    <div class="alert alert-<?echo $type?> <?echo ($dismissable ? " alert-dismissible" : " ") ?> fade show" role="alert">
      <?echo $msg?>
      <?if ($dismissable){?>
      <button type="button" class="close close-me" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <?}?>
    </div>
    <? 
    }

    public static function error($msg, $dismissable = true) {
        static::alert($msg,"danger",$dismissable);
    }

    public static function success($msg, $dismissable = true) {
        static::alert($msg,"success",$dismissable);
    }

    public static function warning($msg, $dismissable = true) {
        static::alert($msg,"warning",$dismissable);
    }

    // public function alert_dismiss_trigger(){
        //TODO: autoclose javascript
    // }
        
}