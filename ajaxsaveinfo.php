<?php
    $servername = "localhost";
	$username = "root";
	$password = "Nt208@123456";
	$database = "nt213lab1";
	$table = "student_info";

	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (isset($_POST['dataAjax'])) {
		try {
			$input = $_POST['dataAjax'];
			$data = json_decode("$input");
			if (isset($data->gender)) {
				if ($data->gender === "Nam") {
					$data->gender = 1;
				} else if ($data->gender === "Nữ") {
					$data->gender = 2;
				} else {
					$data->gender = 3;
				}
			}
			$sql = "insert into student_info(fullname, student_id, phone, email, birthday, gender, address, comment) values (:fullname, :student_id, :phone, :email, :birthday, :gender, :address, :comment)";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(
				'fullname' => $data->name,
				'student_id' => $data->student_id,
				'phone' => $data->phone,
				'email' => $data->email,
				'birthday' => $data->dob,
				'gender' => $data->gender,
				'address' => $data->address,
				'comment' => $data->note
			));
            echo json_encode(array('status' => 'Đã lưu thành công!'));
            die;
		} catch (PDOException $e) {
			echo json_encode(array('status' => 'Lưu thất bại!'));
		}
	}
?>