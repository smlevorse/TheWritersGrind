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
					</div>
				<?php
					}
				?>
			</div>
			
			<div id="body">
				

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget condimentum tellus, sed rutrum libero. Fusce ipsum nisl, sodales vitae scelerisque eu, viverra in nulla. Fusce quis euismod magna, facilisis pulvinar sem. Duis eget tincidunt mauris, nec porttitor sapien. Vestibulum in ex sit amet lorem elementum tempus. Phasellus elementum sodales enim, eu porta odio condimentum quis. Morbi vehicula justo ac volutpat pulvinar. Nunc id turpis in erat condimentum ultrices sit amet et ipsum.

Etiam aliquet leo magna, a porttitor diam maximus at. Sed non volutpat nibh. Donec urna felis, scelerisque nec arcu et, fermentum hendrerit turpis. Nulla erat dui, imperdiet a volutpat a, venenatis id metus. Proin a bibendum justo. Phasellus ac felis quis risus hendrerit feugiat. Integer aliquet id felis in condimentum. Nullam quis suscipit arcu. Etiam sagittis, risus in accumsan condimentum, ex nibh faucibus diam, non suscipit ligula tortor eu felis. Nulla facilisi.

Fusce ultrices odio dui. Mauris vehicula magna id sem eleifend pretium. Curabitur faucibus ante a purus ultricies, vitae dictum lectus pharetra. Praesent laoreet mi vitae ante posuere, ut malesuada augue porttitor. Mauris eu gravida urna. Fusce vitae ante et quam pellentesque sagittis. Integer consequat velit ligula, ac ultrices nulla efficitur at. Sed non felis quis diam efficitur condimentum vel eu justo. Aenean semper ipsum id eros convallis, vel vehicula felis tincidunt. Nullam sed enim vel mauris pellentesque laoreet. Mauris dignissim ac leo at ornare. Morbi elementum nisl vel risus laoreet cursus.

Sed nec orci porttitor nisl laoreet maximus. Duis faucibus commodo enim, a vestibulum dui elementum id. Curabitur non purus eget sem faucibus lacinia. Maecenas lectus urna, maximus ut lorem faucibus, maximus ullamcorper dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec gravida tellus at bibendum dignissim. Donec id vehicula ex. Sed vehicula odio vel purus vestibulum, eget pellentesque elit maximus. Nunc eleifend erat interdum purus rutrum euismod ac et mi. Maecenas mollis rutrum ex, non elementum velit sodales eu. Phasellus non enim eget mauris sagittis tempus. Curabitur tristique tristique imperdiet. Mauris sagittis congue nisi, in faucibus nibh consectetur et. Ut porta enim nunc, vitae vulputate leo gravida et. Aenean viverra, felis nec porta elementum, eros quam congue nunc, non laoreet nisl turpis nec augue.

Nam at semper nulla, aliquet suscipit magna. Phasellus suscipit dui nulla, sit amet facilisis sapien rhoncus dignissim. Cras nisi purus, tempor a pulvinar in, accumsan quis mi. Nam consequat nisi ligula, vel mollis ex euismod ac. Vestibulum tincidunt lorem quis mauris varius luctus. Nam sit amet efficitur neque. Nunc vitae lorem eget neque bibendum malesuada. Aliquam quis dolor sit amet mi egestas pulvinar nec vel nunc. Aliquam venenatis mollis purus eget ullamcorper.

Maecenas sit amet sagittis augue, eget sagittis tortor. Maecenas efficitur accumsan mauris, quis viverra ligula condimentum in. Nunc bibendum erat eu gravida convallis. Nam imperdiet diam ac rutrum convallis. Nullam suscipit sit amet odio sit amet dictum. Maecenas posuere turpis massa, in dignissim nisl placerat vel. Curabitur volutpat rhoncus posuere. Fusce fermentum rhoncus elit, pharetra consectetur velit lacinia vel. Mauris at pellentesque urna. Nullam facilisis dapibus enim ut porttitor. Donec leo arcu, posuere id semper et, gravida ac tellus. Nullam laoreet, elit ut posuere venenatis, justo felis dapibus ligula, vel efficitur odio est in risus.

Pellentesque eget dapibus sapien, ac placerat enim. Mauris eu mauris et erat ultrices imperdiet. Donec quis elementum lacus, in dictum ex. Aenean sollicitudin felis a erat pharetra viverra. Donec lacus leo, scelerisque et ultricies id, pharetra vitae purus. Morbi tincidunt iaculis tincidunt. Etiam hendrerit congue metus quis bibendum. Maecenas ullamcorper luctus arcu vitae lobortis. Aliquam in eros sem. Curabitur quam neque, luctus quis posuere vel, pulvinar eget elit. Cras sagittis eget diam id semper. Praesent fermentum, libero ac tempor lacinia, ante felis gravida ante, in tempor ligula sapien nec nisi.

Mauris mi est, condimentum non convallis non, laoreet ac urna. Nam condimentum leo sed ullamcorper rhoncus. Mauris tempus tincidunt elit eu sollicitudin. Sed commodo volutpat erat, a rhoncus lacus venenatis id. Integer malesuada non lorem sed accumsan. Vestibulum sit amet purus at neque mollis mollis sit amet pretium enim. Duis scelerisque sagittis convallis. Proin interdum malesuada dignissim. Vestibulum tincidunt sem quis tempus mattis. Nullam lobortis est enim, luctus rutrum massa euismod sit amet. Ut ut dapibus arcu. Nulla eleifend ultricies nisl vitae feugiat. Curabitur orci ligula, iaculis id ornare at, vulputate et nibh.

