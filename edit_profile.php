<?php
  include("include/header.php");
  include("include/conect.php");
  session_start();
     if(isset($_POST['submit_profile'])){
      $nama1 = strip_tags($_POST['nama']);
      $nim1 = strip_tags($_POST['nim']);
      $email1 = strip_tags($_POST['email']);
      $password1 = md5(trim(htmlspecialchars($_POST['password'])));
      $jurusan1 = $_POST['jurusan'];
      $kelamin1 = $_POST['kelamin'];
      $about1 = $_POST['about'];
      $alamat1 = $_POST['alamat'];
     if(isset($_FILES['image'])){
      $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_ext = pathinfo($image_name , PATHINFO_EXTENSION);
    $image_path = 'image/'.$image_name;
    $image_db_path = 'image/'.$image_name;
    echo"kok";
    if($image_size < 1000000000 ){
      if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
        
        if(move_uploaded_file($image_tmp, $image_path)){
          
          $ins_sql = "UPDATE data_mahasiswa SET Nama = '$nama1', Email = '$email1', Password = '$password1', Kelamin = '$kelamin1', Jurusan = '$jurusan1' ,About = '$about1', Alamat = '$alamat1' ,image = '$image_db_path' WHERE Nim = '$_POST[change]'";
          if(mysqli_query($koneksi,$ins_sql)){
            $_SESSION['update_profile'] = true;
            header("Location: profile.php?cat_name=Profile&details=$_POST[change]");
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
  <?php include("include/navbar.php"); ?>
<?php 
     if(isset($_GET['details'])){
         $sql =  mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE Nim = '$_GET[details]'");
      while ($row = mysqli_fetch_array($sql)) {?>
<div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
      
      <!-- edit form column -->
      <div class="col-md-12 personal-info">
        <form method="post" action="edit_profile.php" class="form-horizontal" role="form" enctype="multipart/form-data">
             
               <div class="form-group">
            <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
           <label class="col-lg-3 control-label" for="image"></label>
        <img src="<?php echo $row['image'] ?>" width="100px">
      </div>
            <div class="form-group">
            <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
           <label class="col-lg-3 control-label" for="image">Foto:</label>
        <input type="file" id="image" name="image" class="btn btn-primary">
      </div>

          <div class="form-group">
            <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-lg-3 control-label">Nama:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $row['Nama']; ?>" name="nama">
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-lg-3 control-label">Nim:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $row['Nim']; ?>" name="nim">
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="email" value="<?php echo $row['Email']; ?>" name="email">
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
              <input class="form-control" type="password" name="password">
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-lg-3 control-label">Jurusan:</label>
            <div class="col-lg-8">
              <select name="jurusan" class="form-control" style="margin-bottom:10px;" name="jurusan" required>
                <option values="Teknik Informatika">Teknik Informatika</option>
                <option values="Sistem Informasi">Sistem Informasi</option>
                <option values="Sistem Komputer">Sistem Komputer</option>
              </select>
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-md-3 control-label">Jenis Kelamin:</label>
            <div class="col-md-8">
              <label class="radio-inline" style="margin-bottom:10px;">
                <input type="radio" name="kelamin" value="Laki-Laki" name="kelamin" checked>Laki - Laki
              </label>
              <label class="radio-inline" style="margin-bottom:10px;">
                <input type="radio" name="kelamin" value="Perempuan">Perempuan
              </label>
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-md-3 control-label">Tentang Saya:</label>
            <div class="col-md-8">
              <textarea name="about" class="form-control" cols="25" rows="3" style="margin-bottom:10px;"><?php echo $row['About']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
             <input type="hidden" name="change" value="<?php echo $_GET['details']; ?>">
            <label class="col-md-3 control-label">Alamat:</label>
            <div class="col-md-8">
              <textarea name="alamat" class="form-control" cols="25" rows="5" style="margin-bottom:10px;"><?php echo $row['Alamat']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" name="submit_profile" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
';
<?php }
}
?>
<?php include("include/footer.php"); ?>
</body>