<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Biskanah - The Best MMO STR</title>
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300" rel="stylesheet" type="text/css" />
    <!-- Included CSS Files -->
    <?php echo $this->Html->css('Home/header'); ?>
    <?php echo $this->Html->css('Home/main'); ?>
    <?php echo $this->Html->css('Home/devices'); ?>
    <?php echo $this->Html->css('Home/paralax_slider'); ?>
    <?php echo $this->Html->css('Home/jquery.fancybox?v=2.1.2'); ?>
    <!--<link rel="stylesheet" href="stylesheets/main.css" />
    <link rel="stylesheet" href="stylesheets/devices.css" />
    <link rel="stylesheet" href="stylesheets/paralax_slider.css" />
    <link rel="stylesheet" href="stylesheets/jquery.fancybox.css?v=2.1.2" type="text/css"  media="screen" />-->
    <!--[if IE]>
    <?php echo $this->Html->css('Home/ie'); ?>
    <!--<link rel="stylesheet" href="stylesheets/ie.css">-->
    <![endif]-->


</head>

<body>

<!--********************************************* Header Start *********************************************--

<div id="switcher">
    <div class="users form login">
        <form action="/users/login" controller="users" id="UserLoginForm" method="post" accept-charset="utf-8">
            <div style="display:none;">
                <input type="hidden" name="_method" value="POST"/>
            </div>
            <div class="center">
                <ul>
                    <li class="username">
                        <div class="input text required">
                            <input name="data[User][username]" maxlength="45" type="text" id="UserUsername" placeholder="Username" required="required"/>
                        </div>
                    </li>
                    <li class="password">
                        <div class="input password required">
                            <input name="data[User][password]" type="password" id="UserPassword" placeholder="************" required="required"/>
                        </div>
                    </li>
                    <li class="submit">
                        <div class="submit">
                            <input  type="submit" value="Login"/>
                        </div>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>

<!--********************************************* Header Stop *********************************************-->

<!--********************************************* Main wrapper Start *********************************************-->
<div id="footer_image">
<div id="main_wrapper">

<!--********************************************* Logo Start *********************************************-->
<div id="logo"> <a href="#"><?php echo $this->Html->image('Home/logo.png',array('alt'=>'alt_example'));?></a>
    <div id="social_ctn">

        <a class="social_t"><?php echo $this->Html->image('Home/social_tleft.png',array('alt'=>'alt_example'));?></a>

        <a href="#" id="rss"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="37px" /></a>
        <a href="#" id="facebook"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="37px" /></a>
        <a href="#" id="twitter"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="37px" /></a>
        <a href="#" id="google_plus"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="37px" /></a>
        <a href="#" id="you_tube"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="37px" /></a>

        <a class="social_t" ><img alt="alt_example" src="/img/Home/social_tright.png" /></a>

    </div>

</div>
<!--********************************************* Logo end *********************************************-->

<!--********************************************* Main_in Start *********************************************-->
<div id="main_in">

<!--********************************************* Mainmenu Start *********************************************-->
<div id="menu_wrapper">
    <div id="menu_left"></div>
    <ul id="menu">
        <li><a href="./index.html">Accueil</a></li>
        <li><a href="./banner2.html">Histoire</a></li>
        <li><a href="./post_list.html">Fonctionnalités</a></li>
        <li><a href="./post.html">Médias</a></li>
        <li><a href="./post_game.html">Forum</a></li>
        <li><a href="./contact.html">Recrutement</a></li>
    </ul>
    <a href="#" id="pull" style="width: 940px;">Menu</a>
    <div id="menu_right"></div>
    <div class="clear"></div>
</div>

<!--********************************************* Mainmenu end *********************************************-->



