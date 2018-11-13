<?php
    session_start();
    error_reporting(1);
    require_once "connection.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno!=0){
        echo "No connection to the database: ".$conn->connect_errno;
    } else {
        $login = $_SESSION['user'];
        if($result = @$conn->query(
        sprintf("SELECT Address1, City, ZipCode FROM customer WHERE login='%s'",
        mysqli_real_escape_string($conn,$login)))){
            $users = $result->num_rows;
            if($users > 0){
                $row = $result->fetch_assoc();
                $_SESSION['addressSession']=$row['Address1'];
                $_SESSION['zipCodeSession']=$row['ZipCode'];
                $_SESSION['citySession']=$row['City'];
            }
        }
      $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diavola - Create your pizza</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="pic/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">

</head>

<body>
    <nav class="navbar">
        <div class="navbar--row">
            <a href="index.php" class="navbar--logo">diavola</a>
            <span id="navbar--toggle">
                <i class="fas fa-bars"></i>
            </span>
        </div>
        <ul id="navbar--list">
            <li><a href="index.php" class="navbar--list__link">home</a></li>
            <li><a href="pizza-menu.php" class="navbar--list__link">pizza menu</a></li>
            <li><a href="pizza-builder.php" class="navbar--list__link">pizza builder</a></li>
            <li><a href="index.php#about-us" class="navbar--list__link">about us</a></li>
            <li><a href="#contact" class="navbar--list__link">contact</a></li>
            <li>
                <?php
                    if((isset($_SESSION["zalogowany"]))&&($_SESSION["zalogowany"]==True)){
                        echo '<a class="navbar--list__link navbar--list__link-fixed">'.$_SESSION['user'].'</a>';
                        echo '<a href="logout.php" class="navbar--list__link navbar--list__link-fixed"><input type="button" value="Logout" class="subpage-input"></a>';
                    }
                    else{
                        echo '<a href="login.php" class="navbar--list__link special" value="Log In">login</a>';
                    }
                ?>
            </li>
        </ul>
    </nav>
    <section class="banner-pizza-builder">
        <h1>Checkout</h1>
        <div class="banner-pizza-builder--breadcrumb">
            <ul>
                <li><a href="index.php">home</a></li>
                <li>></li>
                <li><a href="#">Checkout</a></li>
            </ul>
        </div>
    </section>
    <section class="checkout">
        <div class="checkout--side">
            <div class="checkout--side__billing-details">
                <?php
                if(!(isset($_SESSION["zalogowany"]))&&($_SESSION["zalogowany"]==False)){
                    echo '<h1>Do you have an account?</h1>
                    <input type="radio" name="account"checked class="input-radio" data-value="no"><label class="radio-label">no</label>
                    <input type="radio" name="account" class="input-radio" data-value="yes"><label class="radio-label">yes</label>
                        <br>
                        <br>';
                }
                ?>
                
                <form action="" id="form-with-personal-data" method="post">
                <?php
                if((isset($_SESSION["zalogowany"]))&&($_SESSION["zalogowany"]==True)){
                    echo '<div>
                    <h1>Another address to ship?</h1>
                    <label for="address">address*</label>
                    <input type="text" class="full-inputs" id="address" required value='.$_SESSION['addressSession'].'>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="town-city">town/city*</label>
                            <input required type="text" name="miasto_rej" value='.$_SESSION['citySession'].'>
                        </div>
                        <div class="half-inputs--element">
                            <label for="post-code">postcode*</label>
                            <input required type="text" name="kod_pocztowy_rej" value='.$_SESSION['zipCodeSession'].'>
                        </div>
                    </div>
                    </div>';
                } else {
                    echo '<h1>billing Details</h1>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="last-name">first name*</label>
                            <input required type="text" name="imie_rej">
                        </div>
                        <div class="half-inputs--element">
                            <label for="last-name">last name*</label>
                            <input required type="text" name="nazwisko_rej">
                        </div>
                    </div>
  
                    <label for="address">address*</label>
                    <input type="text" class="full-inputs" id="address" required>


                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="town-city">town/city*</label>
                            <input required type="text" name="miasto_rej">
                        </div>
                        <div class="half-inputs--element">
                            <label for="post-code">postcode*</label>
                            <input required type="text" name="kod_pocztowy_rej">
                        </div>
                    </div>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="email-address">email address*</label>
                            <input required type="text" name="email_rej">
                        </div>
                        <div class="half-inputs--element">
                            <label for="phone">phone*</label>
                            <input required type="text" name="tel_rej">
                        </div>
                    </div>
                    <div class="checkbox-row">
                        <input required type="checkbox" name="check">
                        <label for="">I have read and accept the <a href="#">Terms &
                            conditions</a></label>
                    </div>';
                }
                ?>
                </form>
                <form action="login-action-checkout.php" id="login-form-checkout" method="post">
                    <label for="login">login</label>
                    <input type="text" id="login" required name="login">
                    <label for="password">password</label>
                    <input type="password" id="password" required name="password">
                    <?php
                    if(isset($_SESSION['errorLoginCheckout'])){
                        echo $_SESSION['errorLoginCheckout'];
                        unset($_SESSION['errorLoginCheckout']);
                    }
                    ?> 
                    <input type="submit" value="Log in" name="submit">
                </form>
            </div>

            <div class="checkout--side__order">
                <h1>Your Order</h1>
                <div class="order--products-total">
                    <p>product</p>
                    <p>total</p>
                </div>
                <div class="order--products-list">
                </div>
                <div class="order-products-price">
                    <h2>order total</h2>
                    <h2 id="checkout-order-total-price">$ 43.00</h2>
                </div>
                <h1>Payments methods</h1>
                <form action="" id="form-with-personal-data-nd">
                    <input type="radio" name="payment" checked><label for="">direct bank transfer</label><br>
                    <input type="radio" name="payment"><label for="">cheque payment</label> <br>
                    <input type="radio" name="payment"><label for="">paypal</label>
                </form>
                <input type="submit" value="place order" name="submit" form="form-with-personal-data">
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="newsletter--text">
            <div class="newsletter--text__heading">
                <h1>Sign up for the newsletter and coupons!</h1>
            </div>
            <div class="newsletter--text__send-box">
                <form action="">
                    <input type="email" class="send-box--input" placeholder="Enter your email address" required>
                    <input type="submit" class="send-box--button" value="subscribe">
                </form>
            </div>
        </div>
    </section>
    <section class="footer" id="contact">
        <div class="footer--contact">
            <h1>+43 943 423 542</h1>
            <h2>diavola@contact.com</h2>
        </div>
        <div class="footer--line">
            <div class="line--block"></div>
            <div class="line--radius">
                <h1>&</h1>
            </div>
            <div class="line--block"></div>
        </div>
        <div class="footer--social-media">
            <ul>
                <li><a href="#facebook" id="fb">Facebook</a></li>
                <li><a href="#twitter" id="tw">Twitter</a></li>
                <li><a href="#Instagram" id="ig">Instagram</a></li>
                <li><a href="#Pinterest" id="pi">Pinterest</a></li>
                <li><a href="#Flickr" id="fl">Flickr</a></li>
            </ul>
        </div>
    </section>
</body>
<script type="module">
    import { NavbarChanging } from './js/navbarChanging.js';
    import { GenerateCheckout } from './js/generateCheckout.js';
</script>

</html>