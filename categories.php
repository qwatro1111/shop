<?php
$title = "Category";
include_once 'admincp/function.php';
$content = '';
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
    $content .= "<h3 class='w3-xxxlarge w3-text-red'>Category ".$name_category."</h3>";
    
    $content.="<div class='w3-row-padding'>";
    foreach($arr_product_category as $key=>$products){
        $content .= "<div class='w3-col m4 w3-margin-bottom'>";
        $content.="<form action='concret.php' method='post'>";
            if(!empty($products)){
                
                $content .= "<div class='w3-light-grey text_align_center'>";
                $content .= "<img src='catalogue/$name_category/".$products['img_name']."' width='150' height='150' />";
                $content .= "<div class='w3-container'>";
                $content .= "<div class='w3-container'>";
                $content .= "<h3>".$products['title']."</h3>";
                $content .= "<p>".$products['description']."</p>";
                $content .= "<p class='w3-opacity'>".$products['price']." $</p>";
                $content .= "<input type='hidden' name='buy' value='".$products['title']."'/>";
                $content .= "<input type='hidden' name='category' value='$name_category'/>";
                $content .= "<input class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' type='submit' value='Buy product'/>";
                $content .= "</div></div></div>";
            }
        $content.="</form>";
        $content.="</div>";
    }
    $content.="</div>";
    
    fclose($handle); //=== close directory ===
    }else{
        $content .= "Not products!";
    }
}else if($_POST['all']){
    $arr_dir_catalogue = scandir('catalogue');
    foreach ($arr_dir_catalogue as $catalogue){
        if($catalogue!=='.' && $catalogue!=='..'){
            $file_test = "catalogue/$catalogue/product";
            if(file_exists($file_test)){
                $handle = fopen($file_test, 'r'); //=== open directory
                $arr_product_category = array();
                if($handle){
                    $content .= "<h3 class='w3-xxxlarge w3-text-red'>Category ".$catalogue."</h3>";
                    
                    $content .= "<div class='w3-row-padding'>";
                        while($row = fgets($handle)){
                            $product = unserialize($row);
                            $content .= "<div class='w3-col m4 w3-margin-bottom'>";
                            $content.="<form action='concret.php' method='post'>";
                            if(!empty($product)){
                                
                                $content .= "<div class='w3-light-grey text_align_center'>";
                                $content .= "<img src='catalogue/$catalogue/".$product['img_name']."' width='150' height='150' />";
                                $content .= "<div class='w3-container'>";
                                $content .= "<div class='w3-container'>";
                                $content .= "<h3>".$product['title']."</h3>";
                                $content .= "<p>".$product['description']."</p>";
                                $content .= "<p class='w3-opacity'>".$product['price']." $</p>";
                                $content .= "<input type='hidden' name='buy' value='".$product['title']."'/>";
                                $content .= "<input type='hidden' name='category' value='$catalogue'/>";
                                $content .= "<input class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' type='submit' value='Buy product'/>";
                                $content .= "</div></div></div>";
                            }
                            $content.="</form>";
                            $content .= "</div>";
                        }
                    $content .= "</div>";
                    
                    fclose($handle);
                }
            }
        }
    }
}else{
    $arr_dir_catalogue = scandir('catalogue');
    foreach ($arr_dir_catalogue as $catalogue){
        if($catalogue!=='.' && $catalogue!=='..'){
            $file_test = "catalogue/$catalogue/product";
            if(file_exists($file_test)){
                $handle = fopen($file_test, 'r'); //=== open directory
                $arr_product_category = array();
                if($handle){
                    $content .= "<h3 class='w3-xxxlarge w3-text-red'>Category ".$catalogue."</h3>";
                    
                    $content .= "<div class='w3-row-padding'>";
                        while($row = fgets($handle)){
                            $product = unserialize($row);
                            $content .= "<div class='w3-col m4 w3-margin-bottom'>";
                            $content.="<form action='test.php' method='post'>";
                            if(!empty($product)){
                                
                                $content .= "<div class='w3-light-grey text_align_center'>";
                                $content .= "<img src='catalogue/$catalogue/".$product['img_name']."' width='150' height='150' />";
                                $content .= "<div class='w3-container'>";
                                $content .= "<div class='w3-container'>";
                                $content .= "<h3>".$product['title']."</h3>";
                                $content .= "<p>".$product['description']."</p>";
                                $content .= "<p class='w3-opacity'>".$product['price']." $</p>";
                                $content .= "<input type='hidden' name='buy' value='".$product['title']."'/>";
                                $content .= "<input type='hidden' name='category' value='".$catalogue."'/>";
                                $content .= "<input class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' type='submit' value='Buy product'/>";
                                $content .= "</div></div></div>";
                            }
                            $content.="</form>";
                            $content .= "</div>";
                        }
                    $content .= "</div>";
                    
                    fclose($handle);
                }
            }
        }
    }
}
include_once 'index.php';