<!--********************************************* Main start *********************************************-->
<div id="main_news_wrapper">

    <div id="row">
        <!-- Left wrapper Start -->
        <div id="left_wrapper">
            <div class="header">
                <h2><span>Biskanah //</span> Version #alpha en cours de développement</h2>
            </div>
            <ul id="general_news">
                <li>
                    <div class="image"><a href="./post.html"><img alt="alt_example" src="/img/Home/media/full/biskanah-0_7.png" /></a></div>
                    <!--<ul class="social_share">
                        <li><a href="#"><img alt="alt_example" src="/img/Home/fbk.png" border="0" /></a></li>
                        <li><a href="#"><img alt="alt_example" src="/img/Home/twitter.png" border="0" /></a></li>
                        <li><a href="#"><img alt="alt_example" src="/img/Home/more.png" border="0" /></a></li>
                    </ul>-->
                    <div class="info">
                        <!--<div class="comments"> 18 </div>-->
                        <h2><a href="./post.html">Prochainement dans la version 0.8</a></h2>
                        <div class="date_n_author">18 juillet 2014, par Remy Tamazy</div>
                        <p> + Création et améliorations des technologies depuis le laboratoire et l'armurerie.</p>
                        <p> + Création des unités depuis le caserne, le factory et la base aérienne.</p>
                        <p> + Liste des constructibles ou non en fonction des prérequis.</p>
                        <!--<a href="./post.html" class="read_more2">read more</a>--> </div>
                    <div class="clear">
                    </div>
                </li>
                <li>
                    <div class="image"><a href="./post.html"><img alt="alt_example" src="/img/Home/media/full/biskanah-0_7.png" /></a></div>
                    <!--<ul class="social_share">
                        <li><a href="#"><img alt="alt_example" src="/img/Home/fbk.png" border="0" /></a></li>
                        <li><a href="#"><img alt="alt_example" src="/img/Home/twitter.png" border="0" /></a></li>
                        <li><a href="#"><img alt="alt_example" src="/img/Home/more.png" border="0" /></a></li>
                    </ul>-->
                    <div class="info">
                        <!--<div class="comments"> 18 </div>-->
                        <h2><a href="./post.html">Actuellement dans la version 0.7</a></h2>
                        <div class="date_n_author">17 juillet 2014, par Remy Tamazy</div>
                        <p> + Chaque construction rapporte des points en fonction de son coût en ressources.</p>
                        <p> + Classement des joueurs mis à jour en temps réel.</p>
                        <p> + Création et améliorations des bâtiments.</p>
                        <p> + Liste de bâtiments constructibles ou non en fonction des prérequis.</p>
                        <!--<a href="./post.html" class="read_more2">read more</a>--> </div>
                    <div class="clear">
                    </div>
                </li>
            </ul>
            <!--<ul id="pager">
                <li><a href="#" ><img alt="alt_example" src="/img/Home/left_pager.jpg" border="0"/></a></li>
                <li><a href="#" >1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#" class="active">3</a></li>
                <li><a href="#"><img alt="alt_example" src="/img/Home/right_pager.jpg" border="0"/></a></li>
            </ul>-->


            <div class="clear"></div>
        </div>
        <!-- Left wrapper end -->

        <!-- Right wrapper Start -->
        <div id="right_wrapper">

            <div class="review">
                <form action="/users/register" method="post">
                    <div class="header"><a href="#">// Inscription au serveur alpha</a></div>
                    <div id="search">
                        <input type="text" placeholder="Nom d'utilisateur" name="username" class="required" id="s" />
                    </div>
                    <div id="search">
                        <input type="text" placeholder="Mot de passe" name="password" class="required" id="s" />
                    </div>
                    <div id="search">
                        <input type="text" placeholder="Email" name="email" class="required" id="s" />
                    </div>
                    <div class="button-register"><a href="#" onclick="$(this).closest('form').submit()" >Jouez maintenant !</a></div>
                </form>
            </div>

            <div class="review">
                <form action="/users/login" method="post">
                    <div class="header"><a href="#">// Connexion à l'interface</a></div>
                    <div id="search">
                        <input type="text" placeholder="Nom d'utilisateur" name="username" class="required" id="s" />
                    </div>
                    <div id="search">
                        <input type="text" placeholder="Mot de passe" name="password" class="required" id="s" />
                    </div>
                    <div class="button-login"><a href="#" onclick="$(this).closest('form').submit()" >Se connecter</a></div>
                </form>
            </div>


            <!-- Right wrapper end -->

        </div>
        <div class="clear"></div>

    </div>
