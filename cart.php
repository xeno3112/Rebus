<?php
    session_start();

    // connection to database
    require 'partials/_dbconnect.php';

    // product id from get request 
    $user_id = $_SESSION['user_id'];
    require 'partials/_header.php';

    // Navbar
    require 'partials/_navbar.php';

    // category tab
    require 'partials/_categories.php';

    $total_price = 0; // total price of the cart

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cart_product_id = $_POST['cpid']; // cart product id of the product to remove
        $quantity = $_POST['quant']; // quantity of the product in the cart
        $product_id = $_POST['pid']; // product id of the product to remove
        
        //Removal of product from the cart
        $remove_product_from_cart_sql = "DELETE FROM `cart` WHERE `cart_product_id` = '$cart_product_id';";
        $execute_remove_product_from_cart = $conn->query($remove_product_from_cart_sql);

        //Get quantity of product available
        $get_product_quantity_sql = "SELECT `quantity` FROM `products` WHERE `product_id`='$product_id';";
        $execute_get_product_quantity_sql = $conn->query($get_product_quantity_sql);
        $row_get_product_quantity_sql = $execute_get_product_quantity_sql->fetch_assoc();

        //Quantity of product after adding to cart
        $new_quantity = $row_get_product_quantity_sql['quantity'] + $quantity;

        //Updating product quantity available
        $update_product_quantity_sql = "UPDATE `products` SET `quantity`='$new_quantity' WHERE `product_id`='$product_id';";
        $execute_update_product_quantity_sql = $conn->query($update_product_quantity_sql);
    }
?>

<div class="container my-5">
    <h1 class="h1 text-center">My Cart</h1>

<?php
    echo '</div>
            <section class="products container-fluid">
                <div class="row m-5">';

            
    // get products from cart table
    $sql = "SELECT * FROM `cart` WHERE `user_id`='$user_id';";
    $result = $conn->query($sql);

    if($result){
        while($row = $result->fetch_assoc()){
            $pid = $row['product_id'];

            $get_product_sql = "SELECT * FROM `products` WHERE product_id='$pid';";
            $execute_product_sql = $conn->query($get_product_sql);
            while($product_row = $execute_product_sql->fetch_assoc()){

                //calculating total cart price
                $total_price += ($product_row['product_price'] * $row['quantity']);

                echo '<div class="col-md-4">
                        <div class="card">
                            <img src="' . $product_row['image_location'] . '" class="img-top" />
                            <div class="card-body">
                                <a href="product.php?pid=' . $product_row['product_id'] . '">
                                    <h5 class="card-title">' . $product_row['product_name'] . ' &nbsp;&nbsp;&nbsp;&nbsp;Rs.' . $product_row['product_price'] .'
                                    </h5>
                                </a>
                                <p class="card-text text-center">
                                    <strong>Quantity: </strong>' . $row['quantity'] . '
                                    <form class="text-center" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                                        <input type="hidden" name="cpid" id="cpid" value="' . $row['cart_product_id'] . '" />
                                        <input type="hidden" name="pid" id="pid" value="' . $row['product_id'] . '" />
                                        <input type="hidden" name="quant" id="quant" value="' . $row['quantity'] . '" />
                                        <button class="btn btn-lg btn-danger">Remove from cart</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>';
            }
        }
    }

    echo '</div>
            </section>
        <p class="m-5 text-center"><strong style="font-size: 28px;">Total cart price: </strong>' . $total_price .'</p>';
    
?>

<?php
    // footer
    require 'partials/_footer.php';
?>