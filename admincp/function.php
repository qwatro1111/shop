<?php

function save_images(){
    if(!isset($_FILES['photo'])){
        $message = "фото отсутствует";
    }else if($_FILES['photo']['error']!=UPLOAD_ERR_OK){
        switch ($_FILES['photo']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }
    }else if(!in_array($_FILES['photo']['type'], $AVAILABLE_TYPES)){
        $message = "тип файла не подходит";
    }else if($_FILES['photo']['size']>10*1024*1024){
        $message = "размер файла больше допустимого";
    }else{
        //попытка загрузки
        $images = scandir('gallery');
        $images = preg_grep('/\\.(?:png|gif|jpe?g)$/', $images);
        //$images = preg_grep('java', $images);
        $name_files = $_FILES['photo']['name'];
        $tmp_path = $_FILES['photo']['tmp_name'];

        if(in_array($name_files, $images)){
            $arr_name=array();
            foreach ($images as $key=>$img){
                if(stristr($img, $name_files)){
                    $arr_name[]=$images[$key];
                }
                foreach ($arr_name as $k=>$arr_img){
                    if($arr_img===$name_files){
                        $k = $k + 1;
                        if(stristr($name_files, '.png')==='.png'){
                            $name_files = stristr($name_files, '.png', true)."( ".$k." ).png";
                        }else if(stristr($name_files, '.jpeg')==='.jpeg'){
                            $name_files = stristr($name_files, '.jpeg', true)."( ".$k." ).jpeg";
                        }else if(stristr($name_files, '.gif')==='.gif'){
                            $name_files = stristr($name_files, '.gif', true)."( ".$k." ).gif";
                        }
                    $destination_path = 'gallery'.DIRECTORY_SEPARATOR.$name_files;
                        if(move_uploaded_file($tmp_path, $destination_path)){
                            $message = "файл дубликат загружен";
                        }else{
                            $message = "возникла ошибка при сохранении дубликата";
                        }
                    }
                }
            } 
        }else{
            $destination_path = 'gallery'.DIRECTORY_SEPARATOR.$name_files;
            if(move_uploaded_file($tmp_path, $destination_path)){
                $message = "файл загружен";
            }else{
                $message = "возникла ошибка при сохранении";
            }
        }
    }
}

function save_info_product(){
    $product_info = array(
        'name_category'=>$name_category,
        'title'=>$title,
        'description'=>$description,
    );
    $product_info = serialize($product_info);
}