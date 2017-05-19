<?php
	include("include/header.php");
	include("include/conect.php");
  session_start();

if(isset($_POST['submit_post'])){
    
    $title = strip_tags($_POST['title']);
    $description = $_POST['description'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $date = date('Y-m-d h:i:s');
    $author = $_SESSION['author'];
    if(isset($_FILES['image'])){
      $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_ext = pathinfo($image_name , PATHINFO_EXTENSION);
    $image_path = 'image/'.$image_name;
    $image_db_path = 'image/'.$image_name;
    
    if($image_size < 100000000 ){
      if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
        
        if(move_uploaded_file($image_tmp, $image_path)){
          
          $ins_sql = "UPDATE posts SET tittle = '$title' , description= '$description',image= '$image_db_path',category='$category' ,status='$status' ,dates='$date' ,author='$author' WHERE id = '$_POST[post_id]'";
          if(mysqli_query($koneksi,$ins_sql)){
            $_SESSION['update_post'] = true;
            header("Location: post_list.php");
          }else{
            $error = die(mysql_error());
          }
        }
        else{
          $error = '<div class"alert alert-danger">Maaf ,Gambar nya tidak bisa di upload</div>';
        }
      }
      else{
        $error = '<div class"alert alert-danger">Format gambar tidak benar</div>';
      }
    }
    else{
      $error = '<div class"alert alert-danger">Ukuran gambar terlalu besar</div>';
    }
    }
}

?>

</head>
<body>
<?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
<?php
if(isset($_GET['edit_post'])){
  $sql = mysqli_query($koneksi,"SELECT * FROM posts WHERE id = '$_GET[edit_post]'") or die (mysqli_error());
          while ($row = mysqli_fetch_assoc($sql)){ ?>
            
  <div class="col-lg-10">
  <div class="container-fluid">
     <div class="page-header"><h1>Edit Post <i class="
glyphicon glyphicon-edit"></i></h1></div>
    <form class="form-horizontal" action="edit_post.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" name="post_id" value="<?php echo $_GET['edit_post']; ?>">
        <img src="<?php echo $row['image'] ?>" width="100px">
        <label for="image">Upload an Image</label>
        <input type="file" id="image" name="image" class="btn btn-primary">
      </div>

      <div class="form-group">
        <input type="hidden" name="post_id" value="<?php echo $_GET['edit_post']; ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $row['tittle']?>">
      </div>

      <div class="form-group">
        <input type="hidden" name="post_id" value="<?php echo $_GET['edit_post']; ?>">
        <label for="category">Category</label>
        <select id="category" name="category" class="form-control">';
        <?php  
            $cat = mysqli_query($koneksi,"SELECT * FROM category") or die (mysql_error());
          while ($cat_name = mysqli_fetch_assoc($cat)){
            echo'<option value="'.$cat_name['c_name'].'">'.$cat_name['c_name'].'</option>';
          }
      ?>
        </select>
      </div>

      <div class="form-group">
        <input type="hidden" name="post_id" value="<?php echo $_GET['edit_post']; ?>">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control"> 
          <?php echo $row['description'] ?>
        </textarea>
      </div>

      <div class="form-group">
        <input type="hidden" name="post_id" value="<?php echo $_GET['edit_post']; ?>">
        <label for="status">Status</label>
        <select id="category" name="status" class="form-control">
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
      </div>

      <div class="form-group">
        <label for="submit"></label>
        <input type="submit" id="submit" name="submit_post"class="btn btn-danger btn-block">
      </div>

    </form>
  </div>

</div>';
<?php }
} ?>
<footer></footer>
</body>