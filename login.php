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
	if (isset($_POST['login_info'])) {
		try {
			$data = $_POST['login_info'];
			$sql = "select * from users where username = :username and password = :password";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(
				'username' => $data['username'],
				'password' => MD5($data['password'])
			));
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			if ($result) {
				$_SESSION['msg'] = "Login Success!";
				$_SESSION['name'] = $result->username;
			} else {
				$_SESSION['msg'] = "Login Failed!";
			}
		} catch (PDOException $e) {
			$_SESSION['msg'] = "Login Failed!";
 			echo $e->getMessage();
		}
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
	 	if (isset($_SESSION['name']))
		 	echo 'Welcome '.$_SESSION['name'];
		else{
			if (isset($_SESSION['msg']))
				echo $_SESSION['msg'];
		}
	?>
</body>
</html>