<?php
    session_start();
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
            <li><a href="index.html#contact" class="navbar--list__link">contact</a></li>
            <li><a href="#" class="navbar--list__link special">login</a></li>
        </ul>
    </nav>
    <section class="login">
        <div class="login--form">
            <form action="logowanie.php" id="login__form" method="post">
                <label for="login">login</label>
                <input type="text" id="login" required name="login">
                <label for="password">password</label>
                <input type="password" id="password" required name="haslo">
                <input type="submit" value="Sign in" name="submit">
            </form>
        </div>
    </section>
</body>
<script type="module">
import { NavbarChanging } from './js/navbarChanging.js';</script>

</html>