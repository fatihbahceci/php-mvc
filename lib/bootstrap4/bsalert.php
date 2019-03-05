<? 
class bsalert {
    //success, danger, warning
    public static function alert($msg, $type = "success") {
    ?>
    <div class="alert alert-<?echo $type?> alert-dismissible fade show" role="alert">
      <?echo $msg?>
      <button type="button" class="close close-me" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <? 
    }

    public static function error($msg) {
        static::alert($msg,"danger");
    }

    public static function success($msg) {
        static::alert($msg,"success");
    }

    public static function warning($msg) {
        static::alert($msg,"warning");
    }

    // public function alert_dismiss_trigger(){
        //TODO: autoclose javascript
    // }
        
}