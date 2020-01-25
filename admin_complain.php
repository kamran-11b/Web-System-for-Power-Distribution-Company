<?php 
   session_start();
   include("database/connectdb.php");

   if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $admin_email = $_SESSION["admin_email"];
    $admin_id_q = "SELECT admin_id FROM admin WHERE admin_email='$admin_email' ";
    $admin_result = $connect->query($admin_id_q);
    $admin_row = $admin_result->fetch_assoc();
    $admin_id = $admin_row['admin_id'];
    
    $fq = "SELECT * FROM `complain`ORDER BY complain_id DESC";
    $result = $connect->query($fq);

    $fq1 = "SELECT * FROM `complain`ORDER BY complain_id DESC";
    $result1 = $connect->query($fq1);


      // Delete Files
   if(isset($_GET["complain_id"]))
   {
    $complain_id = $_GET["complain_id"];
    if($complain_id!=null)
    {
        $sql_d="DELETE FROM complain WHERE complain_id=$complain_id";
        if($connect->query($sql_d))
        {
            echo "Successfully Deleted";
            header('location: admin_complain.php');
        }
    }
}

if(isset($_POST['update'])){
    $id = $_POST['complain_id'];
    $status = $_POST['status'];


    $sql = "UPDATE `complain` SET `status`= '$status' WHERE complain_id='$id' ";

    if($connect->query($sql)==true){
    	
        header('location:admin_complain.php');
    }
}

if(isset($_GET['delete'])){

        $id=$_GET['delete'];
        $del = "DELETE FROM `Complain` WHERE complain_id='$id' ";

        if($connect->query($del) == true){
            echo '<script> alert("DELETE Data Successfully!!!");</script>';
            header('location:admin_complain.php');
        }
    }


?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Complain</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allura|Josefin+Sans">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
   
     .main-contant {
        margin: 25px 30px 10px 30px;
    }
    .b1{
        font-variant: small-caps;
    }
    .b2{
        font-variant: small-caps;
        color: green;
    }
    .form-horizontal label {
        text-align: right;
    }
    .id2 {
        border:1px solid #999;
        border-radius:10px;
        box-shadow:0 0 40px #F5F5F5;
        font-variant: small-caps;
    }
    .table-hover tbody tr:hover td {
      background-color: #DAA520;
  }


</style>

</head>

