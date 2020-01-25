<?php
session_start();
include "database/connectdb.php";
if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $admin_email = $_SESSION["admin_email"];
    $admin_Query = "SELECT `admin_email`FROM `admin` WHERE admin_email LIKE 'admin_email'";
    $login_user = $connect->query($admin_Query);
    

    $fq = "SELECT * FROM `admin`";
    $result = $connect->query($fq);

    $fq1 = "SELECT * FROM `admin` WHERE admin_email='$admin_email'";
    $result1 = $connect->query($fq1);

    ?>



<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
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
    .mx {
        margin: 45px;
    }

    .head {
        margin: 10px;
    }
    .modal-body label {
        text-align: right;
    }
     .fab{
      padding: 8px;
      font-size: 28px;
    }
    .fab:hover{
      color:green;
   
    }
     .table-hover tbody tr:hover td {
            background-color:   #98FB98;
         }
    </style>

</head>

<body>
    <div class="container-fluid">
        <!--Header Start-->
        <?php include "include/header_admin.php";?>
        <!--Header End-->
         
         <div class="container-fluid">
             <div class="row">
                <div class="col-sm-4 bg-warning">
                   <div class="modal-dialog">
                    <div class="modal-content text-center">
                        <?php if ($result1->num_rows > 0) {?>
                            <?php $i = 1;while ($row = $result1->fetch_assoc()) {?>
                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                    <div class="modal-body bg-info">
                                        <img src="images/customer.png" class="rounded-circle" alt="Cinque Terre" width="150" height="170">
                                        <p style="font-size: 25px;  font-variant: small-caps;">Admin Profile</p><br>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 control-label">Admin Name :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="name" class="form-control" value=" <?php echo $row['admin_name'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-4 control-label">Admin Id : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id" class="form-control" value=" <?php echo $row['admin_id'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-4 control-label">Admin Mobile : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id" class="form-control" value=" <?php echo $row['admin_phone'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id" class="col-sm-4 control-label">Admin E-Mail : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id" class="form-control" value=" <?php echo $row['admin_email'] ?>" readonly>
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
                                <?php $i++;}?>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="bg-warning p-2"><br><br>
                        <h4 style="color: green; font-size: 25px; font-variant: small-caps;">Others Admin Information:</h4>
                   </div>
                    <div class="table-responsive">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 470px;">
                        <?php
                        if ($result->num_rows > 0) {?>
                            <table class="table table-bordered table-striped mb-0 table-hover">
                                <thead class="text-white" style="background-color:#2F4F4F;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    while ($row = $result->fetch_assoc()) {?>
                                        <tr>
                                            <?php if($row['admin_email']!=$admin_email) {?>
                                            <td> <?php echo $row['admin_id'] ?> </td>
                                            <td> <?php echo $row['admin_name'] ?> </td>
                                            <td> <?php echo $row['admin_email'] ?> </td>
                                            <td> <?php echo $row['admin_phone'] ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['admin_id'] ?>">View</button>
                                            </td>
                                        </tr>
                                        <div id="myModal<?php echo $row['admin_id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-right">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h4 class="modal-title">Admin Information View</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body bg-dark text-white">
                                                        <from class="form-horizontal">
                                                            <div class="form-group row">
                                                                <label  class="col-sm-4 control-label">Admin Name :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" value=" <?php echo $row['admin_name'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 control-label">Admin ID :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"value=" <?php echo $row['admin_id'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 control-label">Admin Mobile :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"value=" <?php echo $row['admin_phone'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label  class="col-sm-4 control-label">Admin E-Mail :</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" value=" <?php echo $row['admin_email'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      <?php }?>
                                    <?php $i++;}?>
                                </tbody>
                              </table>
                            <?php }?>
                        </div>
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