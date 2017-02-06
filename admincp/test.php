<?php
$title = 'Add product';
$AVAILABLE_TYPES=array(
    'image/jpeg',
    'image/png',
    'image/gif',
);

include_once 'function.php';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}

if($_POST['button']){
    $name_category = filter_input(INPUT_POST, 'name_category');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $image = $_FILES['image'];
    if(!$name_category){
        echo "Not selected category!";
    }else if(!$title){
        echo "Not enter title!";
    }else if(!$description){
        echo "Not enter description!";
    }else if(!$image['name']){
        echo "Not selected image!";
    }else{
        $product_info = array(
        'name_category'=>$name_category,
        'title'=>$title,
        'description'=>$description,
        );
        $product_info = serialize($product_info);
         file_put_contents("../catalogue/$name_category/product",$product_info, FILE_APPEND);
        echo "Goot Igor";
    }
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
