<?php
session_start();
include "database/connectdb.php";


if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $q1 = "SELECT * FROM customer NATURAL JOIN residential NATURAL JOIN application ORDER BY application_id DESC";
    $result = $connect->query($q1);
    $q2 = "SELECT * FROM customer NATURAL JOIN commercial NATURAL JOIN application ORDER BY application_id DESC";
    $result1 = $connect->query($q2);


    if (isset($_POST["update"])) {

        $name = $_POST['name'];
        $customer_meter_no = $_POST['customer_meter_no'];
        $customer_no =$_POST['customer_no'];

        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $application_id = $_POST['application_id'];

        $c_q= "SELECT `application_id` FROM `customer` WHERE customer_no='$customer_no' ";
        $cq1 = $connect->query($c_q);
        $cq_row=$cq1->fetch_assoc();
        $application_id = $cq_row['application_id'];

        $up1 = "UPDATE `application` SET `mobile`='$mobile' , `email`= '$email',`address`= '$address' WHERE application.application_id='$application_id' ";

        $up2 = "UPDATE `residential` SET `name`='$name' WHERE residential.application_id='$application_id' ";

        $up3 = "UPDATE `customer` SET `customer_meter_no`= '$customer_meter_no' WHERE customer.customer_no='$customer_no' ";

        if($connect->query($up1)==true && $connect->query($up2)==true && $connect->query($up3)==true)
        {
            header("location: customer.php");
        }else{
            echo "Failed";
        }

       
    }
    if (isset($_POST["update1"])) {

        $organizatio_name = $_POST['organizatio_name'];
        $proprietor_name =$_POST['proprietor_name'];
        $customer_meter_no = $_POST['customer_meter_no'];
        $customer_no =$_POST['customer_no'];

        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $application_id = $_POST['application_id'];

        $c_q1= "SELECT `application_id` FROM `customer` WHERE customer_no='$customer_no' ";
        $cq11 = $connect->query($c_q1);
        $cq_row1=$cq11->fetch_assoc();
        $application_id = $cq_row1['application_id'];

        $up1 = "UPDATE `application` SET `mobile`='$mobile' , `email`= '$email',`address`= '$address' WHERE application.application_id='$application_id' ";

        $up2 = "UPDATE `commercial` SET `organizatio_name`='$organizatio_name',`proprietor_name`='$proprietor_name' WHERE commercial.application_id='$application_id' ";

        $up3 = "UPDATE `customer` SET `customer_meter_no`= '$customer_meter_no' WHERE customer.customer_no='$customer_no' ";

        if($connect->query($up1)==true && $connect->query($up2)==true && $connect->query($up3)==true)
        {
            header("location: customer.php");
        }else{
            echo "Failed";
        }

       
    }

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Customers</title>
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
                margin: 20px 30px 10px 30px;
            }
        .form-horizontal label {
 
            text-align: right;
         }
         .table-hover tbody tr:hover td {
            background-color:   #98FB98;
         }
         .b22{
            color: white;
            background-color:#000;
            padding: 3px;
            font-variant: small-caps;
         }
         .b2{
            color: green;
         }

    </style>

</head>

