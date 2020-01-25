
<?php 
   include("database/connectdb.php");
   session_start();
   if (isset($_SESSION["customer_no"]) &&  $_SESSION["customer_no"]== true) {
     header("Location:bill_making.php");
     exit;
   }
   else{

    if(isset($_POST["submit"]))
    {
      $customer_no = $_POST['customer_no'];
      $pin = $_POST['pin'];

      $q1 = "SELECT * FROM customer WHERE customer_no='$customer_no' AND pin ='$pin' ";
      $r1 = $connect->query($q1);

      if($r1->num_rows>0)
      {
          $_SESSION["customer_no"] = $customer_no;
          setcookie('customer_no', $customer_no, time() + 3600 * 24, '/');
          header("Location:bill_making.php");
      }else{

        echo "<script> alert('Wrong Customer Number! Try Again...'); </script>";
        header("Location:pay_bill.php");
      }
    }
   }
?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Pay Bill</title>
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
  .lol{
   background-color: #787878;
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
    <div class="lol">
      <br><br><br><br><br><br>
      <div class="card mx-auto id2" style="width: 800px; background-color: #3c3c3c;">
         <h3 style="text-align: center; background-color: #ffa500;padding: 10px;">Pay Your Electricity Bill</h3><br>
         <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
          <div class="form-group row">
            <label class="col-sm-3 control-label">Customer No:</label>
            <div class="col-sm-7">
              <input type="text" name="customer_no" placeholder="Enter Your Customer Number" class="form-control" autofocus required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label">Pin No:</label>
            <div class="col-sm-7">
              <input type="password" name="pin" placeholder="Enter Your Pin Number" class="form-control" autofocus required>
            </div>
          </div><br>
          <div>
            <button type="submit" name="submit" value="submit" class="btn btn-danger btn-sm" style="width: 100%;"><i class="fa fa-search" style="padding: 8px;"></i>Search</button>
          </div>
        </form>
      </div>
      <br><br><br><br><br><br><br><br><br><br>
    </div>
    <!-- Footer Start-->
    <?php include("include/footer.php"); ?>
    <!-- Footer End-->

  </div>
</body>
</html>
