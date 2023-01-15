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
            if(document.getElementById("addamt").value =="")
      {
           alert("Please Enter Amount");
           document.getElementById("addamt").focus();
           return false;
      }
       if(isNaN(document.getElementById("addamt").value) || parseInt(document.getElementById("addamt").value) > parseInt(document.getElementById("credit").value))
          {
           alert("Please Enter Amount equal to due or lesser");
           document.getElementById("addamt").focus();
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
	<div class="twelve columns">
		
		<hr>
		<?php
                                 
         $id= $_GET['id'];                                              
        $page = $_GET['page'];
        
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           $sql = "SELECT * FROM transactpurchase WHERE invoiceno=$id";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $vendorname=$row["vendorname"];
                              $date=$row["date"];
							      	$totalamt=$row["totalamt"];
                             $amtpaid=$row["amtpaid"];
                             $balpay=$row["baldueamt"];
									  $vid=$row["vid"];
                             }
                             } else {
                             echo "0 results";
                              }
                     $conn->close();
        
        ?>
          <fieldset>
         <legend>Purchase - Amount Update </legend>
		 <div class="three columns"> <label>Purchase Invoice No: <?php echo  "".$id; ?>	</div>														
		 <div class="five columns"> <label>	Vendor Name :  <?php echo $vendorname;?> </div>
		 <div class="three columns"> <label>		Date :  <?php echo $date;?> 		</div>
		 <div class="three columns"> <label>	Total Amount :  <?php echo $totalamt;?> </div>
		 <div class="three columns"> <label>		Amount paid :  <?php echo $amtpaid;?> </div>
		 <div class="three columns"> <label>		Balance Payment :  <?php echo $balpay;?> </div>
				 <form action="updatepurchasecredit_process.php?page=<?php echo $page;?>" method="post" onsubmit="return validateForm()">
            <div class="six columns"> <label>  Add Amount: <input type="text" name="addamt" class="smoothborder" id="addamt"></div>
			 <div class="six columns"> <label>	  Date : <input type="text" name="date" id="date" class="smoothborder" size="10" maxlength="15" value="<?php  echo date("d-m-Y") ?>"></div>	
        <input type="hidden" name="invno" id="invno" value="<?php echo $id?>">
		   <input type="hidden" name="vid" id="vid" value="<?php echo $vid?>">
		<input type="hidden" name="credit" id="credit" value="<?php echo $balpay;?>">
       <div class="three columns"> <label>   <input type="submit" class="button"  value="Submit">  &nbsp;&nbsp;&nbsp;<input class="button" type="reset"></div>
          </fieldset>
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