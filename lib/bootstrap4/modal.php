<?
class modalForm
{

    public static function dialogClose($id, $title, $content, $close = "Kapat")
    {
        ?>
<div id="<?echo $id ?>" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?echo $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?echo $content ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?echo $close ?></button>
      </div>
    </div>
  </div>
</div>
        <?
    }

    public static function dialogSaveCancel($id, $title, $content, $save = "Kaydet", $cancel = "Vazgeç")
    {
        ?>
<div id="<?echo $id ?>" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?echo $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?echo $content ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?echo $cancel ?></button>
      </div>
    </div>
  </div>
</div>
        <?
    }
}