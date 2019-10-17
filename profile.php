<?php
 include "header.php";
    include "conn.php";
    error_reporting(0);
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM userdetails WHERE  uid='$uid'";
    $query1 = mysqli_query($conn,$sql);
    $row_user = mysqli_fetch_assoc($query1);
    //edit
    $uid = $_SESSION['uid'];
    $email = $_REQUEST['email'];
    $surname = $_REQUEST['surname'];
    $othernames = $_REQUEST['othernames'];
    $idno = $_REQUEST['idno'];
    $phone = $_REQUEST['phone'];
    $password = $_REQUEST['password'];
    if(isset($_REQUEST['update']))
    {
      $sql2 ="UPDATE `userdetails` SET `email`='$email',`surname`='$surname',`othernames`='$othernames',`idno`='$idno',`phone`='$phone',`password`='$password' WHERE `uid`='$uid'";  
      $query2= mysqli_query($conn, $sql2) or die();
      if($query2)
      {
        header("Location: profile.php");
        $edit=("<span class='alert alert-success'>Profile updated Successfully!</span>");
      }
      else
      {
        header("Location: profile.php");
         $edit=("<span class='alert alert-danger'>Failed to update. Try again!</span>");
      }
    }
 
 ?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Profile
          <small>Edit Details</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Profile</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">My Details</h3>
          </div>
          <div class="container-fluid">
          <?php if(isset($edit)){ echo $edit;}?>
          <div class="row">
          <div class="col-md-4">
                        <div class="card card-user">
                            
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="dist/img/face-0.jpg" alt="..."/>

                                      <h4 class="title"><?php echo $row_user['surname']; echo " "; echo $row_user['othernames']; ?><br /><br />
                                         <small><?php echo $row_user['email']; ?></small>
                                         <h3><?php echo $row_user['type']; ?></h3>
                                      </h4>
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            
                            <div class="content">
                                <form name="f1" action="" method="post">
                                    <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $row_user['email']; ?>">
                                            </div>
                                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sur Name</label>
                                                <input type="text" name="surname" class="form-control" placeholder="Sur Name" value="<?php echo $row_user['surname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Other Name</label>
                                                <input type="text" class="form-control" name="othername" placeholder="Other Name" value="<?php echo $row_user['othernames']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone </label>
                                                <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="<?php echo $row_user['phone']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status.</label>
                                                <input type="text" class="form-control" placeholder="User Type." value="<?php echo $row_user['status']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID No.</label>
                                                <input type="number" class="form-control" name="idno" placeholder="ID No." value="<?php echo $row_user['idno']; ?>">
                                            </div>
                                        </div>
                                        </div>
                                         <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Password" value="" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" >
                                            </div>
                                        </div>
                                    </div>

                                  

                                    <button type="submit" name="update" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
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
