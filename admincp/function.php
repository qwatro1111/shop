<?php
//$_FILES['image']
function check_images($image, $name_category){
$AVAILABLE_TYPES=array(//======== mime type image
    'image/jpeg',
    'image/png',
    'image/gif',
);
    //======= loading image ========
        if(!isset($_FILES['image'])){
            $result = "Not selected image!";
        }else if($_FILES['image']['error']!=UPLOAD_ERR_OK){
            switch ($_FILES['image']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $content = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $result = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $result = "The uploaded file was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $result = "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $result = "Missing a temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $result = "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $result = "File upload stopped by extension";
                    break;

                default:
                    $result = "Unknown upload error";
                    break;
            }
        }else if(!in_array($_FILES['image']['type'], $AVAILABLE_TYPES)){
            $result = "тип файла не подходит";
        }else if($_FILES['image']['size']>10*1024*1024){
            $result = "размер файла больше допустимого";
        }else{
            //====== попытка загрузки ========
            $images = scandir("../catalogue/$name_category");
            $images = preg_grep('/\\.(?:png|gif|jpe?g)$/', $images);
            $name_files = $_FILES['image']['name'];
            $tmp_path = $_FILES['image']['tmp_name'];

            $destination_path = "../catalogue/$name_category".DIRECTORY_SEPARATOR.$name_files;
                
            if(move_uploaded_file($tmp_path, $destination_path)){
                $result = TRUE;
            }else{
                $result = "возникла ошибка при сохранении";
            }
            
        }
    return $result;
}


