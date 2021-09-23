<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$currencyString="";
$amount = "";
$sql = "INSERT INTO users (username, password, wallet) VALUES (?)";

?>

 <!DOCTYPE html>
<html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box}
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #ffffff;
  width: 30%;
  height: 300px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 300px;
  display: none;
}

/* Clear floats after the tab */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}


</style>
<body class="w3-light-grey"
>
<div id="overlay" onclick="off()"></div>


<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">EWALLET</span>
</div>

</div>



<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></span><br>
	  <span>Wallet ID: <strong><?php echo htmlspecialchars($_SESSION["wallet"]); ?></strong></span><br>
	  
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="welcome.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="wallet.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-briefcase fa-fw"></i>  Wallet</a>
    <a href="news.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-bell fa-fw"></i>  News</a>
    <a href="reset-password.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Reset Password</a>
	<a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Logout</a><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
<h2> NEWS</h2>
  <div class="tab">
  <button class="tablinks w3-light-blue w3-hover-red" onmouseover="openCity(event, 'Launch')" >New Launch</button>
  <button class="tablinks w3-light-blue w3-hover-red" onmouseover="openCity(event, 'Updates')">Updates Soon</button>
  <button class="tablinks w3-light-blue w3-hover-red" onmouseover="openCity(event, 'Noble')">Noble Peace Prize Won</button>
</div>

<div id="Launch" class="tabcontent">
  <h3>New Launch</h3>
  <p>EWALLET has successfully launched on 23/09/2021. Please enjoy the platform!!</p>
</div>

<div id="Updates" class="tabcontent">
  <h3>Update Soon</h3>
  <p>The new release of EWALLET is not the end of the production of the program, there will be new updates in the coming months, please stay tuned!</p> 
</div>

<div id="Noble" class="tabcontent">
  <h3>Noble Peace Prize Won</h3>
  <p>EWALLET has won the Noble Peace Prize due to its advances in the cryptocurrency industry. Rafael Cabrera and James Feliciano are now proud owners of Noble Peace Prizes.</p>
</div>

<div class="clearfix"></div>

  

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>EWALLET</h4>
    <p>Powered by Cabrera & Feliciano</p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
  
}
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>

</body>
</html>
