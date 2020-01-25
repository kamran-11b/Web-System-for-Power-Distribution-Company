<?php
session_start();
include "database/connectdb.php";


if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $admin_email = $_SESSION["admin_email"];
    $adminfetchQuery = "SELECT `admin_email`FROM `admin` WHERE admin_email LIKE 'admin_email'";
    $login_user = $connect->query($adminfetchQuery);
    $admin = $login_user->fetch_assoc();

    $marge = "SELECT * FROM residential NATURAL JOIN application ORDER BY application_id DESC" ;
    $result = $connect->query($marge);


    $marge1 ="SELECT * FROM commercial NATURAL JOIN application ORDER BY application_id DESC";

    $result1= $connect->query($marge1);


    if(isset($_GET['delete'])){

        $id=$_GET['delete'];
        $del = "DELETE FROM `application` WHERE application_id='$id' ";

        if($connect->query($del) == true){
            echo '<script> alert("DELETE Data Successfully!!!");</script>';
            header("Location:admin_new_con.php");
        }
    }
    if (isset($_POST['update'])) {

        $id = $_POST['application_id'];
        $status = $_POST['status'];
        $customer_no = $_POST['customer_no'];
        $customer_meter_no = $_POST['customer_meter_no'];
        $pin = $_POST['pin'];

        $em = "SELECT `email` FROM `application` WHERE application_id = '$id'";
        $emq = $connect->query($em);
        $em_row = $emq->fetch_assoc();
        $email = $em_row['email'];
        
        
        $sql = "UPDATE `application` SET `status`= '$status' WHERE application_id='$id' ";

        $sql_insert ="INSERT INTO `customer`(`customer_no`, `customer_meter_no`, `application_id`, `pin`) VALUES('$customer_no','$customer_meter_no',(SELECT application_id FROM application WHERE application_id='$id'),'$pin')";

        $message ="Congratulation..."."\r\n"."Your are selected our new customer."."\r\n";
        $body = "MK Power Distribution Company";
        $header = "From: j.kamran14@gmail.com";
       

        if($connect->query($sql)==true && $connect->query($sql_insert)==true){
           
           $message.="Application ID  :"."$id"."\r\n";
           $message.="Customer ID     :"."$customer_no"."\r\n";
           $message.="Customer Pin    :"."$pin"."\r\n";
           $message.="Meter Number    :"."$customer_meter_no"."\r\n";
           
           if(mail($email,$body,$message,$header)){
               header("Location:admin_new_con.php");
            }else{
               echo "Failed";
             }
         }
       }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin New Connection</title>
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
                margin: 0px 30px 10px 30px;
            }

            .main-contant-1 {
                margin: 15px 30px 0px 30px;
            }
            .b1{
                font-variant: small-caps;
                background-color:#2F4F4F;"
            }
            .b2{
                font-variant: small-caps;
                color: green;
            }
            .form-horizontal label {
 
            text-align: right;
         }
         .id2 {
            border:2px solid #999;
            border-radius:10px;
            box-shadow:0 0 50px #F5F5F5;
            font-variant: small-caps;
          }
          .table-hover tbody tr:hover td {
            background-color:#8FBC8F;
         }

        </style>
    </head>

    <body>
        <div class="container-fluid">
            <?php include "include/header_admin.php";?><br>
            <div class="row main-contant">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            		<h4 class="b2">Residential Application:</h4>
            		<div class="table-responsive">
            			<div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 233px;">
    
            					<table class="table table-bordered table-striped mb-0 table-hover">
            						<thead class="b1 text-white">
            							<tr>
            								<th class="th-sm">Id</th>
            								<th class="th-sm">Name</th>
            								<th class="th-sm">Phone</th>
            								<th class="th-sm">E-mail</th>
            								<th class="th-sm">Address</th>
            								<th class="th-sm">Connection_type</th>
            								<th class="th-sm text-center">Action</th>
            							</tr>
            						</thead><?php if ($result->num_rows > 0) {?>
            						<tbody><?php $i = 1;while ($row = $result->fetch_assoc()) {?>
            							<tr><?php if($row['ap_type']=="residential" && $row['status']==1) {?>
            								
            								<td><?php echo $row['application_id'] ?> </td>
            								<td><?php echo $row['name'] ?></td>
            								<td><?php echo $row['mobile'] ?></td>
            								<td><?php echo $row['email'] ?></td>
            								<td><?php echo $row['address'] ?></td>
            								<td><?php echo $row['connection_type'] ?></td>
            								<td class="text-center">
            									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['application_id'] ?>">View</button>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update<?php echo $row['application_id'] ?>">Add Customer</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row['application_id'] ?>">Delete</button>
            								</td>
            							</tr>

            							<div id="myModal<?php echo $row['application_id'] ?>" class="modal fade" role="dialog">
            								<div class="modal-dialog">
            									<div class="modal-content">
            										<div class="modal-header bg-warning">
            											<h4 class="modal-title">Information View</h4>
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
            														<input type="text" class="form-control"value=" <?php echo $row['mobile'] ?>" readonly>
            													</div>
            												</div>
            												<div class="form-group row">
            													<label  class="col-sm-3 control-label">E-Mail :</label>
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
            												<div class="form-group row">
            													<label class="col-sm-3 control-label">Connection :</label>
            													<div class="col-sm-8">
            														<input type="text" class="form-control" value=" <?php echo $row['connection_type'] ?>" readonly>
            													</div>
            												</div>
            									
            											</from>
            										</div>
            									</div>
            								</div>
            							</div>
                                        
            							<!--Modal: modalConfirmDelete-->
            							<div id="delete<?php echo $row['application_id'] ?>" class="modal fade" role="dialog">
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


                                        <!--Modal: modal Confirm Update Start-->
                                        <div id="update<?php echo $row['application_id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog id2">
                                                <div class="modal-content text-center">
                                                    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                        <div class="modal-body bg-warning">
                                                            <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="150" height="170">
                                                            <p><dt style="font-size: 25px;  font-variant: small-caps;">Add New Coustomer</dt></p><br>
                                                            
                                                             <input type="hidden" name="customer_no" value="<?php echo(rand(1000000,9000000)) ?>">
                                                             <div class="form-group row">
                                                                <label class="col-sm-4 control-label"><dt>Cus. Meter No:</dt></label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" name="customer_meter_no" placeholder="Enter New Meter No" class="form-control" autofocus required>
                                                                </div>
                                                             </div>
                                                             <input type="hidden" name="status" value="2">
                                                             <input type="hidden" name="application_id" value="<?php echo $row['application_id'] ?>" >
                                                             <input type="hidden" name="pin" value="<?php echo(rand(10000,99999)) ?>">
                                                             <br><br>
                                                        </div>
                                                         <div class="modal-footer bg-dark">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><dt>Cancel</dt></button>
                                                            <button type="submit" name="update" value="update" class="btn btn-success btn-sm"><dt>Add Customer</dt></button>
                                                         </div>
                                                    </form>  
                                               </div>
                                            </div>
                                        </div>
                                        <!--Modal: modal Confirm Update End-->

            							<?php $i++;}?>
            						<?php }?>
            						</tbody><?php }?>
            					</table>
            				</div>
            			</div>
            		</div>

            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            			<br>
            			<h4 class="b2">Commercial Application:</h4>
            			<div class="table-responsive">
            				<div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 250px;">
            						<table class="table table-bordered table-striped mb-0 table-hover">
            							<thead class="b1 text-white">
            								<tr>
            									<th class="th-sm">Id</th>
            									<th class="th-sm">Organizatio</th>
            									<th class="th-sm">Proprietor</th>
            									<th class="th-sm">Phone</th>
            									<th class="th-sm">E-mail</th>
            									<th class="th-sm">Address</th>
            									<th class="th-sm">Connection_type</th>
            									<th class="th-sm text-center">Action</th>
            								</tr>
            							</thead><?php if ($result1->num_rows > 0) {?>
            							<tbody><?php $i = 1;while ($row1 = $result1->fetch_assoc()) {?>
            								<tr>
            									<?php if($row1['ap_type']=="commercial" && $row1['status']==1) {?>
            										<td><?php echo $row1['application_id'] ?> </td>
            										<td><?php echo $row1['organizatio_name'] ?></td>
            										<td><?php echo $row1['proprietor_name'] ?></td>
            										<td><?php echo $row1['mobile'] ?></td>
            										<td><?php echo $row1['email'] ?></td>
            										<td><?php echo $row1['address'] ?></td>
            										<td><?php echo $row1['connection_type'] ?></td>
            										<td class="text-center">
            											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal1<?php echo $row1['application_id'] ?>">View</button>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update<?php echo $row1['application_id'] ?>">Add Customer</button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $row1['application_id'] ?>">Delete</button>

            										</td>
            									</tr>

            									<div id="myModal1<?php echo $row1['application_id'] ?>" class="modal fade" role="dialog">
            										<div class="modal-dialog">
            											<div class="modal-content">
            												<div class="modal-header bg-warning">
            													<h4 class="modal-title">Information View</h4>
            													<button type="button" class="close" data-dismiss="modal">&times;</button>
            												</div>
            												<div class="modal-body bg-dark text-white">
            													<from class="form-horizontal">
            														<div class="form-group row">
            															<label class="col-sm-3 control-label">Organizatio:</label>
            															<div class="col-sm-8">
            																<input type="text" class="form-control" value=" <?php echo $row1['organizatio_name'] ?>" readonly>
            															</div>
            														</div>
            														<div class="form-group row">
            															<label class="col-sm-3 control-label">Proprietor :</label>
            															<div class="col-sm-8">
            																<input type="text" class="form-control" value=" <?php echo $row1['proprietor_name'] ?>" readonly>
            															</div>
            														</div>
            														<div class="form-group row">
            															<label class="col-sm-3 control-label">Phone :</label>
            															<div class="col-sm-8">
            																<input type="text" class="form-control" value=" <?php echo $row1['mobile'] ?>" readonly>
            															</div>
            														</div>
            														<div class="form-group row">
            															<label class="col-sm-3 control-label">E-Mail :</label>
            															<div class="col-sm-8">
            																<input type="text" class="form-control" value=" <?php echo $row1['email'] ?>" readonly>
            															</div>
            														</div>
            														<div class="form-group row">
            															<label class="col-sm-3 control-label">Address :</label>
            															<div class="col-sm-8">
            																<input type="text"  class="form-control" value=" <?php echo $row1['address'] ?>" readonly>
            															</div>
            														</div>
            													</from>
            												</div>
            											</div>
            										</div>
            									</div>

            									<!--Modal: modalConfirmDelete-->
            									<div id="delete<?php echo $row1['application_id'] ?>" class="modal fade" role="dialog">
            										<div class="modal-dialog modal-sm">
            											<div class="modal-content text-center">
            												<div class="modal-body">
            													<i class="fas fa-times fa-4x mb-3 text-danger"></i>
            													<p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
            													<button type="button" class="btn btn-danger btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
            													<a href="?delete=<?php echo $row1['application_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-info btn-sm">YES</a>
            												</div>
            											</div>
            										</div>
            									</div>
            									<!--Modal: modalConfirmDelete-->


                                                <!--Modal: modal Confirm Update Start-->
                                                <div id="update<?php echo $row1['application_id'] ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog id2">
                                                        <div class="modal-content text-center">
                                                            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                                                <div class="modal-body bg-warning">
                                                                    <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="150" height="170">
                                                                    <p><dt style="font-size: 25px;  font-variant: small-caps;">Add New Coustomer</dt></p><br>
                                                                    <input type="hidden" name="customer_no" value="<?php echo(rand(1000000,9000000)) ?>">
                                                                    <div class="form-group row">
                                                                    <label class="col-sm-4 control-label"><dt>Cus. Meter No:</dt></label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" name="customer_meter_no" placeholder="Enter New Meter Number" class="form-control" autofocus required>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="status" value="2">
                                                                <input type="hidden" name="application_id" value=" <?php echo $row1['application_id'] ?>" >
                                                                <input type="hidden" name="pin" value="<?php echo(rand(10000,99999)) ?>">
                                                                <br><br>
                                                            </div>
                                                            <div class="modal-footer bg-dark">
                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><dt>Cancel</dt></button>
                                                                <button type="submit" name="update" value="update" class="btn btn-success btn-sm"><dt>Add Customer</dt></button>
                                                            </div>
                                                        </form>  
                                                    </div>
                                                </div>
                                              </div>
                                              <!--Modal: modal Confirm Update End-->

            									<?php $i++;}?>
            								<?php }?>
            								</tbody><?php }?>
            							</table>
            						</div>
            					</div>
            				</div>
            			</div><br>
            			<!-- Footer Start-->
            			<?php include "include/footer.php";?>
            			<!-- Footer End-->
            		</div>

            	</body>

            	</html>

            	<?php
            } else {
            	header("location:admin_login.php");
            }
            ?>