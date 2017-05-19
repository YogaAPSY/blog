<?php
	include("include/header.php");
	include("include/conect.php");
	session_start();
?>
</head>
<body>
	<?php include("include/navbar.php"); ?>

	<div class="container">
		<article class="row">
			<section class="col-lg-8">
				<?php

				$perpage = 3;
				$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
				$start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

				$articles = "SELECT * from posts WHERE category='$_GET[cat_name]' AND status='published' ORDER BY Id DESC LIMIT $start , $perpage";
				$result2 = mysqli_query($koneksi, $articles);

				$result = mysqli_query($koneksi , "SELECT * FROM posts WHERE category='$_GET[cat_name]' AND status='published'");
				while($row1 = mysqli_fetch_assoc($result)){
				
					$total = mysqli_num_rows($result);
				}
				
				$pages = ceil($total/$perpage);
				
				while($row = mysqli_fetch_assoc($result2)){ 
				if($row['status'] == 'published' && $row['category'] == $_GET['cat_name']){
					echo'
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
				}else{
				echo'<p>Category tidak ditemukan</p>';
			}
			
			}
				?>

				<div>
				<nav>
				<ul class="pagination">
				<?php
					if(isset($_GET['halaman'])){
						if ( $_GET['halaman'] > 1 ) {
						$link = $_GET['halaman']-1;
						$prev ='<li><a href="?cat_name='.$_GET['cat_name'].'&halaman='.$link.'" aria-label="Previous">
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
						<li class="'.$class.'"><a href="?cat_name='.$_GET['cat_name'].'&halaman='.$i.'"> '.$i.' </a></li>
						';			
					} ?>
					<?php
					if(isset($_GET['halaman'])){
						if ( $_GET['halaman'] < $pages ) {
						$link = $_GET['halaman']+1;
						$next ='<li><a href="?cat_name='.$_GET['cat_name'].'&halaman='.$link.'" aria-label="Next">
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