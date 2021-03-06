<?php
    session_start();
    
    if (isset($_SESSION['username']) && isset($_SESSION['userID'])) {
        #They're logged in already! Redirect them to the index page.
        header("Location:index.php");
    }
?>

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
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link href='http://fonts.googleapis.com/css?family=Rokkitt|Yanone+Kaffeesatz|Pacifico|Dancing+Script:400,700' rel='stylesheet' type='text/css'>
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
                $passwordregister = md5($_POST['passwordregister']);
                $confirmregister = md5($_POST['confirmregister']);
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
                            #nothing
                        } else {
                            #It passed all validation! Time to insert into the table.
                            $insertStmt = $dbh->prepare("INSERT INTO users ( username, password, emailaddress, bio ) values ( ?, ?, ?, ? )");
                            $insertStmt->bindParam(1, $usernameregister);
                            $insertStmt->bindParam(2, $passwordregister);
                            $insertStmt->bindParam(3, $emailregister);
                            $insertStmt->bindParam(4, $bioregister);
                            $insertStmt->execute();
							header("Location:index.php");
                        }
                        
                        $dbh = null;
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
            }
        ?>

        <?php
			if (!isset($_POST['submitregister'])) {
		?>
			<!-- Add your site or application content here -->
			<h3>Please complete the form below.</h3>
			<h5>Upon completion, you will be redirected to the main page where the login is in the top right hand corner.</h5>
			<form name="register" class="pure-form pure-form-aligned" action="register.php" method="POST">
				<div class="pure-control-group">
					<label for="username">Username: </label>
					<input type="text" name="usernameregister" maxlength="20" required> <?php if($takenusername) { echo "<span style='color: red;'>Username is taken.</span"; } ?>
				</div>
				<div class="pure-control-group">
					<label for="email">E-Mail: </label>
					<input type="text" name="emailregister" maxlength="80" required>
				</div>
				<div class="pure-control-group">
					<label for="password">Password: </label>
					<input type="password" name="passwordregister" maxlength="20" required>
				</div>
				<div class="pure-control-group">
					<label for="confirm">Confirm: </label>
					<input type="password" name="confirmregister" maxlength="20" required> <?php if($wrongpasswords) { echo "<span style='color: red;'>Passwords do not match.</span"; } ?>
				</div>
				<div class="pure-control-group">
					<label for="bio">Biography: </label>
					<input type="text" name="bioregister" maxlength="300" required>
				</div>
				<div class="pure-controls">
					<button type="submit" class="pure-button pure-button-primary"name="submitregister"> Create an Account </button>
					</div>
			</form>
		<?php	
			} else {
		?>
			<h2>New account created!</h2>
			<h3><a href="index.php">Click here to go to the main screen to log in.</a></h3>
		<?php	
			}
		?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTa
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -gName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>