Nullam eros ante, tempus ac diam vitae, volutpat dapibus est. Duis et volutpat tortor. Quisque id elementum nunc. Morbi commodo odio ac lectus cursus, vitae elementum enim accumsan. Nulla dolor risus, tristique pulvinar pharetra ut, fermentum tempus odio. Ut a enim elit. Donec sapien arcu, interdum et diam ut, dapibus ornare elit. Cras gravida, libero vel malesuada convallis, augue dui posuere turpis, et suscipit justo ex quis velit. Nam vitae turpis blandit, porttitor massa quis, tempor risus. Curabitur semper lectus eu scelerisque varius.

Vivamus sed dolor pellentesque, blandit libero sit amet, imperdiet purus. Fusce euismod at ante at vulputate. Sed facilisis felis quis nisl ultricies aliquet. Cras sed gravida ligula, nec facilisis mauris. Ut consectetur erat leo, ac rhoncus dui faucibus quis. Duis mollis mauris sit amet congue pretium. Suspendisse at diam interdum, tempus justo ut, feugiat nunc. Donec pretium massa iaculis massa condimentum pretium. Nulla ut accumsan felis. Nulla ut augue dapibus, volutpat enim a, suscipit orci. Nulla facilisi. Nulla vel maximus arcu.

Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In placerat quis neque in imperdiet. Vestibulum eleifend lorem eget lectus luctus consectetur. Aenean a imperdiet enim. Cras rhoncus, sapien semper consectetur aliquet, arcu enim placerat tortor, vitae tempus mauris nisi sit amet odio. Praesent eget laoreet odio, ut tincidunt nisi. Fusce accumsan sagittis turpis vitae elementum.

Aenean vehicula, felis imperdiet rhoncus maximus, felis est feugiat nunc, eget venenatis nibh odio et risus. Curabitur et lacus magna. Etiam bibendum tempor magna, at bibendum arcu hendrerit faucibus. Vivamus dapibus mauris sit amet placerat varius. Pellentesque gravida placerat augue, vitae blandit ex venenatis scelerisque. Cras vel neque sit amet eros elementum iaculis. Etiam id ornare dui, ut volutpat lectus. Suspendisse vel est auctor purus fermentum fermentum. Morbi nibh est, euismod vel dictum id, dapibus nec nunc. Quisque vel odio venenatis, consequat eros nec, ornare libero. Maecenas pulvinar ex et suscipit placerat. Ut rutrum gravida orci, et lobortis odio volutpat et.

Vestibulum efficitur neque sem, eu hendrerit dui vulputate vel. Vestibulum eget nisl sagittis, feugiat dui nec, elementum elit. In odio augue, ornare eu volutpat ac, interdum rhoncus neque. Nullam massa libero, aliquet pellentesque nisl vitae, porttitor tincidunt velit. In hac habitasse platea dictumst. Phasellus tortor elit, euismod ac neque nec, suscipit iaculis sem. Cras condimentum augue massa, ut tincidunt mauris mollis nec. Maecenas ut sapien a nisi tempus porta. Mauris diam sapien, lacinia sit amet lacus eu, imperdiet porta risus. Mauris pretium nisi at rhoncus aliquet. Maecenas sed aliquet ipsum. In dignissim molestie mi id sollicitudin. Duis mattis nulla sit amet odio bibendum congue. Mauris sagittis mollis lacus, a porttitor arcu semper vitae. Vestibulum luctus auctor leo eget finibus. Nam eu interdum risus.

Maecenas rhoncus ex eget nunc fringilla, gravida ornare lorem rhoncus. Aliquam accumsan ullamcorper fringilla. Donec iaculis sapien eu orci maximus, eu ornare est consequat. In turpis mauris, vestibulum ut accumsan at, congue nec dolor. Nam nunc tellus, laoreet ut congue non, tempus sed ante. Ut feugiat efficitur mattis. Morbi risus orci, dignissim nec gravida vitae, tincidunt sed sem. Donec pulvinar, magna non aliquam cursus, ipsum mi eleifend ipsum, ac euismod dui mauris ac nunc. Integer vitae felis sed diam egestas laoreet ut a urna. Maecenas risus neque, laoreet vitae blandit quis, gravida nec mi. Donec felis risus, hendrerit vitae commodo quis, aliquet sed eros. Suspendisse eu mollis enim. Suspendisse nec feugiat tortor.

Nam justo risus, ullamcorper non orci placerat, posuere tincidunt nunc. Donec malesuada justo tellus, et vulputate orci iaculis ut. Praesent in viverra diam. Curabitur consequat sapien orci, sed vestibulum risus pharetra sed. Integer ac nisi bibendum, facilisis erat vel, iaculis tellus. Nunc at nisl volutpat, volutpat est a, sollicitudin magna. Maecenas non blandit lectus, nec interdum nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean elementum sagittis mauris, et fermentum est posuere at. Mauris tortor nisl, ornare sit amet iaculis eu, mollis nec libero. Vivamus eleifend est at magna suscipit, vel vehicula quam pellentesque. Nam tristique nisi ac nisl ornare pulvinar. Proin fringilla in purus lacinia feugiat. Duis quis vestibulum tellus. Nullam molestie, purus at feugiat aliquet, est est blandit odio, at cursus orci ante a turpis. Aenean faucibus aliquet dictum. 
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
