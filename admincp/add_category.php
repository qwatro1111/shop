<?php
$title = 'Add category';
if($_POST['name_directory']){
    $name_directory = $_POST['name_directory'];
    $arr_dir_catalogue = scandir('../catalogue');
    $valie_directory = FALSE;
    foreach ($arr_dir_catalogue as $val){ 
        if($val === $name_directory){
            $valie_directory = TRUE;
            break;
        }      
    }
    if($valie_directory){
        $content = 'Directory exists.';
    }else{
        //$destination_path = 'pricelists' . DIRECTORY_SEPARATOR . mb_convert_encoding($file['name'], 'Windows-1251', mb_detect_encoding($file['name']));//решение проблем с кодировкой
        mkdir("../catalogue/$name_directory");
        $content = "Created directory - $name_directory.<br/><a href='add_category.php'>Add category</a>";
    }
}else{
$content = '<form method="POST">
        <div class="w3-group">
            <label>Name directory</label>
            <input class="w3-input w3-border"  maxlength="20" type="text" name="name_directory" required>
        </div>
            <input type="submit" name="button" class="w3-btn-block w3-padding-large w3-red w3-margin-bottom" value="Save category"/>
    </form>';
}
include_once 'index.php';

