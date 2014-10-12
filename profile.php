<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		#They're not logged in. Redirect to index.php
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

		<?php
			if (isset($_POST['submit'])) {
				#Login form has been pressed
				
				$user = "wj2389sj";
				$pass = "R298fjsk3";
				$host = "localhost";
				$dbname = "simplesocialnetwork";
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
						echo "<span style='color:red;'>NO USER FOUND</span>";
					} else {
						#They're a registered user.
						$userID = $stmt->fetch()['id'];
						
						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['userID'] = $userID;
					}
					
					$dbh = null;
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
            
		?>
		
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

            </div>
            <div id="body">
                <!--if no username get variable is passed, assume they want their own profile.-->
				<?php
					#function deleteStory(id) {
					#	$user = "wj2389sj";
					#	$pass = "R298fjsk3";
					#	$host = "localhost";
					#	$dbname = "simplesocialnetwork";
						
						#try {
					#		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
					#	} catch (PDOException $e) {
					#		echo $e->getMessage();
					#	}
					#}
				
					$user = "wj2389sj";
					$pass = "R298fjsk3";
					$host = "localhost";
					$dbname = "simplesocialnetwork";
					$username = $_POST['username'];
					$password = md5($_POST['password']);
					
					if (!isset($_GET['username'])) {
						#GET username variable wasn't passed. Assume they want their own profile.
						try {
							$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				
							$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
							$username = $_SESSION['username'];
							$stmt->bindParam(1, $username);
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							$stmt->execute();
							$result = $stmt->fetch();
							echo "<strong>Username:</strong> " . $result['username'] . "<br />";
							echo "<strong>User ID:</strong> " . $result['id'] . "<br />";
							echo "<strong>Total submissions:</strong> " . $result['submissions'] . "<br />";
							echo "<strong>Biography:</strong> " . $result['bio'] . "<br />";
							
							echo "<h2>Vault</h2>";
							
							$storyStmt = $dbh->prepare("SELECT * FROM stories WHERE author = ?");
							$storyStmt->bindParam(1, $username);
							$storyStmt->setFetchMode(PDO::FETCH_ASSOC);
							$storyStmt->execute();
							while ($result = $storyStmt->fetch()) {
								echo "<a href=\"story.php?id=" . $result["id"] . "\">" . $result["title"] . "</a><br />";
							}
						} catch (PDOException $e) {
							echo $e->getMessage();
						}
					} else {
						#GET username variable was passed. Pull up their profile.
						try {
							$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				
							$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
							$username = $_GET['username'];
							$stmt->bindParam(1, $username);
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							$stmt->execute();
							if ($stmt->rowCount() == 1) {
								#User exists.
								$result = $stmt->fetch();
								echo "<strong>Username:</strong> " . $result['username'] . "<br />";
								echo "<strong>User ID:</strong> " . $result['id'] . "<br />";
								echo "<strong>Total submissions:</strong> " . $result['submissions'] . "<br />";
								echo "<strong>Biography:</strong> " . $result['bio'] . "<br />";
								
								echo "<h2>Vault</h2>";
								
								$storyStmt = $dbh->prepare("SELECT * FROM stories WHERE author = ?");
								$storyStmt->bindParam(1, $username);
								$storyStmt->setFetchMode(PDO::FETCH_ASSOC);
								$storyStmt->execute();
								while ($result = $storyStmt->fetch()) {
									echo "<a href=\"story.php?id=" . $result["id"] . "\">" . $result["title"] . "</a><br />";
								}
								#foreach ($results as $result) {
								#	echo $result["title"] . "<br />";
								#}"""
								#var_dump($result);
							} else {
								echo "<strong>User $username does not exist.</strong>";
							}
						} catch (PDOException $e) {
							echo $e->getMessage();
						}
					}
				?>
            </div>
            <div id="footer">
                &copy; 2014 Nathan Holt, Sean Levorse, Maranda De Stefano.
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