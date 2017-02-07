<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method='POST' enctype='multipart/form-data'>
            <div class='w3-group'>

            </div>
            <div class='w3-group'>
                <input type='text' class='w3-input w3-border' name='title' value='".$file_product['title'])."'/>
            </div>
            <div class='w3-group'>
                <textarea class='w3-input w3-border' name='description'>".$file_product['description'])."</textarea>
            </div>
            <div class='w3-group'>
                <input type='number' class='w3-input w3-border' name='price' value='".$file_product['description'])."'/>
            </div>
            <div class='w3-group'>
                <img src='".$file_product['img_url'])."'/>
            </div>
            <div class='w3-group'>
                <label>To replace loading image.<input type='file' class='w3-input w3-border' name='image'/></label>
            </div>
            <input type='submit' class='w3-btn-block w3-padding-large w3-red w3-margin-bottom' name='save_product' value='Save product'/>
        </form>
    </body>
</html>
