<!DOCTYPE html>
<html>
<head>
    <title><?= $title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <style>
        body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
        body {font-size:16px;}
        .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
        .w3-half img:hover{opacity:1}
    </style>
</head>
<body>

<!-- Sidenav/menu -->
<?php include_once 'sidenav_menu.php';?>

<!-- Content -->
<?= $content;?>

<!--////////////////////////////////////////////////////////////////////////-->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
<?php if($_POST['button']):?>
<?php
$arrusers = array(
    'login'=>'admin',
    'password'=>'password',
);
$login = filter_input(INPUT_POST, 'login');
$password = filter_input(INPUT_POST, 'password');
if(!$login || !$password){
    echo 'Данние переданы не в полной мере';
}else{
    
}
?>
<?php else:?>

    <p>Good afternoon. To access the admin panel fill in the form.</p>
    <!-- Authorization form -->
    <form method="POST">
      <div class="w3-group">
        <label>Login</label>
        <input class="w3-input w3-border" type="text" name="login" required>
      </div>
      <div class="w3-group">
        <label>Password</label>
        <input class="w3-input w3-border" type="password" name="password" required>
      </div>
        <input type="submit" name="button" class="w3-btn-block w3-padding-large w3-red w3-margin-bottom" value="Authorization"/>
    </form>  
<?php endif;?>
    </div>
</div>
<!--////////////////////////////////////////////////////////////////////////-->

<!-- footer -->
<?php include_once 'footer.php';?>

</body>
</html>
