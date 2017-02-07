<?php
$title = 'Edit product';
include_once 'function.php';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}

if($_POST['option_category']){//======== choose product
    $option_category = filter_input(INPUT_POST, 'option_category');
    $file_test = "../catalogue/$option_category/product";
    if(file_exists($file_test)){
    $handle = fopen($file_test, 'r'); //=== open directory
    $arr_product_category = array();
    if($handle){
        while($row = fgets($handle)){
            $arr_product_category[]=unserialize($row);
        }
    }
    //$content.="<div class='w3-row-padding w3-grayscale'>";
    foreach($arr_product_category as $products){
        if(!empty($products)){
            $products_category .= "<option>".$products['title']."</option>"; 
        }
    }
    //$content.="</div>";
    fclose($handle); //=== close directory
    }else{
        $content = "Not products!";
    }
    $content = "<form method='POST'>
        <div class='w3-group'>
            <label>Name product</label>
            <select class='w3-input w3-border' name='option_product'>
                $products_category
            </select>
            <input type='hidden' name='hidden' value='$option_category'/>
        </div>
        <input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Open'/>
    </form>";
}else if($_POST['option_product']){ //========= choose product atribute
    $option_product = filter_input(INPUT_POST, 'option_product');
    $hidden = filter_input(INPUT_POST, 'hidden');
    $url_file_product = "../catalogue/$hidden/product";    
    $file_product = file($url_file_product);
    $i = 0;//=== counter position string
    foreach($file_product as $products){
        $products = unserialize($products);
        if($products['title'] === $option_product){   
            break;
        }
        $i++;
    }
    $product_atribute = unserialize($file_product[$i]);
    $content = "<form method='POST' enctype='multipart/form-data'>
            <div class='w3-group'>
                <p>".$product_atribute['name_category']."</p>
                <input type='hidden' name='name_category' value='".$product_atribute['name_category']."'/>
            </div>
            <div class='w3-group'>
                <input type='text' class='w3-input w3-border' name='title' value='".$product_atribute['title']."'/>
            </div>
            <div class='w3-group'>
                <textarea class='w3-input w3-border' name='description'>".$product_atribute['description']."</textarea>
            </div>
            <div class='w3-group'>
                <input type='number' class='w3-input w3-border' name='price' value='".$product_atribute['price']."'/>
            </div>
            <div class='w3-group'>
                <img src='".$product_atribute['img_url']."'/>
            </div>
            <input type='hidden' name='product_atribute' value='$i'/>
            <div class='w3-group'>
                <label>To replace loading image.<input type='file' class='w3-input w3-border' name='image'/></label>
                <input type='hidden' name='image_hidden' value='".$product_atribute['img_url']."'/>
            </div>
            <input type='submit' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' name='save_product' value='Save product'/>
            <input type='submit' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' name='delete_product' value='delete product'/>
        </form>";
}else if($_POST['delete_product']){//========= delete product atribute
    $product_atribute = filter_input(INPUT_POST, 'product_atribute');
    $name_category = filter_input(INPUT_POST, 'name_category');
    $url_file_product = "../catalogue/$name_category/product";    
    $file_product = file($url_file_product);
    $file_product[$product_atribute] = ''.PHP_EOL;//===== dubbing string =====
    file_put_contents($url_file_product, $file_product);//===== save string =====
    $content = "Delete product";
}else if($_POST['save_product']){ //========= save product atribute
    $product_atribute = filter_input(INPUT_POST, 'product_atribute');
    
    $name_category = filter_input(INPUT_POST, 'name_category');
    $title_product = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $price = filter_input(INPUT_POST, 'price');
    if($_FILES['image']){
        check_images($_FILES['image'], $name_category);
        $name_files = "../catalogue/$name_category/".$_FILES['image']['name'];
    }else{
        $name_files = filter_input(INPUT_POST, 'image_hidden');
        echo 'pizdec';
    }
    $product_info = array(
        'name_category'=>$name_category,
        'title'=>$title_product,
        'description'=>$description,
        'price'=>$price,
        'img_url'=>$name_files,
    );
    $product_info = serialize($product_info);
    $url_file_product = "../catalogue/$name_category/product";    
    $file_product = file($url_file_product);
    $file_product[$product_atribute] = $product_info.PHP_EOL;//===== dubbing string =====
    file_put_contents($url_file_product, $file_product);//===== save string =====
    $content = "Save product";
}else{
    $content = "<form method='POST'>
        <div class='w3-group'>
            <label>Name directory</label>
            <select class='w3-input w3-border' name='option_category'>
                $option_category
            </select>
        </div>
        <input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Open'/>
    </form>";
}
include_once 'index.php';