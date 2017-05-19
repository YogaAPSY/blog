<?php
	include("include/header.php");
	include("include/conect.php");
  session_start();

  $alert_status = '';
  if(isset($_GET['new_status'])){
    $new_status = $_GET['new_status'];
    $sql = "UPDATE posts SET status='$new_status' WHERE id = '$_GET[id]'";
    if(mysqli_query($koneksi ,$sql)){
      $_SESSION['alert_status'] = true;
    }
  }

  if(isset($_GET['delete_post'])){

    mysqli_query($koneksi,"DELETE FROM posts WHERE id='$_GET[delete_post]'") or die (mysql_error());

    $_SESSION['hapus'] = true;

    header("location:post_list.php");
  }
?>
</head>
<body>
 <?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
  <div class="col-lg-10">
  <div style="width:50px; height:50px;"></div>
<!--Post List Start-->
<?php
    if(isset($_SESSION['update_point'])){
      echo '<div class="alert alert-success" role="alert">Point telah berhasil di Update</div><br>';
      session_unset('update_point');
    }
 ?>
<?php
    $perpage = 5;
    $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

    $articles = "SELECT * from data_mahasiswa ORDER BY id DESC LIMIT $start , $perpage";
    $result2 = mysqli_query($koneksi, $articles);

    $result = mysqli_query($koneksi , "SELECT * FROM data_mahasiswa");
    $total = mysqli_num_rows($result);

    $pages = ceil($total/$perpage);

  echo '
<div class="panel panel-danger">
  <div class="panel-heading"><h3>User</h3></div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
		<tr>
			<th>Nama</th>
      <th>Foto</th>
			<th>Nim</th>
			<th>Kelamin</th>
			<th>Jurusan</th>
      <th>Role</th>
			<th>Update Point & Role</th
		</tr>
	</thead>
      <tbody>
      ';
      while($row = mysqli_fetch_assoc($result2)){
      echo'
        <tr>
          <td>'.$row['Nama'].'</td>
          <td>'.($row['image'] == '' ? 'No Image' : '<img src="'.$row['image'].'" width="50px">' ).'</td>
          <td>'.$row['Nim'].'</td>
          <td>'.$row['Kelamin'].'</td>
          <td>'.$row['Jurusan'].'</td>
          <td>'.$row['role'].'</td>
         <td><a href="update_point.php?nim='.$row['Nim'].'" class="btn btn-primary btn-xs" ><i class="
glyphicon glyphicon-edit"></i> Update</a></td>
        </tr>
    ';
}
?>
<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
</tbody>

    </table>
  </div>
</div>
</div>
 
<div class="text-center">
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
<footer></footer>
</body>