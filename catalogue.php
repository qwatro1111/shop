<?php
$title = "Catalogue";
$category_in_catalogue = '';
$arr_dir_catalogue = scandir('catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $category_in_catalogue.="<div class='w3-group'>";
        $category_in_catalogue.="<input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='$catalogue'/>";
        $category_in_catalogue.="</div>";
    }
}
$content = "<form action='categories.php' method='POST'>
        <div class='w3-group'>
            <input type='submit' name='all' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='All products'/>
        </div>
            $category_in_catalogue
        </form>";
include_once 'index.php';
