<?php
	include("include/header.php");
	include("include/conect.php");
  session_start();
?>
</head>
<body>
<?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
  <div class="col-lg-10">
  <div style="width:50px; height:50px;"></div>
    <div class="col-md-3">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3" style="font-size:4.5em"><i class="glyphicon glyphicon-signal"></i></div>
            <div class="col-xs-9 text-right">
            <div style="font-size:2.5em">
              <?php 
              $sql = mysqli_query($koneksi , "SELECT * FROM posts");
       
              while($row = mysqli_fetch_assoc($sql)){
              $_SESSION['view_post'] = mysqli_num_rows($sql);
              }
              if(isset($_SESSION['view_post'])){

                echo "$_SESSION[view_post]";
              }else{
                echo"-";
              }
              
             ?>
            </div>
            <div>Post</div>
          </div>
        </div>
      </div>
      <a href="post_list.php">
      <div class="panel-footer">
        <div class="pull-left">View Posts</div>
        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
        <div class="clearfix"></div>
      </div>
      </a>
    </div>
  </div>

  <div class="col-md-3">
      <div class="panel panel-success">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3" style="font-size:4.5em"><i class="glyphicon glyphicon-th-list"></i></div>
            <div class="col-xs-9 text-right">
            <div style="font-size:2.5em">
              <?php 
              $sql = mysqli_query($koneksi , "SELECT * FROM category");

        
                  while($row = mysqli_fetch_assoc($sql)){
                  $_SESSION['view_category'] = mysqli_num_rows($sql);
                }
                  if(isset($_SESSION['view_category'])){

                    echo "$_SESSION[view_category]";
                  }else{
                    echo"-";
                  }
       
             ?>
            </div>
            <div>Categorys</div>
          </div>
        </div>
      </div>
      <a href="category_list.php">
      <div class="panel-footer">
        <div class="pull-left">View Categorys</div>
        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
        <div class="clearfix"></div>
      </div>
      </a>
    </div>
  </div>

  <div class="col-md-3">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3" style="font-size:4.5em"><i class="glyphicon glyphicon-user"></i></div>
            <div class="col-xs-9 text-right">
            <div style="font-size:2.5em">
              <?php 
              $sql = mysqli_query($koneksi , "SELECT * FROM data_mahasiswa");
  
                  while($row = mysqli_fetch_assoc($sql)){
                 $_SESSION['view_user'] = mysqli_num_rows($sql);
                  } 
                if(isset($_SESSION['view_user'])){
                     echo "$_SESSION[view_user]";
                }else{
                  echo"-";
                }
             ?>
            </div>
            <div>Users</div>
          </div>
        </div>
      </div>
      <a href="user_list.php">
      <div class="panel-footer">
        <div class="pull-left">View Users</div>
        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
        <div class="clearfix"></div>
      </div>
      </a>
    </div>
  </div>

   <div class="col-md-3">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3" style="font-size:4.5em"><i class="glyphicon glyphicon-comment"></i></div>
            <div class="col-xs-9 text-right">
            <div style="font-size:2.5em"> <?php 
              $sql = mysqli_query($koneksi , "SELECT * FROM comment");
              
              if($sql != NULL){
              while($row = mysqli_fetch_assoc($sql)){
              $_SESSION['view_comment'] = mysqli_num_rows($sql);
              } 
                echo "$_SESSION[view_comment]";
              }else{
                echo"-";
              }
             ?></div>
            <div>Comment
            </div>
          </div>
        </div>
      </div>
      <a href="comment_list.php">
      <div class="panel-footer">
        <div class="pull-left">View Comments</div>
        <div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
        <div class="clearfix"></div>
      </div>
      </a>
    </div>
  </div>
  <div class="clearfix"></div>
<!--Top Blocks End-->

<!-- Users Area -->
<?php

  $perpage = 7;
  $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

  $articles = "SELECT * from data_mahasiswa LIMIT $start , $perpage";
  $result2 = mysqli_query($koneksi, $articles);

  $result = mysqli_query($koneksi , "SELECT * FROM data_mahasiswa");
  $total = mysqli_num_rows($result);

  $pages = ceil($total/$perpage);
echo'
<div class="col-lg-8">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>Users List</h4>
    </div>

    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <th>S.No</th>
          <th>Name</th>
          <th>Role</th>
        </thead>
        <tbody>
        ';
        while($row = mysqli_fetch_assoc($result2)){
        echo'
          <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['Nama'].'</td>
            <td>'.$row['role'].'</td>
          </tr>
          ';
        }
        while($row = mysqli_fetch_assoc($result)){
       $_SESSION['view_user'] = mysqli_num_rows($result);
    }
          ?>
        </tbody>
      </table>
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
</div>

<!-- Profile Area -->

<div class="col-lg-4">
   <div class="panel panel-primary">
            <div class="panel-heading">
              <?php
                 $sql =  mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$_SESSION[nim]'");
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
                        <td>'.$row['Jurusan'].'</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Jenis Kelamin</td>
                        <td>'.$row['Kelamin'].'</td>
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
                 <div class="panel-footer">
    
                    <span class="pull-right">
                        <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        
                    </span>
                    <div class="clearfix"></div>
                 </div>
            
          </div>
        </div>';
      }
        ?>
<div class="clearfix"></div>
<!--Post List Start-->
<?php

  $perpage = 3;
  $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

  $articles = "SELECT * from posts ORDER BY Id DESC LIMIT $start , $perpage";
  $result2 = mysqli_query($koneksi, $articles);

  $result = mysqli_query($koneksi , "SELECT * FROM posts");
  $total = mysqli_num_rows($result);

  $pages = ceil($total/$perpage);
echo'
<div class="panel panel-primary">
  <div class="panel-heading"><h3>Latest Post</h3></div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Date</th>
          <th>Image</th>
          <th>Title</th>
          <th>Description</th>
          <th>Category</th>
          <th>Author</th>
        </tr>
      </thead>
      <tbody>
      ';

         while($row = mysqli_fetch_assoc($result2)){
      echo'
        <tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['dates'].'</td>
          <td><img src="'.$row['image'].'" width="50px"></td>
          <td>'.$row['tittle'].'</td>
          <td>'.substr($row['description'], 0 , 100).' ... </td>
          <td>'.$row['category'].'</td>
          <td>'.$row['author'].'</td>
        </tr>
        ';
      }
        ?>
      </tbody>

    </table>
  </div>
</div>
<?php

  $perpage = 3;
  $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

  $articles = "SELECT * from comment LIMIT $start , $perpage";
  $results2 = mysqli_query($koneksi, $articles);

  $results = mysqli_query($koneksi , "SELECT * FROM  comment");
  $total = mysqli_num_rows($results);

  $pages = ceil($total/$perpage);
echo'
<div class="panel panel-primary">
  <div class="panel-heading"><h3>Latest Comments</h3></div>
  <div class="panel-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Date</th>
          <th>Nama</th>
          <th>Subject</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>
      ';
      $no = 1;
       while($rows = mysqli_fetch_assoc($results2)){
      echo'
        <tr>
          <td>'.$no.'</td>
          <td>'.$rows['dates'].'</td>
          <td>'.$rows['nama'].'</td>
          <td>'.$rows['subject'].'</td>
          <td>'.substr($rows['komen'], 0 , 100).' ... </td>
        </tr>
        ';
        $no++;
      }
        ?>
      </tbody>

    </table>
  </div>
</div>

</div>
<footer></footer>
</body>