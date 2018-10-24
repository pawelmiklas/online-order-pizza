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
    <link rel="stylesheet" href="../node_modules/animate.css/animate.min.css">
    <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
    <script src="../node_modules/aos/dist/aos.js"></script>
    <script src="../countUp.js-1.9.3/countUp.js"></script>


</head>

<body>
    <section class="banner">
        <div class="banner--info">
            <h1>Get it while it's hot!</h1>
            <h2>You can create your custom pizzas <br> with the same great quality.</h2>
            <div class="banner--info__btn">
                <a href="pizza-menu.html"><button class="banner--info__btn animated rubberBand delay-2s">ORDER ONLINE</button></a>
            </div>
        </div>
    </section>
    <nav class="navbar">
        <div class="navbar--row">
            <a href="index.html" class="navbar--logo">diavola</a>
            <span id="navbar--toggle">
                <i class="fas fa-bars"></i>
            </span>
        </div>
        <ul id="navbar--list">
            <li><a href="#" class="navbar--list__link">home</a></li>
            <li><a href="pizza-menu.html" class="navbar--list__link">pizza menu</a></li>
            <li><a href="#pizza-builder" class="navbar--list__link">pizza builder</a></li>
            <li><a href="#about-us" class="navbar--list__link">about us</a></li>
            <li><a href="#contact" class="navbar--list__link">contact</a></li>
            <!-- <li><a href="login.php" class="navbar--list__link special">login</a></li> -->
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
    <main>
        <section class="about" id="about-us">
            <div class="about--info">
                <div class="info--title">
                    <h2 class="info--title__header">We are pizza makers, and our mission is to make
                        cool pizza which feeds all yours senses.</h2>
                </div>
                <div class="info--text">
                    <p>I'm beginning to feel like a Rap God, Rap God. All my people from the front to the back nod,
                        back
                        nod.
                        The way I'm racing around the track, call me NASCAR, NASCAR. Dale Earnhardt of the trailer
                        park,
                        the White Trash God.
                        Kneel before General Zod. This planet's Krypton – no, Asgard, Asgard.
                    </p>
                </div>
                <div class="info">
                    <div class="info--column">
                        <div class="info--column__pic"><i class="fab fa-envira fa-3x"></i></div>
                        <div class="info--column__title">
                            <h2>we're careful</h2>
                        </div>
                        <div class="info--column__text">
                            <p> A little bit of weed mixed with some hard liquor. Some vodka that'll jump start my
                                heart
                                quicker. Than a shock when I get shocked at the hospital.</p>
                        </div>
                    </div>
                    <div class="info--column">
                        <div class="info--column__pic"><i class="fas fa-medal fa-3x"></i></div>
                        <div class="info--column__title">
                            <h2>We're certified</h2>
                        </div>
                        <div class="info--column__text">
                            <p> A little bit of weed mixed with some hard liquor. Some vodka that'll jump start my
                                heart
                                quicker. Than a shock when I get shocked at the hospital.</p>
                        </div>
                    </div>
                    <div class="info--column">
                        <div class="info--column__pic"><i class="fas fa-rocket fa-3x"></i></div>
                        <div class="info--column__title">
                            <h2>You're Creative</h2>
                        </div>
                        <div class="info--column__text">
                            <p> A little bit of weed mixed with some hard. Some vodka that'll jump start my heart
                                quicker.
                                Than a shock when I get shocked at the hospital.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="recommend">
            <div class="recommend--elements">
                <div class="recommend--text">
                    <p>We're gonna rock this house until we knock it down. So turn the volume loud. 'Cause it's mayhem
                        'til
                        the
                        A.M.. So, baby, make just like K-Fed. And let yourself go, let yourself go. Say "Fuck it!"
                        before
                        we
                        kick the bucket. Life's too short to not go for broke. So everybody, everybody, go berserk,
                        grab
                        your
                        vial, yeah.</p>
                    <img src="pic/signature.png" alt="signature">
                </div>
                <div class="recommend--pic">
                    <img src="pic/chef.png" alt="chef">
                </div>
            </div>
        </section>
        <section class="build-pizza" id="pizza-builder">
            <div class="build-pizza--title">
                <h1>build your own pizza</h1>
                <p>Can't you see what you do to me, baby?. You make me crazy, you make me act like a maniac. I'm like a
                    lunatic, you make me sick. You're truly the only one who can do this to me. You just make me get so
                    crazy.</p>
            </div>
            <div class="build-pizza--ingridients">
                <div class="ingridients--list">
                    <div class="ingridients--list__up">
                        <div class="list--up__title">
                            <h1>1.</h1>
                            <h2>choose your crust</h2>
                        </div>
                        <div class="list--up__btn activex">
                            <i class="fas fa-angle-down fa-lg fa-angle"></i>
                        </div>
                    </div>
                    <div class="ingridients--list__down ingridients--list__down-hide">
                        <div class="down--border">
                            <div class="down--pic">
                                <img src="pic/pizza-41.jpg" alt="pizza">
                            </div>
                        </div>
                        <div class="down--text">
                            <p>Our pizzas are started on our classic hand tossed crust unless otherwise requested. When
                                choosing an alternate crust style, take into consideration topping and cheese
                                selections to
                                find your perfect match!</p>
                            <ul>
                                <li>Classic Hand-tossed</li>
                                <li>Cracker-thin</li>
                                <li>Hand-tossed Thin</li>
                                <li>Thick</li>
                                <li>Gluten-free</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ingridients--list">
                    <div class="ingridients--list__up">
                        <div class="list--up__title">
                            <h1>2.</h1>
                            <h2>select your sauce</h2>
                        </div>
                        <div class="list--up__btn activex">
                            <i class="fas fa-angle-down fa-lg fa-angle"></i>
                        </div>
                    </div>
                    <div class="ingridients--list__down ingridients--list__down-hide">
                        <div class="down--border">
                            <div class="down--pic">
                                <img src="pic/dips.jpg" alt="dips">
                            </div>
                        </div>
                        <div class="down--text">
                            <p>Same shit, different toilet. Oh, you got a nice ass, darling. Can’t wait to get you into
                                my
                                Benz, take you for a spin. What you mean we ain't fuckin’? You take me for a friend?.
                                Let
                                me tell you the whole story of Shady’s origin.</p>
                            <ul>
                                <li>Pizza Sauce</li>
                                <li>BBQ Sauce</li>
                                <li>No Sauce</li>
                            </ul>
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
                        <div class="down--border">
                            <div class="down--pic">
                                <img src="pic/cheese.jpg" alt="cheese">
                            </div>
                        </div>
                        <div class="down--text">
                            <p>Same shit, different toilet. Oh, you got a nice ass, darling. Can’t wait to get you into
                                my
                                Benz, take you for a spin. What you mean we ain't fuckin’? You take me for a friend?.
                                Let
                                me tell you the whole story of Shady’s origin.</p>
                            <ul>
                                <li>Mozarella</li>
                                <li>Provolone</li>
                                <li>Cheddar</li>
                                <li>Parmesan</li>
                                <li>Ricotta</li>
                            </ul>
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
                        <div class="down--border">
                            <div class="down--pic">
                                <img src="pic/pizza-40.jpg" alt="pizza">
                            </div>
                        </div>
                        <div class="down--text">
                            <p>Same shit, different toilet. Oh, you got a nice ass, darling. Can’t wait to get you into
                                my
                                Benz, take you for a spin. What you mean we ain't fuckin’? You take me for a friend?.
                                Let
                                me tell you the whole story of origin.</p>
                            <ul>
                                <li>Pepperoni</li>
                                <li>Mushromes</li>
                                <li>Onion</li>
                                <li>Fresh Garlic</li>
                                <li>Bracolli</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <a href="pizza-builder.html"><button>create your own pizza</button></a>
        </section>
        <section class="ingridients">
            <div class="ingridients--row" id="chuj">
                <div class="ingridients--row__pair">
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>crusts</p>
                    </div>
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>sauces</p>
                    </div>
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>cheesess</p>
                    </div>
                </div>
                <div class="ingridients--row__pair">
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>veggies</p>
                    </div>
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>meats</p>
                    </div>
                    <div class="ingridients--row__element">
                        <h1 class="element-to-countup">&nbsp;</h1>
                        <p>topings</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="opinions">
            <div class="opinions--elements">
                <div class="opinions--elements__header">
                    <h1>Here's what customers are saying...</h1>
                    <p>Slim Shady please stand up?. We're gonna have a problem here. Jaws all on the floor like Pam
                        like.
                        And started whoopin' her ass worse than before.</p>
                </div>
                <div class="opinions--elements__content">
                    <div class="content" data-aos="flip-left" data-aos-duration="800" data-aos-once="true"
                        data-aos-offset="200">
                        <img src="pic/pizza-1.png" alt="">
                        <p>Hawaii</p>
                        <div class="content--stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="content--opinion">
                            <p>“ I visited just yesterday. and I and more 3 guys orders many menu. I recommend you. ”</p>
                        </div>
                        <div class="content--person">
                            <p>Denis Low</p>
                        </div>
                    </div>
                    <div class="content" data-aos="flip-left" data-aos-duration="800" data-aos-delay="300"
                        data-aos-once="true" data-aos-offset="200">
                        <img src="pic/pizza-2.png" alt="">
                        <p>Cacciatore</p>
                        <div class="content--stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="content--opinion">
                            <p>“ We were like little kids in a candy store.There was live food counters. ”</p>
                        </div>
                        <div class="content--person">
                            <p>Angela Rasselow</p>
                        </div>
                    </div>
                    <div class="content" data-aos="flip-left" data-aos-duration="800" data-aos-delay="600"
                        data-aos-once="true" data-aos-offset="200">
                        <img src="pic/pizza-3.png" alt="">
                        <p>Prosciutto</p>
                        <div class="content--stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="content--opinion">
                            <p>“ Italian Executive Chef. Here you can find the best Italian pizza City. ”</p>
                        </div>
                        <div class="content--person">
                            <p>Andrew Gants</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="newsletter" id="foo">
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
    import { CountUpIngridients } from './js/countUpIngridients.js';
    import { DropdownList } from './js/dropdownList.js';
</script>
<script>
    AOS.init();
</script>

</html>