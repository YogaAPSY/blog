<?php
	include("include/header.php");
	include("include/conect.php");
  	session_start();

		if(isset($_POST['submit_comment']))
		{
			$nama = $_POST['nama'];
			$subjek = $_POST['subjek'];
			$comments = $_POST['comments'];
			$date = date('Y-m-d h:i:s');
			$id_post = $_POST['post_id'];

		$sql = mysqli_query($koneksi,"INSERT INTO comment(nama, subject , komen , dates ,id_post )
			VALUES('$nama','$subjek','$comments','$date','$id_post')");
	    
	    if(mysqli_query($koneksi,$sql)){
	    $_SESSION['komenberhasil'] = true;
		header("Location: post.php?post_id=$id_post");
		exit();

		}else{
			header("Location: post.php?post_id=$id_post");
			exit();
		}
	}else{
			header("Location: post.php?post_id=$id_post");
			exit();
		}
?>