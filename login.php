<?php
	include("include/conect.php");
	session_start();

	if(isset($_POST['nim']) && isset($_POST['password']))
	{	
		$nim1 = $_POST['nim'];
		$password1 = $_POST['password'];
		$sql = mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$nim1' and Password = '".md5($password1)."'");
		
		if (mysqli_num_rows($sql) === 1) { 
			while ($row = mysqli_fetch_array($sql)) { 
				$_SESSION['nim'] = $row["Nim"];
				$_SESSION['nama'] = $row['Nama'];
				echo $_SESSION['nama'];
				header("Location: article.php");
				exit();
				}
		}
		else{
			$_SESSION['salah_password'] = true;
			header("Location: index.php");
		exit;
		}
	}
	else {
		header("Location: index.php");
		exit;
		}
?>