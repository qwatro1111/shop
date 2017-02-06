<?php
$title = 'Categories';
$arr_dir_catalogue = scandir('../catalogue');
$content = '';
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $content .= "<p>$catalogue</p>";
    }
}
include_once 'index.php';
