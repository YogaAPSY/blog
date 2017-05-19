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
			          if(isset($_SESSION['salah_password'])){
			          echo'<div class="alert alert-danger" role="alert">Nim atau Password yang anda masukan salah atau anda bukan admin</div><br>';
			          unset($_SESSION['salah_password']);
			        }elseif(isset($_SESSION['update_comment'])){
			          echo'<div class="alert alert-success" role="alert">Comment Berhasil dikirim</div><br>';
			          unset($_SESSION['update_comment']);
			      }
			        ?>

				<!-- Pagination -->
				<?php

				$perpage = 3;
				$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
				$start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

				$articles = "SELECT * from posts WHERE status='published' ORDER BY Id DESC LIMIT $start , $perpage";
				$result2 = mysqli_query($koneksi, $articles);

				$result = mysqli_query($koneksi , "SELECT * FROM posts WHERE status='published'");
				while($row1 = mysqli_fetch_assoc($result)){
					$total = mysqli_num_rows($result);
				}

				$pages = ceil($total/$perpage);
				$no = 1;
				while($row = mysqli_fetch_assoc($result2)){ 
				if($row['status'] == 'published'){
						echo'
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3><a href="post.php?post_id='.$row['id'].'">'.$row['tittle'].'</a></h3>
							'.$row['dates'].'
						</div>
						<div class="panel-body">
								<div class="col-sm-4">
									<img src="'.$row['image'].'" width="100%" height="180px">
								</div>
								<div class="col-sm-8">
									<p>
										'.substr($row['description'], 0 , 400).'
									</p>
									<a href="post.php?post_id='.$row['id'].'" class="btn btn-primary">Read more</a>
								</div>
						</div>
					</div>
				';
				}

				 } ?>

				<div>
				<nav>
				<ul class="pagination">
				<?php
					if(isset($_GET['halaman'])){
						if ( $_GET['halaman'] > 1 ) {
						$link = $_GET['halaman']-1;
						$prev ='<li><a href="?halaman='.$link.'" aria-label="Previous">
					        <span aria-hidden="true">&laquo;</span>
					      </a></li>';
						} else {
						$prev = '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
						}
						echo $prev;
						}
					else{
						$_GET['halaman'] = 1;
						$prev = '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
						echo $prev;
					}
				?>
					<?php for($i = 1; $i <= $pages; $i++ ){
					
					if (isset($_GET['halaman'])) {
						if ( $_GET['halaman'] == $i){
							$class = 'active';
						} else{
							$class = ' ';
						}
					} else{
						$class = ' ';
					}

						echo'
						<li class="'.$class.'"><a href="?halaman='.$i.'"> '.$i.' </a></li>
						';			
					} ?>
					<?php
					if(isset($_GET['halaman'])){
						if ( $_GET['halaman'] < $pages ) {
						$link = $_GET['halaman']+1;
						$next ='<li><a href="?halaman='.$link.'" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					      </a></li>';
						} else {
						$next = '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
						}
						echo $next;
						}
					?>
				  </ul>
				</nav>
				</div>
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