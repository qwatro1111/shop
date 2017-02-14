<?php
$category = filter_input(INPUT_POST, 'category');
$product = filter_input(INPUT_POST, 'buy');
$title = "$product";
$file_product = "catalogue/$category/product";
$handle = fopen($file_product, r);
if($handle){
    while($row = fgets($handle)){
        $row = unserialize($row);
        if($row['title'] == $product){
        $product_arr_attribute = $row;
        break;
        }
    }
}
$content = "
    <div class='w3-row-padding'>
        <div class='w3-half'>
            <img src='catalogue/".$category."/".$product_arr_attribute['img_name']."' onclick='onClick(this)' alt='".$product_arr_attribute['title']."'/>
        </div>
    </div>
";
include_once 'index.php';