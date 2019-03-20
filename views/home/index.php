<?$model = (object)$model;?>
<h2>Home</h2>
<h2>Try Post Area</h2>
<pre>
  <h4>Post Result</h4>
    <? echo print_r($model, true); ?>
</pre>
<form class="form-horizontal" action="/home/index" method="post" id="sendURL">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Name</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" type="text" placeholder="What's u'r name" class="form-control input-md" required="">
  <span class="help-block">A name is a term used for identification. 
    Names can identify a class or category of things.</span>  
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Password </label>
  <div class="col-md-4">
    <input id="passwordinput" name="passwordinput" type="password" placeholder="Realy!?" class="form-control input-md">
    <span class="help-block">Hmmm maybe</span>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="details">Here we go</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="details" name="details"></textarea>
  </div>
</div>

<!-- Prepended checkbox -->
<div class="form-group">
  <label class="col-md-4 control-label" for="hero">I'm a hero!</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox" checked="checked">     
      </span>
      <input id="hero" name="hero" class="form-control" type="text" placeholder="">
    </div>
    
  </div>
</div>

</fieldset>

<input type="submit" class="btn btn-primary" id="submitUleynnnn" value="Go!" />

</form>
