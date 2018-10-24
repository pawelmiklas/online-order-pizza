<?php
    session_start();
    error_reporting(1);
    if(isset($_POST['login_rej']))
    {
        $ok = True;
        $imie = $_POST['imie_rej'];
        $nazwisko = $_POST['nazwisko_rej'];
        $adres = $_POST['adres_rej'];
        $miasto = $_POST['miasto_rej'];
        $kod_pocztowy = $_POST['kod_pocztowy_rej'];

        $login = $_POST['login_rej'];
        $haslo = $_POST['haslo_rej'];
        $haslo2 = $_POST['haslo_rej2'];
        $email = $_POST['email_rej'];
        $nr_telefonu = $_POST['tel_rej'];
//        $data_rejestracji NOW();
         $today = date("Y-m-d H:i:s");
        //sprawdzanie loginu
        if((strlen($login)<3) || (strlen($login)>20))
        {
            $ok = False;
            $_SESSION['blad_login'] = "Login musi mieć od 3 do 20 znaków";
        }
        if(ctype_alnum($login)==False)
        {
            $ok=False;
            $_SESSION['blad_login'] = "Login nie może zawierać znaków specjalynch (tylko litery i cyfry)";
        }



        //czy login istnieje?
        require_once "polaczenie.php";

        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

        if($polaczenie->connect_errno!=0)
        {
          echo '<p>jakis problem jest </p>';
        }
        else
        {
            $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE login='$login'");


            $ile_loginow = $rezultat->num_rows;
            if($ile_loginow>0)
            {
                $ok = False;
                $_SESSION['blad_login'] = "Taki login już istnieje";
            }
            else
                $ok = True;

          $polaczenie->close();
        }


        //sprawdzanie maila

//
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
//        {
//            $ok=False;
//            $_SESSION['blad_email'] = "Podaj poprawny adres email";
//        }
//
        //sprawdzanie haseł
        if((strlen($haslo)<5))
        {
            $ok = False;
            $_SESSION['blad_haslo'] = "Hasło musi składać się minimum z 5 znaków";
        }
        if($haslo!=$haslo2)
        {
            $ok=False;
            $_SESSION['blad_haslo2'] = "Hasła nie są takie same!";
        }





        if(!isset($_POST['check']))
        {
            $ok=False;
            $_SESSION['blad_regulamin'] = "Nie zaakceptowałeś regulaminu";
        }

        require_once "polaczenie.php";


        //zapamietywanie danych

        $_SESSION['zap_login'] = $login;
        $_SESSION['zap_haslo1'] = $haslo;
        $_SESSION['zap_haslo2'] = $haslo2;
        $_SESSION['zap_email'] = $email;
        $_SESSION['zap_tel'] = $nr_telefonu;
//        $_SESSION['zap_rej'] = $data_rejestracji;
         $_SESSION['zap_imie'] = $imie;
        $_SESSION['zap_nazwisko'] = $nazwisko;
        $_SESSION['zap_adres'] = $adres;
        $_SESSION['zap_miasto'] = $miasto;
        $_SESSION['zap_kod_pocztowy'] = $kod_pocztowy;


        if($ok==True)
        {


            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            if (mysqli_connect_errno() != 0){
                echo '<p>Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</p>';
            }
            else
            {
               $wynik = @$polaczenie -> query("INSERT INTO uzytkownicy (id_uzytkownika, login, haslo, email, nr_telefonu, data_rejestracji, imie, nazwisko, adres, miasto, kod_pocztowy) VALUES ('', '$login','$haslo','$email','$nr_telefonu', '$today', '$imie','$nazwisko','$adres','$miasto','$kod_pocztowy')");

//                $wynik2 = @$polaczenie -> query("INSERT INTO dateczka (id_data, data) VALUES ('','NOW()')");
            }



            if ($wynik == false)
            {
                echo '<p>Zapytanie nie zostało wykonane poprawnie!</p>';
                $polaczenie -> close();
            }
                else {
                    $_SESSION['okrejestracja'] = True;

                    echo "<div style='color: white; margin-top: 25%; margin-left: auto; margin-right: auto; font-size: 20px;
          width: 600px; height: 70px; background-color: rgb(38, 126, 226);text-align: center; line-height: 70px; border-radius: 10px;'>"."<p>Dziękujemy za rejestrację!</p>"."</div>";
                    sleep(2);
                    header('Refresh: 2; url=index.php');



                    $polaczenie -> close();
                }
                exit();
        }
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
            <a href="index.html" class="navbar--logo">diavola</a>
            <span id="navbar--toggle">
                <i class="fas fa-bars"></i>
            </span>
        </div>
        <ul id="navbar--list">
            <li><a href="index.html" class="navbar--list__link">home</a></li>
            <li><a href="pizza-menu.html" class="navbar--list__link">pizza menu</a></li>
            <li><a href="pizza-builder.html" class="navbar--list__link">pizza builder</a></li>
            <li><a href="index.html#about-us" class="navbar--list__link">about us</a></li>
            <li><a href="#contact" class="navbar--list__link">contact</a></li>
            <li><a href="login.html" class="navbar--list__link special">login</a></li>
        </ul>
    </nav>
    <section class="banner-pizza-builder">
        <h1>Checkout</h1>
        <div class="banner-pizza-builder--breadcrumb">
            <ul>
                <li><a href="index.html">home</a></li>
                <li>></li>
                <li><a href="#">Checkout</a></li>
            </ul>
        </div>
    </section>
    <section class="checkout">
        <div class="checkout--side">
            <div class="checkout--side__billing-details">
                <form action="" id="form-with-personal-data" method="post">
                    <h1>billing Details</h1>
                    <label for="country">country</label>
                    <select name="country" class="full-inputs" id="country" required>
                        <option value="" selected="true" disabled="disabled">Country...</option>
                        <option value="AF">Afghanistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                    </select>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                        <label for="last-name">first name*</label>
                        <input required type="text" name="imie_rej" value="<?php
                         if(isset($_SESSION['zap_imie']))
                         {
                             echo $_SESSION['zap_imie'];
                             unset ($_SESSION['zap_imie']);
                            }

                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="last-name">last name*</label>
                            <input required type="text" name="nazwisko_rej" value="<?php
                         if(isset($_SESSION['zap_nazwisko']))
                         {
                             echo $_SESSION['zap_nazwisko'];
                             unset ($_SESSION['zap_nazwisko']);
                            }

                            ?>">
                        </div>
                    </div>
                    <div class="half-inputs">
                        <div class="half-inputs--element">

                            <!-- <label for="company-name">company name</label>
                            <input type="text" class="full-inputs" id="company-name"> -->
                            <label for="login_rej">Login</label>
                            <input required type="text" name="login_rej" value="<?php
                         if(isset($_SESSION['zap_login']))
                         {
                             echo $_SESSION['zap_login'];
                             unset ($_SESSION['zap_login']);
                            }
                            
                            ?>"> 
                            </div>
                            <div class="half-inputs--element">

                                <label for="haslo_rej">Hasło</label>
                                <input  class="full-inputs" required type="password" name="haslo_rej" value="<?php
                         if(isset($_SESSION['zap_haslo1']))
                         {
                             echo $_SESSION['zap_haslo1'];
                             unset ($_SESSION['zap_haslo1']);
                            }
                            
                            ?>"> 
                            </div>
                            
                            
                        </div>
                            <label for="miasto_rej2">Hasło</label>
                <input required class="full-inputs" type="password" name="haslo_rej2" value="<?php
                         if(isset($_SESSION['zap_haslo2']))
                         {
                             echo $_SESSION['zap_haslo2'];
                             unset ($_SESSION['zap_haslo2']);
                            }

                            ?>"> <br>
                    <label for="address">address*</label>
                    <input type="text" class="full-inputs" placeholder="Street address" id="address" required>
                    
                   
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                        <label for="town-city">town/city*</label>
                    <input required type="text" name="miasto_rej" value="<?php
                         if(isset($_SESSION['zap_miasto']))
                         {
                             echo $_SESSION['zap_miasto'];
                             unset ($_SESSION['zap_miasto']);
                            }

                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="post-code">postcode*</label>
                            <input required type="text" name="kod_pocztowy_rej" value="<?php
                         if(isset($_SESSION['zap_kod_pocztowy']))
                         {
                             echo $_SESSION['zap_kod_pocztowy'];
                             unset ($_SESSION['zap_kod_pocztowy']);
                            }

                            ?>">
                        </div>
                    </div>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="email-address">email address*</label>
                            <input required type="text" name="email_rej" value="<?php
                         if(isset($_SESSION['zap_email']))
                         {
                             echo $_SESSION['zap_email'];
                             unset ($_SESSION['zap_email']);
                            }

                            ?>"> 
                        </div>
                        <div class="half-inputs--element">
                            <label for="phone">phone*</label>
                            <input required type="text" name="tel_rej" value="<?php
                         if(isset($_SESSION['zap_tel']))
                         {
                             echo $_SESSION['zap_tel'];
                             unset ($_SESSION['zap_tel']);
                            }

                            ?>">
                        </div>
                    </div>
                    <span class="checkbox-row">
                        <input required type="checkbox" name="check">
                        <label for="">Akceptuję regulamin</label>
                        &nbsp;
                            <?php
                                if(isset($_SESSION['blad_regulamin']))
                                {
                                    echo "<div class='blad form__error'>".$_SESSION['blad_regulamin']."</div>";
                                    unset($_SESSION['blad_regulamin']);
                                }
                            ?>
                    </span>
                    <!-- <div class="checkbox-element">
                        <input type="checkbox" id="create-account" placeholder="create-account">
                        <label for="create-account">Create an account?</label>
                    </div> -->
                    <h1 class="shipping-address-h1">shipping address</h1>
                    <label for="create-account2">order notes</label>
                    <textarea name="" id="create-account2" maxlength="255" placeholder="Notes about your order"></textarea>
                    <input type="submit" name="submit" value="Zarejestruj!">
                </form>
            </div>



            <div class="checkout--side__order">
                <h1>Your Order</h1>
                <div class="order--products-total">
                    <p>product</p>
                    <p>total</p>
                </div>
                <div class="order--products-list">
                    <div class="order--products-list__item">
                        <div class="item--item-with-amount">
                            <p>pizza &nbsp;</p>
                            <p> x1</p>
                        </div>
                        <p>30.00</p>
                    </div>
                    <div class="order--products-list__item">
                        <div class="item--item-with-amount">
                            <p>pizza &nbsp;</p>
                            <p> x1</p>
                        </div>
                        <p>30.00</p>
                    </div>
                    <div class="order--products-list__item">
                        <div class="item--item-with-amount">
                            <p>pizza &nbsp;</p>
                            <p> x1</p>
                        </div>
                        <p>30.00</p>
                    </div>
                    <div class="order--products-list__item">
                        <div class="item--item-with-amount">
                            <p>pizza &nbsp;</p>
                            <p> x1</p>
                        </div>
                        <p>30.00</p>
                    </div>
                </div>
                <div class="order-products-price">
                    <h2>order total</h2>
                    <h2>$ 43.00</h2>
                </div>
                <h1>Payments methods</h1>
                <form action="" id="form-with-personal-data-nd">
                    <input type="radio" name="payment" checked><label for="">direct bank transfer</label><br>
                    <input type="radio" name="payment"><label for="">cheque payment</label> <br>
                    <input type="radio" name="payment"><label for="">paypal</label> <br> <br> <br>
                    <input type="radio" required> <label for="">I have read and accept the <a href="#">Terms &
                            conditions</a></label>
                </form>
                <input type="submit" value="place order">
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
</script>

</html>