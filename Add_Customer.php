<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
 $id= $_GET['id'];
 $tag= $_GET['s'];
 $page = $_GET['page'];  
 if($tag==4){
	$cusname=$_POST["cusname"];
	$place=$_POST["place"];
	$mobile=$_POST["mobile"];
	$address=$_POST["address"];
	$amtpurchased=$_POST["amtpurchased"];
	$pendingpay=$_POST["pendingpay"];
	$lastransdate=$_POST["lastransdate"];
 $advamt=$_POST["advamt"];
 
$conn = new mysqli($servername, $username, $password, $dbname);
 $sql = "SELECT * FROM customer WHERE mobile=$mobile";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            header('Location:Add_Customer.php?s=2');
                           }else{
 
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO customer(name,place,mobile,address,totalamtpurchased,totalamtdue,lasttransactiondate,advamt) VALUES ('$cusname','$place','$mobile','$address','$amtpurchased','$pendingpay','$lastransdate','$advamt')";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 header('Location:Add_Customer.php?s=1');
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
<title>Customer</title>
<?php include 'headerscripts.php';?>
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
	<div class="twelve columns">
		<h5>Customer</h5>
		 <?php
        if($tag=="1")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Customer added successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="2")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Mobile number already register, Registration unsuccessfull<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
       
       ?>
     
	<div class="twelve columns">
				<form action="Add_Customer.php?s=4&page=<?php echo $page; ?>" method="post" onsubmit="return validateForm()">
    <fieldset>
                      <legend>Add Customer </legend>
                  
    <div class="three columns"> <label>Name :</label> <input type="text" name="cusname" class="smoothborder" id="cusname" size="10" maxlength="90"></div>
       <div class="three columns">                   <label>Place: </label>
		<input type="text" name="place" id="place" class="smoothborder" size="20" maxlength="190"> </div>
                     
    <div class="three columns">                     <label>Mobile:  </label>
		<input type="text" name="mobile" id="mobile"  class="smoothborder" size="20" maxlength="15"></div>
		 <div class="three columns"> <label>Address: </label><input type="text" name="address"  class="smoothborder" id="address" size="30" maxlength="190"></div>
	 <div class="three columns">	 <label>Total Amt Purchased:  </label><input type="text"  class="smoothborder" name="amtpurchased" id="amtpurchased" size="10" maxlength="8" value="0"></div>
	 <div class="three columns">	 <label>Payment Pending: </label><input type="text"  class="smoothborder" name="pendingpay" id="pendingpay" size="10" maxlength="8" value="0"></div>
  <div class="three columns">  <label>Advance amount :  </label>  <input type="text"  class="smoothborder" name="advamt" id="advamt" size="10" maxlength="8" value="0"></div>
	 <div class="three columns">	 <label>Last transaction date: </label><input type="text"  class="smoothborder" name="lastransdate" id="lastransdate" value="<?php  echo date("d-m-Y") ?>" size="10" maxlength="15"></div>
      <div class="three columns">    <input type="submit" class="button" value="Submit">  &nbsp;&nbsp;&nbsp;<input class="button" type="reset"></div>
            </fieldset>
    </form>
             </div>  </div>
       
	


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