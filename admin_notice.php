<?php
session_start();
include "database/connectdb.php";

    
// Views PDF Files
    if (isset($_GET['id_view'])) {

        $notice_id = $_GET['id_view'];
        $sql_d = "SELECT notice_file FROM notice WHERE notice_id='$notice_id'";
        $result = $connect->query($sql_d);
        $file_d = mysqli_fetch_assoc($result);
        $file_path = ('upload/notice/' . $file_d['notice_file']);

        if (file_exists($file_path)) {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $$file_path . '"');
            header('Content-Transfer-Encoding: binary');
            readfile($file_path);
        }
    }

// Downloads files
    if (isset($_GET['id'])) {

        $notice_id = $_GET['id'];
        $sql_d = "SELECT notice_file FROM notice WHERE notice_id='$notice_id'";
        $result = $connect->query($sql_d);
        $file_d = mysqli_fetch_assoc($result);
        $file_path = ('upload/notice/' . $file_d['notice_file']);

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename= "' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            flush();
            readfile($file_path);
            exit;
        }
    }

if (isset($_SESSION["admin_email"]) || isset($_COOKIE['admin_email'])) {

    $admin_email = $_SESSION["admin_email"];
    $adminfetchQuery = "SELECT `admin_email`FROM `admin` WHERE admin_email LIKE 'admin_email'";
    $login_user = $connect->query($adminfetchQuery);
    $admin = $login_user->fetch_assoc();

    $fq = "SELECT * FROM `notice`ORDER BY notice_date DESC";
    $result = $connect->query($fq);

    // Upload Files
    if (isset($_POST['submit'])) {
        $filename = $_FILES['file']['name'];
        $destination = 'upload/notice/' . $filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $tmp = $_FILES['file']['tmp_name'];
        $size = $_FILES['file']['size'];
        move_uploaded_file($tmp, $destination);
        $admin_email = $_SESSION["admin_email"];
        $notice_type = $_POST['notice_type'];

        $sql_id = "SELECT admin_id FROM admin WHERE admin_email='$admin_email' ";
        $result1 = $connect->query($sql_id);
        $row1 = $result1->fetch_assoc();
        $admin_id = $row1['admin_id'];

        $insertQuery = "INSERT INTO `notice` (`notice_id`, `admin_id`, `notice_date`, `notice_type`, `notice_file`)
                  VALUES (NULL,'$admin_id', current_timestamp(), '$notice_type', '$filename')";

        if ($connect->query($insertQuery) == true) {
            echo '<script> alert("File Upload Successfully!!!");</script>';
            header("Location:admin_notice.php");
        }
    }

    // Delete Files
    if (isset($_GET["notice_id"])) {
        $notice_id = $_GET["notice_id"];
        if ($notice_id != null) {
            $file = "SELECT * FROM notice WHERE notice_id = '$notice_id'";
            $q = $connect->query($file);
            $after = mysqli_fetch_assoc($q);
            unlink('upload/notice/' . $after['notice_file']);

            $sql_d = "delete from notice where notice_id=$notice_id";
            if ($connect->query($sql_d)) {
                echo "Successfully Deleted";
                header('location: admin_notice.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Notice Admin</title>
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
    .table-hover tbody tr:hover td {
            background-color:  #8FBC8F;
         }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php include "include/header_admin.php";?><br><br>
        <div class="row main-contant-1">
            <div class="col align-self-start">
                <h3>Latest Notice and Report:</h3>
            </div>
            <!--start add notice -->
            <div class="col-auto">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#id101">Add
                    Notice</button>
                <!-- Modal -->
                <div class="modal fade" id="id101" tabindex="-1" role="dialog" aria-labelledby="idlabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-secondary text-white">
                            <div class="modal-header bg-warning text-dark">
                                <h5 class="modal-title" id="idlabel">Add New Notice</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="bg-warning" aria-hidden="true">&times;</span>
                                </button>
                            </div><br>
                            <div class="modal-body">
                                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="notice_type" class="col-sm-4 control-label">Notice Type:</label>
                                        <select name="notice_type" class="custom-select col-sm-7">
                                            <option selected>Choose</option>
                                            <option value="notice">Notice</option>
                                            <option value="annual_reports">Annual Reports</option>
                                            <option value="executive_summary">Executive Summary</option>
                                            <option value="annual_procurement_plan">Annual Procurement Plan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="file" class="col-sm-4 col-form-label">Upload File:</label>
                                        <input type="file" class="col-sm-7" name="file" autofocus required>
                                    </div><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-success">submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End add notice  -->
        </div>
        <div class="row main-contant">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                  <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 510px;">
                    <?php if ($result->num_rows > 0) {?>

                    <table class="table table-bordered table-striped mb-0 table-hover">
                        <tr class="bg-dark text-white">
                            <th width="10%"><strong>Notice No</strong></th>
                            <th width="10%"><strong>Admin Id</strong></th>
                            <th width="30%"><strong>Notice Title</strong></th>
                            <th><strong>Notice Type</strong></th>
                            <th><strong>Publish Date</strong></th>
                            <th><strong>Action</strong></th>
                        </tr>
                        <?php $i = 1;while ($row = $result->fetch_assoc()) {?>
                        <tr>
                            <th><strong><?php echo $row['notice_id'] ?> </strong></th>
                            <th><strong><?php echo $row['admin_id'] ?> </strong></th>
                            <th><a href="?id=<?php echo $row['notice_id']; ?>" ><strong><?php echo $row['notice_file'] ?></strong></a></th>
                            <th><strong><?php echo $row['notice_type'] ?></strong></th>
                            <th><strong><?php echo $row['notice_date'] ?></strong></th>
                            <th><a href="?id_view=<?php echo $row['notice_id']; ?>"><i class="fa fa-eye btn btn-info" style="font-size: 15pt;" aria-hidden="true"></i></a>
                                <a href="?id=<?php echo $row['notice_id']; ?>"><i class="fa fa-download btn btn-success" style="font-size: 15pt;" aria-hidden="true"></i></a>
                                <a data-toggle="modal" data-target="#delete<?php echo $row['notice_id'] ?>"><i class="fa fa-trash-o btn btn-danger" style="font-size: 15pt;" aria-hidden="true"></i></a>
                            </th>
                        </tr>
                        <!--Modal: modalConfirmDelete-->
                        <div id="delete<?php echo $row['notice_id'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content text-center">
                                    <div class="modal-body">
                                        <i class="fas fa-times fa-4x mb-3 text-danger"></i>
                                        <p style="font-size: 20px;">Are you sure you want to delete this record?</p><br>
                                        <button type="button" class="btn btn-danger btn-sm" style="padding-left: 20px;padding-right:20px;" data-dismiss="modal">NO</button>
                                        <a href="?notice_id=<?php echo $row['notice_id'] ?>" style="padding-left: 20px;padding-right:20px;" class="btn btn-info btn-sm">YES</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Modal: modalConfirmDelete-->

                        <?php $i++;}?>
                    </table><?php }?>
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