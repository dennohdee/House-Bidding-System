<?php
 include "header.php";
 include "conn.php";
 error_reporting(0);
    //fetch pending
    $sql3 = "SELECT COUNT(`house`.`hid`) as chid,`house`.`hid`,`house`.`type`,`house`.`time`,`house`.`price`,`house`.`availability`,`images`.`image`,`userdetails`.`surname`,`userdetails`.`othernames`,`userdetails`.`phone`,`userdetails`.`email` FROM `house`,`images`,`userdetails` WHERE `house`.`uid`=`userdetails`.`uid` AND `house`.`hid`=`images`.`hid` AND `house`.`status`='1' group by `images`.`hid` order by `house`.`hid` DESC";
    $query3 = mysqli_query($conn, $sql3) or die();
    $result3 = mysqli_num_rows($query3);
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
        header("Location: index.php?bidmsg=Bid placed Successfully!");
      }
      else
      {
        header("Location: index.php?bidmsg=Failed to place bid. Try again!");
      }
    }
    
?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Home
          <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Houses</h3>
            
          </div>
          <div class="box-body">
            <div class="row">
            <?php while($row_pend = mysqli_fetch_assoc($query3)) { ?>
            
             <div class="col-md-6">
	      <div class="box box-default">
               <div class="box-header">
                <h3 class="box-title"> <?php echo $row_pend['type'];?></h3>
		           <div class="box-tools pull-right">
                Ref.#<?php echo $row_pend['hid'];?>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="postdets.php?hid=<?php echo $row_pend['hid'];?>"><img src='dist/img/<?php echo $row_pend['image'];?>' alt="Img" class="img-responsive pad">
             <?php echo "KES." .$row_pend['price'].".00".". Owned by ".$row_pend['surname']." of ".$row_pend['phone']; ?></a>
             <br><small><?php echo "Posted on " .$row_pend['time'];?></small>
             <button data-toggle="modal"data-target="#modal-default" class="btn btn-sm btn-success pull-right"style="margin-right:10px;"> Bid </button>
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
        <input type="number" name="ref" class="form-control" placeholder="Ref#" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" name="price" class="form-control" placeholder="Bid Price" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="hidden" name="hid" class="form-control" value="<?php echo $row_pend['hid']; ?>" required>
        
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
