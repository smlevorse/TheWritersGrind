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
			$takenusername = false;
		
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
					#Check if username is already taken.
					
					try {
						$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
						
						$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
						$stmt->bindParam(1, $usernameregister);
						$stmt->execute();
						
						if ($stmt->rowCount() > 0) {
							#username is already taken!
							
							$takenusername = true;
						}
						$stmt = null;
						
						if (($wrongpasswords == true) || ($takenusername == true)) {
							#Something went wrong. Don't submit form.
							return false;
						}
						
						#It passed all validation! Time to insert into the table.
						$insertStmt = $dbh->prepare("INSERT INTO users ( username, password, emailaddress, bio ) values ( ?, ?, ?, ? )");
						$insertStmt->bindParam(1, $usernameregister);
						$insertStmt->bindParam(2, $passwordregister);
						$insertStmt->bindParam(3, $emailregister);
						$insertStmt->bindParam(4, $bioregister);
						$insertStmt->execute();
						echo "User created!";
						
						$dbh = null;
					} catch (PDOException $e) {
						echo $e->getMessage();
					}
				}
			}
        ?>
        
        <!-- Add your site or application content here -->
        <div id="head">
            <a href="index.php"><img id="logo" src="res/logo.png" alt="The Writer's Grind logo"/></a>
            <div id="login"> 
                <form name="login" action="index.php" method="POST">
                    <label for="username">Username: </label>
                    <input type="text" name="username">
                    <label for="password">Password: </label>
                    <input type="text" name="password">
                    <input type="Submit" name="submit" value="Submit"/>
                </form>
            </div>
        </div>


        <form name="register" action="register.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="usernameregister" maxlength="20"> <?php if($takenusername) { echo "<span style='color: red;'>Username is taken.</span"; } ?>
            <label for="email">E-Mail: </label>
            <input type="text" name="emailregister" maxlength="80">
            <label for="password">Password: </label>
            <input type="password" name="passwordregister" maxlength="20">
            <label for="confirm">Confirm: </label>
            <input type="password" name="confirmregister" maxlength="20"> <?php if($wrongpasswords) { echo "<span style='color: red;'>Passwords do not match.</span"; } ?>
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
