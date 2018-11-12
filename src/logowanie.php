<?php
session_start();
   $login = $_POST['login'];
   $password = $_POST['password'];
    //usuwanie zapamietanych sesyjnych i bledow
    if(isset($_SESSION['loginSession'])) unset($_SESSION['loginSession']);
    if(isset($_SESSION['passwordSession'])) unset($_SESSION['passwordSession']);
    //if(isset($_SESSION['zap_login2'])) unset($_SESSION['zap_haslo2']);
    if(isset($_SESSION['emailSession'])) unset($_SESSION['emailSession']);

    if(isset($_SESSION['blad_login'])) unset($_SESSION['blad_login']);
    if(isset($_SESSION['blad_haslo'])) unset($_SESSION['blad_haslo']);
    //if(isset($_SESSION['blad_haslo2'])) unset($_SESSION['blad_haslo2']);
    if(isset($_SESSION['blad_email'])) unset($_SESSION['blad_email']);
    if(isset($_SESSION['blad_regulamin'])) unset($_SESSION['blad_regulamin']);

    require_once "polaczenie.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno!=0){
        echo "No connection to the database: ".$conn->connect_errno;
    } else {
        $login = $_POST["login"];
        $password = $_POST["password"];
        if($result = $conn->query("SELECT * FROM customer WHERE Login='$login' AND Password='$password'")){
            $users = $result->num_rows;
            if($users > 0){
                $_SESSION['zalogowany'] = True;
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $row['Login'];
                unset($_SESSION['error']);
                $result->free_result();
                header('Location: index.php');
            } else {
              $_SESSION['error'] = "<div style='text-align:left;font-size: 15px;'>"."<span style='color:red;'>Incorrect login or password</span>"."</div>";
              header('Location: login.php');
            }
        }
      $conn->close();
    }
?>