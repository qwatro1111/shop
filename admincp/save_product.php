<?php
//======================== save products =====================================
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
//======================== loading image =====================================
            if(!isset($_FILES['image'])){
            echo  "фото отсутствует";
        }else if($_FILES['image']['error']!=UPLOAD_ERR_OK){
            switch ($_FILES['image']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    echo  "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo  "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo  "The uploaded file was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo  "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo  "Missing a temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo  "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo  "File upload stopped by extension";
                    break;

                default:
                    echo  "Unknown upload error";
                    break;
            }
        }else if(!in_array($_FILES['image']['type'], $AVAILABLE_TYPES)){
            echo  "тип файла не подходит";
        }else if($_FILES['image']['size']>10*1024*1024){
            echo  "размер файла больше допустимого";
        }else{
            //попытка загрузки
            $images = scandir("../catalogue/$name_category");
            $images = preg_grep('/\\.(?:png|gif|jpe?g)$/', $images);
            //$images = preg_grep('java', $images);
            $name_files = $_FILES['image']['name'];
            $tmp_path = $_FILES['image']['tmp_name'];

            $destination_path = "../catalogue/$name_category".DIRECTORY_SEPARATOR.$name_files;
                
            if(move_uploaded_file($tmp_path, $destination_path)){
            //запись данных
            $product_info = array(
            'name_category'=>$name_category,
                    'title'=>$title,
                    'description'=>$description,
                    'img_url'=>"../catalogue/$name_category/".$name_files,
                    );
                    $product_info = serialize($product_info);
                    file_put_contents("../catalogue/$name_category/product",$product_info."\n", FILE_APPEND);
                    echo "Product save in category".$name_category;
                    echo  "файл загружен";
                }else{
                    echo  "возникла ошибка при сохранении";
                }
            
        }
//==================================================================
        
    }