<body>

    <div class="container-fluid">
        <!--Admin Header Start-->
        <?php include("include/header_admin.php"); ?>
        <!--Admin Header End-->
        <div class="row main-contant">
            <h5 class="b22">Customers Information:</h5>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h6 class="b2">Residential:</h6>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 245px;">
                            <table class="table table-bordered table-striped mb-0 table-hover">
                                <thead class="text-white" style="background-color:#2F4F4F;">
                                    <tr>
                                        <th class="th-sm">Customer Name</th>
                                        <th class="th-sm">Customer No</th>
                                         <th class="th-sm">Pin Number</th>
                                        <th class="th-sm">Customer.M.No</th>
                                        <th class="th-sm">Phone</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Address</th>
                                        <th class="th-sm text-center">Action</th>
                                    </tr>
                                </thead> <?php if ($result->num_rows > 0) {?>
                                <tbody><?php $i = 1;while ($row = $result->fetch_assoc()) {?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['customer_no'] ?> </td>
                                        <td><?php echo $row['pin'] ?></td>
                                        <td><?php echo $row['customer_meter_no'] ?></td>
                                        <td><?php echo $row['mobile'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['customer_no'] ?>">View</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update<?php echo $row['customer_no'] ?>">Update</button>
                                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['customer_no'] ?>">Delete</button> -->
                                            
                                        </td>
                                    </tr>

                                    <div id="myModal<?php echo $row['customer_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h4 class="modal-title">Customer Information View</h4>
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
                                                            <label  class="col-sm-3 control-label">Cust.No :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['customer_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 control-label">Cust.M.No :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"value=" <?php echo $row['customer_meter_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 control-label">E-Mail :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['email'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-3 control-label">Address :</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['address'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="application_id" value="<?php echo $row['application_id'] ?>">

                                                    </from>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="update<?php echo $row['customer_no'] ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                 <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <div class="modal-header bg-info">
                                                        <h3 class="modal-title text-white">Update Customer Info</h3>
                                                    </div>
                                                    <div class="modal-body bg-warning">
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Name:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="name" value=" <?php echo $row['name'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">Cust.M.No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="customer_meter_no" value="<?php echo $row['customer_meter_no'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Mobile:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="mobile" value=" <?php echo $row['mobile'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">E-Mail:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">Address:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
                                                            </div>
                                                        </div>
                                                         <input type="hidden" name="customer_no" value="<?php echo $row['customer_no'] ?>">

                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                        <button name="update" value="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal: modalConfirmDelete-->
                                    <div id="delete<?php echo $row['customer_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content text-center">
                                                <div class="modal-body">
                                                    <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                                    <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                                    <button type="button" class="btn btn-danger btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                                    <a href="?delete=<?php echo $row['application_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-info btn-sm">YES</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal: modalConfirmDelete-->

                                <?php $i++;}?>
                            </tbody><?php }?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h6 class="b2">Commercial:</h6>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 245px;">
                            <table class="table table-bordered table-striped mb-0 table-hover">
                                <thead class="text-white" style="background-color:#2F4F4F;">
                                    <tr>
                                        <th class="th-sm">Organizatio</th>
                                        <th class="th-sm">Proprietor</th>
                                        <th class="th-sm">Customer No</th>
                                        <th class="th-sm">Pin Number</th>
                                        <th class="th-sm">Customer.M.No</th>
                                        <th class="th-sm">Phone</th>
                                        <th class="th-sm">Email</th>
                                        <th class="th-sm">Address</th>
                                        <th class="th-sm text-center">Action</th>
                                    </tr>
                                </thead> <?php if ($result1->num_rows > 0) {?>
                                <tbody><?php $i = 1;while ($row = $result1->fetch_assoc()) {?>
                                    <tr>
                                        <td><?php echo $row['organizatio_name'] ?></td>
                                        <td><?php echo $row['proprietor_name'] ?></td>
                                        <td><?php echo $row['customer_no'] ?> </td>
                                         <td><?php echo $row['pin']?></td>
                                        <td><?php echo $row['customer_meter_no'] ?></td>
                                        <td><?php echo $row['mobile'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['customer_no'] ?>">View</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update1<?php echo $row['customer_no'] ?>">Update</button>
                                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['customer_no'] ?>">Delete</button> -->
                                        </td>
                                    </tr>

                                    <div id="myModal<?php echo $row['customer_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h4 class="modal-title">Customer Information View</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark text-white">
                                                    <from class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Organizatio:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['organizatio_name'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Proprietor:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['proprietor_name'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Cust.No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['customer_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">Cust.M.No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"value=" <?php echo $row['customer_meter_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">E-Mail:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['email'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Address:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['address'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </from>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="update1<?php echo $row['customer_no'] ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <div class="modal-header bg-info">
                                                        <h3 class="modal-title text-white">Update Customer Info</h3>
                                                    </div>
                                                    <div class="modal-body bg-warning">
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Organizatio:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="organizatio_name" value=" <?php echo $row['organizatio_name'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Proprietor:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="proprietor_name" value=" <?php echo $row['proprietor_name'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">Cust.M.No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="customer_meter_no" value="<?php echo $row['customer_meter_no'] ?>">
                                                            </div>
                                                        </div>
                                                         <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Mobile:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="mobile" value=" <?php echo $row['mobile'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">E-Mail:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">Address:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>">
                                                            </div>
                                                        </div>
                                                         <input type="hidden" name="customer_no" value="<?php echo $row['customer_no'] ?>">
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                        <button name="update1" value="update1" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal: modalConfirmDelete-->
                                    <div id="delete<?php echo $row['customer_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content text-center">
                                                <div class="modal-body">
                                                    <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                                    <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                                    <button type="button" class="btn btn-danger btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                                    <a href="?delete=<?php echo $row['application_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-info btn-sm">YES</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal: modalConfirmDelete-->

                                <?php $i++;}?>
                            </tbody><?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div><br>

        <!-- Footer Start-->
        <?php include("include/footer.php"); ?>
        <!-- Footer End-->
    </div>
</body>

</html>
<?php
} else {
   header("location:admin_login.php");
}
?>