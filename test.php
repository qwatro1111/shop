<?php

$arr_dir_catalogue = scandir('catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $file_test = "catalogue/$catalogue/product";
        if(file_exists($file_test)){
            $handle = fopen($file_test, 'r'); //=== open directory
            $arr_product_category = array();
            if($handle){
                while($row = fgets($handle)){
                    $row = unserialize($row);
                    echo '<pre>';
                    var_dump($row);
                    echo '</pre>';
                }
            }
        }
    }
}