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
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.form-popup {
  display: none;
  position: fixed;
  bottom: 50;
	left: 10;
  border: 3px solid #f1f1f1;
  z-index: 9;
}
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
  

  
}
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
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
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Wallet</a>
    <a href="news.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>
    <a href="reset-password.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Reset Password</a>
	<a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Logout</a><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<!-- popup menu -->
<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
     <h2 id="demo"></h2>

    <label for="buyValue"><b>ENTER USD VALUE </b></label>
    <input type="text" placeholder="USD VALUE" name="buyValue" required>

	<label for="creditCard"><b>CREDIT CARD NUMBER</b></label>
    <input type="text" placeholder="Enter Number" name="creditcard" required>
	
	<label for="CVV"><b>CVV</b></label>
    <input type="text" placeholder="Enter Number" name="ccv" required>


    <button type="submit" class="btn" >Buy</button>
	
	
    <button type="button" class="btn cancel" onclick="closeForm(); off()">Close</button>
  </form>
</div>







  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Statistics</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Messages</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>99</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      
      <div class="w3-twothird">
	  
        <h5>Crypto Currency Values</h5>
		<! --- try to insert the images of each of the bitcoins --->
		<! --- insert data here instead of those things, add another column  --->
		<! --- the columns will be name, average rate, volume(24) --->
				
	
		
		
        <table class="w3-table w3-striped w3-white w3-hoverable">
          <tr>
            
			<td><img src="/w3images/1200px-BTC_Logo.png" class="w3-circle w3-margin-right" style="width:46px"></td>
			
            <td>Bitcoin (BTC)</td>
            <td>$43,705.71</td>
			
			<td onclick="openForm(); on();bitCoinFunc()" class= "w3-button w3-blue w3-hover-red"  ><i class="fa fa-exchange"></i>  Buy</td>
			
			
          </tr>
          <tr>
            
			<td><img src="/w3images/1257px-Ethereum_logo_2014.png" class="w3-circle w3-margin-right" style="width:46px"></td>
			
            <td>Ethereum (ETH)</td>
            <td>$3,079.11</td>
			<td onclick="openForm();on();ethFunc()" class=" w3-button  w3-light-blue w3-hover-red"><i class="fa fa-exchange"></i>  Buy</td>
			
          </tr>
          <tr>
		  
            <td><img src="/w3images/binance-coin-bnb-logo.png" class="w3-circle w3-margin-right" style="width:46px"></td>
			
            <td>Binance Coin (BNB)</td>
            <td>$377.41</td>
			<td onclick="openForm();on();binFunc()" class=" w3-button  w3-blue w3-hover-red"><i class="fa fa-exchange"></i>  Buy</td>
			
          </tr>
          <tr>
            <td><img src="/w3images/cardano-ada-logo.png" class="w3-circle w3-margin-right" style="width:46px"></td>
            <td>Cardano (ADA)</td>
            <td>$2.45</td>
			<td onclick="openForm();on();cardFunc()" class="w3-button  w3-light-blue w3-hover-red"><i class="	fa fa-exchange"></i>  Buy</td>
			
          </tr>
          <tr>
            <td><img src="/w3images/825.png" class="w3-circle w3-margin-right" style="width:46px"></td>
            <td>Tether (USDT)</td>
            <td>$1.00</td>
			<td onclick="openForm();on();tethFunc()" class=" w3-button  w3-blue w3-hover-red"><i class="	fa fa-exchange"></i>  Buy</td>
          </tr>
          <tr>
           <td><img src="/w3images/52.png" class="w3-circle w3-margin-right" style="width:46px"></td>
            <td>XRP(XRP)</td>
            <td>$1.00</td>
			<td  onclick="openForm();on();xrpFunc()"class="w3-button  w3-light-blue w3-hover-red"><i class="	fa fa-exchange"></i>  Buy</td>
          </tr>
          <tr>
            <td><img src="/w3images/Dogecoin_Logo.png" class="w3-circle w3-margin-right" style="width:46px"></td>
            <td>Dogecoin(DOGE)</td>
            <td>$0.2247</td>
			<td onclick="openForm();on();dogeFunc()"class=" w3-button  w3-blue w3-hover-red"><i class="	fa fa-exchange"></i>  Buy</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Top Countries using Crypto</h5>
    <p>Nigeria</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:32%">32%</div>
    </div>

    <p>Vietnam</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:21%">21%</div>
    </div>

    <p>Philippines</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:20%">20%</div>
	  </div>
	   <p>Turkey</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-white" style="width:16%">16%</div>
	  </div>
	  <p>Peru</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-yellow" style="width:16%">16%</div>
	  </div>
    </div>
  </div>
  <hr>

  

  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div>

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

function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}

function bitCoinFunc() {
  document.getElementById("demo").innerHTML = "BUY BitCoin";
}

function ethFunc() {
  document.getElementById("demo").innerHTML = "BUY Ethereum";
}

function binFunc() {
  document.getElementById("demo").innerHTML = "BUY Binance";
}
function cardFunc() {
  document.getElementById("demo").innerHTML = "BUY Cardano";
}
function tethFunc() {
  document.getElementById("demo").innerHTML = "BUY Tether";
}
function xrpFunc() {
  document.getElementById("demo").innerHTML = "BUY XRP";
}
function dogeFunc() {
  document.getElementById("demo").innerHTML = "BUY DogeCoin";
}


</script>

</body>
</html>