<body>
    <div class="container-fluid">
        <?php include("include/header_admin.php"); ?>
        <div class="row main-contant">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="b2">Latest Complain:</h4>
            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 240px;">
                    <?php  if ($result->num_rows > 0) {?>
                        <table class="table table-bordered table-striped mb-0 table-hover" style="background-color: #CCBE8A;">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="th-sm">C.No</th>
                                    <th class="th-sm">Name</th>
                                    <th class="th-sm">Email</th>
                                    <th class="th-sm">M.Number</th>
                                    <th class="th-sm">C.Title</th>
                                    <th class="th-sm">Date</th>
                                    <th class="th-sm">Complain</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;while ($row = $result->fetch_assoc()) {?>
                                    <tr><?php if( $row['status']==1) {?>
                                        <td><?php echo $row['complain_id'] ?></td>
                                        <td><?php echo $row['name'] ?> </td>
                                        <td><?php echo $row['email'] ?> </td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['complain_type'] ?></td>
                                        <td><?php echo $row['complain_date'] ?></td>
                                        <td> <textarea class="form-control" rows="1"><?php echo $row['complain'] ?></textarea></td>
                                        <td>
                                           <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['complain_id'] ?>">View</button>
                                           <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update<?php echo $row['complain_id'] ?>">Pending</button>
                                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['complain_id'] ?>">Delete</button>
                                       </td>
                                   </tr>

                                   <div id="myModal<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog id2">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h4 class="modal-title">Complain View</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body bg-dark text-white">
                                                <from class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">Name :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['name'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Phone :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"value=" <?php echo $row['email'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">E-Mail :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['phone'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">Address :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['complain_type'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Connection :</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" rows="5"><?php echo $row['complain'] ?></textarea>
                                                        </div>
                                                    </div>

                                                </from>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--Modal: modal Confirm Update Start-->
                                <div id="update<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <i class="material-icons" style="font-size: 5rem; color: green;">done</i>
                                                    <p style="font-size: 20px;">Are you sure you want to solve this problem?</p><br>
                                                    <input type="hidden" name="status" value="<?php echo "$admin_id"; ?>">
                                                    <input type="hidden" name="complain_id" value=" <?php echo $row['complain_id'] ?>" >
                                                    <button type="button" class="btn btn-danger btn-sm" style="padding-left: 25px;padding-right:25px;" data-dismiss="modal">NO</button>
                                                    <button type="submit" name="update" value="update" style="padding-left: 25px;padding-right:25px;" class="btn btn-info btn-sm">YES</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal: modal Confirm Update End-->

                                <!--Modal: modal Confirm Delete Start-->
                                <div id="delete<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                                <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                                <button type="button" class="btn btn-info btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                                <a href="?delete=<?php echo $row['complain_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-danger btn-sm">YES</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal: modal Confirm Delete End-->


                            <?php } ?>
                            <?php $i++; } ?>
                        </tbody>
                        </table><?php } ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="row main-contant">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="b2">Solved Complain:</h4>
            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 240px;">
                    <?php  if ($result1->num_rows > 0) {?>
                        <table class="table table-bordered table-striped mb-0 table-hover" style="background-color: #CCBC8B;">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="th-sm">C.No</th>
                                    <th class="th-sm">Admin Id</th>
                                    <th class="th-sm">Name</th>
                                    <th class="th-sm">Email</th>
                                    <th class="th-sm">M.Number</th>
                                    <th class="th-sm">C.Title</th>
                                    <th class="th-sm">Date</th>
                                    <th class="th-sm">Complain</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;while ($row = $result1->fetch_assoc()) {?>
                                    <tr><?php if( $row['status']!=1) {?>
                                        <td><?php echo $row['complain_id'] ?></td>
                                        <td><?php echo $row['status'] ?></td>
                                        <td><?php echo $row['name'] ?> </td>
                                        <td><?php echo $row['email'] ?> </td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['complain_type'] ?></td>
                                        <td><?php echo $row['complain_date'] ?></td>
                                        <td> <textarea class="form-control" rows="1"><?php echo $row['complain'] ?></textarea></td>
                                        <td>
                                         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['complain_id'] ?>">View</button>
                                         <button type="button" class="btn btn-success">Solved</button>
                                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['complain_id'] ?>">Delete</button>
                                     </td>
                                 </tr>

                                 <div id="myModal<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog id2">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h4 class="modal-title">Complain View</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body bg-dark text-white">
                                                <from class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">Name :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['name'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Phone :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control"value=" <?php echo $row['email'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">E-Mail :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['phone'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label  class="col-sm-3 control-label">Address :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" value=" <?php echo $row['complain_type'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 control-label">Connection :</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" rows="5"><?php echo $row['complain'] ?></textarea>
                                                        </div>
                                                    </div>

                                                </from>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Modal: modalConfirmDelete-->
                                <div id="update<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <i class="material-icons" style="font-size: 5rem; color: green;">done</i>
                                                    <p style="font-size: 20px;">Are you sure you want to solve this problem?</p><br>
                                                    <input type="hidden" name="status" value="2">
                                                    <input type="hidden" name="complain_id" value=" <?php echo $row['complain_id'] ?>" >
                                                    <button type="button" class="btn btn-info btn-sm" style="padding-left: 25px;padding-right:25px;" data-dismiss="modal">NO</button>
                                                    <button type="submit" name="update" value="update" style="padding-left: 25px;padding-right:25px;" class="btn btn-danger btn-sm">YES</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal: modalConfirmDelete-->

                                <!--Modal: modal Confirm Delete Start-->
                                <div id="delete<?php echo $row['complain_id'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                                <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                                <button type="button" class="btn btn-info btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                                <a href="?delete=<?php echo $row['complain_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-danger btn-sm">YES</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal: modal Confirm Delete End-->

                            <?php } ?>
                            <?php $i++; } ?>
                        </tbody>
                        </table><?php } ?>
                    </div>
                </div>
            </div>
        </div><br>


        <!-- Footer Start-->
        <?php include("include/footer.php"); ?><br>
        <!-- Footer End-->
    </div>
</body>

</html>
<?php
} else {
header("location:admin_login.php");
}
?>