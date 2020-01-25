  <?php
    include("database/connectdb.php");
   session_start();
  
   if (isset($_SESSION["admin_email"]) &&  $_SESSION["admin_email"]== true) {
    header("Location:admin_panel.php");
     exit;
  }else{


  if (isset($_POST["login"])) {

    $admin_email = $_POST["admin_email"];
    $admin_password = $_POST["admin_password"];
    $rem = isset($_POST["remember"]) == TRUE ? 1 : 0;

    $lq = "SELECT * FROM admin WHERE admin_email='$admin_email' AND admin_password='$admin_password'";

    $result = $connect->query($lq);
   
    if ($result->num_rows > 0) {

      $_SESSION["admin_email"] = $admin_email;

      if ($rem == 1) {
        setcookie('admin_email', $admin_email, time() + 3600 * 24 * 14, '/');
      }
       header("Location:admin_panel.php");
    } 
    else {
      echo "<script> alert('Wrong username/password! Try Again...'); </script>";
    }
  }
}
?>


  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <title>Log in </title>

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
     html,
      body {
        background-image: url('images/login.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Numans', 'Josefin Sans',sans-serif;
      }
      .container {
        height: 100%;
        align-content: center;
      }

      .card {
        height: 300px;
        margin-top: auto;
        margin-bottom: auto;
        width: 450px;
        background-color: #567fA0;
      }
      .card-header h3 {
        color: white;
        text-align: center;
      }
      .input-group-prepend span {
        width: 50px;
        background-color: #FF7F50;
        color: black;
        border: 0 !important;
      }

      input:focus {
        outline: 0 0 0 0 !important;
        box-shadow: 0 0 0 0 !important;

      }

      .remember {
        color: white;
      }

      .remember input {
        width: 20px;
        height: 20px;
        margin-left: 15px;
        margin-right: 5px;
      }

      .login_btn {
        color: black;
        background-color:#FF7F50;
        width: 100px;
      }

      .login_btn:hover {
        color: black;
        background-color: #32CD32;
      }


    </style>
  </head>

  <body>
    <div class="container">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-header">
            <h3>ADMIN LOGIN</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" name="admin_email" placeholder="E-Mail" autofocus required>

              </div>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" name="admin_password" placeholder="password" autofocus required>
              </div>
              <div class="row align-items-center remember">
                <input type="checkbox" name="remember">Remember Me
              </div>
              <div class="form-group">
                <input onclick="JSalert()" type="submit" name="login" value="LOGIN" class="btn float-right login_btn">
              </div>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        function JSalert() {
          swal("Congrats!", ", Your account is created!", "success");
        }
      </script>
    </div>
  </body>
</html>
