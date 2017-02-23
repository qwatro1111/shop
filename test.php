<?php
$category = filter_input(INPUT_POST, 'category');
$product = filter_input(INPUT_POST, 'buy');
$title = $product;
if($product == NULL || $category == NULL){
    header('Location: categories.php');
}
$file_product = "catalogue/$category/product";
$handle = file($file_product);
$i = 0;
foreach ($handle as $key=>$val){
    $val = unserialize($val);
    if($val['title']===$product){        
        break;
    }
    $i++;
}
$selected_product = unserialize($handle[$i]);

echo "
    <div class='w3-row-padding'>
        <div class='w3-half'>
            <img style = 'width: 30%' src='catalogue/".$category."/".$selected_product['img_name']."' onclick='onClick(this)' alt='".$product_arr_attribute['title']."'/>
        </div>
        ".$selected_product['name_category']."<br/>
        ".$selected_product['title']."<br/>
        ".$selected_product['description']."<br/>
        ".$selected_product['price']." $
    
        <form method='POST'>
            <div class='w3-group'>
                <input type='submit' name='product_add_corf' class='w3-btn w3-red w3-padding-large w3-hover-black' value='Buy'/>
            </div>
            <input type='hidden' name='name_category' value='".$selected_product['name_category']."'/>
            <input type='hidden' name='title' value='".$selected_product['title']."'/>
            <input type='hidden' name='price' value='".$selected_product['price']."'/>
        </form>
    </div>
";
$product_add_corf = filter_input(INPUT_COOKIE, 'add_in_corf');
if($product_add_corf){
    $arr_product_add_corf= unserialize($product_add_corf);
}
