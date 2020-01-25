<?php
include "database/connectdb.php";

if (isset($_POST["submit"])) {
  $name = $_POST['name'];
  $father_name = $_POST['father_name'];
  $mother_name = $_POST['mother_name'];
  $mobile = $_POST['mobile'];
  $nationality = $_POST['nationality'];
  $nid = $_POST['nid'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $phase = $_POST['phase'];
  $connection_type = $_POST['connection_type'];
  $tariff_category = $_POST['tariff_category'];
  $demand_meter = $_POST['demand_meter'];
  $relegion = $_POST['relegion'];
  $date_of_birth = $_POST['date_of_birth'];
  $ap_type = $_POST['ap_type'];


  $insert_q1 = "INSERT INTO `application`(`application_id`, `father_name`, `mother_name`, `mobile`, `nationality`, `nid`, `gender`, `email`, `address`, `city`, `phase`, `connection_type`, `tariff_category`, `demand_meter`, `relegion`, `date_of_birth`, `ap_type`) VALUES (NULL,'$father_name','$mother_name','$mobile','$nationality','$nid','$gender','$email','$address','$city','$phase','$connection_type','$tariff_category','$demand_meter','$relegion','$date_of_birth','$ap_type')";
 
  
  $max="SELECT application_id FROM application ORDER BY application_id DESC LIMIT 1";

  $insert_q2= "INSERT INTO `residential`(`application_id`, `name`) VALUES ((SELECT application_id FROM application ORDER BY application_id DESC LIMIT 1),'$name');";
  
  $message ="Thank You..."."\r\n"."Your Applicatiom Sucessfully Submited."."\r\n";
  $body = "MK Power Distribution Company";
  $header = "From: j.kamran14@gmail.com";

  if (($connect->query($insert_q1)==true) && ($connect->query($insert_q2)==true)){

    $id_q= "SELECT `application_id` FROM `application` ORDER BY application_id DESC";
    $id_row = $connect->query($id_q);
    $row_id = $id_row->fetch_assoc();
    $last_id = $row_id['application_id'];
    $message.="Your Applicatiom Id:".' '."$last_id";


    if(mail($email,$body,$message,$header)){
          header("Location:new_connection.php");
     }else{
       echo "Failed";
    }
  }
}

if (isset($_POST["submit1"])) {

  $organizatio_name = $_POST['organizatio_name'];
  $proprietor_name = $_POST['proprietor_name'];
  $father_name = $_POST['father_name'];
  $mother_name = $_POST['mother_name'];
  $mobile = $_POST['mobile'];
  $nationality = $_POST['nationality'];
  $nid = $_POST['nid'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $phase = $_POST['phase'];
  $connection_type = $_POST['connection_type'];
  $tariff_category = $_POST['tariff_category'];
  $demand_meter = $_POST['demand_meter'];
  $relegion = $_POST['relegion'];
  $date_of_birth = $_POST['date_of_birth'];
  $status = $_POST['status'];
  $ap_type = $_POST['ap_type'];



  $insert_q1 = "INSERT INTO `application`(`application_id`, `father_name`, `mother_name`, `mobile`, `nationality`, `nid`, `gender`, `email`, `address`, `city`, `phase`, `connection_type`, `tariff_category`, `demand_meter`, `relegion`, `date_of_birth`, `ap_type`) VALUES (NULL,'$father_name','$mother_name','$mobile','$nationality','$nid','$gender','$email','$address','$city','$phase','$connection_type','$tariff_category','$demand_meter','$relegion','$date_of_birth','$ap_type')";
  
  $max="SELECT application_id FROM application ORDER BY application_id DESC LIMIT 1";

  $insert_q2= "INSERT INTO `commercial`(`application_id`, `organizatio_name`, `proprietor_name`) VALUES ((SELECT application_id FROM application ORDER BY application_id DESC LIMIT 1),'$organizatio_name','$proprietor_name');";

  $message ="Thank You..."."\r\n"."Your Applicatiom Sucessfully Submited."."\r\n";
  $body = "MK Power Distribution Company";
  $header = "From: j.kamran14@gmail.com";

  if (($connect->query($insert_q1)==true) && ($connect->query($insert_q2)==true)){
     
    $id_q= "SELECT `application_id` FROM `application` ORDER BY application_id DESC";
    $id_row = $connect->query($id_q);
    $row_id = $id_row->fetch_assoc();
    $last_id = $row_id['application_id'];
    $message.="Your Applicatiom Id:".' '."$last_id";

    if(mail($email,$body,$message,$header)){
            echo "$message";
            header("Location:new_connection.php");
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
  <title>New Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  
  <script src="alert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="alert/dist/sweetalert.css">
  <script type="text/javascript" src="js/addons/datatables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  
    .b1{
      border-radius: 50%;
      font-size: 40px;
    }
    .id2 {
      border:2px solid #999;
      border-radius:15px;
      box-shadow:0 0 30px #99f;
      font-variant: small-caps;

    }
    .modal label{
     color: white;

   }
   .modal-header { 
     background-color: #669999;
     font-variant: small-caps;
   }
   .modal-footer { 
     background-color: #669999;
     font-variant: small-caps;
   }
   .fade{
    text-align: left;
   }
 </style>

</head>

<body>

  <div class="container-fluid">
    <!--Admin Header Start-->
    <?php include "include/header.php";?>
    <!--Admin Header End-->

    <!-- New Application Home page-->
    <div class="content" style="background-image: url(images/c1.jpg); width:100%; height:auto;">
      <fieldset class="p-5 text-white text-lg">
        <center>
          <div class="id2" style="padding:10px; margin: 0px 140px 0px 140px; background-color:  #2F4F4F;">
            <h5 style="font-size: 30px;font-variant: small-caps;">Online Application Process</h5>
          </div>
        </center>
      </fieldset>
      <fieldset class="p-3 text-sm">
        <div class="row m-3" align="center">
          <div class="col p-1 mr-2 mt-2">
          </div>
          <div class="col p-3 mr-2 mt-2 id2" style="background: #f7641d">
            <div class="col-auto">
              <!-- Button trigger modal -->
              <a data-toggle="modal" data-target="#id11"><img src="images\ees.png" style="height: 60%;width: 35%; border-radius: 50%;"> <h3>Residential</h3></a>
              <!-- Modal -->
              <div class="modal fade" id="id11" tabindex="-1" role="dialog" aria-labelledby="idlabel"
              aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content bg-secondary text-white">
                  <div class="modal-header">
                    <h5 class="modal-title" id="idlabel" style="font-variant: small-caps;">Application for New Connection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="bg-warning" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="<?php $_SERVER["PHP_SELF"];?>" method="post"
                      enctype="multipart/form-data">

                      <fieldset class="border p-3 h-100 bg-dark text-white">
                        <center>
                          <h5><b>Residential</b></h5>
                        </center>
                      </fieldset><br>
                      <h6>Personal Information:</h6>
                      <fieldset class="border p-3 bg-dark">
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-4">
                            <input type="text" name="name" placeholder="" class="form-control" autofocus required>
                          </div>
                          <label for="gender" class="col-sm-2 control-label">Gender</label>
                          <div class="col-sm-4">
                            <select name="gender" class="custom-select">
                              <option selected>Choose</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="father_name" class="col-sm-2 control-label">Father's Name</label>
                          <div class="col-sm-4">
                            <input type="text" name="father_name" placeholder="" class="form-control" autofocus required>
                          </div>
                          <label for="mother_name" class="col-sm-2 control-label">Mother Name</label>
                          <div class="col-sm-4">
                            <input type="text" name="mother_name" placeholder="" class="form-control" autofocus required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="relegion" class="col-sm-2 control-label">Relegion</label>
                          <div class="col-sm-4">
                            <input type="text" name="relegion" placeholder="" class="form-control" autofocus required>
                          </div>
                          <label for="nationality" class="col-sm-2 control-label">Nationality</label>
                          <div class="col-sm-4">
                            <input type="text" name="nationality" placeholder="" class="form-control" autofocus required>
                          </div>

                        </div>
                        <div class="form-group row">
                          <label for="nid" class="col-sm-2 control-label">National ID</label>
                          <div class="col-sm-4">
                            <input type="text" name="nid" placeholder="" class="form-control" autofocus required>
                          </div>
                          <label for="date_of_birth" class="col-sm-2 control-label">Date of Birth</label>
                          <div class="col-sm-4">
                            <input type="date" name="date_of_birth" placeholder="Date of Birth" class="form-control" autofocus required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 control-label">E-Mail</label>
                          <div class="col-sm-4">
                            <input type="email" name="email" placeholder="pdc@gmail.com" class="form-control" autofocus required>
                          </div>
                          <label for="mobile" class="col-sm-2 control-label">Phone Number</label>
                          <div class="col-sm-4">
                            <input type="text" name="mobile" placeholder="" class="form-control" autofocus required>
                          </div>
                        </div>
                      </fieldset><br>

                      <h6 >Address:</h6>
                      <fieldset class="border p-3 bg-dark">
                        <div class="form-group row">
                          <label for="city" class="col-sm-2 control-label">City</label>
                          <div class="col-sm-4">
                            <input type="text" name="city" placeholder="" class="form-control" autofocus required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="address" class="col-sm-2 control-label">Address</label>
                          <div class="col-sm-10">
                            <input type="text" name="address" placeholder="Amborkhana,Sylhet etc." class="form-control" autofocus required>
                          </div>
                        </div>
                      </fieldset><br>

                      <h6>Description of Connection:</h6>
                      <fieldset class="border p-3 bg-dark">
                        <div class="form-group row">
                         <label for="connection_type" class="col-sm-2 control-label">Connection Type</label>
                         <div class="col-sm-4">
                          <select name="connection_type" class="custom-select">
                            <option selected>Choose</option>
                            <option value="Permanent">permanent</option>
                            <option value="Temporary">temporary</option>
                          </select>
                        </div>
                        <label for="phase" class="col-sm-2 control-label">Phase</label>
                        <div class="col-sm-4">
                          <select name="phase" class="custom-select">
                            <option selected>Choose</option>
                            <option value="Single">Single</option>
                            <option value="Three">Three</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="tariff_category" class="col-sm-2 control-label">Tariff Category</label>
                        <div class="col-sm-4">
                          <input type="text" name="tariff_category" placeholder="" class="form-control" autofocus required>
                        </div>
                        <label for="demand_meter" class="col-sm-2 control-label">Demand Meter</label>
                        <div class="col-sm-4">
                          <input type="text" name="demand_meter" placeholder="" class="form-control" autofocus required>
                        </div>
                      </div>
                      <div>
                          <input type="hidden" name="ap_type" value="residential">
                      </div>
                    </fieldset>
                    <div class="modal-footer">
                      <button type="submit" name="submit" class="btn btn-success" onclick="JSalert()">submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Commercial Application Form Start-->
      <div class="col">
      </div>


      <div class="col p-3 mr-3 mt-2 id2" style="background: #f7641d">
        <div class="col auto">
         <a data-toggle="modal" data-target="#id12"><img src="images\commercial.png" style="height: 60%;width: 35%; border-radius: 50%;"> <h3>Commercial</h3></a>

         <div class="modal fade" id="id12" tabindex="-1" role="dialog" aria-labelledby="idlabel"
         aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
          <div class="modal-content bg-secondary text-white">
           <div class="modal-header">
            <h5 class="modal-title" id="idlabel" style="font-variant: small-caps;">Application for New Connection</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="bg-warning" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
             <fieldset class="border p-3 bg-dark text-white">
              <center>
                <h5><b>Commercial</b></h5>
              </center>
            </fieldset><br>
            <h6>Organization:</h6>
            <fieldset class="border p-3  bg-dark">
              <div class="form-group row">
                <label for="organizatio_name" class="col-sm-2 control-label">Organizartion Name</label>
                <div class="col-sm-4">
                  <input type="text" name="organizatio_name" placeholder="" class="form-control" autofocus required>
                </div>
                <label for="proprietor_name" class="col-sm-2 control-label">Proprietor Name</label>
                <div class="col-sm-4">
                  <input type="text" name="proprietor_name" placeholder="" class="form-control" autofocus required>
                </div>
              </div>
              <div class="form-group row">
                <label for="gender" class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-4">
                  <select name="gender" class="custom-select">
                    <option selected>Choose</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="father_name" class="col-sm-2 control-label">Father's Name</label>
                <div class="col-sm-4">
                  <input type="text" name="father_name" placeholder="" class="form-control" autofocus required>
                </div>
                <label for="mother_name" class="col-sm-2 control-label">Mother Name</label>
                <div class="col-sm-4">
                  <input type="text" name="mother_name" placeholder="" class="form-control" autofocus required>
                </div>
              </div>
              <div class="form-group row">
                <label for="relegion" class="col-sm-2 control-label">Relegion</label>
                <div class="col-sm-4">
                  <input type="text" name="relegion" placeholder="" class="form-control" autofocus required>
                </div>
                <label for="nationality" class="col-sm-2 control-label">Nationality</label>
                <div class="col-sm-4">
                  <input type="text" name="nationality" placeholder="" class="form-control" autofocus required>
                </div>

              </div>
              <div class="form-group row">
                <label for="nid" class="col-sm-2 control-label">NID</label>
                <div class="col-sm-4">
                  <input type="text" name="nid" placeholder="" class="form-control" autofocus required>
                </div>
                <label for="mobile" class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-4">
                  <input type="text" name="mobile" placeholder="" class="form-control" autofocus required>
                </div>
              </div>
              <div class="form-group row">
                <label for="date_of_birth" class="col-sm-2 control-label">Date of Birth</label>
                <div class="col-sm-4">
                  <input type="date" name="date_of_birth" placeholder="Date of Birth" class="form-control" autofocus required>
                </div>
                <label for="email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-4">
                  <input type="email" name="email" placeholder="pdc@gmail.com" class="form-control" autofocus required>
                </div>
              </div>
            </fieldset><br>

            <h6>Address:</h6>
            <fieldset class="border p-3  bg-dark">
              <div class="form-group row">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-4">
                  <input type="text" name="city" placeholder="" class="form-control" autofocus required>
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" name="address" placeholder="Amborkhana,Sylhet etc." class="form-control" autofocus required>
                </div>
              </div>
            </fieldset><br>

            <h6>Description of Connection:</h6>
            <fieldset class="border p-3 bg-dark">
              <div class="form-group row">
               <label for="connection_type" class="col-sm-2 control-label">Connection Type</label>
               <div class="col-sm-4">
                <select name="connection_type" class="custom-select">
                  <option selected>Choose</option>
                  <option value="Permanent">permanent</option>
                  <option value="Temporary">temporary</option>
                </select>
              </div>
              <label for="phase" class="col-sm-2 control-label">Phase</label>
              <div class="col-sm-4">
                <select name="phase" class="custom-select">
                  <option selected>Choose</option>
                  <option value="Single">Single</option>
                  <option value="Three">Three</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="tariff_category" class="col-sm-2 control-label">Tariff Category</label>
              <div class="col-sm-4">
                <input type="text" name="tariff_category" placeholder="" class="form-control" autofocus required>
              </div>
              <label for="demand_meter" class="col-sm-2 control-label">Demand Meter</label>
              <div class="col-sm-4">
                <input type="text" name="demand_meter" placeholder="" class="form-control" autofocus required>
              </div>
            </div>
            <div>
                <input type="hidden" name="ap_type" value="commercial">
            </div>
        </fieldset>
        <div class="modal-footer">
          <button type="submit" name="submit1" class="btn btn-success">submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


</div>
</div>
<!-- Commercial Application Form End-->


<div class="col">
</div>

</div>
</fieldset><br>


<fieldset class="p-1 text-sm">
  <div class="container text-white bg-info id2"><br>
    <h4 style="color:white; background:black;padding: 6px;">Information for New Connection System:</h4>
    <p style="text-align:justify;"><b>Step-1:</b>
    Click on Application for New Connection at the panel of MKPDC website.After fill up the page with appropriate information please enter Save button. Immediately, a short message will send to entered mobile number along with tracking number and pin number. Besides that, prospective customer will be requested for his/her confirmation.Applicant can update entered information before his/her confirmation but not permitted after that. After the confirmation, there will be an application form displayed on the screen and customer should printout the same. Applicant should put his/her signature on the form and submit to respective NOCS office. Moreover, prospective customer can monitor his current application status via website or SMS service by using this tracking number.</p>
    <p><b>Step-2:</b> For connection, prospective customer will be requested to submit the following documents:</p>
    <ul>
      <li>Printout application along with signature of the prospective applicant</li>
      <li>Two copies of Passport size color photos</li>
      <li>Photocopy of National ID/Passport</li>
      <li>Land Ownership Document/Lease Deed/Namazari Paper, The Inheritance Certificate in the absence of Original Owner</li>
      <li>Copy of paid bill, if previously connected (there are no new documents needed to get more connections in the same name/place)</li>
    </ul>

    <p style="text-align:justify;"><b>Step-3:</b>
    Applicant will be informed via SMS about site survey and that will be done within 3 days for LT connection whereas 5 days for HT/MT connection. After the survey, Load will be allocated within 2 days for LT connection and 10 days for HT/MT connection.If there are any types discrepancy in survey report, applicantwill be informed immediately.</p>

    <p style="text-align:justify;"><b>Step-4:</b>
    Applicant should submit the bank deposit receipt to NOCS office.</p>
    <p style="text-align:justify;"><b>Step-5:</b>
    Customer will be requested to submit meter and after successful testing of the meter it will be installed within 1 days for LT connection and 7 days for HT/MT connection.</p>
  </div><br><br>

</fieldset>

</div>
<!-- New Application Home page-->


<!-- Footer Start-->
<?php include "include/footer.php";?>
<!-- Footer End-->
</div>

</body>
</html>
