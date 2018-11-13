<?php
session_start();
    if(isset($_SESSION['loginSession'])) unset($_SESSION['loginSession']);
    if(isset($_SESSION['passwordSession'])) unset($_SESSION['passwordSession']);
    //if(isset($_SESSION['zap_login2'])) unset($_SESSION['zap_haslo2']);
    if(isset($_SESSION['emailSession'])) unset($_SESSION['emailSession']);

    if(isset($_SESSION['blad_login'])) unset($_SESSION['blad_login']);
    if(isset($_SESSION['blad_haslo'])) unset($_SESSION['blad_haslo']);
    //if(isset($_SESSION['blad_haslo2'])) unset($_SESSION['blad_haslo2']);
    if(isset($_SESSION['blad_email'])) unset($_SESSION['blad_email']);
    if(isset($_SESSION['blad_regulamin'])) unset($_SESSION['blad_regulamin']);

    require_once "connection.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno!=0){
        echo "No connection to the database: ".$conn->connect_errno;
    } else {
        $login = $_POST["login"];
        $password = $_POST["password"];
        $login = htmlentities($login,ENT_QUOTES,"UTF-8");

        if($result = @$conn->query(
        sprintf("SELECT * FROM customer WHERE Login='%s'",
        mysqli_real_escape_string($conn,$login)))){
            $users = $result->num_rows;
            if($users > 0){
                $row = $result->fetch_assoc();
                if (password_verify($password,$row['Password'])){
                    $_SESSION['zalogowany'] = True;
                    $_SESSION['user'] = $row['Login'];
                    unset($_SESSION['error']);
                    $result->free_result();
                    header('Location: checkout.php');
                } else {
                    $_SESSION['errorLoginCheckout'] = "<div style='text-align:left;font-size: 15px;'>"."<span style='color:red;'>Incorrect login or password</span>"."</div>";
                    header('Location: checkout.php');
                }
            } else {
              $_SESSION['errorLoginCheckout'] = "<div style='text-align:left;font-size: 15px;'>"."<span style='color:red;'>Incorrect login or password!</span>"."</div>";
              header('Location: checkout.php');
            }
        }
      $conn->close();
    }
?>