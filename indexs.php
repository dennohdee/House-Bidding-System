<?php
 include "header.php";
 include "conn.php";
 
    //fetch houses
    $sql3 = "SELECT COUNT(`house`.`hid`) as chid,`house`.`hid`,`house`.`type`,`house`.`time`,`house`.`price`,`house`.`availability`,`images`.`image`,`userdetails`.`surname`,`userdetails`.`othernames`,`userdetails`.`phone`,`userdetails`.`email` FROM `house`,`images`,`userdetails` WHERE `house`.`uid`=`userdetails`.`uid` AND `house`.`hid`=`images`.`hid` AND `house`.`status`='1' group by `images`.`hid` order by `house`.`hid` DESC";
    $query3 = mysqli_query($conn, $sql3) or die();
    $result3 = mysqli_num_rows($query3);
    
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
            
             <div class="col-md-6" id="col">
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
             
               <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Place Bid</h4>
              </div>
              <div class="modal-body">
                <form action="" method="post">
      
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
      
    </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Place Bid</button>
              </div>
            </div>
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