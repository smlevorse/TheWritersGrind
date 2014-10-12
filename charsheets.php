<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Character Sheet - The Writer's Grind</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--
		<?php
//			if (isset($_POST['submit'])) {
//				#Login form has been pressed
//				
//				$user = "wj2389sj";
//				$pass = "R298fjsk3";
//				$host = "localhost";
//				$dbname = "simplesocialnetwork";
//				$username = $_POST['username'];
//				$password = md5($_POST['password']);
//				
//				try {
//					$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
//					
//					$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
//					$stmt->bindParam(1, $username);
//					$stmt->bindParam(2, $password);
//					$stmt->setFetchMode(PDO::FETCH_ASSOC);
//					$stmt->execute();
//					
//					if ($stmt->rowCount() != 1) {
//						echo "<span style='color:red;'>NO USER FOUND</span>";
//					} else {
//						#They're a registered user.
//						$userID = $stmt->fetch()['id'];
//						
//						session_start();
//						$_SESSION['username'] = $username;
//						$_SESSION['userID'] = $userID;
//					}
//					
//					$dbh = null;
//				} catch (PDOException $e) {
//					echo $e->getMessage();
//				}
//			}
//            
		?>
		-->
        <!-- Add your site or application content here --><!--
        <div id="head">
            <a href="index.php"><img id="logo" src="res/logo.png" alt="The Writer's Grind logo"/></a>
            <div id="login"> 
                <h1>Login</h1>
                <form name="login" action="index.php" method="POST">
                    <label for="username">Username: </label>
                    <input type="text" name="username">
                    <label for="password">Password: </label>
                    <input type="password" name="password">
                    <input type="Submit" name="submit" value="Submit"/>
                </form>
                <a href="register.php">Register for an account</a>
            </div>
        </div>
        -->

        <h1>Character Sheets</h1>
        <form name="charactersheet" action="charsheets.php" method="POST">
            <label for="name">Name: </label>
            <input type="text" name="name">
            <label for="age">Age: </label>
            <input type="text" name="age">
            <label for="gender">Gender: </label>
            <input type="text" name="gender">
            <label for="ethniciy">Ethnicity: </label>
            <input type="text" name="ethnicity">
            <label for="occupation">Occupation: </label>
            <input type="text" name="occupation">
            <label for="physicaldesc">Physical Description: </label>
            <input type="text" name="physicaldesc">
            <label for="personaldesc">Personality Description: </label>
            <input type="text" name="personaldesc">
            <label for="backstory">Back-Story: </label>
            <input type="text" name="backstory">
            <label for="flaws">Flaws: </label>
            <input type="text" name="flaws">
            <label for="talents">Talents&#47;Strengths: </label>
            <input type="text" name="talents">
            <label for="habits">Habits: </label>
            <input type="text" name="habits">
            <label for="petpeeves">Pet Peeves: </label>
            <input type="text" name="petpeeves">
            <label for="likes">Likes: </label>
            <input type="text" name="likes">
            <label for="dislikes">Dislikes: </label>
            <input type="text" name="dislikes">
            <label for="selfimage">How they view themselves: </label>
            <input type="text" name="selfimage">
            <label for="image">How others view them: </label>
            <input type="text" name="image">
            <label for="beliefs">Beliefs: </label>
            <input type="text" name="beliefs">
            <label for="interests">Interests: </label>
            <input type="text" name="interests">
            <h2>Favorites</h2>
            <label for="favmusic">Music: </label>
            <input type="text" name="favmusic">
            <label for="favanimal">Animal: </label>
            <input type="text" name="favanimal">
            <label for="favfood">Foods: </label>
            <input type="text" name="favfood">
            <label for="favcolor">Color: </label>
            <input type="text" name="favcolor">
            <label for="style">Clothing Style: </label>
            <input type="text" name="style">
            <br/>
            <h2>Best Friend</h2>
            <label for="namefriend">Name: </label>
            <input type="text" name="namefriend">
            <label for="meet">How they met: </label>
            <input type="text" name="meet">
            <label for="relationship">Describe their relationship: </label>
            <input type="text" name="relationship">
            <label for="change">How their relationship has changed oer time: </label>
            <input type="text" name="change">
            <label for="actions">How does this character act around this peron?: </label>
            <input type="text" name="actions">
            <br/>
            <h2>Significant Other</h2>
            <label for="nameso">Name: </label>
            <input type="text" name="nameso">
            <label for="meetpartner">How they met: </label>
            <input type="text" name="meetpartner">
            <label for="dating">How&#47;when did they start dating?: </label>
            <input type="text" name="dating">
            <label for="close">How close are they?: </label>
            <input type="text" name="close">
            <label for="actionsso">How does this character act around their significant other?: </label>
            <input type="text" name="actionsso">
            <label for="why">Why does this character like this person?: </label>
            <input type="text" name="why">
            <label for="problems">Are there any propblems in their relationship?: </label>
            <input type="text" name="problems">
            <br/>
            <label for="weapon">Weapon preference: </label>
            <input type="text" name="weapon">
            <label for="fightstyle">Fighting style: </label>
            <input type="text" name="fight">
            <label for="abilities">Special abilities: </label>
            <input type="text" name="abilities">
            <label for="fetishes">Sexual fetishes: </label>
            <input type="text" name="fetishes">
            <label for="orientation">Sexual orientation: </label>
            <input type="text" name="orientation">
        </form>

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
