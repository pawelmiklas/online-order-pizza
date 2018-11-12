<?php
    session_start();
    error_reporting(1);
    if(isset($_POST['loginRegister'])){
        $ok = True;
        $name = $_POST['nameRegister'];
        $lastName = $_POST['lastNameRegister'];
        $address = $_POST['addressRegister'];
        $city = $_POST['cityRegister'];
        $postalCode = $_POST['postalCodeRegister'];
        $login = $_POST['loginRegister'];
        $password = $_POST['passwordRegister'];
        $password2 = $_POST['passwordRegister2'];
        $email = $_POST['emailRegister'];
        $phoneNumber = $_POST['phoneNumberRegister'];
//        $data_rejestracji NOW();
        $today = date("Y-m-d H:i:s");

        if((strlen($login)<3) || (strlen($login)>20)){
            $ok = False;
            $_SESSION['loginError'] = "Login must be between 3 and 20 characters long";
        }
        if(ctype_alnum($login)==False){
            $ok=False;
            $_SESSION['loginError'] = "The login can not contain special characters (only letters and numbers)";
        }

        require_once "polaczenie.php";
        $conn = @new mysqli($host, $db_user, $db_password, $db_name);
        if($conn->connect_errno!=0){
          echo '<p>ERROR</p>';
        }else{
            $result = $conn->query("SELECT id FROM customer WHERE login='$login'");
            $logins = $result->num_rows;
            if($logins>0){
                $ok = False;
                $_SESSION['loginError'] = "This login already exists";
            } else {
                $ok = True;
            }
          $conn->close();
        }

//
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
//        {
//            $ok=False;
//            $_SESSION['blad_email'] = "Podaj poprawny adres email";
//        }
//
        if((strlen($password)<5)){
            $ok = False;
            $_SESSION['passwordError'] = "The password must be at least 5 characters long";
        }
        if($password!=$password2){
            $ok=False;
            $_SESSION['passwordError2'] = "Passwords are not the same";
        }
        if(!isset($_POST['check'])){
            $ok=False;
            $_SESSION['regulationsError'] = "You did not accept the regulations";
        }
        require_once "polaczenie.php";

        //zapamietywanie danych

        $_SESSION['loginSession'] = $login;
        $_SESSION['passwordSession'] = $password;
        $_SESSION['passwordSession2'] = $password2;
        $_SESSION['emailSession'] = $email;
        $_SESSION['phoneNumberSession'] = $phoneNumber;
//        $_SESSION['zap_rej'] = $data_rejestracji;
        $_SESSION['nameSession'] = $name;
        $_SESSION['lastNameSession'] = $lastName;
        $_SESSION['addressSession'] = $address;
        $_SESSION['citySession'] = $city;
        $_SESSION['postalCodeSession'] = $postalCode;


        if($ok==True){
            $conn = @new mysqli($host, $db_user, $db_password, $db_name);
            if (mysqli_connect_errno() != 0){
                echo '<p>Connection error: ' . mysqli_connect_error() . '</p>';
            } else {
               $wynik = @$conn -> query("INSERT INTO customer (CustomerID, Login, Password, Date, Name, SurName, Email, Address1, City, ZipCode, PhoneNumber) VALUES ('', '$login','$password','$today', '$name','$lastName','$email','$address','$city','$postalCode','$phoneNumber')");
//                $wynik2 = @$conn -> query("INSERT INTO dateczka (id_data, data) VALUES ('','NOW()')");
            }

            if ($wynik == false)            {
                echo '<p>The query was not carried out correctly!</p>';
                $conn -> close();
            } else {
                $_SESSION['okrejestracja'] = True;
                echo "<div style='color: white; margin-top: 25%; margin-left: auto; margin-right: auto; font-size: 20px;
                width: 600px; height: 70px; background-color: orange;text-align: center; line-height: 70px; border-radius: 10px;'>"."<p>Dziękujemy za rejestrację!</p>"."</div>";
                sleep(2);
                header('Refresh: 2; url=index.php');
                $conn -> close();
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
            <li><a href="index.php#contact" class="navbar--list__link">contact</a></li>
            <li><a href="login.php" class="navbar--list__link special">login</a></li>
        </ul>
    </nav>
    <section class="login ">
    <div class="checkout--side__billing-details register">
                <form id="register-form" method="post">
                    <h1>Register</h1>
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
                            <input required type="text" name="nameRegister" value="<?php
                            if(isset($_SESSION['nameSession'])){
                                echo $_SESSION['nameSession'];
                                unset ($_SESSION['nameSession']);
                                }
                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="last-name">last name*</label>
                            <input required type="text" name="lastNameRegister" value="<?php
                            if(isset($_SESSION['lastNameSession'])){
                                echo $_SESSION['lastNameSession'];
                                unset ($_SESSION['lastNameSession']);
                                }
                            ?>">
                        </div>
                    </div>
                            <label for="loginRegister">Login</label><br>
                            <input required type="text" class="full-inputs" name="loginRegister" value="<?php
                            if(isset($_SESSION['loginSession'])){
                                echo $_SESSION['loginSession'];
                                unset ($_SESSION['loginSession']);
                                }
                            ?>">
                    <div class="half-inputs half-inputs-fixed">
                        <div class="half-inputs--element">
                            <label for="passwordRegister">Password</label>
                            <input class="full-inputs" required type="password" name="passwordRegister" value="<?php
                            if(isset($_SESSION['passwordSession'])){
                                echo $_SESSION['passwordSession'];
                                unset ($_SESSION['passwordSession']);
                              }
                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="miasto_rej2">Password</label>
                            <input required class="full-inputs" type="password" name="passwordRegister2" value="<?php
                            if(isset($_SESSION['passwordSession2'])){
                                echo $_SESSION['passwordSession2'];
                                unset ($_SESSION['passwordSession2']);
                            } 
                            ?>">
                        </div>
                    </div>
                    <label for="address">address*</label>
                    <input type="text" class="full-inputs" id="address" name="addressRegister"required value="<?php
                            if(isset($_SESSION['addressSession'])){
                                echo $_SESSION['addressSession'];
                                unset ($_SESSION['addressSession']);
                                }
                            ?>">
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="town-city">town/city*</label>
                            <input required type="text" name="cityRegister" value="<?php
                            if(isset($_SESSION['citySession'])){
                                echo $_SESSION['citySession'];
                                unset ($_SESSION['citySession']);
                                }
                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="post-code">postcode*</label>
                            <input required type="text" name="postalCodeRegister" value="<?php
                            if(isset($_SESSION['postalCodeSession'])){
                                echo $_SESSION['postalCodeSession'];
                                unset ($_SESSION['postalCodeSession']);
                                }
                            ?>">
                        </div>
                    </div>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="email-address">email address*</label>
                            <input required type="text" name="emailRegister" value="<?php
                            if(isset($_SESSION['emailSession'])){
                                echo $_SESSION['emailSession'];
                                unset ($_SESSION['emailSession']);
                                }
                            ?>">
                        </div>
                        <div class="half-inputs--element">
                            <label for="phone">phone*</label>
                            <input required type="text" name="phoneNumberRegister" value="<?php
                            if(isset($_SESSION['phoneNumberSession'])) {
                                echo $_SESSION['phoneNumberSession'];
                                unset ($_SESSION['phoneNumberSession']);
                                }
                            ?>">
                        </div>
                    </div>
                    <span class="checkbox-row">
                        <input required type="checkbox" name="check">
                        <label for="">I have read and accept the <a href="#">Terms &
                            conditions</a></label>
                        &nbsp;
                        <?php
                            if(isset($_SESSION['regulationsError'])){
                                echo "<div class='+ form__error'>".$_SESSION['regulationsError']."</div>";
                                unset($_SESSION['regulationsError']);
                            }
                        ?>
                    </span>
                   
                </form>
                <div class="for-input">
                    <input type="submit" form="register-form" name="submit" value="Zarejestruj!" id="register-btn">
                </div>
            </div>
    </section>
</body>
<script type="module">
import { NavbarChanging } from './js/navbarChanging.js';</script>

</html>