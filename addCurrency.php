<?php 
include 'welcome.php';

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

$usdValue="";


if($_SERVER["REQUEST_METHOD"] == "POST"){
	
if ($selected==1){
	
	
	$usdValue =  $_POST["buyValue"]+$_SESSION["BITCOIN"];
	$sql = "UPDATE users SET BITCOIN = ? WHERE id = ?";
	
	 if($stmt = mysqli_prepare($link, $sql)){
		 mysqli_stmt_bind_param($stmt, "ii", $param_value, $param_id);
		 $param_value= $usdValue;
         $param_id = $_SESSION["id"];
		  // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){            
                
                exit();
			} else{
                echo "Oops! Something went wrong. Please try again later.";
			}

            // Close statement
            mysqli_stmt_close($stmt);
	 }
	mysqli_close($link);
}
	
		

 if ($selected==2){
	$usdValue =  $_POST["buyValue"]+$_SESSION["ETHEREUM"];
	$sql = "UPDATE users SET ETHEREUM = ? WHERE id = ?";
	
	 if($stmt = mysqli_prepare($link, $sql)){
		 mysqli_stmt_bind_param($stmt, "ii", $param_value, $param_id);
		 $param_value= $usdValue;
         $param_id = $_SESSION["id"];
		  // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){            
                header("location: welcome.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
	 }
	mysqli_close($link);
	
}

}


?>