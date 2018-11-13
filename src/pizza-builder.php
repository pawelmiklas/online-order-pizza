<?php
    session_start();
    require_once "connection.php";
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
            <li><a href="pizza-menu.php" class="navbar--list__link">pizza menu</a></li>
            <li><a href="#" class="navbar--list__link">pizza builder</a></li>
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
        <h1>Pizza builder</h1>
        <div class="banner-pizza-builder--breadcrumb">
            <ul>
                <li><a href="index.php">home</a></li>
                <li>></li>
                <li><a href="pizza-builder.php">pizza builder</a></li>
            </ul>
        </div>
    </section>
    <section class="build-pizza" id="pizza-builder">
        <div class="build-pizza--ingridients build-pizza--ingridients-custom">
            <div class="ingridients--list">
                <div class="ingridients--list__up">
                    <div class="list--up__title">
                        <h1>1.</h1>
                        <h2>choose your crust size</h2>
                    </div>
                    <div class="list--up__btn">
                        <i class="fas fa-angle-up fa-lg fa-angle"></i>
                    </div>
                </div>
                <div class="ingridients--list__down">
                    <div class="down--sizes">
                        <div class="down--sizes__element" data-value="Small" data-price="9.00">
                            <div class="element element-1">
                                <p>9'</p>
                            </div>
                            <p>Small</p>
                        </div>
                        <div class="down--sizes__element" data-value="Medium" data-price="12.00">
                            <div class="element element-2">
                                <p>12'</p>
                            </div>
                            <p>Medium</p>
                        </div>
                        <div class="down--sizes__element" data-value="Large" data-price="15.00">
                            <div class="element element-3">
                                <p>14'</p>
                            </div>
                            <p>Large</p>
                        </div>
                        <div class="down--sizes__element" data-value="Jumbo" data-price="17.00">
                            <div class="element element-4">
                                <p>16'</p>
                            </div>
                            <p>Jumbo</p>
                        </div>
                        <div class="down--sizes__element" data-value="Party" data-price="21.00">
                            <div class="element element-5">
                                <p>18'</p>
                            </div>
                            <p>Party</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ingridients--list">
                <div class="ingridients--list__up">
                    <div class="list--up__title">
                        <h1>2.</h1>
                        <h2>select your sauce</h2>
                    </div>
                    <div class="list--up__btn">
                        <i class="fas fa-angle-up fa-lg fa-angle"></i>
                    </div>
                </div>
                <div class="ingridients--list__down ">
                    <div class="down--ingridients">
                    <?php
                        if($connection->connect_errno!=0){
                            echo '<p>error</p>';
                        }else{
                            $result = $connection->query("SELECT * FROM `products` WHERE `CategoryID`='3'");
                            $allRows = $result->num_rows;
                            for ($i=1; $i <=$allRows; $i++){
                                $row = $result->fetch_assoc();
                                $_SESSION{'name' . $i} = $row['Name'];
                                $_SESSION{'description' . $i} = $row['Description'];
                                $_SESSION{'price' . $i} = $row['Price'];
                                // $connection->close();
                                    echo '
                                    <div class="down--ingridients__sauce without" value='.$_SESSION["name$i"].' data-price='.$_SESSION["price$i"].'>
                                        <i class="fas fa-check-circle fa-2x"></i>
                                        <img src="pic/'.$_SESSION["name$i"].'.png" alt='.$_SESSION["name$i"].'>
                                        <h2>'.$_SESSION["name$i"].'</h2>
                                        <p>'.$_SESSION["description$i"].'</p>
                                        <div class="price" value='.$_SESSION["price$i"].'>
                                            <h2>$'.$_SESSION["price$i"].'</h2>
                                        </div>
                                    </div>
                                    ';
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
            <div class="ingridients--list">
                <div class="ingridients--list__up">
                    <div class="list--up__title">
                        <h1>3.</h1>
                        <h2>add cheese</h2>
                    </div>
                    <div class="list--up__btn activex">
                        <i class="fas fa-angle-down fa-lg fa-angle"></i>
                    </div>
                </div>
                <div class="ingridients--list__down ingridients--list__down-hide">
                    <div class="down--ingridients">
                    <?php
                        if($connection->connect_errno!=0){
                            echo '<p>error</p>';
                        }else{
                            $result = $connection->query("SELECT * FROM `products` WHERE `CategoryID`='2'");
                            $allRows = $result->num_rows;
                            for ($i=1; $i <=$allRows; $i++){
                                $row = $result->fetch_assoc();
                                $_SESSION{'name' . $i} = $row['Name'];
                                $_SESSION{'description' . $i} = $row['Description'];
                                $_SESSION{'price' . $i} = $row['Price'];
                                // $connection->close();
                                    echo '
                                    <div class="down--ingridients__sauce without" value='.$_SESSION["name$i"].' data-price='.$_SESSION["price$i"].'>
                                        <i class="fas fa-check-circle fa-2x "></i>
                                        <img src="pic/'.$_SESSION["name$i"].'.png" alt='.$_SESSION["name$i"].'>
                                        <h2>'.$_SESSION["name$i"].'</h2>
                                        <p>'.$_SESSION["description$i"].'</p>
                                        <div class="price" value='.$_SESSION["price$i"].'>
                                            <h2>$'.$_SESSION["price$i"].'</h2>
                                        </div>
                                    </div>
                                    ';
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
            <div class="ingridients--list">
                <div class="ingridients--list__up">
                    <div class="list--up__title">
                        <h1>4.</h1>
                        <h2>choose your toppings</h2>
                    </div>
                    <div class="list--up__btn activex">
                        <i class="fas fa-angle-down fa-lg fa-angle"></i>
                    </div>
                </div>
                <div class="ingridients--list__down ingridients--list__down-hide">
                    <div class="down--ingridients">
                    <?php
                        if($connection->connect_errno!=0){
                            echo '<p>error</p>';
                        }else{
                            $result = $connection->query("SELECT * FROM `products` WHERE `CategoryID`='1'");
                            $allRows = $result->num_rows;
                            for ($i=1; $i <=$allRows; $i++){
                                $row = $result->fetch_assoc();
                                $_SESSION{'name' . $i} = $row['Name'];
                                $_SESSION{'description' . $i} = $row['Description'];
                                $_SESSION{'price' . $i} = $row['Price'];
                                // $connection->close();
                                    echo '
                                    <div class="down--ingridients__sauce without" value='.$_SESSION["name$i"].' data-price='.$_SESSION["price$i"].' >
                                        <i class="fas fa-check-circle fa-2x "></i>
                                        <img src="pic/'.$_SESSION["name$i"].'.png" alt='.$_SESSION["name$i"].'>
                                        <h2>'.$_SESSION["name$i"].'</h2>
                                        <p>'.$_SESSION["description$i"].'</p>
                                        <div class="price" >
                                            <h2>$'.$_SESSION["price$i"].'</h2>
                                        </div>
                                    </div>
                                    ';
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pizza-builder__checkout">
            <h1>Your Order</h1>
            <div class="order--products-total">
                <p>product</p>
                <p>total</p>
            </div>
            <div class="order--products-list" id="product-list-order">
                <div class="order--products-list__item">
                    <div class="item--item-with-amount">
                        <p></p>
                        <p></p>
                    </div>
                    <p></p>
                </div>
            </div>
            <div class="order--products-list__item">
                <div class="item--item-with-amount">
                    <p>Pizza size: &nbsp;</p>
                    <p id="size-crust-pizza">-</p>
                </div>
                <p id="price-crust-pizza">-</p>
            </div>
            <div class="order-products-price fixed-bottom">
                <h2>order total</h2>
                <h2 id="order-total-price">$ 0.00</h2>
            </div>
            <input type="submit" value="ADD TO CARD" id="add-to-card">
            <input type="submit" value="ADD AND CREATE ANOTHER PIZZA" id="buy-btn2">
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
    // import { SizeOfCrust } from './js/sizeOfCrust.js';
    import { CheckCircle } from './js/checkCircle.js';
    import { DropdownList } from './js/dropdownList.js';
</script>


</html>