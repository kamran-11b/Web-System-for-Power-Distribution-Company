
<?php 
    include("database/connectdb.php");

    if(isset($_POST["submit"]))
    {
       $name = $_POST['name'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $complain_type = $_POST['complain_type'];
       $complain = $_POST['complain'];
       
       $insert_q="INSERT INTO `complain`(`complain_id`, `name`, `email`, `phone`, `complain_date`, `complain_type`, `complain`) VALUES (NULL,'$name','$email','$phone', current_timestamp(), '$complain_type', '$complain')";

       $message ="Thank You..."."\r\n"."Your Complain Sucessfully Accepted."."\r\n";
       $body = "MK Power Distribution Company";
       $header = "From: j.kamran14@gmail.com";

       if ($connect->query($insert_q) == TRUE) {
          $id_q= "SELECT `complain_id` FROM `complain` ORDER BY complain_id DESC";
          $id_row = $connect->query($id_q);
          $row_id = $id_row->fetch_assoc();
          $last_id = $row_id['complain_id'];
          $message.="Your Complain ID :".' '."$last_id";

          if(mail($email,$body,$message,$header)){
             header("Location:complain.php");
           }else{
              echo "Failed";
             }
        }
    }
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Complain</title>
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
    .container-fluid label{
      color: white;
      text-align: right;
    }
    
    .id2 {
      border:2px solid #999;
      border-radius:10px;
      box-shadow:0 0 50px #F5F5F5;
      font-variant: small-caps;
    }

  </style>



</head>

<body>

  <div class="container-fluid">
    <!--Admin Header Start-->
    <?php include("include/header.php"); ?>
    <!--Admin Header End-->
    <div style="background-color: #787878;">
      <br><br><br>

      <div class="card mx-auto id2" style="width: 700px; background-color: #3c3c3c;">
       <h3 style="text-align: center; background-color: #ffa500;padding: 4px;">Sent Us A Complain</h3><br>
       <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="name" class="col-sm-3 control-label">Name:</label>
          <div class="col-sm-8">
            <input type="text" name="name" placeholder="Full Name" class="form-control" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-3 control-label">E-mail:</label>
          <div class="col-sm-8">
            <input type="text" name="email" placeholder="E-mail" class="form-control" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="phone" class="col-sm-3 control-label">Mobile:</label>
          <div class="col-sm-8">
            <input type="text" name="phone" placeholder="Mobile No." class="form-control" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="complain_type" class="col-sm-3 control-label">Complain Title:</label>
          <div class="col-sm-8">
            <input type="text" name="complain_type" placeholder="Complain Title" class="form-control" autofocus required>
          </div>
        </div>

        <div class="form-group row">
          <label for="complain" class="col-sm-3 control-label">Complain:</label>
          <div class="col-sm-8">
           <textarea name="complain" class="form-control" rows="4"></textarea>
         </div>
       </div>
       <div>
        <button  type="submit" name="submit" class="btn btn-danger btn-sm" style="width: 100%;"><i class="fa fa-envelope" style="padding-right: 7px;" ></i>Send</button>
      </div>
    </form>
  </div>


      <br><br><br><br><br></div>
    <!-- Footer Start-->
    <?php include("include/footer.php"); ?>
    <!-- Footer End-->

  </div>
</body>
</script>

</html>
