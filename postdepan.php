<?php
  session_start();
  include("include/header.php");
  include("include/conect.php");
?>

</head>
<body>
  <!-- Fixed navbar -->
  <header class="navbar navbar-inverse navbar-fixed-top" style="background-color: rgba( 0 , 0 , 0 ,0.5);">
  <div class="container">
    <div class="navbar-header"> 
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" class="navbar-brand"><b>BerbagIlmu.com</b> <span class="label label-default">Beta</span></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
       <li role="presentation">
        <a href="index.php">
          <b>Home</b>
        </a>
      </li> 
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <b>Articles</b> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
            $sel_cat =  mysqli_query($koneksi ,"SELECT * FROM category") or die (mysqli_error());
            while ($row = mysqli_fetch_assoc($sel_cat)){
            echo'
              <li><a href="postdepan.php?cat_name='.$row['c_name'].'">'.ucfirst($row['c_name']).'</a></li>
              ';
            }
          ?>
            </ul>
        </li>
      <li role="presentation">
        <a href="articledepan.php">
          <b>Post</b>
        </a>
      </li>
    </ul>
  </div>
</div>
</header>

  <div class="container" style="margin-top : 80px">
    <article class="row">
      <section class="col-lg-8">
        <?php

        $result = mysqli_query($koneksi , "SELECT * FROM posts WHERE id = '$_GET[post_id]' AND status='published'");
        $no = 1;
        while($row = mysqli_fetch_assoc($result)){ 
        if($row['status'] == 'published'){
            echo'
              <div class="panel panel-success">
              <div class="panel-heading">
                <h3>'.$row['tittle'].'</h3>
              </div>
                <div class="panel-body">
                    <img src="'.$row['image'].'" width="100%">
                    <p class="text-danger">'.date('Y-m-d h:i:s').' WIB - '.$row['author'].'</p>
                    <p>
                      '.$row['description'].'
                    </p>
                </div>
              </div>  

            ';
          }
          }
        ?>  
       
      </section>
      <aside class="col-lg-4">
      <?php include('include/sidebardepan.php'); ?>
      </aside>
    </article>
    <div class="clearfix"></div>
    <div>
      
    </div>
  </div>
  <?php include("include/footer.php"); ?>
</body>
</html>