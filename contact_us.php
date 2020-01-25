<?php

   include("database/connectdb.php");

   if(isset($_POST["submit"])){

      $name=$_POST['name'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $message=$_POST['message'];
       
      $insert_query="INSERT INTO `contact_us`(`contact_id`, `name`, `email`, `phone`, `message`, `date`) VALUES (NULL,'$name','$email','$phone','$message',current_timestamp() )";
    
       if ($connect->query($insert_query) == TRUE) {
               echo '<script> alert("Message sent Successfully!!!");</script>';
               header("Location:contact_us.php");
        }
   }

?>



<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
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
      
        #map {
        height: 500px;
      }
    </style>

</head>

<body>
    <div class="container-fluid">

        <?php include("include/header.php"); ?><br>
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.231162256928!2d91.85876681496946!3d24.890095484039964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3751aacd70cd7665%3A0xc8ae330ad72490dd!2sNorth%20East%20University%20Bangladesh!5e0!3m2!1sen!2sbd!4v1574439227393!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        
        <section class="contact py-5 bg-light" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4><b>Contact Us</b></h4>
                        <hr>
                    </div>
                    <div class="col-md-6"><br>
                        <div class="address">

                            <h5>Address:</h5>

                            <ul class="list-unstyled">
                                <li>MK Power Distribution Company</li>
                            </ul>
                        </div><br>
                        <div class="email">
                            <h5>Email:</h5>
                            <ul class="list-unstyled">
                                <li>mkpdc.bd@email.com</li>
                            </ul>
                        </div><br>
                        <div class="phone">
                            <h5>Phone:</h5>
                            <ul class="list-unstyled">
                                <li>Phone:+8801785477814</li>
                                <li>Phone:+8801717929270</li>
                            </ul>
                        </div>
                        <hr>

                        <div class="social">
                            <ul class="list-inline list-unstyled">
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fa fa-youtube-play fa-2x"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                               <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"  enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text"  name="name" placeholder="Full Name" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="email" placeholder="Email" class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="phone" placeholder="Mobile No." class="form-control" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <textarea name="message" rows="5" placeholder="Your Message" class="form-control" autofocus required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Start-->
        <?php include("include/footer.php"); ?>
        <!-- Footer End-->

    </div>

</body>

</html>
