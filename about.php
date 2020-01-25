<!DOCTYPE html>
<html lang="en">
<head>
	<title>about</title>
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
   
    .about-text {
        width: 520px;
        height: auto;

    }

    .about-text h2 {
        font-size: 25px;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 2px solid #fff;
        margin-bottom: 20px;
        padding-top: 20px;

    }

    .about-text p {
        font-size: 16px;
        color: white;
        line-height: 22px;
        text-align: left;
    }


    .about-section {
        background: #34495e;
        padding: 10px 10px;
        margin-top: 20px;
    }

    .about-section p {
        padding: 5px 10px;
        margin-top: 10px;
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
        color: white;

    }
  .border1 {
        display: block;
        margin: auto;
        width: 160px;
        height: 3px;
        background: #ecf0f1;
        margin-bottom: 40px;
    } 
    .border2 {
    display: block;
    margin: auto;
    width: 350px;
    height: 3px;
    background: #ecf0f1;
    margin-bottom: 40px;
}
        
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}



.wrapper{
  margin-top: 1%;
 
  background-color: #34495e;
}

.wrapper h1{
  font-family: 'Allura', cursive;
  font-weight: bold;
  font-size: 42px;
  padding-top: 20px;
  margin-bottom: 30px;
  text-align: center;
  color: white;
}

.team{
  display: flex;
  justify-content: center;
  width: auto;
  text-align: center;
  flex-wrap: wrap;
}

.team .team_member{
  background: #fff;
  margin: 5px;
  margin-bottom: 50px;
  width: 300px;
  padding: 20px;
  line-height: 20px;
  color: black;  
  position: relative;
}

.team .team_member h3{
 
  color: #34495e;
  font-size: 26px;
  margin-top: 50px;
}

.team .team_member p.role{
  color: #1abc9c;
  margin: 12px 0;
  font-size: 12px;
  text-transform: uppercase;
}

.team .team_member .team_img{
  display: inline-block;
        margin: 0 30px;
        width: 160px;
        height: 160px;
        overflow: hidden;
        border-radius: 50%;
}

.team .team_member .team_img img{
        width: 100%;
        filter: grayscale(100%);
        transition: 0.4s all;
}
.team .team_member .team_img:hover>img{
    filter: none;
            
        }
        
        
    </style>
</head>
<body>
    <div class="container-fluid">
        <!--Admin Header Start-->
        <?php include "include/header.php";?>
        <!--Admin Header End-->
        <marquee id="top_marque" style="color:#ecf0f1;z-index: 1;font-style: italic; font-size:20px;position: fixed;background-color:rgb(0,0,0,0.5);padding:5px; margin-right: 2%;">For any emergency dial 16116.</marquee>
        <br>
        <div class="about-section">
            <h2 class="text-white text-center">About Us</h2>
            <span class="border1"></span>
            
            <div class="text-white">
                <p style="margin-left: 50px; margin-right: 30px;">MK Power Distribution Company was established on Septembur 13, 2019 through
                    a legislative Act of the Government of Bangladesh. The commission became effective
                    on April 27, 2019 with the appointment of two, of the five member commission including
                    the chairman. The 1st Chairman was appointed on june 4, 2019.The commission has the
                    mandate to regulate Electricity, Gas and Petroleum products for the whole of Bangladesh</p>
            </div>
        </div>

<div class="wrapper">
  <h1>Board Of Director</h1>
    <span class="border2"></span>
  <div class="team">
    <div class="team_member">
      <div class="team_img">
        <img src="images/man1.png" alt="Team_image">
      </div>
      <h3>Donald Trump</h3>
      <p class="role">Chairmen</p>
      <p>A chairman is an executive elected by a company's board of directors who is responsible for presiding over board or committee meetings. A chairman often sets the agenda and has significant sway as to how the board votes</p>
    </div>
    <div class="team_member">
      <div class="team_img">
        <img src="images/man1.png" alt="Team_image">
      </div>
      <h3>Barak Obama</h3>
      <p class="role">CEO</p>
      <p>A chief executive officer (CEO) is the highest-ranking executive in a company, whose primary responsibilities include making major corporate decisions, managing the overall operations.</p></div>
    <div class="team_member">
      <div class="team_img">
        <img src="images/man1.png" alt="Team_image">
      </div>
      <h3>Jeorge W Bush</h3>
      <p class="role">General Manager</p>
      <p>A general manager usually oversees most or all of the firm's marketing and sales functions as well as the day-to-day operations of the business. ... Most corporate managers holding the titles of chief executive officer (CEO) or president.</p>
    </div>
  </div>
</div>	
        <!-- Footer Start-->
        <?php include "include/footer.php";?><br>
        <!-- Footer End-->
</div>

</body>
</html>