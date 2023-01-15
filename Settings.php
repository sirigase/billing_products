<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
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
            if(document.getElementById("compname").value =="")
      {
           alert("Please Enter Company");
           document.getElementById("compname").focus();
           return false;
      }
       if(document.getElementById("compaddr").value =="")
      {
           alert("Please Enter Company Address");
           document.getElementById("compaddr").focus();
           return false;
      }
       if(document.getElementById("compphone").value =="")
      {
           alert("Please Enter Phone number");
           document.getElementById("compphone").focus();
           return false;
      }
      if(document.getElementById("rprod").value =="") 
      {
           alert("Please Enter Record for Products ");
           document.getElementById("rprod").focus();
           return false;
      }
      if(isNaN(document.getElementById("rprod").value)){
           document.getElementById("rprod").value=5;
           alert("Please Enter Number in Record for Products");
           document.getElementById("rprod").focus();
           return false;
      }
       if(document.getElementById("rcat").value =="") 
      {
           alert("Please Enter Record for Categories ");
           document.getElementById("rcat").focus();
           return false;
      }
      if(isNaN(document.getElementById("rcat").value)){
           document.getElementById("rcat").value=5;
           alert("Please Enter Number in Record for Categories");
           document.getElementById("rcat").focus();
           return false;
      }
       if(document.getElementById("rretail").value =="") 
      {
           alert("Please Enter Record for Retail ");
           document.getElementById("rretail").focus();
           return false;
      }
      if(isNaN(document.getElementById("rretail").value)){
           document.getElementById("rretail").value=5;
           alert("Please Enter Number in Record for Retail");
           document.getElementById("rretail").focus();
           return false;
      }
       if(document.getElementById("rcsale").value =="") 
      {
           alert("Please Enter Record for Counter Sales Invoice ");
           document.getElementById("rcsale").focus();
           return false;
      }
      if(isNaN(document.getElementById("rcsale").value)){
           document.getElementById("rcsale").value=5;
           alert("Please Enter Number in Record for Counter Sales Invoice");
           document.getElementById("rcsale").focus();
           return false;
      }
       if(document.getElementById("rcgiven").value =="") 
      {
           alert("Please Enter Record for Credit given page ");
           document.getElementById("rcgiven").focus();
           return false;
      }
      if(isNaN(document.getElementById("rcgiven").value)){
           document.getElementById("rcgiven").value=5;
           alert("Please Enter Number in Record for Credit given page");
           document.getElementById("rcgiven").focus();
           return false;
      }
						if(document.getElementById("rccus").value =="") 
      {
           alert("Please Enter Record for Customer & Vendor page ");
           document.getElementById("rccus").focus();
           return false;
      }
      if(isNaN(document.getElementById("rccus").value)){
           document.getElementById("rccus").value=5;
           alert("Please Enter Number in Record for Customer & Vendor page");
           document.getElementById("rccus").focus();
           return false;
      }
							if(document.getElementById("invqty").value =="") 
      {
           alert("Please Enter Record for Qty in Invoice page ");
           document.getElementById("invqty").focus();
           return false;
      }
      if(isNaN(document.getElementById("invqty").value)){
           document.getElementById("invqty").value=5;
           alert("Please Enter Number in Record for Qty in Invoice page");
           document.getElementById("invqty").focus();
           return false;
      }
   }

			function myFunction() {
      alert("You are set to delete records");
   
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
	<div class="twelve columns">
		<h5>Settings</h5>
		<hr>
			<?php

 $tag= $_GET['s'];
    if($tag=="1")
    { $delRecord=$_POST["delrecord"];
       if($delRecord>0)
         {
										 $conn = new mysqli($servername, $username, $password, $dbname);
           if($delRecord==1)
          { $sql = "TRUNCATE TABLE category";}
          if($delRecord==2)
          { $sql = "TRUNCATE TABLE items";}
          if($delRecord==3)
         { $sql = "TRUNCATE TABLE billdetails";
									  $sql2 = "TRUNCATE TABLE transaction";
											 $conn->query($sql2);
												 $sql3 = "TRUNCATE TABLE credithistory";
											 $conn->query($sql3);
											}
											if($delRecord==4)
          { $sql = "TRUNCATE TABLE generate";}
          if($delRecord==5)
         { $sql = "TRUNCATE TABLE purchasebill";
									  $sql2 = "TRUNCATE TABLE transactpurchase";
											 $conn->query($sql2);
												 $sql3 = "TRUNCATE TABLE creditpurchasehistory";
											 $conn->query($sql3);
											}
												if($delRecord==6)
          { $sql = "TRUNCATE TABLE generatepurchase";}
													if($delRecord==7)
          {
											$sql1 = "TRUNCATE TABLE customer";
											$sql = "INSERT INTO `customer` (`id`, `name`, `place`, `mobile`, `address`, `totalamtpurchased`, `totalamtdue`, `lasttransactiondate`, `update_date`) VALUES (1, 'shop sales', '', '', '', '0', '0', '', '')";
											$conn->query($sql1);
										}
											if($delRecord==10)
          { $sql = "TRUNCATE TABLE production";}
														if($delRecord==8)
          { $sql = "TRUNCATE TABLE vendor";}
										if($delRecord==9)
          {
												$sql1 = "TRUNCATE TABLE production";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE billdetails";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE category";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE credithistory";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE creditpurchasehistory";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE customer";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE generate";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE generatepurchase";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE items";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE login";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE purchasebill";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE settings";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE transaction";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE transactpurchase";
											$conn->query($sql1);
											$sql1 = "TRUNCATE TABLE vendor";
											$conn->query($sql1);
											$sql1 = "INSERT INTO `login` (`id`, `username`, `password`) VALUES (1, 'bheema', 'pass123')";
											$conn->query($sql1);
											$sql1 = "INSERT INTO `customer` (`id`, `name`, `place`, `mobile`, `address`, `totalamtpurchased`, `totalamtdue`, `lasttransactiondate`, `update_date`) VALUES (1, 'shop sales', '', '', '', '0', '0', '', '')";
											$conn->query($sql1);
											$sql = "INSERT INTO `settings` (`id`, `name`, `address`, `phone`, `recordProducts`, `recordCategories`, `recordRetail`, `recordCounSale`, `recordCreditGiven`, `recordPurchase`, `recordCustomer`) VALUES (1, 'Bheema - Natural Food Stuffs', 'Peelamedu', '0422-2625026', 10, 10, 10, 10, 10, 10,10)";
											}
           //$conn = new mysqli($servername, $username, $password, $dbname);
           if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
          } else {
           echo "Error deleting record: " . $conn->error;
             }
          header('Location:Settings.php');
          
         }
         else
         {

       $companyname=$_POST["compname"];
						 $companyaddress=$_POST["compaddr"];
      $companyphone=$_POST["compphone"];
       $rprod=$_POST["rprod"];
       $rcat=$_POST["rcat"];
       $rretail=$_POST["rretail"];
       $rcsale=$_POST["rcsale"];
       $rcgiven=$_POST["rcgiven"];
							 $rpur=$_POST["rpur"];
								$rcus=$_POST["rccus"];
								$invqty=$_POST["invqty"];
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "UPDATE settings SET address='$companyaddress',phone='$companyphone',recordProducts='$rprod',recordCategories='$rcat',recordRetail='$rretail',recordCounSale='$rcsale',recordCreditGiven='$rcgiven',recordPurchase='$rpur',recordCustomer='$rcus',recordInvQty='$invqty' WHERE id=1";

     if ($conn->query($sql) === TRUE) {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Updated record successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
       
      } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
        }

       $conn->close();
      header('Location:Settings.php');
       // echo "Product added successfully";
         }
    }
    
 ?>
   
    <br>
     <form action="Settings.php?s=1" method="post" onsubmit="return validateForm()">
         <div class="form">
      <!--  Company Name : &nbsp;&nbsp;<input type="text" name="compname" id="compname" size="100" maxlength="100" value="<?php echo $companyname;?>"><br> -->
       <div class="six columns"> <label>  Company Address :</label> <input type="text" name="compaddr" id="compaddr" class="smoothborder" size="100" maxlength="350" value="<?php echo $companyaddress;?>"></div>
      <div class="six columns"> <label>   Company Phone :</label> <input type="text" name="compphone" id="compphone" class="smoothborder" size="20" maxlength="15" value="<?php echo $companyphone;?>"></div>
       <div class="six columns"> <label>  Number of Products Records to display per page : </label> <input type="text" class="smoothborder" name="rprod" id="rprod" size="5" maxlength="6" value="<?php echo $rprod;?>"></div>
      <div class="six columns"> <label>   Number of Categories Records to display per page :</label>  <input type="text" class="smoothborder" name="rcat" id="rcat" size="5" maxlength="6" value="<?php echo $rcat;?>"></div>
      <div class="six columns"> <label>   Number of Delivery Invoices Records to display per page :</label>  <input type="text" class="smoothborder" name="rretail" id="rretail" size="5" maxlength="6" value="<?php echo $rretail;?>"></div>
     <div class="six columns"> <label>    Number of CounterSales Invoices Records to display per page : </label> <input type="text" class="smoothborder" name="rcsale" id="rcsale" size="5" maxlength="6" value="<?php echo $rcsale;?>"></div>
	 <div class="six columns"> <label> Number of Purchase Records to display per page : </label> <input type="text" name="rpur" id="rpur" class="smoothborder" size="5" maxlength="6" value="<?php echo $rpur;?>"></div>
        <div class="six columns"> <label> Number of Credit Given Records to display per page :</label>  <input type="text" name="rcgiven" class="smoothborder" id="rcgiven" size="5" maxlength="6" value="<?php echo $rcgiven;?>"></div>
	 <div class="six columns"> <label> Number of Customer & Vendor Records to display per page :</label>  <input type="text" name="rccus" class="smoothborder" id="rccus" size="5" maxlength="6" value="<?php echo $rcus;?>"></div>
	 <div class="six columns"> <label>Number of Quantity to show in Invoice : </label> <input type="text" name="invqty" id="invqty" size="5" class="smoothborder" maxlength="4" value="<?php echo $invqty;?>"></div>
    	<!--	   <a href="backup.php">BackUp Database</a><br>
			Delete Records for :  &nbsp;&nbsp;<select id="delrecord" name="delrecord" onchange="myFunction()">
  <option value="0" selected>NIL</option>
  <option value="1">Categories</option>
  <option value="2">Products</option>
   <option value="3">All Bills, Transaction, Credit history</option>
  <option value="4">Reset Invoice</option>
		 <option value="5">All Purchases, Transaction, Purchase Credit history</option>
			<option value="6">Reset Purchase Invoice</option>
			<option value="7">Customer Information</option>
				<option value="8">Vendor Information</option>
						<option value="10">Production</option>
				<option value="9">Reset All Information</option>
    </select>  --> <br> 
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