<?php
$title = 'Edit category';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}
if($_POST['button']){
    $name_directory = filter_input(INPUT_POST,'option_category');
    $valie_directory = FALSE;
    foreach ($arr_dir_catalogue as $val){ 
        if($val === $name_directory){
            $valie_directory = TRUE;
            break;
        }      
    }
    if($valie_directory){
        $content = 'Delete category '.$name_directory.'.';
        rmdir("../catalogue/$name_directory");
    }else{
        $content = 'Directory '.$name_directory.', does not exist!';
    }
}else{
    $content = "
            <form method='POST'>
                <div class='w3-group'>
                    <label>Name directory</label>
                    <select class='w3-input w3-border' name='option_category'>
                        $option_category
                    </select>
                </div>
                    <input type='submit' name='button' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Delete category'/>
            </form>
    ";
}
include_once 'index.php';

