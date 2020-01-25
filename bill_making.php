<?php
session_start();
include("database/connectdb.php");
if (isset($_SESSION["customer_no"]) || isset($_COOKIE['customer_no'])) {
    
    $customer_no = $_SESSION['customer_no'];

    $query_select = "SELECT * FROM residential NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer_no='$customer_no' ORDER BY bill_no DESC";
    $result1 = $connect->query($query_select);
    
    $query_select3 = "SELECT * FROM residential NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer_no='$customer_no' ORDER BY bill_no DESC";
    $result3 = $connect->query($query_select3);



    $query_select2 = "SELECT * FROM commercial NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer_no='$customer_no' ORDER BY bill_no DESC";
    $result2 = $connect->query($query_select2);

    $query_select4 = "SELECT * FROM commercial NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer_no='$customer_no' ORDER BY bill_no DESC";
    $result4 = $connect->query($query_select4);


    if (isset($_POST["paybill"])) {
         $bk_n = $_POST['number'];
         $bk_trx_id = $_POST['trx_id'];
         $customer_no = $_POST['customer_no'];
         $bill_no = $_POST['bill_no'];
         $status = $_POST['status'];

        $q2 = "UPDATE `bill_info` SET `bill_status`='$status' WHERE bill_no='$bill_no' ";

        $q1= "INSERT INTO `payment`(`payment_id`, `customer_no`, `bill_no`, `payment_date`, `bk_n`, `bk_trx_id`) VALUES(NULL,'$customer_no','$bill_no',current_timestamp(),'$bk_n','$bk_trx_id')";

        
        if($connect->query($q1)==true && $connect->query($q2)==true){
            echo '<script> alert("Message sent Successfully!!!");</script>';
            header("Location:bill_making.php");
        }
    }

  
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer Profile</title>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <style>
      
   .modal-dialog label {
    text-align: right;
}
 .table-hover tbody tr:hover td {
            background-color:   #98FB98;
         }
.fab{
  padding: 8px;
  font-size: 28px;
}
.fab:hover{
  color:green;
}

</style>

</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top text-lg" style="background-color: #202a3b;">
            <div class="container">
                <a style="font-size: 25px;" class="navbar-brand" href="#"><i>MK Power Distribution Company</i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse sticky-left" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us<span class="sr-only">(current)</span></a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Customer Service</a>
                            <div class="dropdown-menu" style="background-color: #3f4f6b; ">
                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';"  href="pay_bill.php">Pay Bill</a>
                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';" href="complain.php">Complain</a>
                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';" href="new_connection.php">New Connection</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="notice.php">Notice Board</a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                            <div class="dropdown-menu" style="background-color: #3f4f6b;">
                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';" href="report_annual.php">Annual Reports</a>

                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';" href="report_plan.php">Annual Procurement Plan</a>

                                <a class="dropdown-item text-white" onmouseover="this.style.backgroundColor='#4C4646';" onmouseout="this.style.backgroundColor='#3f4f6b';" href="report_summary.php">Executive Summary</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact_us.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="bill_making.php">Profile</a></li>
                        <li class="nav-item active"><a class="nav-link" href="customer_logout.php">LogOut</a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
    <?php if ($result1->num_rows > 0) {?>
        <div class="row">
            <div class="col-sm-4">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <?php $row = $result3->fetch_assoc() ?>
                        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                            <div class="modal-body bg-warning">
                                <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="150" height="170">
                                <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p><br>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 control-label">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value=" <?php echo $row['name'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">E-Mail : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Mobile: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['mobile'] ?>" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-4 control-label">Customer No: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['customer_no'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Address: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['address'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <i class='fab fa-facebook-square'></i>
                                <i class='fab fa-twitter-square'></i>
                                <i class='fab fa-google-plus-square'></i>
                                <i class='fab fa-linkedin'></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <br><br><br>
                <h4 class="b2">Bill Info:</h4>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 525px;">
                        <table class="table table-bordered table-striped mb-0 table-hover">
                            <thead class="text-white" style="background-color:#2F4F4F;">
                                <tr class="text-center text-white">
                                    <th class="th-sm">Bill No</th>
                                    <th class="th-sm">Bill Month</th>
                                    <th class="th-sm">Bill Issue Date</th>
                                    <th class="th-sm">Last Pay Date</th>
                                    <th class="th-sm">Total Units</th>
                                    <th class="th-sm">Total Amount</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody><?php $i = 1;while ($row1 = $result1->fetch_assoc()) {?>
                                <tr class="text-center">
                                    <td><?php echo $row1['bill_no'] ?> </td>
                                    <td><?php echo $row1['bill_month'] ?></td>
                                    <td><?php echo $row1['bill_issue_date'] ?></td>
                                    <td><?php echo $row1['bill_last_pay_date'] ?></td>
                                    <td><?php echo $row1['present_unit']-$row1['previous_unit'] ?></td>
                                    <td><?php echo $row1['total_amount'] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1<?php echo $row1['bill_no'] ?>">View Bill</button>

                                        <?php if($row1['bill_status']==1){?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update<?php echo $row1['bill_no'] ?>">Pay Now</button>
                                        <?php }?>
                                        <?php if($row1['bill_status']==2){?>
                                            <button type="button" class="btn btn-warning">Pending...</button>
                                        <?php }?>

                                       <?php if($row1['bill_status']==3){?>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#paid<?php echo $row1['bill_no'] ?>">Paid</button>
                                        <?php }?>
                                      </td>
                                </tr>


                                <div id="myModal1<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <fieldset class="border-bottom p-3">
                                                    <h5 align="center">MK Power Distribution Company</h5>
                                                    <p align="center">Sylhet,Bamgladesh</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label><b>Bill Number   :</b>  <?php echo $row1['bill_no']?></label>
                                                            <label><b> Meter No: </b> <?php echo $row1['customer_meter_no']?> </label>
                                                        </div>
                                                        <div class="col-md-5 offset-md-3">
                                                            <label><b>Bill Issue Date: </b><?php echo $row1['bill_issue_date'] ?></label>
                                                            <label><b>Bill Pay Last Date: </b><?php echo $row1['bill_last_pay_date'] ?></label>
                                                        </div>
                                                    </div>
                                                </fieldset><br>
                                                <div class="row">

                                                    <div class="col-sm-5">
                                                        <center><br>
                                                            <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="80" height="90">
                                                            <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p></center><br>
                                                            <div class="form-group row bg-info">
                                                                <input type="text" class="form-control" value="   Name :  <?php echo $row1['name'] ?>">
                                                                <input type="text" class="form-control" value=" F.Name :  <?php echo $row1['father_name'] ?>">
                                                                <input type="text" class="form-control" value="M.Name :  <?php echo $row1['mother_name'] ?>">
                                                                <input type="text" class="form-control" value=" Address :  <?php echo $row1['address'] ?>">
                                                                <input type="text" class="form-control" value="   Phone :   <?php echo $row1['mobile'] ?>">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-7">
                                                            <fieldset class="border p-3 bg-white">
                                                                <h5>Electricity Bill:</h5><br>

                                                                <from class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Bill Month :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['bill_month'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Customer No :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['customer_no'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Present Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['present_unit'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Previous Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['previous_unit'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Total Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo ($row1['present_unit']-$row1['previous_unit']) ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Total Amount :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"> <?php echo $row1['total_amount'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                </from>
                                                            </fieldset>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal: modal Confirm Update Start-->
                                    <div id="update<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h3 class="modal-title text-white">Pay Bill</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Please use following steps to pay now:</h5>
                                                        <ul style="line-height: 20.8px;">
                                                            <li><span style="font-size: 18px;">Our Merchant wallet number : <strong>01730791523</strong></span></li>
                                                            <li><span style="font-size: 18px; line-height: 28.8px;">Enter your bKash contact number and transaction ID in the below form and submit.</span></li>
                                                        </ul>

                                                        <img src="images/bkash.png" alt="Cinque Terre" width="370" height="370">
                                                        <img src="images/bkashapp.png" alt="Cinque Terre" width="370" height="370">
                                                       
                                                        <p><dt style="font-size: 25px;  font-variant: small-caps;">Payment Detalis:</dt></p>
                                                        <fieldset class="border p-3 bg-white">
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">Total Amount: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="total_amount" value="<?php echo $row1['total_amount'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">bKash Number: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="number" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">Transaction ID: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="trx_id" required>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="status" value="2">
                                                            <input type="hidden" name="customer_no" value=" <?php echo $row1['customer_no'] ?>" >
                                                            <input type="hidden" name="bill_no" value=" <?php echo $row1['bill_no'] ?>" >
                                                        </fieldset>
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><dt>Cancel</dt></button>
                                                        <button type="submit" name="paybill" value="paybill" class="btn btn-success btn-sm"><dt>submit</dt></button>
                                                    </div>
                                                </div>
                                            </form>  
                                        </div>
                                    </div>
                                <!--Modal: modal Confirm Update End-->


                                <!--Modal: modal Confirm Update Start-->
                                    <div id="paid<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <i class="material-icons" style="font-size: 5rem; color: green;">done</i>
                                                    <p style="font-size: 20px;">Payment Successfully Completed.</p><br>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <!--Modal: modal Confirm Update End-->

                            </tbody>
                            <?php $i++;}?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php }?>

    <?php if ($result2->num_rows > 0) {?>
        <div class="row">
            <div class="col-sm-4">
                <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <?php $row = $result4->fetch_assoc() ?>
                        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                            <div class="modal-body bg-warning">
                                <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="150" height="170">
                                <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p><br>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 control-label">Organizatio :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value=" <?php echo $row['organizatio_name'] ?>" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="name" class="col-sm-4 control-label">Proprietor :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value=" <?php echo $row['proprietor_name'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Customer No: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['customer_no'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id" class="col-sm-4 control-label">E-Mail : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['email'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id" class="col-sm-4 control-label">Mobile: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['mobile'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id" class="col-sm-4 control-label">Address: </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="id" class="form-control" value=" <?php echo $row['address'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <i class='fab fa-facebook-square'></i>
                                <i class='fab fa-twitter-square'></i>
                                <i class='fab fa-google-plus-square'></i>
                                <i class='fab fa-linkedin'></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <br><br><br>
                <h4 class="b2">Bill Info:</h4>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 525px;">
                        <table class="table table-bordered table-striped mb-0 table-hover">
                            <thead class="text-white" style="background-color:#2F4F4F;">
                                <tr class="text-center">
                                    <th class="th-sm">Bill No</th>
                                    <th class="th-sm">Bill Month</th>
                                    <th class="th-sm">Bill Issue Date</th>
                                    <th class="th-sm">Last Pay Date</th>
                                    <th class="th-sm">Total Units</th>
                                    <th class="th-sm">Total Amount</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody><?php $i = 1;while ($row1 = $result2->fetch_assoc()) {?>
                                <tr class="text-center">
                                    <td><?php echo $row1['bill_no'] ?> </td>
                                    <td><?php echo $row1['bill_month'] ?></td>
                                    <td><?php echo $row1['bill_issue_date'] ?></td>
                                    <td><?php echo $row1['bill_last_pay_date'] ?></td>
                                    <td><?php echo $row1['present_unit']-$row1['previous_unit'] ?></td>
                                    <td><?php echo $row1['total_amount'] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1<?php echo $row1['bill_no'] ?>">View Bill</button>

                                        <?php if($row1['bill_status']==1){?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update<?php echo $row1['bill_no'] ?>">Pay Now</button>
                                        <?php }?>
                                        <?php if($row1['bill_status']==2){?>
                                            <button type="button" class="btn btn-warning">Pending...</button>
                                        <?php }?>

                                       <?php if($row1['bill_status']==3){?>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#paid<?php echo $row1['bill_no'] ?>">Paid</button>
                                        <?php }?>

                                    </td>
                                </tr>


                                <div id="myModal1<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <fieldset class="border-bottom p-3">
                                                    <h5 align="center">MK Power Distribution Company</h5>
                                                    <p align="center">Sylhet,Bamgladesh</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label><b>Bill Number   :</b>  <?php echo $row1['bill_no']?></label>
                                                            <label><b> Meter No: </b> <?php echo $row1['customer_meter_no']?> </label>
                                                            <label><b>Customer No: </b>  <?php echo $row1['customer_no'] ?> </label>
                                                        </div>
                                                        <div class="col-md-5 offset-md-3">
                                                            <label><b>Bill Issue Date: </b><?php echo $row1['bill_issue_date'] ?></label>
                                                            <label><b>Bill Pay Last Date: </b><?php echo $row1['bill_last_pay_date'] ?></label>
                                                        </div>
                                                    </div>
                                                </fieldset><br><br>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <center>
                                                            <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="80" height="90">
                                                            <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p></center>
                                                            <div class="form-group row bg-info">
                                                                <input type="text" class="form-control" value="Organizatio :  <?php echo $row1['organizatio_name'] ?>">
                                                                 <input type="text" class="form-control" value="Proprietor :  <?php echo $row1['proprietor_name'] ?>">
                                                                <input type="text" class="form-control" value=" F.Name :  <?php echo $row1['father_name'] ?>">
                                                                <input type="text" class="form-control" value=" Address :  <?php echo $row1['address'] ?>">
                                                                <input type="text" class="form-control" value="   Phone :   <?php echo $row1['mobile'] ?>">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-7">
                                                            <fieldset class="border p-3 bg-white">
                                                                <h5>Electricity Bill:</h5><br>

                                                                <from class="form-horizontal">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Bill Month :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['bill_month'] ?></label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Present Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['present_unit'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Previous Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo $row1['previous_unit'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Total Uunit :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"><?php echo ($row1['present_unit']-$row1['previous_unit']) ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-4 control-label">Total Amount :</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="control-label"> <?php echo $row1['total_amount'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                </from>
                                                            </fieldset>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <!--Modal: modal Confirm Update Start-->
                                    <div id="update<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h3 class="modal-title text-white">Pay Bill</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Please use following steps to pay now:</h5>
                                                        <ul style="line-height: 20.8px;">
                                                            <li><span style="font-size: 18px;">Our Merchant wallet number : <strong>01730791523</strong></span></li>
                                                            <li><span style="font-size: 18px; line-height: 28.8px;">Enter your bKash contact number and transaction ID in the below form and submit.</span></li>
                                                        </ul>

                                                        <img src="images/bkash.png" alt="Cinque Terre" width="370" height="370">
                                                        <img src="images/bkashapp.png" alt="Cinque Terre" width="370" height="370">
                                                       
                                                        <p><dt style="font-size: 25px;  font-variant: small-caps;">Payment Detalis:</dt></p>
                                                        <fieldset class="border p-3 bg-white">
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">Total Amount: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="total_amount" value="<?php echo $row1['total_amount'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">bKash Number: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="number" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-3 control-label">Transaction ID: </label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="trx_id" required>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="status" value="2">
                                                            <input type="hidden" name="customer_no" value=" <?php echo $row1['customer_no'] ?>" >
                                                            <input type="hidden" name="bill_no" value=" <?php echo $row1['bill_no'] ?>" >
                                                        </fieldset>
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><dt>Cancel</dt></button>
                                                        <button type="submit" name="paybill" value="paybill" class="btn btn-success btn-sm"><dt>submit</dt></button>
                                                    </div>
                                                </div>
                                            </form>  
                                        </div>
                                    </div>
                                <!--Modal: modal Confirm Update End-->


                                <!--Modal: modal Confirm Update Start-->
                                    <div id="paid<?php echo $row1['bill_no'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content text-center">
                                            <div class="modal-body">
                                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                    <i class="material-icons" style="font-size: 5rem; color: green;">done</i>
                                                    <p style="font-size: 20px;">Payment Successfully Completed.</p><br>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                <!--Modal: modal Confirm Update End-->
                            </tbody>
                            <?php $i++;}?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>



        
        <!-- End add bill  -->

        <!-- Footer Start-->
        <?php include("include/footer.php"); ?>
        <!-- Footer End-->
    </div>
    </body>

    </html>
 <?php
} else {
header("location:login.php");
}
?>
