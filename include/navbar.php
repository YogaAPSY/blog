<header class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header"> 
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand"><a href="article.php"><img src="image/brand.png" style="max-width:200px; margin-top: -9px;" alt="BerbagIlmu.com"><span class="label label-default">Beta</span></a></div> 
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
            <li role="presentation">
      <?php 
        if (isset($_GET['cat_name'])) {
            if ( $_GET['cat_name'] != 'Home'){
              $class = ' ';
            } else{
              $class = 'active';
            }
          } else{
            $class = 'active';
          }
          echo '<li class="'.$class.'"><a href="article.php"><b><i class="glyphicon glyphicon-home"></i> Home</a></b></li>';
      ?>
      </li>

      <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <b>Articles</b> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
            $sel_cat =  mysqli_query($koneksi ,"SELECT * FROM category") or die (mysqli_error());
            while ($row = mysqli_fetch_assoc($sel_cat)){
            echo'
              <li><a href="menu.php?cat_name='.$row['c_name'].'">'.ucfirst($row['c_name']).'</a></li>
              ';
            }
          ?>
            </ul>
        </li>

         <li class="dropdown">
          <?php
        if(isset($_SESSION['nama'])){
          echo'<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Welcome, '.$_SESSION['nama'].'<span class="caret"></span></b></a>';
        }
      ?>
                <ul class="dropdown-menu">
                    <?php
                      if(isset($_SESSION['nim'])){
            echo'
            <li><a href="profile.php?cat_name=Profile&details='.$_SESSION['nim'].'"><i class="icon-envelope"></i>Profile</a></li>
            ';
          }
                    ?>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="icon-off"></i> Sign Out</a></li>
                </ul>
          </li>
    </ul>
  </div>
</div>
</header><br><br><br><br>