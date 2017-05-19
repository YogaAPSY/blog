<?php
  session_start();
  include("include/header.php");
  include("include/conect.php");
?>
<style type="text/css">

.navbar-brand{
  font-size: 1.8em;
}
#topContainer{
  background-image: url("image/background.jpg");
  height: 700px;
  width: 100%;
  background-size: cover;
}
#topDescription{
  margin-top: 170px;
  text-align: center;
  color: #f1c40f;
}
</style>
<script type="text/javascript">
  $("#topContainer").css("height".$(window).height());
</script>
<!-- Fixed navbar -->
  <header class="navbar navbar-inverse navbar-fixed-top" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
  <div class="container">
    <div class="navbar-header"> 
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand"><a href="index.php"><img src="image/brand.png" style="max-width:200px; margin-top: -9px;" alt="BerbagIlmu.com"><span class="label label-default">Beta</span></a></div> 
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
       <li role="presentation">
        <a href="index.php">
          <b>HOME</b>
        </a>
      </li>
      <li role="presentation">
        <a href="#" class="a-menu " data-toggle="modal" data-target="#myModal">
          <b>REGISTER</b>
        </a>
      </li>
      <li role="presentation">
        <a href="articledepan.php">
          <b>POST</b>
        </a>
      </li>
    </ul>
  </div>
</div>
</header>

<div id="topContainer">
<div class="row">
   <div class="col-md-6 col-md-offset-3" id="topDescription"  style="background-color: rgba( 0 , 0 , 0 ,0.4); padding:50px 50px 50px 50px;">
       <?php
          if(isset($_SESSION['terdaftar'])){
            echo'<div class="alert alert-success" role="alert">Anda Telah Berhasil Mendaftar</div><br>';
            unset($_SESSION['terdaftar']);
            } 
           elseif(isset($_SESSION['salah_password'])){
          echo'<div class="alert alert-danger" role="alert">Nim atau Password yang anda masukan salah atau sudah terdaftar</div><br>';
          unset($_SESSION['salah_password']);
        }
        if(isset($_SESSION['ukurangambar'])){
           echo'<div class="alert alert-danger" role="alert">Ukuran Gambar terlalu besar</div><br>';
          unset($_SESSION['ukurangambar']);
        }elseif(isset($_SESSION['errorgambar'])){
           echo'<div class="alert alert-danger" role="alert">Terjadi Error pada File Foto harap coba dengan Foto lain </div><br>';
          unset($_SESSION['errorgambar']);
        }elseif (isset($_SESSION['errorfile'])) {
           echo'<div class="alert alert-danger" role="alert">File yang anda masukan tidak sesuai dengan Format file Foto yang tersedia</div><br>';
          unset($_SESSION['errorfile']);
        }elseif (isset($_SESSION['errornim'])) {
           echo'<div class="alert alert-danger" role="alert">Nim yang anda masukan telah terdaftar</div><br>';
          unset($_SESSION['errornim']);
        }

        ?>

      <h1><b>Selamat datang di BerbagIlmu.com</b></h1><br>

    <p style="font-size:20px;">BerbagIlmu adalah tempat bagi mahasiswa untuk saling berbagi informasi seputar kehidupan dikampus</p> </br>
    <form class="form-inline" action="login.php" method="post">
            <div class="form-group">
              <input type="text" placeholder="Nim" class="form-control" name="nim">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
  </div>
</div>
</div>

<!-- Register -->
<div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
                <h2 class="modal-title">Pendaftaran Anggota</h2>
              </div>           
              <div class="modal-body">
                <form action="register.php" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                   <div class="form-group">
              <label for="foto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-8">
                <input type="file" id="image" name="image" class="btn btn-primary" id="foto" required>
              </div>
            </div>

            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-8">
                <input type="text" name="nama" placeholder="Masukan Nama Anda" class="form-control" id="nama" required>
              </div>
            </div>
            
            <div class="form-group">
              <label for="nim" class="col-sm-2 control-label">Nim</label>
              <div class="col-sm-8">
                <input type="text" name="nim" placeholder="Masukan Nim Anda" id="nim" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input type="email" name="email" placeholder="Masukan Email Anda" class="form-control" id="email" required>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-8">
                <input type="password" name="password" placeholder="Masukan Password Anda" class="form-control" id="password" required>
              </div>
            </div>

            <div class="form-group">
              <label for="kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-8">
                 <label class="radio-inline">
                    <input type="radio" name="kelamin" value="Laki-Laki" checked>Laki - Laki
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="kelamin" value="Perempuan">Perempuan
                  </label>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Jurusan</label>
              <div class="col-sm-8">
                 <select name="jurusan" class="form-control" required>
                    <option values="Teknik Informatika">Teknik Informatika</option>
                    <option values="Sistem Informasi">Sistem Informasi</option>
                    <option values="Sistem Komputer">Sistem Komputer</option>
                  </select>
              </div>
            </div>

            <div class="form-group">
              <label for="about" class="col-sm-2 control-label">Tentang</label>
              <div class="col-sm-8">
                <textarea name="about" class="form-control" cols="25" rows="3" placeholder="Masukan Deskripsi tentang Anda"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="alamat" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-8">
                <textarea name="alamat" class="form-control" cols="25" rows="5" placeholder="Masukan Alamat Anda"></textarea>
              </div>
            </div>
             <center>
                <input type="hidden" name="role" value="Publisher"/>
                <input type="submit" name="submit_value" class="btn btn-success active" value="Sign up">
                <input type="reset" name="reset" class="btn btn-danger active">
            </center>  
        </div>
      </div>

    </div>
  </div>
