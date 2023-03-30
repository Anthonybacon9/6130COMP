<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Runners Crisps Competition</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Runners Crips Competition</h1>
	<form action="BusinessTier/Backend/src/backend.php" method="POST">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>
		<label for="address">Address:</label>
		<textarea id="address" name="address" required></textarea>
		<label for="code">10 digit hexadecimal code:</label>
		<input type="text" id="code" name="code" required>
		<label for="player">Best player in the game:</label>
		<input type="text" id="player" name="player" required>
		<input type="submit" value="Submit">
	</form>
</body>
</html> 
