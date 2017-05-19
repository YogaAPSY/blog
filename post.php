<?php
	session_start();
	include("include/header.php");
	include("include/conect.php");
?>

</head>
<body>
	<?php include("include/navbar.php"); ?>
	<div class="container">
		<article class="row">
			<section class="col-lg-8">
				<?php

				$result = mysqli_query($koneksi , "SELECT * FROM posts WHERE id = '$_GET[post_id]' AND status='published'");
				$no = 1;
				while($row = mysqli_fetch_assoc($result)){ 
				if($row['status'] == 'published'){
						echo'
							<div class="panel panel-success">
							<div class="panel-heading">
								<h3>'.$row['tittle'].'</h3>
							</div>
								<div class="panel-body">
										<img src="'.$row['image'].'" width="100%">
										<p class="text-danger">'.date('Y-m-d h:i:s').' WIB - '.$row['author'].'</p>
										<p>
											'.$row['description'].'
										</p>
								</div>
							</div>	

						';
					}
					}
				?>	
				</hr>
				<h1>Komentar</h1>
				<?php

					if(isset($_SESSION['komenberhasil'])){
						 echo'<div class="alert alert-success" role="alert">Komentar berhasil di Update</div>';
					}

					$sql = mysqli_query($koneksi , "SELECT * FROM comment WHERE id_post = '$_GET[post_id]'");
					while ($row = mysqli_fetch_assoc($sql)) {
						if(isset($sql)){
							echo'
								<div class="panel panel-success">
							<div class="panel-heading">
								<h5>'.$row['nama'].'</h5>
								<p class="text-danger">'.date('Y-m-d h:i:s').' WIB </p>
							</div>
								<div class="panel-body">
										<p>Subjek : '.$row['subject'].'
				
										<p>
											Deskripsi : '.$row['komen'].'
										</p>
								</div>
							</div>	

							';
						}
					}
				?>

				<hr />
				
 				<div class="page-header"><h1><i class="glyphicon glyphicon-comment"></i> Comment</h1></div>
				<form class="form-horizontal" action="comment.php" method="post" role="form">
     				  <div class="form-group">
       				 	<label for="subjek">Subjek</label>
        				<input type="text" id="subjek" name="subjek" class="form-control" placeholder="Insert your Subjek">
     				 </div>
     				 <div class="form-group">
       				 	<label for="comments">Comment</label>
        				<textarea class="form-control" rows="10" name="comments" style="resize:none" id="comments"></textarea>
     				 </div>
   				  <div class="form-group">
			        <label for="submit"></label>
			        <input type="hidden" name="nama" value="<?php echo "$_SESSION[nama]" ?>">	
			        <input type="hidden" name="post_id" value="<?php echo "$_GET[post_id]" ?>">
			        <input type="submit" class="btn btn-block btn-danger" name="submit_comment" value="Comment">
			      </div>
              </form>
			</section>
			<aside class="col-lg-4">
			<?php 
				include("include/sidebar.php");
			 ?>
		
			</aside>
		</article>
		<div class="clearfix"></div>
		<div>
			
		</div>
	</div>
	<?php include("include/footer.php"); ?>
</body>
</html>