</div>
</form>

    <hr class="featurette-divider">
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing" >
      
      <!-- Three columns of text below the carousel -->
      <div class="row">
      <h1 style="text-align:center;">BerbagIlmu.com Team</h1></br></br>
       <div class="col-lg-4">
          <img class="img-circle" src="image/3.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Yosse Septa R</h2>
          <p>.........................................................
          .........................................................
          ..........................................................
          .......................................................
          .....................................................
          </p>
          <p><a href="#" class="a-menu btn btn-info" data-toggle="modal" data-target="#yosse">More Info &raquo;</a></p>
        </div>

        <!--- Riset -->

        <div class="col-lg-4">
          <img class="img-circle" src="image/5.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Yoga A.P</h2>
          <p>Saya adalah Programer Back-End pada BerbagIlmu.com Team. Motivasi saya menjadi bagian dalam pembuatan BerbagIlmu.com team untuk membuat
          suatu wadah bagi para mahasiswa untuk sharing seputar kehidupan kampus seperti pelajar ,pemrograman bahkan sampai hiburan seperti Dota 2 dan lain sebagainya.
          </p>
          <p><a href="#" class="a-menu btn btn-danger" data-toggle="modal" data-target="#myModal3">More Info &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        
        <div class="col-lg-4">
          <img class="img-circle" src="image/4.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Khumaidy S</h2>
          <p>
          .........................................................
          .........................................................
          ..........................................................
          .......................................................
          .....................................................
          </p>
          <p><a href="#" class="a-menu btn btn-primary" data-toggle="modal" data-target="#Khumaidy">More Info &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
        <div class="col-lg-4">
          <img class="img-circle" src="image/6.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Satrio W</h2>
          <p>.........................................................
          .........................................................
          ..........................................................
          .......................................................
          .....................................................
          </p>
          <p><a href="#" class="a-menu btn btn-info" data-toggle="modal" data-target="#Satrio">More Info &raquo;</a></p>
        </div>

        <!--- Riset -->

        <div class="col-lg-4">
          <img class="img-circle" src="image/1.png" alt="Generic placeholder image" width="140" height="140">
          <h2>Yodi Dady P</h2>
          <p>.........................................................
          .........................................................
          ..........................................................
          .......................................................
          .....................................................
          </p>
          <p><a href="#" class="a-menu btn btn-danger" data-toggle="modal" data-target="#Yodi">More Info &raquo;</a></p>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
          <img class="img-circle" src="image/2.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>Hafiz D</h2>
          <p>.........................................................
          .........................................................
          ..........................................................
          .......................................................
          .....................................................
          </p>
          <p><a href="#" class="a-menu btn btn-primary" data-toggle="modal" data-target="#Hafiz">More Info &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      <hr class="featurette-divider">

      <div id="yosse" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Designer BerbagIlmu.com</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/3.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Yosse Septa Rianto <small> Designer</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">HTML5/CSS</span>
                <span class="label label-info">Photoshop</span>
                <span class="label label-success">Corel Draw</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Quotes: </strong><br>Kalo Uong laen biso ngapo nak aku nian ?</p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>

  
      <div id="Khumaidy" class="modal fade" role="dialog">
      <div class="modal-dialog">

      <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Designer BerbagIlmu.com</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/4.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Khumaidy Sayfullah <small> Designer</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">HTML5/CSS</span>
                <span class="label label-info">Photoshop</span>
                <span class="label label-success">Corel Draw</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Quotes: </strong><br>Sukak Atik Kau lah !!</p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>


      <div id="Hafiz" class="modal fade" role="dialog">
      <div class="modal-dialog">

     <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Designer BerbagIlmu.com</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/2.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Hafiz Daramawan <small> Designer</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">HTML5/CSS</span>
                <span class="label label-info">Photoshop</span>
                <span class="label label-success">Corel Draw</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Quotes: </strong><br>Sukak Atik Kau lah !!</p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>


      <div id="Yodi" class="modal fade" role="dialog">
      <div class="modal-dialog">

    <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Designer BerbagIlmu.com</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/1.png" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Yodi Dady Prasidatama<small> Dokumentasi BerbagIlmu.com Team</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">HTML5/CSS</span>
                <span class="label label-info">Photoshop</span>
                <span class="label label-success">Corel Draw</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Quotes: </strong><br>Sukak Atik Kau lah !!</p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>



      <div id="Satrio" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Admin Dota 2 BerbagIlmu.com</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/6.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Satrio Wijaya <small> Admin Dota 2 BerbagIlmu.com</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">Miss Black Hole</span>
                <span class="label label-info">Rampage IO</span>
                <span class="label label-success">5 menit Battle Furry AM</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Quotes: </strong><br>GG EZ MID !!! </p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>


      <div id="myModal3" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="color:black;">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" style="margin-right:10px;">&times;</button>
            <h2 class="modal-title">Back-End Programer</h2>
          </div>           
          <div class="modal-body text-center">
            <div class="row-fluid">
                  <div class="span10 offset1">
                      <div id="modalTab">
                          <div class="tab-content">
                              <div class="tab-pane active" id="about">
    <img src="image/5.jpg" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
      <h3 class="media-heading">Yoga Anugrah Pratama.SY <small> Back-End Programer BerbagIlmu.com</small></h3>
                <span><strong>Skills: </strong></span>
                <span class="label label-warning">HTML5/CSS</span>
                <span class="label label-info">PHP</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-success">Bootstrap</span>
    </center>
    <hr>
    <center>
    <p class="text-left"><strong>Qoutes: </strong><br>NGAPOI BALEK ?</p>
      <br>
      </center>
      </div>
        </div>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

      </div>
    </div>
