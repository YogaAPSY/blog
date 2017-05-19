<?php
	include("include/header.php");
	include("include/conect.php");
  session_start();
?>

<?php
if(isset($_POST['category'])){

  $category = $_POST['category'];

  mysqli_query($koneksi,"INSERT INTO category(c_name) VALUES('$category')") or die(mysql_error());
  $_SESSION['new_cat'] = true;
}
?>
</head>
<body>
 <?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>

  <div class="col-lg-10">
    <div class="col-lg-5">
      <div class="page-header"><h1>New Category <i class="
glyphicon glyphicon-pencil"></i></h1></div>
   <?php
      if(isset($_SESSION['new_cat'])){
        echo'<div class="alert alert-success" role="alert">Category <b>'.$_POST['category'].'</b> sudah ditambahkan</div><br>';
        unset($_SESSION['new_cat']);
      }
    ?>
  <div class="container-fluid">
    <form class="form-horizontal" action="new_category.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category" name="category" class="form-control">
      </div>

      <div class="form-group">
        <label for="submit"></label>
        <input type="submit" id="submit" name=" submit_category"class="btn btn-danger btn-block">
      </div>

    </form>
  </div>
    </div>

</div>
<footer></footer>
</body>