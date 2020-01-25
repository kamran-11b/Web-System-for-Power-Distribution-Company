<!DOCTYPE html>
<html>

<head>
  <title>Annual Procurement Plan</title>
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
            margin: 30px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <?php include("include/header.php"); ?>

        <div><br>
            <div class="main-contant">
                <h4>Latest Annual Procurement Plan:</h4>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                       <div class="table-responsive">
                           <div class="table-wrapper-scroll-y my-custom-scrollbar" style="height: 510px;">
                            <?php  
                             include("database/connectdb.php");

                             $fq = "SELECT * FROM `notice`ORDER BY notice_date DESC";
                             $result = $connect->query($fq); ?>

                            <?php  if ($result->num_rows > 0) {?>

                            <table class="table table-condensed table-striped table-bordered">
                                <tr class="bg-info text-white">
                                    <th width="10%"><strong>P_Plan No</strong></th>
                                    <th width="50%"><strong>Procurement Plan Title</strong></th>
                                    <th><strong>Publish Date</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                                <?php   $i = 1; while ($row = $result->fetch_assoc()){?>
                                <tr>
                                    <?php if($row['notice_type']=="annual_procurement_plan") {?>
                                    <th><strong><?php echo $row['notice_id'] ?> </strong></th>
                                    <th><a href="?id=<?php echo $row['notice_id']; ?>" class="text-dark"><strong><?php echo $row['notice_file'] ?></strong></a>
                                    </th>
                                    <th><strong><?php echo $row['notice_date'] ?></strong></th>
                                    <th><a href="admin_notice.php?id_view=<?php echo $row['notice_id']; ?>"><i
                                                class="fa fa-eye btn btn-info" style="font-size: 15pt;"
                                                aria-hidden="true"></i></a>
                                        <a href="admin_notice.php?id=<?php echo $row['notice_id']; ?>"><i
                                                class="fa fa-download btn btn-success" style="font-size: 15pt;"
                                                aria-hidden="true"></i></a>
                                    </th>
                                    <?php } ?>
                                </tr>
                                <?php $i++; } ?>
                            </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Footer Start-->
        <?php include("include/footer.php"); ?><br>
        <!-- Footer End-->
    </div>
</body>

</html>