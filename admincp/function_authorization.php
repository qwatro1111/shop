<?php
session_start();
if(isset($_POST['exit'])){
    session_destroy();
}
function save_name($name_user){
    $_SESSION['user_login'] = $name_user;
}

if($_SESSION['user_login']){
    $user_login = $_SESSION['user_login'];
    if($pageid == 1){
        $a_panel = '<a href="../index.php">Shop products</a>.';
    }else{
        $a_panel = '<a href="admincp/index.php">Admin panel</a>.';
    }
    $user_exit = <<<id
    <div class="block_user">
        <form method="POST">
            In system, $user_login.
            $a_panel
            <input type="submit" name="exit" value="Exit"/>
        </form>
    </div>
id;
}