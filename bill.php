<?php
session_start();
include("database/connectdb.php");
if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {
        
   function calculate_bill($units) {
            $unit_cost_first = 3.50;
            $unit_cost_second = 4.00;
            $unit_cost_third = 5.20;
            $unit_cost_fourth = 6.50;

            if($units <= 50) {
                $bill = $units * $unit_cost_first;
            }
            else if($units > 50 && $units <= 100) {
                $temp = 50 * $unit_cost_first;
                $remaining_units = $units - 50;
                $bill = $temp + ($remaining_units * $unit_cost_second);
            }
            else if($units > 100 && $units <= 200) {
                $temp = (50 * 3.5) + (100 * $unit_cost_second);
                $remaining_units = $units - 150;
                $bill = $temp + ($remaining_units * $unit_cost_third);
            }
            else {
                $temp = (50 * 3.5) + (100 * $unit_cost_second) + (100 * $unit_cost_third);
                $remaining_units = $units - 250;
                $bill = $temp + ($remaining_units * $unit_cost_fourth);
            }
        return number_format((float)$bill, 2, '.', '');
    }


   if(isset($_POST["submit"])){

        /*Admin Id Select*/
        $admin_email = $_SESSION["admin_email"];
        $admin_id_q = "SELECT admin_id FROM admin WHERE admin_email='$admin_email' ";
        $admin_result = $connect->query($admin_id_q);
        $admin_row = $admin_result->fetch_assoc();
        $admin_id = $admin_row['admin_id'];
        $customer_no = $_POST['customer_no'];
        $bill_month =$_POST['bill_month'];
        $bill_issue_date =$_POST['bill_issue_date'];
        $bill_last_pay_date = date('Y-m-d', strtotime($bill_issue_date. ' + 15 days'));
        $bill_due_pay_date = date('Y-m-d', strtotime($bill_issue_date. ' + 20 days'));

        $present_unit = $_POST['present_unit'];
        $previous_unit = $_POST['previous_unit'];
        
        $units =$present_unit - $previous_unit;

        if($customer_no>200000){
              $total_amount = calculate_bill($units);
        }else{
            $total_amount = calculate_bill($units);
        }


        $insert_q = "INSERT INTO `bill_info`(`bill_no`, `admin_id`, `customer_no`, `bill_month`, `bill_issue_date`, `bill_last_pay_date`,`bill_due_pay_date`,`present_unit`, `previous_unit`, `total_amount`) VALUES (NULL,'$admin_id','$customer_no','$bill_month','$bill_issue_date','$bill_last_pay_date','$bill_due_pay_date','$present_unit','$previous_unit','$total_amount')";

        if($connect->query($insert_q)==true){
            echo '<script> alert("Message sent Successfully!!!");</script>';
            header("Location:bill.php");
        }

    }

    $query_select = "SELECT * FROM residential NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer.customer_no=bill_info.customer_no ORDER BY bill_no DESC";
    $result1 = $connect->query($query_select);

    $query_select2 = "SELECT * FROM commercial NATURAL JOIN application NATURAL JOIN customer NATURAL JOIN bill_info
                      WHERE customer.customer_no=bill_info.customer_no ORDER BY bill_no DESC";
    $result2 = $connect->query($query_select2);



    if (isset($_POST["update"])) {

        $customer_no = $_POST['customer_no'];
        $bill_month = $_POST['bill_month'];
        $bill_issue_date = $_POST['bill_issue_date'];

        $bill_last_pay_date = $_POST['bill_last_pay_date'];
        $present_unit = $_POST['present_unit'];
        $previous_unit = $_POST['previous_unit'];
        $bill_no = $_POST['bill_no'];

        $unit = $present_unit - $previous_unit;

        $total_amount = calculate_bill($unit);



        $up1= "UPDATE `bill_info` SET `customer_no`='$customer_no',`bill_month`='$bill_month',`bill_issue_date`='$bill_issue_date',
             `bill_last_pay_date`='$bill_last_pay_date',`present_unit`='$present_unit',`previous_unit`='$previous_unit',`total_amount`= '$total_amount' WHERE bill_no='$bill_no'";

        if($connect->query($up1)==true){
            header("location: bill.php");
        }
        
    }

  
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bill Info</title>
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
    
    </style>

</head>

<body>

    <div class="container-fluid">
        <?php include("include/header_admin.php"); ?>

        <!--start add bill -->
        <div class="col-auto">
            <!-- Button trigger modal -->
            <div class="text-right mb-3">
             <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#id101">Add New Bill</button>
         </div><br>
         
         <!--Modal: modal Confirm Update Start-->
         <div id="id101" class="modal fade" role="dialog">
            <div class="modal-dialog id2">
                <div class="modal-content text-center">
                    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                        <div class="modal-body bg-warning">
                            <img src="images/bill.png" class="rounded-circle" alt="Cinque Terre" width="140" height="150">
                            <p><dt style="font-size: 25px;  font-variant: small-caps;">Add New Bill</dt></p>
                            <div class="form-group row">
                             <label class="col-sm-4 control-label"><dt>Customer No: </dt></label>
                             <div class="col-sm-6">
                                 <input type="text" name="customer_no" class="form-control" autofocus required>
                             </div>
                         </div>
                         <div class="form-group row">
                            <label class="col-sm-4 control-label"><dt>Bill Month: </dt></label>
                            <div class="col-sm-6">
                                <select name="bill_month" class="custom-select">
                                    <option selected>Choose</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                    <option>April</option>
                                    <option>May</option>
                                    <option>June</option>
                                    <option>July</option>
                                    <option>August</option>
                                    <option>September</option>
                                    <option>October</option>
                                    <option>November</option>
                                    <option>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                         <label class="col-sm-4 control-label"><dt>Bill Issue Date: </dt></label>
                         <div class="col-sm-6">
                             <input type="date" name="bill_issue_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" autofocus required>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="col-sm-4 control-label"><dt>Present Unit: </dt></label>
                         <div class="col-sm-6">
                             <input type="text" name="present_unit" class="form-control" autofocus required>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label class="col-sm-4 control-label"><dt>Previous Unit: </dt></label>
                         <div class="col-sm-6">
                             <input type="text" name="previous_unit" class="form-control" autofocus required>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><dt>Cancel</dt></button>
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-sm"><dt>Submit</dt></button>
                </div>
            </form>  
        </div>
    </div>
</div>
<!--Modal: modal Confirm Update End-->

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 class="b2">Residential Customer Bill Info:</h4>
    <div class="table-responsive">
        <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 240px;">
                <table class="table table-bordered table-striped mb-0 table-hover">
                    <thead class="text-white" style="background-color:#2F4F4F;">
                        <tr class="text-center">
                            <th class="th-sm">Bill No</th>
                            <th class="th-sm">Admin Id</th>
                            <th class="th-sm">Customer No</th>
                            <th class="th-sm">Bill Month</th>
                            <th class="th-sm">Bill Issue Date</th>
                            <th class="th-sm">Last Pay Date</th>
                            <th class="th-sm">Total Units</th>
                            <th class="th-sm">Total Amount</th>
                            <th class="th-sm">Action</th>
                        </tr>
                    </thead> <?php if ($result1->num_rows > 0) {?>
                    <tbody><?php $i = 1;while ($row1 = $result1->fetch_assoc()) {?>
                        <tr class="text-center">
                            <td><?php echo $row1['bill_no'] ?> </td>
                            <td><?php echo $row1['admin_id'] ?> </td>
                            <td><?php echo $row1['customer_no'] ?></td>
                            <td><?php echo $row1['bill_month'] ?></td>
                            <td><?php echo $row1['bill_issue_date'] ?></td>
                            <td><?php echo $row1['bill_last_pay_date'] ?></td>
                            <td><?php echo $row1['present_unit']-$row1['previous_unit'] ?></td>
                            <td><?php echo $row1['total_amount'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1<?php echo $row1['bill_no'] ?>">View Bill</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#update<?php echo $row1['bill_no'] ?>">Update</button>
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
                                                     <label><b>E-Mail: </b><?php echo $row1['email'] ?></label>
                                                </div>
                                            </div>
                                        </fieldset><br>
                                        <div class="row">
                                            
                                            <div class="col-sm-5">
                                                <center>
                                                    <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="80" height="90">
                                                    <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p></center>
                                                    <div class="form-group row bg-info">
                                                        <input type="text" class="form-control" value="   Name :  <?php echo $row1['name'] ?>">
                                                        <input type="text" class="form-control" value=" F.Name :  <?php echo $row1['father_name'] ?>">
                                                        <input type="text" class="form-control" value="M.Name :  <?php echo $row1['mother_name'] ?>">
                                                        <input type="text" class="form-control" value=" Address :  <?php echo $row1['address'] ?>">
                                                        <input type="text" class="form-control" value="   Phone :   <?php echo $row1['mobile'] ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-7">
                                                    <fieldset class="border p-3 bg-white"><br>
                                                        <h5>Electricity Bill:</h5>

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
                                <div class="modal-dialog id2">
                                    <div class="modal-content text-center">
                                        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                            <div class="modal-header bg-info">
                                                <h3 class="modal-title text-white">Update Bill</h3>
                                            </div>
                                            <div class="modal-body bg-warning">
                                                <div class="form-group row">
                                                    <label  class="col-sm-4 control-label">Customer No:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="customer_no" value=" <?php echo $row1['customer_no'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label  class="col-sm-4 control-label">Bill Month:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="bill_month" value=" <?php echo $row1['bill_month'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label  class="col-sm-4 control-label">Issue Date:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="bill_issue_date" value=" <?php echo $row1['bill_issue_date'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 control-label">Last Pay Date:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="bill_last_pay_date" value="<?php echo $row1['bill_last_pay_date'] ?>">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label class="col-sm-4 control-label">Present Unit:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="present_unit" value="<?php echo $row1['present_unit'] ?>">
                                                    </div>
                                                </div>
                                                 <div class="form-group row">
                                                    <label class="col-sm-4 control-label">Previous Unit:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="previous_unit" value="<?php echo $row1['previous_unit'] ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="bill_no" value="<?php echo $row1['bill_no'] ?>">
                                            </div>
                                            <div class="modal-footer bg-dark">
                                                <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                <button name="update" value="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!--Modal: modal Confirm Update End-->
                        <?php $i++;}?>
                        </tbody><?php }?>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <br>
            <h4 class="b2">Commercial Customer Bill Info:</h4>
            <div class="table-responsive">
                <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 240px;">
                        <table class="table table-bordered table-striped mb-0 table-hover">
                            <thead class="text-white" style="background-color:#2F4F4F;">
                                <tr class="text-center">
                                    <th class="th-sm">Bill No</th>
                                    <th class="th-sm">Customer No</th>
                                    <th class="th-sm">Bill Month</th>
                                    <th class="th-sm">Bill Issue Date</th>
                                    <th class="th-sm">Last Pay Date</th>
                                    <th class="th-sm">Total Units</th>
                                    <th class="th-sm">Total Amount</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead> <?php if ($result2->num_rows > 0) {?>
                            <tbody><?php $i = 1;while ($row1 = $result2->fetch_assoc()) {?>
                                <tr class="text-center">
                                    <td><?php echo $row1['bill_no'] ?> </td>
                                    <td><?php echo $row1['customer_no'] ?></td>
                                    <td><?php echo $row1['bill_month'] ?></td>
                                    <td><?php echo $row1['bill_issue_date'] ?></td>
                                    <td><?php echo $row1['bill_last_pay_date'] ?></td>
                                    <td><?php echo $row1['present_unit']-$row1['previous_unit'] ?></td>
                                    <td><?php echo $row1['total_amount'] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1<?php echo $row1['bill_no'] ?>">View Bill</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#update<?php echo $row1['bill_no'] ?>">Update</button>
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
                                                            <label><b>E-Mail: </b><?php echo $row1['email'] ?></label>
                                                        </div>
                                                    </div>
                                                </fieldset><br>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-5">
                                                        <center>
                                                            <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="90" height="80">
                                                            <p style="font-size: 25px;  font-variant: small-caps;">Customer Profile</p></center>
                                                            <div class="form-group row bg-info">
                                                                <input type="text" class="form-control" value="  O.Name :  <?php echo $row1['organizatio_name'] ?>">
                                                                <input type="text" class="form-control" value="  P.Name :  <?php echo $row1['proprietor_name'] ?>">
                                                                <input type="text" class="form-control" value=" F.Name :  <?php echo $row1['father_name'] ?>">
                                                                <input type="text" class="form-control" value=" Address :  <?php echo $row1['address'] ?>">
                                                                <input type="text" class="form-control" value="   Phone :   <?php echo $row1['mobile'] ?>">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <fieldset class="border p-3 bg-white">

                                                                <h5>Electricity Bill:</h5>

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
                                            <div class="modal-dialog id2">
                                                <div class="modal-content text-center">
                                                    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                        <div class="modal-header bg-info">
                                                            <h3 class="modal-title text-white">Update Bill</h3>
                                                        </div>
                                                        <div class="modal-body bg-warning">
                                                            <div class="form-group row">
                                                                <label  class="col-sm-4 control-label">Customer No:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="customer_no" value=" <?php echo $row1['customer_no'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-4 control-label">Bill Month:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="bill_month" value=" <?php echo $row1['bill_month'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-4 control-label">Issue Date:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="bill_issue_date" value=" <?php echo $row1['bill_issue_date'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 control-label">Last Pay Date:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="bill_last_pay_date" value="<?php echo $row1['bill_last_pay_date'] ?>">
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-4 control-label">Present Unit:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="present_unit" value="<?php echo $row1['present_unit'] ?>">
                                                                </div>
                                                            </div>
                                                             <div class="form-group row">
                                                                <label class="col-sm-4 control-label">Previous Unit:</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="previous_unit" value="<?php echo $row1['previous_unit'] ?>">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="bill_no" value="<?php echo $row1['bill_no'] ?>">
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                            <button name="update" value="update" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                        <!--Modal: modal Confirm Update End-->
                                <?php $i++;}?>
                                </tbody><?php }?>
                            </table>
                        </div>
                    </div>
                </div><br>
            </div>
            <!-- End add bill  -->

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