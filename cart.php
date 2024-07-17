<?php include('connect.php');
//update_quantity
if(isset($_POST['update_qty'])){
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    
    //update query
    $update_product_quantity = mysqli_query($conn,"Update `cart` set quantity=$quantity where id=$id");

    if($update_product_quantity){
        header('location:cart.php');
    }

}



    //delete query
     if(isset($_GET['remove'])){
        $id = $_GET['remove'];

        $delete = mysqli_query($conn,"Delete from `cart` where id= $id");
        header('location:cart.php');

     

}

//delete all create_function

if(isset($_GET['delete_all'])){
    $delete = mysqli_query($conn,"Delete from `cart`");
    header('location:cart.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
     <!--- css file--->
     <link rel="stylesheet" href="css/style.css">

    <!--- font awesome link---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'header.php'   ?>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">My Cart</h1>
            <table>
                <?php
                $select_cart = mysqli_query($conn,"Select * from `cart`");
                $num =1;
                $grand_total =0;
                if(mysqli_num_rows($select_cart)>0){
                    echo "  <thead>
                    <th>SI No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Quanity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>";
                while($fetch_data=mysqli_fetch_assoc($select_cart)){
                     ?>

                    <tr>
                          <td><?php echo $num ?></td>
                        <td><?php echo $fetch_data['name'] ?></td>
                        <td> <img src="images/<?php echo $fetch_data['image'] ?>" alt=""></td>
                        <td>$<?php echo  $fetch_data['price'] ?>/-</td>
                        <td>
                            <form action="" method="post">
                            <div class="quantity_box">
                                <input type="hidden" value="<?php echo $fetch_data['id'] ?>" name="id">
                                <input type="number" min="0" value="<?php echo $fetch_data['quantity'] ?>" name="quantity">
                                <input type="submit" class="update_quantity" value="Update" name="update_qty">
                            </div>
                            </form>
                        </td>
                        <td>$<?php echo $subtotal = number_format($fetch_data['price'] * $fetch_data['quantity'])   ?>/-</td>
                        <td>
                            <a href="cart.php?remove=<?php echo $fetch_data['id'] ?>" onclick="return confirm('Are you sure want to delete this item')">
                            <i class="fas fa-trash"></i>
                            Remove
                        </a></td>
                    </tr>
               <?php 
               $num++;
               $grand_total = $grand_total+($fetch_data['price'] * $fetch_data['quantity']);
            }

                }
                else{
                    echo "<div class='empty_text'>Cart is empty</div>";

                }



                ?>
              
         
                </tbody>
            </table>

            <?php
            if($grand_total>0) {
            echo   "
            <div class='table_bottom'>
                <a href='shop_products.php' class='bottom_btn'>Continue Shopping</a>
                <h3 class='bottom_btn'>Grand Total: $<span> $grand_total /-</span></h3>
               
            </div>
           
                 ";

            
          ?>

            <!--bottom area--->
           
            <a href="cart.php?delete_all" class="delete_all_btn">
                <i class="fas fa-trash">  Delete All</i>
            </a>

            <?php
            }
            else{

            }

            ?>
        </section>
    </div>
    
</body>
</html>