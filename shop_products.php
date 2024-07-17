<?php
include 'connect.php';
if(isset($_POST['add_to_cart'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = 1;

    //select cart database on condition
    $select_product = mysqli_query($conn,"Select * from `cart` where name='$name'");
    if(mysqli_num_rows($select_product)>0){
      $display_message[] = "Product alreday added to cart";
    }
    else{
           //insert cart data into cart table
    $insert_query = mysqli_query($conn, "Insert into `cart` (name,price,image,quantity)
    values('$name','$price','$image',$quantity)");
     $display_message[] = "Product added to cart";
    }

  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products</title>
     <!--- css file--->
     <link rel="stylesheet" href="css/style.css">

<!--- font awesome link---->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
 integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'header.php' ?>

    <div class="container">
        <?php
        if(isset($display_message)){
            foreach($display_message as $display_message){
                echo "<div class='display_message'>
                <span>$display_message</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                </div>";
            }
        }
         ?>
        <section class="products">
            <h1 class="heading">Lets Shop</h1>
            <div class="product_container">
                <?php
                $select_products = mysqli_query($conn,"Select * from `products`");
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_assoc=mysqli_fetch_assoc($select_products)){
                        ?>

                <form method="post" action="">
                <div class="edit_form">
                    <img src="images/<?php echo $fetch_assoc['image'] ?>" alt="">
                    <h3><?php echo $fetch_assoc['name'] ?></h3>
                    <div class="price"><?php echo $fetch_assoc['price'] ?>/-</div>
                    <input type="hidden" name="name" value="<?php echo $fetch_assoc['name'] ?>">
                    <input type="hidden" name ="price" value="<?php echo $fetch_assoc['price'] ?>">
                    <input type="hidden" name="image" value="<?php echo $fetch_assoc['image'] ?>">
                    <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
                </div>
                </form>


                 <?php  }
                }
                else{
                    echo "<div class='empty_text'>No Products available </div>";
                }

                ?>
            </div>
        </section>
    </div>
    
</body>
</html>