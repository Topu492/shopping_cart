<?php include('connect.php');

//update product

if(isset($_POST['update_product'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['product_image']['name'];
    $image_tmp = $_FILES['product_image']['tmp_name'];
    $update_product_image = 'images/'.$image;

    //update query
    $update_product = mysqli_query($conn,"Update `products` set name='$name',price='$price',
    image='$image' where id=$id");
    if($update_product){
        move_uploaded_file($image_tmp,$update_product_image);
       header('location:view_products.php');
    }
    else{
        $display_message = "There is some error in updating the product";
    }



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
      <!--- css file--->
      <link rel="stylesheet" href="css/style.css">

<!--- font awesome link---->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include('header.php') ?>

    <?php
        if(isset($display_message)){
           echo "<div class='display_message'>
           <span>$display_message </span>
           <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';>
           </i> </div>";
        }

        ?>
    <section class="edit_container">
        <!--php code---->
        <?php 
        if(isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $update_query = mysqli_query($conn,"Select * from `products` where id=$edit_id");
            if(mysqli_num_rows($update_query)>0){

                $fetch_data = mysqli_fetch_assoc($update_query);

                ?>
                <!--- form ---->
                <form action="" method="post" class="update_product product_container_box" enctype="multipart/form-data">
                    <img src="images/<?php echo $fetch_data['image']  ?>" alt="">
                    <input type="hidden" value="<?php echo $fetch_data['id'] ?>" name="id">
                    <input type="text" class="input_fields fields" name="name" required value="<?php echo $fetch_data['name'] ?>">
                    <input type="number" class="input_fields fields" name="price" required value="<?php echo $fetch_data['price'] ?>">
                    <input type="file" class="input_fields fields"  required  accept="image/png, image/jpg, image/jpeg" name="product_image">
                    <div class="btns">
                        <input type="submit" class="edit_btn" name="update_product" value="Update Product">
                        <input type="reset" id="close-id" value="cancel" class="cancel_btn">
                    </div>
                </form>
                
                
           
         
         <?php   }
         }  
         ?>
      
    </section>
</body>
</html>