<?php
    session_start();
    // connection to database
    require 'partials/_dbconnect.php';

    require 'partials/_header.php';

    // Navbar
    require 'partials/_navbar.php';

    // category tab
    require 'partials/_categories.php';

    //carousel
    require 'partials/_carousel.php';

    // Products

    echo '<section class="products container-fluid">
            <div class="row m-5">
            <h3 class="mb-5">Mobiles</h3>';

    // get products

    //Mobile
    $sql = "SELECT * FROM `products` WHERE `category_id` = '21';";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){

        echo '<div class="col-md-4">
            <div class="card">
                <img src="' . $row['image_location'] . '" class="img-top" alt="Mi Redmi 8" />
                <div class="card-body">
                    <a href="product.php?pid=' . $row['product_id'] . '">
                        <h5 class="card-title">' . $row['product_name'] . ' &nbsp;&nbsp;&nbsp;&nbsp;Rs.' . $row['product_price'] .'
                        </h5>
                    </a>
                    <p class="card-text">
                        <ul>';

        $product_id = $row['product_id'];
        $descSQL = "SELECT * FROM `descriptions` WHERE `product_id` = '$product_id';";
        $descResult = $conn->query($descSQL);

        while($descRow = $descResult->fetch_assoc()){
            echo '<li>' . $descRow['description'] . '</li>';
        }

        echo '</ul></p></div></div></div>';
    }

    echo '</div>
    </section>';

    // Footwear

    echo '<section class="products container-fluid">
            <div class="row m-5">
            <h3 class="mb-5">Men\'s Footwear</h3>';


    $sql = "SELECT * FROM `products` WHERE `category_id` = '1';";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){

        echo '<div class="col-md-4">
            <div class="card">
                <img src="' . $row['image_location'] . '" class="img-top" alt="Mi Redmi 8" />
                <div class="card-body">
                    <a href="product.php?pid=' . $row['product_id'] . '">
                        <h5 class="card-title">' . $row['product_name'] . ' &nbsp;&nbsp;&nbsp;&nbsp;Rs.' . $row['product_price'] .'
                        </h5>
                    </a>
                    <p class="card-text">
                        <ul>';

        $product_id = $row['product_id'];
        $descSQL = "SELECT * FROM `descriptions` WHERE `product_id` = '$product_id';";
        $descResult = $conn->query($descSQL);

        while($descRow = $descResult->fetch_assoc()){
            echo '<li>' . $descRow['description'] . '</li>';
        }

        echo '</ul></p></div></div></div>';
    }

    echo '</div>
    </section>';

    // Products end

    // footer
    require 'partials/_footer.php';
?>