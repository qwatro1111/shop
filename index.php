<?php
include_once 'admincp/function_authorization.php';
if(!empty($_SESSION['product_corf'])){
    $product_corf = $_SESSION['product_corf'];
}else{
    $product_corf = array();
}
$product = filter_input(INPUT_POST, 'buy');
if($product){
    $product_corf[]= $product;
    $_SESSION['product_corf'] = $product_corf;
    header('Location:'.$_SERVER['PHP_SELF']);
}else if(isset ($_POST['delete'])){
    session_destroy();
    header('Location:'.$_SERVER['PHP_SELF']);
}
?>
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
        .block_user{
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }
        .text_align_center{
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Sidenav/menu -->
<?php include_once 'sidenav_menu.php';?>

<div class="w3-main" style="margin-left:340px;margin-right:40px">
    <h1><?= $title;?></h1>
    
<?= $user_exit;?>
<!-- Content -->
<?= $content;?>

<!-- footer -->
<?php include_once 'footer.php';?>
<form method="POST">
    <input type="submit" name="delete" value="Delete product corf"/>
</form>
<?php
var_dump($product_corf);
?>
</div>
</body>
</html>
