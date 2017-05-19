<?php
  include("include/header.php");
  include("include/conect.php");
  session_start();

  if(isset($_POST['update_category'])){
   $ins_sql = "UPDATE category SET c_name = '$_POST[category_name]' WHERE c_id = '$_POST[cat_id]'";
   if(mysqli_query($koneksi , $ins_sql)){
    $_SESSION['update_cat'] = true;
    header("Location: category_list.php");
    exit;
   }
  }

?>
</head>
<body>
 <?php include("navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
  <div class="col-lg-10">
     <?php

    if(isset($_GET['category'])){
       $sql = mysqli_query($koneksi,"SELECT * FROM category WHERE c_id = '$_GET[category]'") or die (mysqli_error());
          while ($row = mysqli_fetch_assoc($sql)){?>
    <div class="col-lg-5">
      <div class="page-header"><h1>Edit Category</h1></div>
 
     <form class="form-horizontal" action="edit_category.php" method="post">
            
            <div class="container-fluid">
   
      <div class="form-group">
        <input type="hidden" name="cat_id" value="<?php echo $_GET['category']; ?>">
        <label for="category">Category</label>
        <input type="text" id="category" name="category_name" class="form-control" value="<?php echo "$row[c_name]" ?>">
      </div>
      <div class="form-group">
        <label for="submit"></label>
        <input type="submit" id="submit" name="update_category" class="btn btn-danger btn-block">
      </div>

    </form>
  </div>
    </div>
  <?php
    }
    }
    ?>
</div>
<footer></footer>
</body>