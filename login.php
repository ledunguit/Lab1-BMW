<?php
	session_start();
	//Change these configs according to your MySQL server
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$database = "testdb";
	$table = "user";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
		// Check connection
		if ($conn->connect_error) {
			$_SESSION['msg'] = "Connection failed";
		    //die("Connection failed: " . $conn->connect_error);
		}
		else{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql_command = "SELECT * FROM ".$table." WHERE username='".$username."' and password='".$password."'";

			$result = mysqli_query($conn, $sql_command);
			if (mysqli_num_rows($result) > 0)
				$_SESSION['name'] = $result[0]['username'];
			else
			{
				$_SESSION['name'] = null;
				$_SESSION['msg'] = "Login failed";
			}
			mysqli_close($conn);
		}
?>
<html>
<head>
	<title>Simple Info Form</title>
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
	 	if ( isset($_SESSION['name']) )
		 	echo 'Welcome '.$_SESSION['name'];
		else{
			if ( isset($_SESSION['msg']) )
				echo $_SESSION['msg'];
		} 
	?>
</body>
</html>