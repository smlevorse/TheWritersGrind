<?php
	if (isset($_POST['submit'])) {

		$user = "wj2389sj";
		$pass = "R298fjsk3";
		$host = "localhost";
		$dbname = "simplesocialnetwork";
		$text = $_POST['text'];
		
		try {
			$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		
			$stmt = $dbh->prepare("INSERT INTO storyideas ( id, text, type ) values ( NULL, ?, 'plot' )");
			$stmt->bindParam(1, $text);
			$stmt->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		echo "Plot " . $_POST['text'] . " was created!";
	}
?>

<form name="upload" action="marandaupload.php" method="POST">
	<label for="text"> Plot: </label>
	<input type="text" name="text" maxlength="100" />
	<input type="submit" name="submit" value="upload to database, Maranda" />
</form>