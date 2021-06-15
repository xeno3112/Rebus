<?php
    session_start();

    // connection to database
    require 'partials/_dbconnect.php';

    $notExists = false;

    if(isset($_SESSION['logggedin']) and $_SESSION['logggedin'] == true){
        header('location: index.php');
        exit;
    }

    // Login form 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `email_id`='$email';";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($pass, $row['pass'])){
                session_start();
                $_SESSION['logggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['user_name'];
                $_SESSION['email_id'] = $row['email_id'];
                $_SESSION['phoneno'] = $row['phone_number'];
                header('location: index.php');
            }
            else{
                header('location: login.php?status=invalid');
            }
        }
        else{
            header('location: login.php?status=does_not_exist');
        }
    }
    require 'partials/_header.php';

    echo '<style>';
    include 'css/profile.css';
    echo '</style>';

    // Navbar
    require 'partials/_navbar.php';

    // category tab
    require 'partials/_categories.php';
    
    if(isset($_GET['status']) and $_GET['status'] == 'does_not_exist'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Account does not exist.
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_GET['status']) and $_GET['status'] == 'invalid'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Invalid credentials.
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>';
    }


    echo '<div class="loginbox">
            <img src="images/download.png" class="download">
            <h1>Login here</h1>
            <form action="login.php" method="post" onsubmit="check_login()">
                <p>Username</p>
                <input type="text" name="email" id="email" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="password" id="password" placeholder="Enter Password">
                <input type="submit" value="Login">
            
                <a href="forgot.html">Forgot password</a><br>
                <a href="sign up.html">Sign Up</a>
            </form>
        </div>';

        // Script for form validation
        echo "<script>
                function checkEmail(){
                    if(email.value == ''){
                        alert('Empty field not accepted.');
                        return false;
                    }
                    return true;
                }
                function checkPassword(){
                    if(password.value == ''){
                        alert('Empty field not accepted.');
                        return false;
                    }
                    return true;
                }
                function check_login(){
                    if(checkEmail() && checkPassword()){
                        return true;
                    }
                    else{
                        document.write('');
                        window.location.replace('http://localhost/Rebus/login.php');
                        return false;
                    }
                }
            </script>";

    // footer
    require 'partials/_footer.php';
?>