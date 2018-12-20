<?php
$app_name = "MVC App";
$title = "MVC Title";
if (defined('_page_title')) {
    $title = _page_title . " - " . $title;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $title ?></title>
<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
<link href="/assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/css/site.css">


<script type="text/javascript" src="/assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/assets/js/popper.min.js"></script>


<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/DataTables/jquery.dataTables.js"></script>

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
                        <a class="nav-link" href="/admin/login">Giriş</a>
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