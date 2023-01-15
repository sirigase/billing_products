<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
$tag= $_GET['s'];
$idno= $_GET['id'];
 if($tag=="2")
          {
           $cusname=$_POST["cusname"];
	$place=$_POST["place"];
	$mobile=$_POST["mobile"];
	$address=$_POST["address"];
			$page = $_GET['page'];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "UPDATE vendor SET name='$cusname',place='$place',mobile='$mobile',address='$address' WHERE id=$idno";

if ($conn->query($sql) === TRUE) {
  echo "Updated record successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location:Add_Vendor.php?s=2&page='.$page);			
						
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
		<h5>Edit Vendor</h5>
		<hr>
		<?php
                     
         
        $page = $_GET['page'];  
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM vendor WHERE id=$idno";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $cusname=$row["name"];
	                           $place=$row["place"];
	                           $mobile=$row["mobile"];
	                            $address=$row["address"];
													               		$amtpurchased=$row["totalamtpurchased"];
	                           $pendingpay=$row["totalamtdue"];
	                            $lastransdate=$row["lasttransactiondate"];
	}
                             } else {
                             echo "0 results";
                              }
                     $conn->close();
                         ?>
        <form action="EditVendor.php?s=2&id=<?php echo $idno;?>&page=<?php echo $page;?>" method="post">
          <div class="form">
    <div class="six columns"> <label>  Name : </label> <input type="text" name="cusname" id="cusname" size="30" maxlength="90" value="<?php echo $cusname;?>"></div>
	<div class="six columns"> <label> Place: </label> 	<input type="text" name="place" id="place" size="20" maxlength="190" value="<?php echo $place;?>"></div>
	<div class="six columns"> <label> Mobile:</label> 	 <input type="text" name="mobile" id="mobile" size="20" maxlength="15" value="<?php echo $mobile;?>"></div>
	<div class="six columns"> <label> 	Address: </label> <input type="text" name="address" id="address" size="30" maxlength="190" value="<?php echo $address;?>"></div>
	<div class="six columns"> <label> 	Total Amt Purchased:</label>  <?php echo $amtpurchased;?></div>
	<div class="six columns"> <label> Payment Pending: </label> 	<?php echo $pendingpay;?></div>
	<div class="six columns"> <label> 	Last transaction date:</label>  <?php echo $lastransdate;?></div>
        <input type="submit" class="button" value="Submit">  &nbsp;&nbsp;&nbsp;<input class="button" type="reset">
          </div>
    </form>
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