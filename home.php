<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
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
       
        .about-logo img {
            width: 630px;
            height: 200px;
            margin: 4px 10px;
            margin-bottom: 10px;
            box-shadow: 0px 8px 10px 0px #000;
        }

        .about-text {
            width: 520px;
            height: auto;
            padding: 10px 5px;
        }

        .about-text h2 {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #fff;
            margin-bottom: 20px;
        }

        .about-text p {
            font-size: 16px;
            color: white;
            line-height: 22px;
        }

        .row {
            overflow: auto;
        }

        .col {
            float: left;
        }

        .about-section {
            background: #54666e;
            padding: 40px 0px;
            margin-top: 20px;
        }

        .title {
            width: 200px;
            height: auto;
            margin: 0 auto;
        }

        .title h2 {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #fff;
            text-align: center;
            margin-bottom: 30px;

        }

        .service {
            width: 300px;
            height: auto;
            border: 2px solid #fff;
            text-align: center;
            display: inline-block;
            margin: 35px;

        }

        .service h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .service p {
            font-size: 14px;
            color: white;
            line-height: 22px;
            padding: 0px 15px;
        }

        .service-section {
            background: #3f6387;
            padding-bottom: 40px;
            padding: 40px 170px;
            margin-top: 20px;
        }

        .serv-icon i {
            font-size: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
            color: #fff;
            transition: 0.5s;
        }

        .serv-icon i:hover {
            color: yellow;
            transform: scale(0.8);
        }

        .contact-a {
            background: #fff;
            padding: 15px 15px 15px 80px;
            box-shadow: 0px 0px 10px #ccc;
            width: 280px;
            position: relative;
            display: inline-block;
            margin: 0px 50px;

        }

        .cont-icon i {
            position: absolute;
            width: 50px;
            height: 50px;
            float: left;
            top: 8px;
            left: 15px;
            background: #222;
            text-align: center;
            color: #fff;
            line-height: 50px;
            font-size: 30px;
            transition: .5s;
        }

        .cont-icon i:hover {
            color: yellow;
            transform: scale(.8);
        }

        .cont-text p {
            padding: 0;
            margin: 0;
            font-size: 16px;
            line-height: 22px;

        }

        .inputTag input {
            font-size: 20px;
            text-transform: capitalize;
            padding: 5px 5px;
            width: 80%;
            border: 0;
            margin: 8px 0px;
        }

        .inputTag textarea {
            width: 500px;
            height: 100px;
            border: 0;
        }

        .inputTag button {
            width: 81%;
            padding: 10px 0px;
            background: #fff;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 4px;
            border: 0;
            transition: .5s;
            color: green;
        }

        .inputTag button:hover {
            color: red;
            transform: scale(.8);
        }
    </style>



</head>

<body>
    <div class="container-fluid">

        <!--Header Start-->
        <?php include("include/header.php"); ?>
        <!--Header End-->
       <marquee id="top_marque" style="color:#faf4f2;z-index: 1;font-style: italic; font-size:20px;position: fixed;background-color:rgb(0,0,0,0.5);padding:5px; margin-right: 2%;">For any emergency dial 16116.</marquee>
        <!--Slideshow Start-->
        <?php include("include/slideshow.php"); ?>
        <!--Slideshow Start-->
        <div class="about-section">
            <div class="title">
                <h2>WELCOME</h2>
            </div>
            <div class="about">
                <div class="row">
                    <div class="col">
                        <div class="about-logo">
                            <img src="images/grid-integration.jpg">
                        </div>
                    </div>
                    <div class="col">
                        <div class="about-text">
                            <h2>Welcome To Our Company</h2>
                            <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the appointment of two, of the five member commission including the chairman. The 1st Chairman was appointed on june 4, 2019.The commission has the mandate to regulate Electricity, Gas and Petroleum products for the whole of Bangladesh</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-section">
            <div class="title">
                <h2>Our Services</h2>
            </div>
            <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-money"></i>
                </div>
                <h3>Online Bill Payment</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>
            
            <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-bell"></i>
                </div>
                <h3>Email Notification System</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>
            <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <h3>Online Notice Board</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>
            <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-edit"></i>
                </div>
                <h3>Online Application</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>
            
            <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-hourglass-start"></i>
                </div>
                <h3>24 Hour Service</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>
             <div class="service">
                <div class="serv-icon">
                    <i class="fa fa-gears"></i>
                </div>
                <h3>Others Facilities</h3>
                <p>MK Power Distribution Company was established on Septembur 13, 2019 through a legislative Act of the Government of Bangladesh. The commission became effective on April 27, 2019 with the</p>
            </div>

        </div>
        

        <section class="contact py-5 text-white" id="contact" style="background-color:#5f666e;">
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
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input id="Full Name" name="Full Name" placeholder="Full Name" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input id="Mobile No." name="Mobile No." placeholder="Mobile No." class="form-control" required="required" type="text">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea id="comment" name="comment" cols="40" rows="5" placeholder="Your Message" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <button type="button" class="btn btn-danger">Submit</button>
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