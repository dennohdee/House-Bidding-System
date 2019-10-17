<?php
 include "header.php";
 include "conn.php";
 error_reporting(0);
       //add post
    $type = stripslashes($_REQUEST['type']);
    $price = stripslashes($_REQUEST['price']);
    $description = stripslashes($_REQUEST['description']);
    $availability = stripslashes($_REQUEST['availability']);
    $uid = $_SESSION['uid'];
    if(isset($_REQUEST['type']))
    {
      $sql1 ="INSERT INTO `house`(`type`, `price`, `description`, `availability`, `uid`) VALUES  ('$type' ,'$price',' $description','$availability','$uid')";  
      $query1 = mysqli_query($conn, $sql1) or die();
      if($query1)
      {
        header("Location: post.php");
        $posterr =("<span class='alert alert-success'>Post Added Successfully! Please click on post below to add images</span>");
      }
      else
      {
        header("Location: post.php");
        $posterr =("<span class='alert alert-success'>Failed to Add Post! Please try again!</span>");
      }
    }
     //fetch my posts
    $sql3 = "SELECT `house`.`hid`,`house`.`type`,`house`.`time`,`house`.`price`,`house`.`availability` FROM `house` WHERE  `house`.`uid`='$uid' order by `house`.`hid` DESC";
    $query3 = mysqli_query($conn, $sql3) or die();
    $result3 = mysqli_num_rows($query3);
     //fetch my posts with pics
    $sql4 = "SELECT COUNT(`house`.`hid`) as chid,`house`.`hid`,`house`.`type`,`house`.`time`,`house`.`price`,`house`.`availability`,`images`.`image`,`userdetails`.`surname`,`userdetails`.`othernames`,`userdetails`.`phone`,`userdetails`.`email` FROM `house`,`images`,`userdetails` WHERE `house`.`uid`=`userdetails`.`uid` AND `house`.`hid`=`images`.`hid` AND `house`.`uid`='$uid' group by `images`.`hid` order by `house`.`hid` DESC ";
    $query4 = mysqli_query($conn, $sql4) or die();
    $result4 = mysqli_num_rows($query4);
    
?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Add Post
          <small>My posts</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#"><i class="fa fa-dashboard"></i> Posts</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Enter Details Below</h3>
            
          </div>
          <div class="box-body">
            
            <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
            
          </div>
          <div class="box-body">
          <?php if(isset($posterr)){ echo $posterr;}?>
           <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="type" class="form-control" placeholder="Type" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
       <div class="form-group has-feedback">
        <input type="text" name="price" class="form-control" placeholder="Price" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="checkbox">
                    <label>
                      <input name="availability" type="checkbox" value="1">
                      Available?
                    </label>
                  </div>
      <div class="form-group has-feedback">
        <textarea name="description" class="form-control" placeholder="Description" required></textarea>
      </div>
      <button type="reset" class="btn btn-default pull-left">Reset</button>
                <button type="submit" class="btn btn-primary pull-right">Post</button>
      </form>
          </div>

          </div>
          <!-- /.box-body -->
          <div class="box box-default">
          <div class="box-header">
            <h3 class="box-title">My Posts</h3>
            
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
            <a href="editpost.php?hid=<?php echo $row_pend['hid'];?>"><img src='dist/img/<?php echo $row_pend['image'];?>' alt="Img" class="img-responsive pad">
             <?php echo "KES." .$row_pend['price'].".00"; ?></a>
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
       <!-- with pics-->
            <?php while($row_pos = mysqli_fetch_assoc($query4)) { ?>
            
             <div class="col-md-6">
	      <div class="box box-default">
               <div class="box-header">
                <h3 class="box-title"> <?php echo $row_pos['type'];?></h3>
		           <div class="box-tools pull-right">
                Ref.#<?php echo $row_pos['hid'];?>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <a href="editpost.php?hid=<?php echo $row_pos['hid'];?>"><img src='dist/img/<?php echo $row_pos['image'];?>' alt="Img" class="img-responsive pad">
             <?php echo "KES." .$row_pos['price'].".00"; ?></a>
             <br><small><?php echo "Posted on " .$row_pos['time'];?></small>
             
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
        <input type="hidden" name="hid" class="form-control" value="<?php echo $row_pos['hid']; ?>" required>
        
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
