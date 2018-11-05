<?php
    session_start();
    require_once "polaczenie.php";
    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
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
            <li><a href="#" class="navbar--list__link">pizza menu</a></li>
            <li><a href="pizza-builder.php" class="navbar--list__link">pizza builder</a></li>
            <li><a href="index.php#about-us" class="navbar--list__link">about us</a></li>
            <li><a href="#contact" class="navbar--list__link">contact</a></li>
            <li class="list-special">
                <?php

                    if((isset($_SESSION["zalogowany"]))&&($_SESSION["zalogowany"]==True)){
                        echo '<p>'.$_SESSION['user'].'</p>';
                        // echo '<i class="far fa-user fa-2x"></i>';
                        // echo '<a href="account-settings.php"><p>'.$_SESSION['user'].'</p></a>';
                        echo '<a href="wyloguj.php" class="navbar--list__link link-special"><input type="button" value="Logout" class="subpage-input"></a>';
                    //                  echo "<span>".$_SESSION['user']."</span>";
                    }
                    else{
                        // echo '<input type="button" id="btn-to-login" value="Log In" class="subpage-input">';
                        echo '<a href="login.php" class="navbar--list__link special" value="Log In">login</a>';
                    }
                    ?>
            </li>
        </ul>
    </nav>
    <section class="banner-pizza-builder">
        <h1>Pizza menu</h1>
        <div class="banner-pizza-builder--breadcrumb">
            <ul>
                <li><a href="index.html">home</a></li>
                <li>></li>
                <li><a href="#">pizza menu</a></li>
            </ul>
        </div>
    </section>
    <section class="pizza-menu">
        <div class="pizza-menu--list">
            <div class="pizza-menu--list__line"></div>
            <?php
            if($connection->connect_errno!=0){
                echo '<p>jakis problem jest </p>';
              }else{
                  $result = $connection->query("SELECT * FROM `products` WHERE `CategoryID`='5'");
                  $allRows = $result->num_rows;
                  for ($i=1; $i <=$allRows; $i++){
                    $row = $result->fetch_assoc();
                    $_SESSION{'name' . $i} = $row['Name'];
                    $_SESSION{'description' . $i} = $row['Description'];
                    $_SESSION{'price' . $i} = $row['Price'];
                    // $connection->close();
                        echo '<div class="pizza-menu--list__item" data-name='.$_SESSION["name$i"].' data-price='.$_SESSION["price$i"].' data-fixedprice='.$_SESSION["price$i"].'>
                            <img src="pic/pizza-1.png" alt='.$_SESSION["name$i"].'>
                            <h2 class="name-of-pizza" >
                                '.$_SESSION["name$i"].'
                            </h2>
                            <p>
                                '.$_SESSION["description$i"].'
                            </p>
                            <div class="price price-of-pizza" >
                                <h2>
                                    $'.$_SESSION["price$i"].'
                                </h2>
                            </div>
                            <div class="item--size-to-order__hide"></div>
                            <div class="item--size-to-order">
                                <form action="">
                                    <select name="size" class='.$_SESSION["name$i"].' data-price='.$_SESSION["price$i"].'>
                                        <option value="0" selected>small</option>
                                        <option value="3">medium</option>
                                        <option value="5">large</option>
                                        <option value="7">jumbo</option>
                                        <option value="9">party size</option>
                                    </select>
                                </form>
                            </div>
                        </div>';
                }
              }
            ?>
            <div class="pizza-menu--list__line"></div>
        </div>
        <div class="pizza-menu__checkout">
            <h1>Your Order</h1>
            <div class="order--products-total">
                <p>product</p>
                <p>total</p>
            </div>
            <div class="order--products-list" id="list-of-pizzas">
                <div class="order--products-list__item">
                    <div class="item--item-with-amount">
                        <p><p>
                        <p></p>
                    </div>
                    <p></p>
                </div>
            </div>
            <div class="order-products-price fixed-bottom">
                <h2>order total</h2>
                <h2 id="total-price">$ 0.00</h2>
            </div>
            <input type="submit" value="ADD TO CARD">
            <input type="submit" value="BUY" id="buy-btn">
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
                <li><a href="#facebook">Facebook</a></li>
                <li><a href="#twitter">Twitter</a></li>
                <li><a href="#Instagram">Instagram</a></li>
                <li><a href="#Pinterest">Pinterest</a></li>
                <li><a href="#Flickr">Flickr</a></li>
            </ul>
        </div>
    </section>
</body>
<script type="module">
    import { NavbarChanging } from './js/navbarChanging.js';
    // import { CheckCircle } from './js/checkCircle.js';
    import { CheckPizzaAtMenu } from './js/checkPizzaAtMenu.js';
</script>

</html>