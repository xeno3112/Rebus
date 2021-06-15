<nav class="navbar-custom">
    <img class="logo" src="images/logo-1.svg" alt="Logo" />
    <h3><a class="navbar-custom-brand" href="/Rebus">Rebus</a></h3>
    <form>
        <input class="nav-search-box" type="text" placeholder="Search">
        <button class="nav-search-button btn btn-outline-dark" type="submit"> <i class="fa fa-search"></i></button>
    </form>
    <?php
        if(isset($_SESSION['logggedin']) and $_SESSION['logggedin']){
            echo '<a class="nav-link navbar-custom-link" style="font-size: 1rem;" href="logout.php">Logout</a>
                    <a class="nav-link navbar-custom-link" style="font-size: 1rem;" href="cart.php">My cart</a>
                    <span>' . $_SESSION['username'] . '</span>';
        }
        else{
            echo '<a class="nav-link navbar-custom-link" href="login.php">Login</a>
                    <a class="nav-link navbar-custom-link" href="signup.php">Sign Up</a>';
        }
    ?>
    <a class="nav-link navbar-custom-link" href="#"><i class="fa fa-2x fa-user"></i></a>
</nav>