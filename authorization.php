<?php
include_once 'admincp/function.php';
$title="Authorization form";
$content = "";

//==============authorization===============//
if(!$_SESSION['user_login']){
    $content.="<div class='w3-container' id='contact' style='margin-top:75px'>";
    if(filter_input(INPUT_POST, 'button')){
        $content.= "<h1 class='w3-xxxlarge w3-text-red'><b>Message site.</b></h1>";
        $content.= "<hr style='width:50px;border:5px solid red' class='w3-round'>";
        $arrusers = array(
            array(
                'login'=>'admin',
                'password'=>'password',
            ),
        );
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
        if(!$login || !$password){
            $content.= "<p>Data is transmitted is not fully!</p>";
        }else{
            foreach ($arrusers as $user){
                if($user['login']==$login && $user['password']==$password){
                    $user_exists = TRUE;
                    break;
                }
            }
            if($user_exists){
                $login_user = filter_input(INPUT_POST, 'login');
                if($login_user){
                    $name_user = $login_user;
                    save_name($name_user);
                    //header('Location:'.$_SERVER['PHP_SELF']);
                }
                $content.= "<p>Greetings, $login!</p>";
            }else{
                $content.= "<p>User with such login does not exist!</p>";
            }
        }
    }else{
        $content.= <<<id
        <h1 class="w3-xxxlarge w3-text-red"><b>Authorization.</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
        <p>Good afternoon. To access the admin panel fill in the form.</p>
        <!-- Authorization form -->
        <form method="POST">
          <div class="w3-group">
            <label>Login</label>
            <input class="w3-input w3-border" maxlength="20" type="text" name="login" required>
          </div>
          <div class="w3-group">
            <label>Password</label>
            <input class="w3-input w3-border" maxlength="20" type="password" name="password" required>
          </div>
            <input type="submit" name="button" lass="w3-btn-block w3-padding-large w3-red w3-margin-bottom" value="Authorization"/>
        </form> 
id;
    }

    $content.='</div>';
}
include_once 'index.php';
