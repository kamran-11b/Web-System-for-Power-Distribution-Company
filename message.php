<?php
session_start();
include "database/connectdb.php";
if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $admin_email = $_SESSION["admin_email"];
    $adminfetchQuery = "SELECT `admin_email`FROM `admin` WHERE admin_email LIKE 'admin_email'";
    $login_user = $connect->query($adminfetchQuery);
    $admin = $login_user->fetch_assoc();

    $fq = "SELECT * FROM `contact_us` ORDER BY contact_id DESC";
    $result = $connect->query($fq);


   
    if(isset($_GET["contact_id"])) {

       $contact_id = $_GET['contact_id'];

       $sq1 = "DELETE FROM `contact_us` WHERE contact_id='$contact_id' ";

       if($connect->query($sq1)){
         header("location:message.php");
       }

    }
    
    ?>


<!DOCTYPE html>
<html>

<head>
    <title>Massage</title>
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
    </style>

</head>

<body>

    <div class="container-fluid">
        <!--Header Start-->
        <?php include "include/header_admin.php";?>
        <!--Header End-->

        <div class="container-fluid">
            <div class="row mx bg-info">
                <div class="head">
                    <h4> All Contact Us:</h4>
                </div>
                <div class="table-responsive bg-white">
                     <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 490px;">
                    <?php
                    if ($result->num_rows > 0) {?>
                    <table class="table table-condensed table-striped table-bordered">
                        <tr class="bg-dark text-white">
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        <?php $i = 1;
                        while ($row = $result->fetch_assoc()) {?>
                        <tr>
                            <td> <?php echo $row['contact_id'] ?> </td>
                            <td> <?php echo $row['name'] ?> </td>
                            <td> <?php echo $row['email'] ?> </td>
                            <td> <?php echo $row['phone'] ?> </td>
                            <td> <?php echo $row['date'] ?> </td>
                            <td> <?php echo $row['message'] ?> </td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['contact_id'] ?>">View</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#delete<?php echo $row['contact_id'] ?>">Delete</button>
                            </td>
                        </tr>
                        

                        <div id="myModal<?php echo $row['contact_id'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="modal-title">Contact Message View</h4>
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
                                                <label  class="col-sm-3 control-label">E-Mail:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value=" <?php echo $row['email'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Mobileo :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"value=" <?php echo $row['phone'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">E-Mail :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value=" <?php echo $row['date'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-3 control-label">Address :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value=" <?php echo $row['message'] ?>" readonly>
                                                </div>
                                            </div>

                                        </from>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal: modalConfirmDelete-->
                        <div id="delete<?php echo $row['contact_id'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content text-center">
                                    <div class="modal-body">
                                        <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                        <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                        <button type="button" class="btn btn-danger btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                        <a href="?contact_id=<?php echo $row['contact_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-info btn-sm">YES</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal: modalConfirmDelete-->



                        <?php $i++;}?>
                    </table>
                    <?php }?>
                  </div>
                </div>
            </div>
        </div>
        <!-- Footer Start-->
        <?php include "include/footer.php";?><br>
        <!-- Footer End-->
    </div>

</body>

</html>
<?php
} else {
    header("location:admin_login.php");
}
?>