<!DOCTYPE html>
<html>
<head>
    <title>My Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            font-size: 1rem;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 1rem;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 400px;
            padding: 1rem;
            border: 1px solid black;
        }
        label {
            display: block;
            margin-bottom: 10px;
            text-align: center;
            font-size: 24px;
        }

        input[type=radio] {
            display: inline-block;
            width: 30px;
            height: 30px;
            margin: 0 10px;
            vertical-align: middle;
            position: relative;
            top: -2px;
            cursor: pointer;
        }

        input[type=radio]:checked::after {
            content: '';
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #333;
        }

        input[type=number], input[type=radio] {
            margin: 0.5rem;
            padding: 0.5rem;
            width: 100%;
            font-size: 1.5rem;
        }

        button[type=submit] {
            margin: 1rem;
            padding: 0.5rem;
            font-size: 1.5rem;
        }

        input:required:hover:invalid {
            background-image: none;
        }

    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div style="display: block;">
            <label for="position">Odaberite poziciju:</label><br>
            <input title="" type="radio" name="position" value="1" id="position1" required>
            <label for="position1">Pozicija 1</label>
            <input title="" type="radio" name="position" value="2" id="position2" required>
            <label for="position2">Pozicija 2</label>
            <input title="" type="radio" name="position" value="3" id="position3" required>
            <label for="position3">Pozicija 3</label>    
        </div>
        <br>
        <label for="number">Unesite broj:</label><br>
        <input title="" autocomplete="off" type="number" name="number" id="number" required><br><br>
        <button type="submit" name="submit">Submit</button>
    </form


	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$number = $_POST["number"];
		$position = $_POST["position"];
		$submission_time = date("Y-m-d H:i:s");

		// Connect to the database
		$servername = "sql211.epizy.com";
		$username = "epiz_33711116";
		$password = "4nhRTk9dd7rdJM0";
		$dbname = "epiz_33711116_vanikuss";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Insert the form data into the database table
		$sql = "INSERT INTO form_data (number, position, submission_time) VALUES ('$number', '$position', '$submission_time')";

		if (mysqli_query($conn, $sql)) {
			echo "Podaci obrasca su uspešno poslati ";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>


</body>
</html>
