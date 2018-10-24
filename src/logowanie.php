<?php
session_start();
//    $login = $_POST['login'];
//    $haslo = $_POST['haslo'];

    if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
//        header('Location: index.php');
        echo "nie istnieje taki uzytkownik";
        exit();
    }

//usuwanie zapamietanych sesyjnych i bledow

if(isset($_SESSION['zap_login'])) unset($_SESSION['zap_login']);
if(isset($_SESSION['zap_haslo1'])) unset($_SESSION['zap_haslo1']);
//if(isset($_SESSION['zap_login2'])) unset($_SESSION['zap_haslo2']);
if(isset($_SESSION['zap_email'])) unset($_SESSION['zap_email']);

if(isset($_SESSION['blad_login'])) unset($_SESSION['blad_login']);
if(isset($_SESSION['blad_haslo'])) unset($_SESSION['blad_haslo']);
//if(isset($_SESSION['blad_haslo2'])) unset($_SESSION['blad_haslo2']);
if(isset($_SESSION['blad_email'])) unset($_SESSION['blad_email']);
if(isset($_SESSION['blad_regulamin'])) unset($_SESSION['blad_regulamin']);



    require_once "polaczenie.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Nie udalo sie polaczyc z bazą: ".$polaczenie->connect_errno;
    }
    else
    {
        $login = $_POST["login"];
        $haslo = $_POST["haslo"];
        $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='$haslo'";

        if($rezultat_zapytania = @$polaczenie->query($sql))
        {
            $ilu_userow = $rezultat_zapytania->num_rows;
            if($ilu_userow>0)
            {
                $_SESSION['zalogowany'] = True;

                $wiersz = $rezultat_zapytania->fetch_assoc();
                $_SESSION['user'] = $wiersz['login'];

                unset($_SESSION['error']);
                $rezultat_zapytania->free_result();
                header('Location: index.php');


            } else
            {

              $_SESSION['error'] = "<div style='text-align:center;font-size: 15px;'>"."<span style='color:red;'>Nieprawidłowy login lub hasło</span>"."</div>";
              header('Location: index.php');

            }
        }

      $polaczenie->close();
    }




?>

