<?php
	include("include/header.php");
	include("include/conect.php");
  session_start();

  if (isset($_POST['update'])) {
     $ins_sql = "UPDATE data_mahasiswa SET  Role = '$_POST[Roles]' WHERE Nim = '$_POST[update_points]'";
   if(mysqli_query($koneksi , $ins_sql)){
    $_SESSION['update_point'] = true;
    header("Location: member.php");
    exit;
   }
  }
?>
</head>
<body>
<?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
  <div class="col-lg-10">

<!-- Profile Area -->
<div class="page-header"><h1>Edit Category <i class="
glyphicon glyphicon-edit"></i></h1></div>
<div class="col-lg-6">
   <div class="panel panel-primary">
            <div class="panel-heading">
              <?php
                if(isset($_GET['nim'])){
                 $sql =  mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$_GET[nim]'");
                  while ($row = mysqli_fetch_array($sql)) {
                  echo'
              <h4 class="panel-title">'.$row['Nama'].'</h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="'.$row['image'].'" class="img-circle img-responsive"> </div>
          
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nim:</td>
                        <td>'.$row['Nim'].'</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>'.$row['Email'].'</td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin</td>
                        <td>'.$row['Kelamin'].'</td>
                      </tr>
                      </tr>
                       <tr>
                        <td>Role</td>
                        <td>'.$row['role'].'</td>
                      </tr>
                       <tr>
                        <td>Alamat</td>
                        <td>'.substr($row['Alamat'], 0,50).'</td>
                      </tr>
                      <tr>
                        <td>Tentang Saya</td>
                        <td>'.substr($row['About'], 0,50).'</td>
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
            
          </div>
        </div>';
      }}
        ?>

<div class="col-lg-6">
      <form class="form-horizontal" action="update_point.php" method="post">
        <?php
        if(isset($_GET['nim'])){
       $sql = mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$_GET[nim]'") or die (mysqli_error());
          while ($row = mysqli_fetch_assoc($sql)){?>
        <div class="form-group">
          <input type="hidden" name="update_points" value="<?php echo $_GET['nim']; ?>">
        <label for="status">Change Role</label>
        <select id="category" name="Roles" class="form-control">
          <option value="Admin">Admin</option>
          <option value="Publisher">Publisher</option>
      </div>

      <div class="form-group">
        <label for="submit"></label>
        <input type="submit" id="submit" name="update"class="btn btn-danger btn-block">
      </div>
      </form>
  </div>
<?php }} ?>
<div class="clearfix"></div>
<?php
    $perpage = 5;
    $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

    $articles = "SELECT * from data_mahasiswa ORDER BY Id DESC LIMIT $start , $perpage";
    $result2 = mysqli_query($koneksi, $articles);

    $result = mysqli_query($koneksi , "SELECT * FROM data_mahasiswa");
    $total = mysqli_num_rows($result);

    $pages = ceil($total/$perpage);

  echo '
<div class="panel panel-danger">
  <div class="panel-heading"><h3>Member IDEV</h3></div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Foto</th>
      <th>Nim</th>
      <th>Kelamin</th>
      <th>Jurusan</th>
      <th>Role</th>
      <th>Update Point</th>
    </tr>
  </thead>
      <tbody>
      ';
      while($row = mysqli_fetch_assoc($result2)){
      echo'
        <tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['Nama'].'</td>
          <td>'.($row['image'] == '' ? 'No Image' : '<img src="'.$row['image'].'" width="50px">' ).'</td>
          <td>'.$row['Nim'].'</td>
          <td>'.$row['Kelamin'].'</td>
          <td>'.$row['Jurusan'].'</td>
          <td>'.$row['role'].'</td>
         <td><a href="update_point.php?nim='.$row['Nim'].'" class="btn btn-primary btn-xs" >Update</a></td>
        </tr>
    ';
    $_SESSION['nim'] = $row['Nim'];
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
    $next ='<li><a href="?halaman='.$link.'?nim='.$_SESSION['nim'].'" aria-label="Next">
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