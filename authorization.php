<?php
$title="Authorization form";
$content=<<<id
<div class="w3-main" style="margin-left:340px;margin-right:40px">
<!-- Authorization form -->
  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <p>Good afternoon. To access the admin panel fill in the form.</p>
    <form action="form.asp" method="POST">
      <div class="w3-group">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-group">
        <label>Password</label>
        <input class="w3-input w3-border" type="password" name="password" required>
      </div>
      <button type="submit" class="w3-btn-block w3-padding-large w3-red w3-margin-bottom">Authorization</button>
    </form>  
  </div>
</div>
id;
include_once 'index.php';
?>