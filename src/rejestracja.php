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
        if($polaczenie->connect_errno!=0){
          echo '<p>jakis problem jest </p>';
        }else{
            $rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE login='$login'");
            $ile_loginow = $rezultat->num_rows;
            if($ile_loginow>0){
                $ok = False;
                $_SESSION['blad_login'] = "Taki login już istnieje";
            } else {
                $ok = True;
            }
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
        if((strlen($haslo)<5)){
            $ok = False;
            $_SESSION['blad_haslo'] = "Hasło musi składać się minimum z 5 znaków";
        }
        if($haslo!=$haslo2){
            $ok=False;
            $_SESSION['blad_haslo2'] = "Hasła nie są takie same!";
        }

        if(!isset($_POST['check'])){
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


        if($ok==True){
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            if (mysqli_connect_errno() != 0){
                echo '<p>Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</p>';
            } else {
               $wynik = @$polaczenie -> query("INSERT INTO uzytkownicy (id_uzytkownika, login, haslo, email, nr_telefonu, data_rejestracji, imie, nazwisko, adres, miasto, kod_pocztowy) VALUES ('', '$login','$haslo','$email','$nr_telefonu', '$today', '$imie','$nazwisko','$adres','$miasto','$kod_pocztowy')");
//                $wynik2 = @$polaczenie -> query("INSERT INTO dateczka (id_data, data) VALUES ('','NOW()')");
            }

            if ($wynik == false)            {
                echo '<p>Zapytanie nie zostało wykonane poprawnie!</p>';
                $polaczenie -> close();
            } else {
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
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
</head>

<body>
<nav class="navigation">
        <div class="wrapper wrapper--flex animated bounceInDown delay-2s">
            <div class="wrapper__element">
                <p><a href="index.php">pasar</a></p>
            </div>
            <div class="wrapper__element">
            </div>
        </div>
    </nav>
    <div class="register">
        <div id="container">
            <form method="post" class="register__form">
                <label for="imie_rej">Imie</label>
                <input required type="text" name="imie_rej" value="<?php
                         if(isset($_SESSION['zap_imie']))
                         {
                             echo $_SESSION['zap_imie'];
                             unset ($_SESSION['zap_imie']);
                            }

                            ?>">
                <label for="nazwisko_rej">Nazwisko</label>
                <input required type="text" name="nazwisko_rej" value="<?php
                         if(isset($_SESSION['zap_nazwisko']))
                         {
                             echo $_SESSION['zap_nazwisko'];
                             unset ($_SESSION['zap_nazwisko']);
                            }

                            ?>">
                <label for="adres_rej">Ulica/nr</label>
                <input required type="text" name="adres_rej" value="<?php
                         if(isset($_SESSION['zap_adres']))
                         {
                             echo $_SESSION['zap_adres'];
                             unset ($_SESSION['zap_adres']);
                            }

                            ?>">
                <label for="miasto_rej">Miasto</label>
                <input required type="text" name="miasto_rej" value="<?php
                         if(isset($_SESSION['zap_miasto']))
                         {
                             echo $_SESSION['zap_miasto'];
                             unset ($_SESSION['zap_miasto']);
                            }

                            ?>">
                <label for="kod_pocztowy_rej">Kod pocztowy</label>
                <input required type="text" name="kod_pocztowy_rej" value="<?php
                         if(isset($_SESSION['zap_kod_pocztowy']))
                         {
                             echo $_SESSION['zap_kod_pocztowy'];
                             unset ($_SESSION['zap_kod_pocztowy']);
                            }

                            ?>">
                <label for="login_rej">Login</label>
                <input required type="text" name="login_rej" value="<?php
                         if(isset($_SESSION['zap_login']))
                         {
                             echo $_SESSION['zap_login'];
                             unset ($_SESSION['zap_login']);
                            }

                            ?>">
                <?php
                if(isset($_SESSION['blad_login']))
                {
                    echo "<div class='blad form__error'>".$_SESSION['blad_login']."</div>";
                    unset($_SESSION['blad_login']);
                }
                ?>
                <label for="haslo_rej">Hasło</label>
                <input required type="password" name="haslo_rej" value="<?php
                         if(isset($_SESSION['zap_haslo1']))
                         {
                             echo $_SESSION['zap_haslo1'];
                             unset ($_SESSION['zap_haslo1']);
                            }

                            ?>">
                <?php
                if(isset($_SESSION['blad_haslo']))
                {
                    echo "<div class='blad form__error'>".$_SESSION['blad_haslo']."</div>";
                    unset($_SESSION['blad_haslo']);
                }
                ?>
                <label for="miasto_rej2">Hasło</label>
                <input required type="password" name="haslo_rej2" value="<?php
                         if(isset($_SESSION['zap_haslo2']))
                         {
                             echo $_SESSION['zap_haslo2'];
                             unset ($_SESSION['zap_haslo2']);
                            }

                            ?>">
                <?php
                if(isset($_SESSION['blad_haslo2']))
                {
                    echo "<div class='blad form__error'>".$_SESSION['blad_haslo2']."</div>";
                    unset($_SESSION['blad_haslo2']);
                }
                ?>
                <label for="email_rej">Email</label>
                <input required type="text" name="email_rej" value="<?php
                         if(isset($_SESSION['zap_email']))
                         {
                             echo $_SESSION['zap_email'];
                             unset ($_SESSION['zap_email']);
                            }

                            ?>">
                <?php
                if(isset($_SESSION['blad_email']))
                {
                    echo "<div class='blad form__error'>".$_SESSION['blad_email']."</div>";
                    unset($_SESSION['blad_email']);
                }
                ?>
                <label for="tel_rej">Numer telefonu</label>
                <input required type="text" name="tel_rej" value="<?php
                         if(isset($_SESSION['zap_tel']))
                         {
                             echo $_SESSION['zap_tel'];
                             unset ($_SESSION['zap_tel']);
                            }

                            ?>">
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

                <input type="submit" name="submit" value="Zarejestruj!">
            </form>
        </div>
    </div>



</body>

</html>