</div>

      <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="image/kategori 1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
              <h1>Pengetahuan</h1> 
              <p>Kuliah pasti identik dengan Belajar ,Disetiap pelajar yang ada dikampus pasti menghasilkan sebuah pengetahuan disini kita akan berbagi seputar pengetahuan yang telah kita dapat dalam kuliah</p>
              <!--<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn More</a></p>-->
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="image/kategori 2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
              <h1>Tips dan Trik Game</h1>
             <p>Dalam kehidupan kampus tidak hanya tentang belajar mulu biasanya mahasiswa disetiap kampus pasti ada yang memainkan sebuah game. Dan di BerbagIlmu.com kita bisa sharing seputar Tips dan Trik Game</p>
              <!--<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
            </div>
          </div>
        </div>
          <div class="item">
          <img class="second-slide" src="image/kategori 3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
              <h1>Tutorial</h1>
              <p>Banyak metode yang didapat dari internet untuk menimba Ilmu seperti membaca dan lain-lain .Tutorial juga menjadi salah satu metode yang efektif untuk belajar di luar Kegiatan kampus.Di BerbaIlmu.com juga kita akan sama-sama sharing tentang semua tutorial seperti tentang pelajaran bahkan hiburan seperti game</p>
              <!--<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
            </div>
          </div>
        </div>

         <div class="item">
          <img class="second-slide" src="image/kategori 4.jpg" alt="Fourth slide">
          <div class="container">
            <div class="carousel-caption" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
              <h1>Pemrograman</h1>
             <p>Pemrograman sudah sangat penting dikehidupan sekarang yang semakin maju jadi kita disini bisa sharing seputar pemrograman yang kita ketahui</p>
              <!--<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
            </div>
          </div>
        </div>


         <div class="item">
          <img class="second-slide" src="image/kategori 5.jpg" alt="Fifth slide">
          <div class="container">
            <div class="carousel-caption" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
              <h1>Dota 2</h1>
             <p>Dota 2 adalah salah satu game terpopuler diseluruh dunia ,dan yang pasti disebuah kampus ada banyak mahasiswa yang bermain Dota disini juga kita bisa berbagi seputar Dota 2</p>
              <!--<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
            </div>
          </div>
        </div>

         </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->
      <?php include("include/footer.php"); ?>
</body>


