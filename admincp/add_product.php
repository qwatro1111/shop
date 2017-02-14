<?php
$title = 'Add product';
include_once 'function.php';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}
if($_POST['button']){
    $name_category = filter_input(INPUT_POST, 'name_category');
    $title_product = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $price =  filter_input(INPUT_POST, 'price');
    $image = $_FILES['image'];
    $name_files = $_FILES['image']['name'];
    $title_product = trim(preg_replace("/\s{2,}/"," ",$title_product));//====== удаляем лишьние пробелы
    if(!$name_category){
        $content = "Not selected category!";
    }else if(!$title_product){
        $content = "Not enter title!";
    }else if(!$description){
        $content = "Not enter description!";
    }else if(!$price){
        $content = "Not enter price!";
    }else{
        $save_image = check_images($image, $name_category);
        if($save_image == 12){
            $product_info = array(
                'name_category'=>$name_category,
                'title'=>$title_product,
                'description'=>$description,
                'price'=>$price,
                'img_url'=>"../catalogue/$name_category/$name_files",
                'img_name'=>$name_files,
            );
            $product_info = serialize($product_info);
            file_put_contents("../catalogue/$name_category/product",$product_info."\n", FILE_APPEND);
            $content = "Product save in category ".$name_category;
        }else{
            $content =  "Sorry, but the product was not established. ".message_save_image($save_image);
        }
    }
}else{
    $content = "<form method='POST' enctype='multipart/form-data'>
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
                <input type='number' class='w3-input w3-border' name='price' placeholder='Enter price'/>
            </div>
            <div class='w3-group'>
                <label>Loading image.<input type='file' class='w3-input w3-border' name='image'/></label>
            </div>
            <input type='submit' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' name='button' value='Add product'/>
    </form>";
}
include_once 'index.php';