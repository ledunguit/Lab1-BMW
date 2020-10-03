<?php
	session_start();
	//Change these configs according to your MySQL server
	$servername = "localhost";
	$username = "root";
	$password = "Nt208@123456";
	$database = "nt213lab1";
	$table = "student_info";

	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (isset($_POST['info'])) {
		try {
			$data = $_POST['info'];
			$sql = "insert into student_info(fullname, student_id, phone, email, birthday, gender, address, comment) values (:fullname, :student_id, :phone, :email, :birthday, :gender, :address, :comment)";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(
				'fullname' => $data['name'],
				'student_id' => $data['student_id'],
				'phone' => $data['phone'],
				'email' => $data['email'],
				'birthday' => $data['dob'],
				'gender' => $data['gender'],
				'address' => $data['address'],
				'comment' => $data['note']
			));
			$_SESSION['msg'] = "New record created successfully";
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	// Create connection
	/* $conn = mysqli_connect($servername, $username, $password, $database);
		// Check connection
		if ($conn->connect_error) {
			$_SESSION['msg'] = "Connection failed";
		    //die("Connection failed: " . $conn->connect_error);
		}
		else{
			// 2 ways to get fields in form, the later is more secure
			// $name = $_POST['name'];
			// $name = mysqli_real_escape_string($conn, $_POST['name']);

			//Create SQL command to insert data to database
			$sql_command = "INSERT INTO ...";

			if ($conn->query($sql_command) === TRUE)
				$_SESSION['msg'] = "New record created successfully";
			else
				$_SESSION['msg'] = $conn->error;
			mysqli_close($conn);
		} */
?>
<html>
<head>
	<title>Form Submit Confirmation</title>
	<style>
	    body{
	    	font-family: Arial
	    }
		.label {
			width: 10%;
			float: left;
		}
		.info{
			padding: 5px;
		}
		form{
			padding-left: 30px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php
		if (isset($_SESSION['msg']))
			echo $_SESSION['msg'];
	?>
</body>
</html>