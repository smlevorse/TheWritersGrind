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
				<?php
					if (isset($_POST['submit'])) {
						$missingTitle = false;
						$missingRating = false;
						$missingSummary = false;
						$missingStory = false;
						
						$title = $_POST['title'];
						$rating = $_POST['rating'];
						$summary = $_POST['summary'];
						$story = $_POST['story'];
						
						if (empty($title)) {
							$missingTitle = true;
						}
						if (empty($rating)) {
							$missingRating = true;
						}
						if (empty($summary)) {
							$missingSummary = true;
						}
						if (empty($story)) {
							$missingStory = true;
						}
						
						if ($missingRating || $missingStory || $missingSummary || $missingTitle) {
							#one or more are missing.
						} else {
							#fields are filled out. We can now add to database!
							$user = "wj2389sj";
							$pass = "R298fjsk3";
							$host = "localhost";
							$dbname = "simplesocialnetwork";
							$wrongpasswords = false;
							$takenusername = false;
							
							try {
								$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
								$insertStmt = $dbh->prepare("INSERT INTO stories ( id, summary, title, story, rating, author ) values ( NULL, ?, ?, ?, ?, ? )");
								$username = $_SESSION['username'];
								$insertStmt->bindParam(1, $summary);
								$insertStmt->bindParam(2, $title);
								$insertStmt->bindParam(3, $story);
								$insertStmt->bindParam(4, $rating);
								$insertStmt->bindParam(5, $username);
								$insertStmt->execute();
								
								$updateStmt = $dbh->prepare("UPDATE users SET submissions = submissions + 1 WHERE username = ?");
								$updateStmt->bindParam(1, $username);
								$updateStmt->execute();
								
								echo "Story has been submitted! <br />";
								echo "<a href='profile.php'>Click here to go back to your profile.</a>";
								die();
							} catch (PDOException $e) {
								echo $e->getMessage();
							}
						}
					}
				?>
                <form name="story" action="submit.php" method="POST">
                    <label for="title">Title: </label>
                    <input type="text" name="title" value="<?php if(isset($title)) { echo $title; } ?>"><?php if($missingTitle) { echo "<span style='color: red;'>Missing title.</span><br />"; } ?>
                    <label for="rating">Rating: </label>
                    <input type="text" name="rating" value="<?php if(isset($rating)) { echo $rating; } ?>"><?php if($missingRating) { echo "<span style='color: red;'>Missing rating.</span><br />"; } ?>
                    <label for="summary">Summary: </label><br />
                    <textarea name="summary" cols="40" rows="5"><?php if(isset($summary)) { echo $summary; } ?></textarea><br /><?php if($missingSummary) { echo "<span style='color: red;'>Missing summary.</span><br />"; } ?>
                    <label for="story">Story text: </label><br />
                    <textarea name="story" cols="40" rows="5"><?php if(isset($story)) { echo $story; } ?></textarea><br /><?php if($missingStory) { echo "<span style='color: red;'>Missing story.</span><br />"; } ?>
					<input type="submit" name="submit" value="Submit story" />
                </form>
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