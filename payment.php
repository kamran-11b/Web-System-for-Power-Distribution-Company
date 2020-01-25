<?php
session_start();
include "database/connectdb.php";

if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $q1 = "SELECT * FROM payment ORDER BY payment_id DESC";

    $result = $connect->query($q1);

    if(isset($_POST["update"])){
       
       $bill_no = $_POST['bill_no'];
       $bill_status =$_POST['bill_status'];
       $payment_id = $_POST['payment_id'];
       $payment_status = $_POST['payment_status'];

       $q3 = "UPDATE `bill_info` SET `bill_status`='$bill_status' WHERE bill_no='$bill_no' ";
       $q4 = "UPDATE `payment` SET `payment_status`='$payment_status' WHERE payment_id='$payment_id' ";

       $q5 = "SELECT * FROM `bill_info` WHERE bill_no = '$bill_no' ";
       $q5_q= $connect->query($q5);
       $q5_row = $q5_q->fetch_assoc();
       $total_a = $q5_row['total_amount'];
       $bill_month = $q5_row['bill_month'];
       $customer_no = $q5_row['customer_no'];


       $q6 = "SELECT `application_id` FROM `customer` WHERE customer_no='$customer_no' ";
       $q6_q= $connect->query($q6);
       $q6_row = $q6_q->fetch_assoc();
       $application_id = $q6_row['application_id'];

       $query_select = "SELECT * FROM application NATURAL JOIN customer WHERE customer.application_id='$application_id' AND application.application_id='$application_id' ";
       $result6 = $connect->query($query_select);
       $result6_row= $result6->fetch_assoc();
       $email = $result6_row['email'];

       $message ="Congratulation..."."\r\n"."Dear user,"."\r\n"."We have received your payment BDT ";
       $body = "MK Power Distribution Company";
       $header = "From: j.kamran14@gmail.com";

       if($connect->query($q3)==true && $connect->query($q4)==true){

        $message.="$total_a "." Taka"."\r\n";
        $message.="Bill Number     :  "."$bill_no"."\r\n";
        $message.="Bill Month      :  "."$bill_month"."\r\n";
        $message.="Customer ID     :  "."$customer_no"."\r\n";
        $message.= "Thanks for being with us.";

         if(mail($email,$body,$message,$header)){
               header("location: payment.php");
            }else{
               echo "Failed";
             }
       }
    }

    $q5 = "SELECT * FROM payment ORDER BY payment_id DESC";

    $result1 = $connect->query($q5);

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
        
        
    </style>

</head>

<body>

    <div class="container-fluid">
        <!--Admin Header Start-->
        <?php include("include/header_admin.php"); ?>
        <!--Admin Header End--><br>
        

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5><span>Payment Pending List:</span></h5>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 250px;">
                            <table class="table table-bordered table-striped mb-0 table-hover">
                                <thead class="text-white" style="background-color:#2F4F4F;">
                                    <tr>
                                        <th class="th-sm">ID</th>
                                        <th class="th-sm">Bill No</th>
                                        <th class="th-sm">Payment Date</th>
                                        <th class="th-sm">Customer No</th>
                                        <th class="th-sm">bKash Number</th>
                                        <th class="th-sm">bKash TrxID</th>
                                        <th class="th-sm text-center">Action</th>
                                    </tr>
                                </thead> <?php if ($result->num_rows > 0) {?>
                                <tbody><?php $i = 1;while ($row = $result->fetch_assoc()) {?>
                                    <tr>
                                        <?php if($row['payment_status']==1){?>
                                        <td><?php echo $row['payment_id'] ?></td>
                                        <td><?php echo $row['bill_no'] ?></td>
                                        <td><?php echo $row['payment_date'] ?> </td>
                                        <td><?php echo $row['customer_no'] ?> </td>
                                        <td><?php echo $row['bk_n'] ?></td>
                                        <td><?php echo $row['bk_trx_id'] ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['payment_id'] ?>">View</button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update<?php echo $row['payment_id'] ?>">Pending...</button>
                                       
                                        </td>
                                    </tr>

                                    <div id="myModal<?php echo $row['payment_id'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h4 class="modal-title">Payment Information View</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark text-white">
                                                    <from class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Payment ID:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['payment_id'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Bill No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['bill_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Payment Date:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['payment_date'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">bKash Number:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"value=" <?php echo $row['bk_n'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">bKash TrxID:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['bk_trx_id'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        
                                                    </from>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal: modal Confirm Update Start-->
                                    <div id="update<?php echo $row['payment_id'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content text-center">
                                                <div class="modal-body">
                                                    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                        <i class="material-icons" style="font-size: 5rem; color: green;">done</i>
                                                        <p style="font-size: 20px;">Are you Confirming the Payment?</p><br>
                                                        <input type="hidden" name="bill_status" value="3">
                                                        <input type="hidden" name="payment_status" value="2">
                                                        <input type="hidden" name="bill_no" value="<?php echo $row['bill_no'] ?>">
                                                         <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                                                         <input type="hidden" name="payment_id" value="<?php echo $row['payment_id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm" style="padding-left: 25px;padding-right:25px;" data-dismiss="modal">NO</button>
                                                        <button type="submit" name="update" value="update" style="padding-left: 25px;padding-right:25px;" class="btn btn-info btn-sm">YES</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal: modal Confirm Update End-->
                                    <?php }?>
                                <?php $i++;}?>
                            </tbody><?php }?>
                        </table>
                    </div>
                </div>
            </div><br>

             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h5><span>Payment Paid List:</span></h5>
                <div class="table-responsive">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 260px;">
                            <table class="table table-bordered table-striped mb-0 table-hover">
                                <thead class="text-white" style="background-color:#2F4F4F;">
                                    <tr>
                                        <th class="th-sm">ID</th>
                                        <th class="th-sm">Bill No</th>
                                        <th class="th-sm">Payment Date</th>
                                        <th class="th-sm">Customer No</th>
                                        <th class="th-sm">bKash Number</th>
                                        <th class="th-sm">bKash TrxID</th>
                                        <th class="th-sm text-center">Action</th>
                                    </tr>
                                </thead> <?php if ($result1->num_rows > 0) {?>
                                <tbody><?php $i = 1;while ($row = $result1->fetch_assoc()) {?>
                                    <tr>
                                        <?php if($row['payment_status']==2){?>
                                        <td><?php echo $row['payment_id'] ?></td>
                                        <td><?php echo $row['bill_no'] ?></td>
                                        <td><?php echo $row['payment_date'] ?> </td>
                                        <td><?php echo $row['customer_no'] ?> </td>
                                        <td><?php echo $row['bk_n'] ?></td>
                                        <td><?php echo $row['bk_trx_id'] ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['payment_id'] ?>">View</button>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update<?php echo $row['payment_id'] ?>">Paid</button>
                                        </td>
                                    </tr>

                                    <div id="myModal<?php echo $row['payment_id'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h4 class="modal-title">Payment Information View</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body bg-dark text-white">
                                                    <from class="form-horizontal">
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Payment ID:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['payment_id'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Bill No:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['bill_no'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label  class="col-sm-4 control-label">Payment Date:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['payment_date'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">bKash Number:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control"value=" <?php echo $row['bk_n'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 control-label">bKash TrxID:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" value=" <?php echo $row['bk_trx_id'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        
                                                    </from>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Modal: modal Confirm Update Start-->
                                    <div id="update<?php echo $row['payment_id'] ?>" class="modal fade" role="dialog">
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
                                    <?php }?>
                                <?php $i++;}?>
                            </tbody><?php }?>
                        </table>
                    </div>
                </div>
            </div>
        
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