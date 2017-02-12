<?php
$title = 'Edit category';
$arr_dir_catalogue = scandir('../catalogue');
foreach ($arr_dir_catalogue as $catalogue){
    if($catalogue!=='.' && $catalogue!=='..'){
        $option_category.= "<option>$catalogue</option>";
    }
}

if($_POST['edit_category']){
    $name_directory = filter_input(INPUT_POST,'option_category');
    $content = "
        <form method='POST'>
            <div class='w3-group'>
                <input type='text' class='w3-input w3-border' name='name_directory' value='$name_directory'/>
                <input type='hidden' class='w3-input w3-border' name='hidden' value='$name_directory'/>
            </div>
            <input type='submit' name='save_category' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Save category'/>
            <input type='submit' name='delete_category' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Delete category'/>
        </form>
    ";
}else if($_POST['delete_category']){
    $name_directory = filter_input(INPUT_POST,'hidden');
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
}else if($_POST['save_category']){
    $name_directory = filter_input(INPUT_POST,'name_directory');
    $old_name_directory = filter_input(INPUT_POST,'hidden');
    $valie_directory = FALSE;
    foreach ($arr_dir_catalogue as $val){ 
        if($val === $old_name_directory){
        $valie_directory = TRUE;
        break;
        }      
    }
    if($valie_directory){
        rename("../catalogue/$old_name_directory","../catalogue/$name_directory");
        $content = "New name category $old_name_directory - $name_directory.";
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
                <input type='submit' name='edit_category' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' value='Edit category'/>
        </form>
    ";
}
include_once 'index.php';

