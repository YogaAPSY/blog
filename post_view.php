<?php
session_start();
include("include/header.php");
include("include/conect.php");
?>
</head>
<body>
  <header class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header"> 
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <div class="navbar-brand"><a href="#"><img src="image/brand.png" style="max-width:200px; margin-top: -9px;" alt="BerbagIlmu.com"><span class="label label-default">Beta</span></a></div> 
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
		<li><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>';
			<li class="dropdown">
     		 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
     		 	Articles <span class="caret"></span></a>
      			<ul class="dropdown-menu">
        			<?php
						$sel_cat =  mysqli_query($koneksi ,"SELECT * FROM category") or die (mysqli_error());
						while ($row = mysqli_fetch_assoc($sel_cat)){
						echo'
							<li><a href="#?cat_name='.$row['c_name'].'">'.ucfirst($row['c_name']).'</a></li>
							';
						}
					?>
      			</ul>
    		</li>
			<li><a href="#">Sign Out</a></li>
		</ul>
	</div>
</div>
</header><br><br><br>
	<div class="container">
		<article class="row">
			<section class="col-lg-8">
				<?php

					$sql = mysqli_query($koneksi,"SELECT * FROM posts WHERE id = '$_GET[post_id]'") or die (mysqli_error());
					while ($row = mysqli_fetch_assoc($sql)){
						
						echo'
							<div class="panel panel-success">
							<div class="panel-heading">
								<h3>'.$row['tittle'].'</h3>
								<p class="text-danger">'.date('Y-m-d h:i:s').' WIB - '.$row['author'].'</p>
							</div>
								<div class="panel-body">
										<img src="'.$row['image'].'" width="100%">
										<p>
											'.$row['description'].'
										</p>
								</div>
							</div>
						';

					}
				?>
				
			</section>
			<aside class="col-lg-4">
			<form class="panel-group form-horizontal" role="form">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-header">
							<h4>Search Something</h4>
						</div>
						<div class="input-group">
							<input type="search" name="search" class="form-control" placeholder="Search Something">
							<div class="input-group-btn">
								<button name="search_submit" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form class="panel-group form-horizontal" role="form">
					<div class="panel panel-default">
						<div class="panel-heading">Login Area</div>
							<div class="panel-body">

							<div class="form-group">
								<label for="username"class="control-label col-sm-4">Nim</label>
								<div class="col-sm-7">
									<input type="text" id="username" class="form-control" placeholder="Nim" name="nim">
								</div>
							</div>

							<div class="form-group">
									<label for="password"class="control-label col-sm-4">Password</label>
									<div class="col-sm-7">
										<input type="password" id="password" class="form-control" placeholder="password" name="password">
									</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" class="btn btn-success btn-block" value="Sign In" placeholder="Log in">
								</div>
							</div>

						</div>
					</div>
				</form>

				<?php

				$perpage = 3;
				$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
				$start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

				$articles = "SELECT * from posts LIMIT $start , $perpage";
				$result2 = mysqli_query($koneksi, $articles);

				$result = mysqli_query($koneksi , "SELECT * FROM posts");
				$total = mysqli_num_rows($result);

				$pages = ceil($total/$perpage);

				while($row = mysqli_fetch_assoc($result2)){ 
					
			echo'
				<a href="#" class="list-group-item">
					<div class="col-sm-4">
						<img src="'.$row['image'].'" width="100%">
						</div>
						<div class="col-sm-8">
							<h4 class="list-group-item-heading">'.substr($row['tittle'],0,50).'</h4>
							<p class="list-group-item-text">'.substr($row['description'], 0,50).'</p>
						</div>
						<div style="clear:both"></div>
					</a>
				';
		}
?>
		
			</aside>
		</article>
	</div>
	<?php include("include/footer.php"); ?>
</body>
</html>