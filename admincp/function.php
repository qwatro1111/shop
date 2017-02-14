<?php
function check_images($files_image, $name_category){
    //список допустимых майн-типов
    $AVAILABLE_TYPES=array(
        'image/jpeg',
        'image/png',
        'image/gif',
    );
    if($files_image['error']!=UPLOAD_ERR_OK){
        switch ($files_image['error']) {
            case UPLOAD_ERR_INI_SIZE:
                return 1;
                break;
            case UPLOAD_ERR_FORM_SIZE:
                return 2;
                break;
            case UPLOAD_ERR_PARTIAL:
                return 3;
                break;
            case UPLOAD_ERR_NO_FILE:
                return 4;
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                return 5;
                break;
            case UPLOAD_ERR_CANT_WRITE:
                return 6;
                break;
            case UPLOAD_ERR_EXTENSION:
                return 7;
                break;

            default:
                return 8;
                break;
        }
    }else if(!in_array($files_image['type'], $AVAILABLE_TYPES)){
        return 9;
    }else if($files_image['size']>1*1024*1024){
        return 10;
    }else{
        //попытка загрузки
        $images = scandir("../catalogue/$name_category");
        $images = preg_grep('/\\.(?:png|gif|jpe?g)$/', $images);
        $name_files = $files_image['name'];
        $tmp_path = $files_image['tmp_name'];

        if(in_array($name_files, $images)){
            return 11;
        }else{
            $destination_path = "../catalogue/$name_category/".DIRECTORY_SEPARATOR.$name_files;
            if(move_uploaded_file($tmp_path, $destination_path)){
                return 12;
            }else{
                return 13;
            }
        }
    }
    return $message;
}
function message_save_image($number){
    switch ($number){
        case 1:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case 2:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case 3:
            $message = "The uploaded file was only partially uploaded";
            break;
        case 4:
            $message = "No file was uploaded";
            break;
        case 5:
            $message = "Missing a temporary folder";
            break;
        case 6:
            $message = "Failed to write file to disk";
            break;
        case 7:
            $message = "File upload stopped by extension";
            break;
        case 8:
            $message = "Unknown upload error";
            break;
        case 9:
            $message = "File type does not fit";
            break;
        case 10:
            $message = "The file size is larger than allowed";
            break;
        case 11:
            $message = "A file with this name exists";
            break;
        case 12:
            $message = "файл загружен";
            break;
        case 13:
            $message = "There was an error when saving";
            break;

        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}
