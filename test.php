<?php
$category = filter_input(INPUT_POST, 'category');
$product = filter_input(INPUT_POST, 'buy');
$title = "$product";
$file_product = "catalogue/$category/product";
$handle = fopen($file_product, r);
if($handle){
    while($row = fgets($handle)){
        $row = unserialize($row);
        if($row['title'] === $product){
        $product_arr_attribute = $row;
        break;
        }
    }
}