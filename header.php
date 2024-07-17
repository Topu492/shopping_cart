<header class="header">
       <div class="header_body">
       <a href="index.php" class="logo">TechnoBing</a>
       <nav class="navbar">
        <a href="index.php">Add Products</a>
        <a href="view_products.php">View Products</a>
        <a href="shop_products.php">Shopit</a>
       </nav>
       <!-- select query---->
        <?php
        $select_cart = mysqli_query($conn,"Select * from `cart` ") or die("Query failed");
        $row_count = mysqli_num_rows($select_cart);

        ?>
       <!--- shopping cart icons---->
       <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i><span><sup><?php echo $row_count  ?></sup></span></a>
       <!-- <div id="menu_btn" class="fas fa-bars"></div> -->
       </div>

    </header>
