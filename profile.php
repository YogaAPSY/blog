<?php
  session_start();
  include("include/header.php");
  include("include/conect.php");
?>
</head>
<body>
  <?php include("include/navbar.php"); ?>
<div class="container text-align">
  <h1>Profile</h1>
    <hr>
  <div class="col-lg-16">

<!-- Profile Area -->
<div class="col-lg-16">
<div class="panel panel-primary">
    <div class="panel-heading">
   <?php
   if(isset($_GET['details'])){
     $sql =  mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$_GET[details]'");
        while ($row = mysqli_fetch_array($sql)) {
        echo'
     <div class="col-md-4">
      <div style="padding-top:20px"></div>
      '.($row['image'] == '' ? 'No Image' : '<img src="'.$row['image'].'" class="img-thumbnail" width="100%">').'
      
    </div>

    <div class="col-md-7 pull-right">
      <h3><u>'.$row['Nama'].'</u></h3>
      <p><i class="glyphicon glyphicon-education"></i> '.$row['Nim'].'</p>
      <p><i class="glyphicon glyphicon-envelope"></i> '.$row['Email'].'</p>
      <p><i class="glyphicon glyphicon-modal-window"></i> '.$row['Jurusan'].'</p>
      <p><i class="glyphicon glyphicon-user"></i> '.$row['Kelamin'].'</p>
    ';

        if($_SESSION['nim'] == $_GET['details']){
         echo'
      <a href="edit_profile.php?details='.$row['Nim'].'" class="btn btn-warning">Edit '.$row['Nama'].'</a>  
        </div><div class="clearfix"></div>  ';
      }
      echo'  
  </div>
  <div class="clearfix"></div>  
    </div>
</div>
<div class="col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>Alamat</h4>
      '.$row['Alamat'].'
      </table>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>About Me</h4>
      '.$row['About'].'
    </div>
  </div>
</div>';
   }
}
?>
    </div>
      <div class="clearfix"></div>
  </div>
    </div>
</div>
</div>
<?php include("include/footer.php"); ?>
</body>