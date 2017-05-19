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
					if(isset($_GET['search_submit'])){
					echo'
					<div class="panel panel-default">
						<div class="panel-body">
							<h4>You Search for <b>"'.$_GET['search'].'"</b></h4>
						</div>
					</div>
					';
					$sql = mysqli_query($koneksi,"SELECT * FROM posts WHERE tittle LIKE '%$_GET[search]%' OR description like '%$_GET[search]%'") or die (mysql_error());
	 				while ($row = mysqli_fetch_assoc($sql)){
						echo '
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3><a href="post.php?post_id='.$row['id'].'">'.$row['tittle'].'</a></h3>
								</div>
								<div class="panel-body">
										<div class="col-sm-4">
											<img src="'.$row['image'].'" width="100%" height="180px">
										</div>
										<div class="col-sm-8">
											<p>
												'.substr($row['description'], 0 , 400).'........
											</p>
											<a href="post.php?post_id='.$row['id'].'" class="btn btn-primary">Read more</a>
										</div>
								</div>
							</div>
						';
					}
				}
				?>
			</section>
			<aside class="col-lg-4">
			<?php
				include("include/sidebar.php"); 
			?>
			</aside>
		</article>
	</div>
	<?php include("include/footer.php"); ?>
</body>
</html>