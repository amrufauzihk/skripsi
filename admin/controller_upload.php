<?php
    
    include 'config/connect-db.php';
    include 'config/base-url.php';
    include 'config/auth.php';
 
	$page    = $_GET['page'];
	$action  = $_GET['action'];

	/* DATA BUKU */
	if($page == "upload" && $action == "insert")
	{
			$type	       = $_FILES["fileupload"]["type"];
			$namaFile      = "file-".date('Y-m-d H-i-s')."-cover.jpg";
			$namaSementara = $_FILES['fileupload']['tmp_name'];
			$size          = $_FILES['fileupload']['size'];
			$dirUpload     = "proses/";
			$upload		   = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

			$file = fopen("proses/image.txt","w");  
			fwrite($file, $namaFile);  
			fclose($file);  
			
			
		  if($upload){ 
		      echo 'ok';
		  }else{
		      echo 'error';
		  }

	}elseif($page == "ocr" && $action == "insert")
	{
		$ocr_text = $_POST['ocr_text'];
		$ocr_image = $_POST['ocr_image'];
		$url_fileupload = $_POST['url_fileupload'];
		
		$result = mysqli_query($mysqli, "INSERT INTO tb_log_perekaman SET
											ocr_text = '$ocr_text',
											ocr_image = '$ocr_image',
											url_fileupload = '$url_fileupload'") or die(mysqli_error($mysqli));

		  
		if($result){ 
			 echo 'ok';
		 }else{
			 echo 'error';
		 }

	
	}elseif($page == "data-buku" && $action == "delete")
	{

		  $ID = $_GET['id'];
		  $page1 = $_GET['page1'];

				  $result = mysqli_query($mysqli, "DELETE FROM tb_buku WHERE id = $ID") or die(mysqli_error($mysqli));

		  
		 if($result){ 
		      echo '<script language="javascript"> window.location.href = "'.$base_url_back.'/index.php?page='.$page1.'" </script>';
		  }else{
		      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		  }

	}
?>