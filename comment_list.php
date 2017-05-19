<?php
  include("include/header.php");
  include("include/conect.php");
  session_start();

  if(isset($_GET['delete_comment'])){
  
    mysqli_query($koneksi,"DELETE FROM comment WHERE id='$_GET[delete_comment]'") or die (mysql_error());
   
    header("location:comment_list.php");

  }
?>
</head>
<body>
 <?php include("include/navbar_admin.php") ?>
<div style="width:50px; height:50px;"></div>
<?php include"admin_panel.php" ?>
  <div class="col-lg-10">
  <div style="width:50px; height:50px;"></div>
 <!--Category List Start-->

<?php

  $perpage = 5;
  $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
  $start = ($page > 1) ? ($page * $perpage ) - $perpage : 0;

  $articles = "SELECT * from comment LIMIT $start , $perpage";
  $result2 = mysqli_query($koneksi, $articles);

  $result = mysqli_query($koneksi , "SELECT * FROM comment");
  $total = mysqli_num_rows($result);

  $pages = ceil($total/$perpage);
echo'
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3>Comment List</h3>
    </div>

    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <th>No</th>
          <th>Nama</th>
          <th>Subjek</th>
          <th>Deskripsi</th>
          <th>Delete</th>
        </thead>
        <tbody>
        ';
         $no=1;
         while($row = mysqli_fetch_assoc($result2)){
      echo'
          <tr>
            <td>'.$no.'</td>
            <td>'.$row['nama'].'</td>
            <td>'.$row['subject'].'</td>
            <td>'.$row['komen'].'</td>
            <td>
               <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete one track, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <a href="#" data-href="comment_list.php?delete_comment='.$row['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"><i class="
glyphicon glyphicon-trash"></i> Delete</a><br>

            </td>
          </tr>
        ';
        $no ++;
      }

?>
<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
 </tbody>

    </table>
  </div>
</div>
</div>
 
<div class="text-center">
<nav>
<ul class="pagination">
<?php
  if(isset($_GET['halaman'])){
    if ( $_GET['halaman'] > 1 ) {
    $link = $_GET['halaman']-1;
    $prev ='<li><a href="?halaman='.$link.'" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a></li>';
    } else {
    $prev = '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
    }
    echo $prev;
    }
  else{
    $_GET['halaman'] = 1;
    $prev = '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
    echo $prev;
  }
?>
  <?php for($i = 1; $i <= $pages; $i++ ){

  if (isset($_GET['halaman'])) {
    if ( $_GET['halaman'] == $i){
      $class = 'active';
    } else{
      $class = ' ';
    }
  } else{
    $class = ' ';
  }

    echo'
    <li class="'.$class.'"><a href="?halaman='.$i.'"> '.$i.' </a></li>
    ';      
  } ?>
  <?php
  if(isset($_GET['halaman'])){
    if ( $_GET['halaman'] < $pages ) {
    $link = $_GET['halaman']+1;
    $next ='<li><a href="?halaman='.$link.'" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a></li>';
    } else {
    $next = '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
    }
    echo $next;
    }
  ?>
  </ul>
</nav>
</div>
<footer></footer>
</body>