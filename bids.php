<?php
 include "header.php";
 include "conn.php";
  error_reporting(0);
    //fetch my bids
    $uid = $_SESSION['uid'];
    $sql3 = "SELECT `bid`.`bid`,`bid`.`bidprice`,`bid`.`time`,`bid`.`status`,`house`.`hid`,`house`.`type`,`userdetails`.`surname`,`userdetails`.`othernames`,`userdetails`.`email`,`userdetails`.`phone` FROM `bid`,`house`,`userdetails` WHERE `house`.`hid`=`bid`.`hid` AND `userdetails`.`uid`=`house`.`uid` AND `userdetails`.`uid`='$uid'";
    $query3 = mysqli_query($conn, $sql3) or die();
    $result3 = mysqli_num_rows($query3);
    
    //approve
    $cuid = $_REQUEST['cuid'];
    if(isset($_REQUEST['app']))
    {
      
      $sql2 ="UPDATE `bid` SET `status`='1' WHERE `bid`='$cuid'";  
      $query2= mysqli_query($conn, $sql2) or die();
      if($query2)
      {
        header("Location: bids.php");
        $edit=("<span class='alert alert-dismissible alert-success'>Bid Approved Successfully!</span>");
      }
      else
      {
        header("Location: bids.php");
         $edit=("<span class='alert alert-danger'>Failed to Approve. Try again!</span>");
      }
    }
    //reject
    
    if(isset($_REQUEST['rej']))
    {
      $sql2 ="UPDATE `bid` SET `status`='2' WHERE `bid`='$cuid'";  
      $query2= mysqli_query($conn, $sql2) or die();
      if($query2)
      {
        
        $edit=("<span class='alert alert-success'>Bid Rejected Successfully!</span>");
      }
      else
      {
        header("Location: bids.php");
         $edit=("<span class='alert alert-danger'>Failed to Reject. Try again!</span>");
      }
    }
    
?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          My Bids
          <small>Bid lists</small>
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
            <h3 class="box-title"></h3>
            
          </div>
          <div class="box-body">
            
            <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
            
          </div>
          <div class="box-body"><?php if(isset($edit)){echo $edit;}?>
            <small>Filter by Ref# on input above OR Search by anything on the right Search</small><br>
            
                <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered table-striped no-padding" id="myTable">
                <thead><tr>
                  <th>Ref#</th>
                  <th>House Type</th>
                  <th>Owner Phone</th>
                  <th>Owner Mail</th>
                  <th>Bid Price</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead><?php while($row_mybid = mysqli_fetch_assoc($query3)) { ?>
                <tr>
                  <td><?php echo $row_mybid['hid'];?></td>
                  <td><?php echo $row_mybid['type'];?></td>
                  <td><?php echo $row_mybid['phone'];?></td>
                  <td><?php echo $row_mybid['email'];?></td>
                  <td><?php echo $row_mybid['bidprice'];?></td>
                  <td><?php echo $row_mybid['time'];?></td>
                  <td><?php if($row_mybid['status'] == 1){ echo '<span class="label label-success">Approved</span>';}
                  else if($row_mybid['status'] == 2){ echo '<span class="label label-danger">Rejected</span>';}
                  else {echo '<span class="label label-warning">Pending</span>';}?></td>
                  <td>
                   <form action="" method="post">
                  <input type="hidden" name="cuid" value="<?php echo $row_mybid['bid'];?>">
                  <?php if($row_mybid['status'] == 1){ print '
                      <div class="btn-group">
                      <button type="submit" name="app" class="btn btn-success disabled" onsubmit="return confirm("Approve User?")">Approve</button>
                      <button type="submit" name="rej" class="btn btn-danger">Reject</button>
                      
                      </div>';} else
                      if($row_mybid['status'] == 2){ print '
                      <div class="btn-group">
                      <button type="submit" name="app" class="btn btn-success" onsubmit="return confirm("Approve User?")">Approve</button>
                      <button type="submit" name="rej" class="btn btn-danger disabled">Reject</button>
                      
                      </div>';} 
                      else
                        if($row_mybid['status'] == 0){ print '
                      <div class="btn-group">
                      <button type="submit" name="app" class="btn btn-success" onsubmit="return confirm("Approve User?")">Approve</button>
                      <button type="submit" name="rej" class="btn btn-danger">Reject</button>
                      
                      </div>';} 
                      ?>
                      </form></td>
                </tr>
               <?php } ?>
              </tbody></table>
            </div>
           
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
 <script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
<?php
 include "footer.php";
?>
