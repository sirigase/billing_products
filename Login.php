<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
include 'functions.php';?>
<?php

 $tag= $_GET['s'];
$username1=$_POST["uname"];
$password1=$_POST["pass"];
 $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           if($username1!="" && $password1!=""){
                          $sql = "SELECT * FROM login WHERE username='$username1' AND password='$password1'";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                             echo "Login Success";
                            $_SESSION["user"] = time();
                            header('Location:Dashboard.php');
                           }
                           else
                           {
                           // echo "Login Failed";
                           }
                           }

?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8"/>
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width"/>
<title></title>
<!-- CSS Files-->
<?php include 'headerscripts.php';?>
 <script>
        function validateForm()
   {
          if(document.getElementById("uname").value =="") 
      {
           alert("Username Cannot be empty");
           document.getElementById("uname").focus();
           return false;
      }
        if(document.getElementById("pass").value =="") 
      {
           alert("Password Cannot be empty ");
           document.getElementById("pass").focus();
           return false;
      }
      
   }
</script> 
</head>
<body>
<!-- HIDDEN PANEL 
================================================== -->

<!-- HEADER
================================================== -->
<div class="row">
	<div class="headerlogo four columns">
		<div class="logo">
			<a href="Dashboard.php">
			<h4><?php echo $companyName; ?></h4>
			</a>
		</div>
	</div>
    		<?php include 'headerlink.php'; ?>
	
</div>
<div class="clear">
</div>
<!-- SUBHEADER
================================================== -->

<!-- CONTENT 
================================================== -->
<!-- SINGLE COLUMN-->
<div class="row">
	<div class="seven columns">
	
		<hr>
		 <?php if($_SESSION["user"]==""){
                
              ?>
               
				<form action="Login.php?s=1" method="post" onsubmit="return validateForm()">
                     <fieldset>
                      <legend>Login </legend>
      <div class="row">
        <div class="five columns"> <label>Username: </label>    <input type="text" class="smoothborder"  name="uname" id="uname" size="20" maxlength="50" >
    <label>Password : </label>   <input type="password" class="smoothborder" name="pass" id="pass" size="20" maxlength="50">
        
         <input type="submit" class="button" value="Login">  &nbsp;&nbsp;&nbsp;<input class="button" type="Reset">
         <br>
                    </div>
                     </fieldset>
        </form>
               
                <?php
                }
                else{
                 header('Location:Dashboard.php');
                    echo "User Already Logged-In";
                }
                ?>
	</div>
</div>

<!-- END EXAMPLES-->


<!-- FOOOTER 
================================================== -->
	<?php include 'footerlinks.php';?>

<!-- JAVASCRIPTS 
================================================== -->
<!-- Javascript files placed here for faster loading -->
<?php include 'jsfiles.php'; ?>

</body>
</html>