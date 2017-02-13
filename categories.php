<?php
$title = "Catalogue";
$content = '';
$category_in_catalogue = '';
$arr_dir_catalogue = scandir('catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $category_in_catalogue.="<div class='w3-group'>";
        $category_in_catalogue.="<input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='$catalogue'/>";
        $category_in_catalogue.="</div>";
    }
}
if($_POST['button']){
    $name_category = filter_input(INPUT_POST, 'button');
    $way_file = "catalogue/$name_category/product";
    if(file_exists($way_file)){
    $handle = fopen($way_file, 'r'); //=== open directory ===
    $arr_product_category = array();
    if($handle){
        while($row = fgets($handle)){
            $arr_product_category[]=unserialize($row);
        }
    }
    //=========== show products =============
    $content.="<form method='post'>";
    $content.="<div class='w3-row-padding'>";
    foreach($arr_product_category as $key=>$products){
        if(!empty($products)){
            $content .= "<div class='w3-col m4 w3-margin-bottom'>";
            $content .= "<div class='w3-light-grey text_align_center'>";
            $content .= "<img src='".$products['img_url']."' width='150' height='150' />";
            $content .= "<div class='w3-container'>";
            $content .= "<div class='w3-container'>";
            $content .= "<h3>".$products['title']."</h3>";
            $content .= "<p>".$products['description']."</p>";
            $content .= "<p class='w3-opacity'>".$products['price']." $</p>";
            $content .= "<input type='hidden' name='buy' value='".$products['title']."'/>";
            $content .= "<input class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' type='submit' value='Buy product'/>";
            $content .= "</div></div></div></div>";
        }
    }
    $content.="</div>";
    $content.="</form>";
    fclose($handle); //=== close directory ===
    }else{
        $content .= "Not products!";
    }
}else{
    $content = "<form method='POST'>
            $category_in_catalogue
        </form>";
}
include_once 'index.php';
