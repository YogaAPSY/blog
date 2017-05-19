
<form class="panel-group form-horizontal" action="search.php" role="form">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-header">
							<h4>Search Something</h4>
						</div>
						<div class="input-group">
							<input type="search" name="search" class="form-control" placeholder="Search Something">
							<div class="input-group-btn">
								<button name="search_submit" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form class="panel-group form-horizontal" role="form" action="login_admin.php" method="post">
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
									<input type="submit" class="btn btn-success btn-block" value="Sign In" placeholder="Log in">
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
						if (isset($_GET['post_id'])) {
						if ( $_GET['post_id'] == $row['id']){
							$class = 'active';
						} else{
							$class = ' ';
						}
					} else{
						$class = ' ';
					}
			echo'
				<a href="post.php?post_id='.$row['id'].'" class="list-group-item '.$class.'">
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