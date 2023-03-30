<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Runners Crisps Competition</title>
	<style>
		body {
			font-family: 'Open Sans', sans-serif;
			background-size: cover;
		}
		h1 {
			color: #fff;
			text-align: center;
			margin-top: 50px;
			font-size: 3em;
			text-shadow: 1px 1px #000;
		}
		form {
			max-width: 500px;
			margin: 0 auto;
			background-color: rgba(255, 255, 255, 0.8);
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			margin-top: 20px;
		}
		label {
			display: block;
			font-size: 1.2em;
			font-weight: bold;
			margin-bottom: 5px;
			color: #fff;
			text-shadow: 1px 1px #000;
		}
		input[type="text"],
		input[type="email"],
		textarea {
			display: block;
			width: 100%;
			padding: 1px;
			margin-bottom: 8px;
			border-radius: 5px;
			border: none;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
			font-size: 1.2em;
		}
		input[type="submit"] {
			background-color: #28a745;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
			font-size: 1.2em;
			text-transform: uppercase;
		}
		input[type="submit"]:hover {
			background-color: #218838;
		}
	</style>
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
		<label for="best_player">Best player in the game:</label>
		<input type="text" id="best_player" name="best_player" required>
		<input type="submit" value="Submit">
	</form>
</body>
</html> 
