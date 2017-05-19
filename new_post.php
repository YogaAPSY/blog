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
        
          $ins_sql = "INSERT INTO posts(tittle , description ,image ,category ,status ,dates ,author) 
          VALUES('$title', '$description', '$image_db_path', '$category' , '$status' ,'$date' , '$author')";
          if(mysqli_query($koneksi,$ins_sql)){
            $_SESSION['new_post'] = true;
            header('post_list.php');
          }else{
            $error = die(mysql_error());
          }
        }
        else{
          $error = '<div class"alert alert-danger">Maaf ,Gambar nya tidak bbisa di upload</div>';
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
  <div class="col-lg-10">
  <div class="container-fluid">
    <div class="page-header"><h1>New Post <i class="
glyphicon glyphicon-pencil"></i></h1></div>
<?php
  if(isset($_SESSION['new_post'])){
      echo '<div class="alert alert-success" role="alert">Artikel telah berhasil di Posting</div>';
      unset($_SESSION['new_post']);
    }
?>

    <form class="form-horizontal" action="new_post.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="image">Upload an Image</label>
        <input type="file" id="image" name="image" class="btn btn-primary">
      </div>

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control">
      </div>

      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" class="form-control">
          <?php
            $sql = mysqli_query($koneksi,"SELECT * FROM category") or die (mysql_error());
          while ($row = mysqli_fetch_assoc($sql)){
            echo'<option value="'.$row['c_name'].'">'.$row['c_name'].'</option>';
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control"></textarea>
      </div>

      <div class="form-group">
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

</div>
<footer></footer>
</body>