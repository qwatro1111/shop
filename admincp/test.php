<?php
$title = 'Add product';
$AVAILABLE_TYPES=array(
    'image/jpeg',
    'image/png',
    'image/gif',
);

$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}

if($_POST['button']){
    include_once 'save_product.php';
}else{
    echo "<form method='POST' enctype='multipart/form-data'>
            <div class='w3-group'>
                Choos category
                <select name='name_category' class='w3-input w3-border'>
                    $option_category
                </select>
            </div>
            <div class='w3-group'>
                <input type='text' class='w3-input w3-border' name='title' placeholder='Enter title'/>
            </div>
            <div class='w3-group'>
                <textarea class='w3-input w3-border' name='description' placeholder='Enter description'></textarea>
            </div>
            <div class='w3-group'>
                <label>Loading image.<input type='file' class='w3-input w3-border' name='image'/></label>
            </div>
            <input type='submit' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' name='button' value='Add product'/>
    </form>";
}
$file_test = '../catalogue/dirone/product';
$handle = fopen($file_test, 'r');
$arr_arr = array();
if($handle){
    while($row = fgets($handle)){
        $arr_arr[]=unserialize($row);
    }
}
echo '<pre>';
var_dump($arr_arr);
echo '</pre>';