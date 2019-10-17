<?php
include "header.php";
 include "conn.php";
 error_reporting(0);
      $url = $_GET['hid'];
//fetch my posts
    $sql3 = "SELECT COUNT(`house`.`hid`) as chid,`house`.`hid`,`house`.`type`,`house`.`time`,`house`.`price`,`house`.`availability`,`images`.`image`,`userdetails`.`surname`,`userdetails`.`othernames`,`userdetails`.`phone`,`userdetails`.`email` FROM `house`,`images`,`userdetails` WHERE `house`.`uid`=`userdetails`.`uid` AND `house`.`hid`=`images`.`hid` AND `house`.`hid`='$url' order by `images`.`hid` DESC";
    $query3 = mysqli_query($conn, $sql3) or die();
    $row_posts = mysqli_fetch_assoc($query3);
    $result3 = mysqli_num_rows($query3);
    
    $sql4 = "SELECT `images`.`image` FROM `images` WHERE `images`.`hid`='$url' order by `images`.`hid` DESC";
    $query4 = mysqli_query($conn, $sql4) or die();
    //bid
    $hid = stripslashes($_REQUEST['ref']);
    $price = stripslashes($_REQUEST['price']);
    $uid = $_SESSION['uid'];
    if(isset($_REQUEST['ref']))
    {
      $sql1 ="INSERT INTO `bid` (`bidprice`,`uid`,`hid`) VALUES ('$price','$uid','$hid')";  
      $query1 = mysqli_query($conn, $sql1) or die();
      if($query1)
      {
        header("Location: index.php");
        $bidmsg = ("<span class='alert alert-success'>Bid Placed Successfully!</span>");
      }
      else
      {
        header("Location: index.php");
        $bidmsg = ("<span class='alert alert-danger'>Failed to place bid. Try again!</span>");
      }
    }
?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Houses
          <small>House Details</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i> Posts Details</a></li>
         
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $row_posts['type'];?> <?php echo " KES." .$row_posts['price'].".00".". Owned by ".$row_posts['surname']." of ".$row_posts['phone']; ?>
             <br><small><?php echo "Posted on " .$row_posts['time'];?></small></h3>
            <div class="box-tools pull-right">
                Ref.#<?php echo $row_posts['hid']. "  ";?>
                &nbsp;<button data-toggle="modal"data-target="#modal-default" class="btn btn-sm btn-success pull-right"style="margin-right:10px;"> Bid </button>
              </div>
          </div>
          <div class="box-body">
          <?php if(isset($bidmsg)){ echo $bidmsg;}?>
            <div class="row">
           
            <?php while($row_post = mysqli_fetch_assoc($query4)) { ?>
             <div class="col-md-6">
	      <div class="box box-default">
               
            <div class="box-body">
           <img src='dist/img/<?php echo $row_post['image'];?>' alt="Img" class="img-responsive pad">
             
               <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Place Bid</h4>
              </div>
              <div class="modal-body">
                <form name="bid" action="" method="post">
      
      <div class="form-group has-feedback">
        <input type="number" name="ref"value="<?php echo $row_posts['hid']; ?>" class="form-control" placeholder="Ref#" disabled required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" name="price" class="form-control" placeholder="Bid Price" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="hidden" name="hid" class="form-control" value="<?php echo $row_posts['hid']; ?>" required>
        
      </div>
      
    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Place Bid</button>
              </div>
            </div>
           </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
            </div>
            <!-- /.box-body -->
          </div>		
		</div>
          
<?php } ?>
	       </div>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

<!-- ./wrapper -->
<?php
 include "footer.php";
?>
