<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register - The Writer's Grind</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
			$user = "wj2389sj";
			$pass = "R298fjsk3";
			$host = "localhost";
			$dbname = "simplesocialnetwork";
			$wrongpasswords = false;
		
            if (isset($_POST['submitlogin'])) {
				#Login form has been pressed
				
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				
				try {
					$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					
					$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
					$stmt->bindParam(1, $username);
					$stmt->bindParam(2, $password);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					
					if ($stmt->rowCount() != 1) {
						echo "NO USER FOUND";
					} else {
						echo "yay! You're a registered user.";
					}
					
					$dbh = null;
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
			
			if (isset($_POST['submitregister'])) {
				#Register form has been submitted.
				
				$usernameregister = $_POST['usernameregister'];
				$emailregister = $_POST['emailregister'];
				$passwordregister = $_POST['passwordregister'];
				$confirmregister = $_POST['confirmregister'];
				$bioregister = $_POST['bioregister'];
				
				if ($passwordregister != $confirmregister) {
					#passwords don't match.
					$wrongpasswords = true;
				} else {
					
				}
				
				try {
					$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					
					
					
					$dbh = null;
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
        ?>
        
        <!-- Add your site or application content here -->

        <div id="head"> 
            <img id="logo" src="res/logo.png" alt="The Writer's Grind logo"/>
            <form name="login" action="index.php" method="POST">
                <label for="username">Username: </label>
             <input type="text" name="username">
                <label for="password">Password: </label>
                <input type="text" name="password">
                <input type="Submit" name="submit" value="Register"/>
            </form>
            <a href="register.php">Register for an account</a>
        </div>


        <form name="register" action="register.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="usernameregister" maxlength="20">
            <label for="email">E-Mail: </label>
            <input type="text" name="emailregister" maxlength="80">
            <label for="password">Password: </label>
            <input type="password" name="passwordregister" maxlength="20">
            <label for="confirm">Confirm: </label> <?php if($wrongpasswords) { echo "<span style='color: red;'>Passwords do not match.</span"; } ?>
            <input type="text" name="confirmregister" maxlength="20">
            <label for="bio">Biography: </label>
            <input type="text" name="bioregister" maxlength="300">
			<input type="submit" value="Create an account" name="submitregister" />
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
