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
          <b><i class="glyphicon glyphicon-home"></i> HOME</b>
        </a>
      </li>
      <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <b>ARTIKEL</b> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
            $sel_cat =  mysqli_query($koneksi ,"SELECT * FROM category") or die (mysqli_error());
            while ($row = mysqli_fetch_assoc($sel_cat)){
            echo'
              <li><a href="menudepan.php?cat_name='.$row['c_name'].'">'.ucfirst($row['c_name']).'</a></li>
              ';
            }
          ?>
            </ul>
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