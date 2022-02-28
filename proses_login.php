<?php

//* Includde Koneksi Ke database
include_once("admin/config/connect-db.php");

//* Include Base Url
include_once("admin/config/base-url.php");


	$username = $_POST['username'];
	$pass     = md5($_POST['password']);
	

	if (!isset($_POST['status']) || $_POST['status'] == "") {
		echo "error-none";

	} elseif ($_POST['status'] == 1) {
		$login = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE username = '$username' AND password='$pass'");
		$row=mysqli_fetch_array($login);
		if ($row['username'] == $username AND $row['password'] == $pass)
		{
			session_start();
			$_SESSION['nama']        = $row['nama_lengkap'];
			$_SESSION['username']    = $row['username'];
			$_SESSION['status'] 	 = 'ADMIN';
			// Jika Sukses, redirect halaman menggunakan javascript
			echo json_encode(array('status' => 'ok', 'url'=>$base_url_back.'/index.php'));

		}
	
		else  
		{
	
		  // Jika Sukses, redirect halaman menggunakan javascript
		  /* echo '<script language="javascript"> window.location.href = "'.$base_url_front.'/index.php" </script>'; */
		  echo "error";
	
		}

	} 

?>