</div>

<div class="bottom_shadow"></div>

<!--********************************************* Main end *********************************************-->

<!--********************************************* Main advert start *********************************************-->
<div class="main_advert">
    <a href="http://themeforest.net/user/Skywarrior" target="_blank"><img alt="alt_example" src="/img/Home/main_ad.png" border="0" /></a>

</div>
<!--********************************************* Main advert end *********************************************-->

<!--********************************************* Twitter feed start *********************************************-->
<div id="twitter_last"> <a id="tr_left" href="#"><img alt="alt_example" src="/img/Home/blank.gif" width="100%" height="30px" border="0" /></a>
    <div id="tr_right">
        <ul id="tw">

        </ul>
    </div>
</div>
<!--********************************************* Twitter feed end *********************************************-->

</div>
<!--********************************************* Main_in end *********************************************-->

<a id="cop_text" href="#"> Powered by Biskanah Games</a>
</div>
</div>
<!--********************************************* Main wrapper end *********************************************-->

<script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/js/Home//jquery.carouFredSel-6.1.0.js" type="text/javascript"></script>
<script src="/js/Home//jquery.cslider.js" type="text/javascript" ></script>
<script src="/js/Home//modernizr.custom.28468.js" type="text/javascript"></script>
<script src="/js/Home//getTweet.js" type="text/javascript" ></script>
<script src="/js/Home//jquery.fancybox.js?v=2.1.3" type="text/javascript" ></script>

<!--******* Javascript Code for the Hot news carousel *******-->
<script type="text/javascript">
    $(document).ready(function() {

        // Using default configuration
        $("#sd").carouFredSel();

        // Using custom configuration
        $("#hot_news_box").carouFredSel({
            items				: 3,
            direction			: "right",
            prev: '#prev',
            next: '#next',
            scroll : {
                items			: 1,
                height			: 250,
                easing			: "quadratic",
                duration		: 2000,
                pauseOnHover	: true
            }
        });
    })
</script>


<!--******* Javascript Code for the Main banner *******-->
<script type="text/javascript">
    $(function() {

        $('#da-slider').cslider({
            autoplay	: true,
            bgincrement	: 450
        });

    });
</script>

<!--******* Javascript Code for the image shadowbox *******-->
<script type="text/javascript">
    $(document).ready(function() {
        /*
         *  Simple image gallery. Uses default settings
         */

        $('.shadowbox').fancybox();
    });
</script>

<!--******* Javascript Code for the menu *******-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#menu li').bind('mouseover', openSubMenu);
        $('#menu > li').bind('mouseout', closeSubMenu);

        function openSubMenu() {
            $(this).find('ul').css('visibility', 'visible');
        };

        function closeSubMenu() {
            $(this).find('ul').css('visibility', 'hidden');
        };
    });
</script>

<script type="text/javascript">
    $(function() {
        var pull    = $('#pull');
        menu 		= $('ul#menu');

        $(pull).on('click', function(e) {
            e.preventDefault();
            menu.slideToggle();
        });

        $(window).resize(function(){
            var w = $(window).width();
            if(w > 767 && $('ul#menu').css('visibility', 'hidden')) {
                $('ul#menu').removeAttr('style');
            };
            var menu = $('#menu_wrapper').width();
            $('#pull').width(menu - 20);
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        var menu = $('#menu_wrapper').width();
        $('#pull').width(menu - 20);
    });
</script>
</body>
</html>
