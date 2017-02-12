<?php
//======================== mime type image =====================================
$AVAILABLE_TYPES=array(
    'image/jpeg',
    'image/png',
    'image/gif',
);
//======================== inspection information products =====================
    $name_category = filter_input(INPUT_POST, 'name_category');
    $title_product = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $price =  filter_input(INPUT_POST, 'price');
    $image = $_FILES['image'];
    if(!$name_category){
        $content = "Not selected category!";
    }else if(!$title_product){
        $content = "Not enter title!";
    }else if(!$description){
        $content = "Not enter description!";
    }else if(!$price){
        $content = "Not enter price!";
    }else{
//======================== loading image =====================================
            if(!isset($_FILES['image'])){
            $content =  "Not selected image!";
        }else if($_FILES['image']['error']!=UPLOAD_ERR_OK){
            switch ($_FILES['image']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $content = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $content =  "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $content =  "The uploaded file was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $content =  "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $content =  "Missing a temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $content =  "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $content =  "File upload stopped by extension";
                    break;

                default:
                    $content =  "Unknown upload error";
                    break;
            }
        }else if(!in_array($_FILES['image']['type'], $AVAILABLE_TYPES)){
            $content =  "тип файла не подходит";
        }else if($_FILES['image']['size']>10*1024*1024){
            $content =  "размер файла больше допустимого";
        }else{
            //====== попытка загрузки ========
            $images = scandir("../catalogue/$name_category");
            $images = preg_grep('/\\.(?:png|gif|jpe?g)$/', $images);
            //$images = preg_grep('java', $images);
            $name_files = $_FILES['image']['name'];
            $tmp_path = $_FILES['image']['tmp_name'];

            $destination_path = "../catalogue/$name_category".DIRECTORY_SEPARATOR.$name_files;
                
            if(move_uploaded_file($tmp_path, $destination_path)){
            //========== save products ==========
            $product_info = array(
                'name_category'=>$name_category,
                'title'=>$title_product,
                'description'=>$description,
                'price'=>$price,
                'img_url'=>"../catalogue/$name_category/".$name_files,
            );
            $product_info = serialize($product_info);
            file_put_contents("../catalogue/$name_category/product",$product_info."\n", FILE_APPEND);
            $content = "Product save in category ".$name_category;
            }else{
                $content =  "возникла ошибка при сохранении";
            }
            
        }
//=========================== esc inspection product ===========================
}
