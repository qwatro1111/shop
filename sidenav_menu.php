<?php if($pageid == 1):?>
<nav class="w3-sidenav w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold" id="mySidenav"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-padding-xlarge w3-hide-large w3-display-topleft w3-hover-white" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>Admin<br>panel</b></h3>
  </div>
  <a href="../index.php" onclick="w3_close()" class="w3-padding w3-hover-white">Main</a> 
  <a href="categories.php" onclick="w3_close()" class="w3-padding w3-hover-white">Categories</a> 
  <a href="products.php" onclick="w3_close()" class="w3-padding w3-hover-white">Products</a> 
  <a href="add_category.php" onclick="w3_close()" class="w3-padding w3-hover-white">Add category</a> 
  <a href="edit_category.php" onclick="w3_close()" class="w3-padding w3-hover-white">Edit category</a> 
  <a href="add_product.php" onclick="w3_close()" class="w3-padding w3-hover-white">Add product</a>
  <a href="edit_product.php" onclick="w3_close()" class="w3-padding w3-hover-white">Edit product</a>
  <a href="orders.php" onclick="w3_close()" class="w3-padding w3-hover-white">Orders</a> 
</nav>
<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-btn w3-red w3-border w3-border-white w3-margin-right" onclick="w3_open()">☰</a>
  <span>Admin panel</span>
</header>
<?php else:?>
<nav class="w3-sidenav w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold" id="mySidenav"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-padding-xlarge w3-hide-large w3-display-topleft w3-hover-white" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>Shop<br>products</b></h3>
  </div>
  <a href="catalogue.php" onclick="w3_close()" class="w3-padding w3-hover-white">Catalogue</a> 
  <a href="categories.php" onclick="w3_close()" class="w3-padding w3-hover-white">Category</a> 
  <a href="#" onclick="w3_close()" class="w3-padding w3-hover-white">Concret</a> 
  <a href="#" onclick="w3_close()" class="w3-padding w3-hover-white">Corf</a> 
  <a href="#" onclick="w3_close()" class="w3-padding w3-hover-white">Checkout</a>
  <?php if(!$_SESSION['user_login']):?>
  <a href="authorization.php" onclick="w3_close()" class="w3-padding w3-hover-white">Authorization</a>
  <?php endif;?>
</nav>
<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-btn w3-red w3-border w3-border-white w3-margin-right" onclick="w3_open()">☰</a>
  <span>Company Name</span>
</header>
<?php endif;?>
