<?php

$title = $app_name;
if (defined('_page_title')) {
    $title = _page_title . " - " . $title;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $title ?></title>


<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="/assets/css/site.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


<script type="text/javascript" src="/assets/js/site.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/home/index"><?php echo $app_name ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <?//if (C::isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/home/index">Admin (area)</a>
                    </li>
                    <?//endif;?>
    </ul>
  </div>
</nav>
    <div class="container body-content">

<script>
    $(document).ready(function(){
        setTimeout(() => {
            $('.close-me').trigger('click');
        }, 5000);
    });
    </script>
   <?php
if ($extra != null) {
    //$extra = (controllerExt)$extra;
    // print_r($extra);
    if (count($extra->errors)>0) {
        foreach ($extra->errors as $line) {
            # code...
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?echo $line?>
  <button type="button" class="close close-me" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?            
        }
    }


    if (count($extra->warnings)>0) {
        foreach ($extra->warnings as $line) {
            # code...
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <?echo $line?>
  <button type="button" class="close close-me" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?            
        }
    }    

    if (count($extra->success)>0) {
        foreach ($extra->success as $line) {
            # code...
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?echo $line?>
  <button type="button" class="close close-me" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?            
        }
    }
}


?>    