<?php
$title = 'Products';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}

$content = "<form method='POST'>
        <div class='w3-group'>
            <label>Name directory</label>
            <select class='w3-input w3-border' name='option_category'>
                $option_category
            </select>
        </div>
        <input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Open category'/>
    </form>";
if($_POST['button']){
    $option_category = filter_input(INPUT_POST, 'option_category');
    $file_test = "../catalogue/$option_category/product";
    if(file_exists($file_test)){
    $handle = fopen($file_test, 'r'); //=== open directory
    $arr_product_category = array();
    if($handle){
        while($row = fgets($handle)){
            $arr_product_category[]=unserialize($row);
        }
    }
    $content.="<div class='w3-row-padding w3-grayscale'>";
    foreach($arr_product_category as $products){
        if(!empty($products)){
            $content .= "<div class='w3-col m4 w3-margin-bottom'>";
            $content .= "<div class='w3-light-grey text_align_center'>";
            $content .= "<img src='".$products['img_url']."' width='150' height='150' />";
            $content .= "<div class='w3-container'>";
            $content .= "<div class='w3-container'><h3>".$products['title']."</h3></div>";
            $content .= "</div>";
            $content .= "</div>";
            $content .= "</div>";
        }
    }
    $content.="</div>";
    fclose($handle); //=== close directory
    }else{
        $content .= "Not products!";
    }
}
include_once 'index.php';
