<?php
	session_start();
	session_unset();
	session_destroy();
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Writer's Grind</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Rokkitt|Yanone+Kaffeesatz|Pacifico|Dancing+Script:400,700' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
        <!-- Add your site or application content here -->

		<div id="wrapper">
            <div id="head">
                <a href="index.php"><img id="logo" src="res/logo.png" alt="The Writer's Grind logo"/></a>
                <?php
                    if (!isset($_SESSION['username'])) {
                        #They're not logged in.
                ?>
                    <div id="login"> 
                        <form name="login" action="index.php" method="POST">
                            <label for="username">Username: </label>
                            <input type="text" name="username">
                            <label for="password">Password: </label>
                            <input type="password" name="password">
                            <input type="Submit" name="submit" value="Submit"/>
                        </form>
                        <a href="register.php">Register for an account</a>
                    </div>
                    <?php
                        } else {
                            #They're signed in.
                    ?>
                    <div id="login">
                        Welcome back, <a href="profile.php?username=<?php echo $_SESSION['username']; ?>"> <?php echo $_SESSION['username']; ?> </a>
                        <form action="logout.php">
                            <input type="submit" value="Logout">
                        </form>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                 <nav>
                    <ul>
                        <li>Browse</li>
                        <li>Create</li>
                        <li>    
                            <form>
                                <label for="search">Search: </label>
                                <input type="text" name="search">
                                <input type="Submit" name="submit" value="Search">
                            </form>
                        </li>
                    </ul>
                </nav>

                <div id="body">
                    <h1 id="goodbye">See you soon!</h1>
                    <img src="res/logout.png" alt="Us waving you goodbye"/>

                </div>
            </div>



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>
