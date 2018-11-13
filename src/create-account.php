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
        $today = date("Y-m-d H:i:s");

        if((strlen($login)<3) || (strlen($login)>20)){
            $ok = False;
            $_SESSION['loginError'] = "<p class='register-error-message'>Login must be between 3 and 20 characters long</p>";
        }
        if(ctype_alnum($login)==False){
            $ok=False;
            $_SESSION['loginError'] = "<p class='register-error-message'>The login can not contain special characters (only letters and numbers)</p>";
        }

        require_once "connection.php";
        $conn = @new mysqli($host, $db_user, $db_password, $db_name);
        if($conn->connect_errno!=0){
          echo '<p>ERROR</p>';
        }else{
            $result = $conn->query("SELECT * FROM customer WHERE Login='$login'");
            $logins = $result->num_rows;
            if($logins>0){
                $ok = False;
                $_SESSION['loginError'] = "<p class='register-error-message'>This login already exists</p>";
            } else {
                $ok = True;
            }
            $result2 = $conn->query("SELECT * FROM customer WHERE Email='$email'");
            $logins2 = $result2->num_rows;
            if($logins2>0){
                $ok = False;
                $_SESSION['emailError'] = "<p class='register-error-message register-error-message-top'>This email already exists</p>";
            } else {
                $ok = True;
            }
            $result3 = $conn->query("SELECT * FROM customer WHERE PhoneNumber='$phoneNumber'");
            $logins3 = $result3->num_rows;
            if($logins3>0){
                $ok = False;
                $_SESSION['phoneNumberError'] = "<p class='register-error-message register-error-message-top'>This phone number already exists</p>";
            } else {
                $ok = True;
            }
          $conn->close();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $ok=False;
            $_SESSION['emailError'] = "<p class='register-error-message register-error-message-top'>Email address is incorrect!</p>";
        }
        if((strlen($password)<5)){
            $ok = False;
            $_SESSION['passwordError'] = "<p class='register-error-message'>The password must be at least 5 characters long</p>";
        }
        if($password!=$password2){
            $ok=False;
            $_SESSION['passwordError2'] = "<p class='register-error-message'>Passwords are not the same</p>";
        }
        if(!isset($_POST['check'])){
            $ok=False;
            $_SESSION['regulationsError'] = "<p class='register-error-message'>You did not accept the regulations</p>";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        require_once "connection.php";

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
               $wynik = @$conn -> query("INSERT INTO customer (CustomerID, Login, Password, Date, Name, SurName, Email, Address1, City, ZipCode, PhoneNumber) VALUES ('', '$login','$passwordHash','$today', '$name','$lastName','$email','$address','$city','$postalCode','$phoneNumber')");
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
    <section class="login ">
    <div class="checkout--side__billing-details register">
                <form id="register-form" method="post">
                    <h1>Register</h1>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="last-name">first name*</label>
                            <input required type="text" name="nameRegister">
                        </div>
                        <div class="half-inputs--element">
                            <label for="last-name">last name*</label>
                            <input required type="text" name="lastNameRegister">
                        </div>
                    </div>
                    <label for="loginRegister">Login</label><br>
                    <input required type="text" class="full-inputs" name="loginRegister">
                    <?php
                    if(isset($_SESSION['loginError'])){
                        echo $_SESSION['loginError'];
                        unset ($_SESSION['loginError']);
                    } 
                    if(isset($_SESSION['loginDigits'])){
                        echo $_SESSION['loginDigits'];
                        unset ($_SESSION['loginDigits']);
                    } 
                    ?>
                    <div class="half-inputs half-inputs-fixed">
                        <div class="half-inputs--element">
                            <label for="passwordRegister">Password</label>
                            <input class="full-inputs" required type="password" name="passwordRegister">
                            <?php
                            if(isset($_SESSION['passwordError2'])){
                                echo $_SESSION['passwordError2'];
                                unset ($_SESSION['passwordError2']);
                            } 
                            if(isset($_SESSION['passwordError'])){
                                echo $_SESSION['passwordError'];
                                unset ($_SESSION['passwordError']);
                              }
                            ?>
                        </div>
                        <div class="half-inputs--element">
                            <label for="miasto_rej2">Password</label>
                            <input required class="full-inputs" type="password" name="passwordRegister2">
                        </div>
                    </div>
                    <label for="address">address*</label>
                    <input type="text" class="full-inputs" id="address" name="addressRegister"required>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="town-city">town/city*</label>
                            <input required type="text" name="cityRegister">
                        </div>
                        <div class="half-inputs--element">
                            <label for="post-code">postcode*</label>
                            <input required type="text" name="postalCodeRegister">
                        </div>
                    </div>
                    <div class="half-inputs">
                        <div class="half-inputs--element">
                            <label for="email-address">email address*</label>
                            <input required type="text" name="emailRegister">
                            <?php
                                if(isset($_SESSION['emailError'])){
                                    echo $_SESSION['emailError'];
                                    unset ($_SESSION['emailError']);
                                } 
                            ?>
                        </div>
                        <div class="half-inputs--element">
                            <label for="phone">phone*</label>
                            <input required type="text" name="phoneNumberRegister">
                            <?php
                                if(isset($_SESSION['phoneNumberError'])){
                                    echo $_SESSION['phoneNumberError'];
                                    unset ($_SESSION['phoneNumberError']);
                                } 
                            ?>
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