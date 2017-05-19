<?php
	include("include/conect.php");
	session_start();

	if(isset($_POST['nim']) && isset($_POST['password']))
	{
		echo"@@@@";
		$nim1 = $_POST['nim'];
		$password1 = $_POST['password'];
		$sql = mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$nim1' and Password = '".md5($password1)."'") or die (mysqli_error());
		
		if (mysqli_num_rows($sql) === 1) {
			while ($row = mysqli_fetch_array($sql)) {
				$_SESSION['nim'] = $row['Nim'];
				$_SESSION['author'] = $row['Nama'];
				$_SESSION['role'] = $row['role'];
				header("Location: admin.php");
				exit;
				}
		}
		else{
			echo "1111";
			$_SESSION['salah_password'] = true;
			header("Location: article.php");
		exit;
		}
	}
	else {
		echo"ASSASA";
		header("Location: article.php");
		exit;
		}
?>