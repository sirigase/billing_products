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
	function printData() {
  var divToPrint = document.getElementById("t01");
  newWin = window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}

$('#print').on('click', function() {printData();window.location = 'Header.html';})

</script>
        <style>
.show-on-print{
 display: none; 
}

@media print {
  .show-on-print{
    display:block;
  }
  .hide-on-print{
    display: none;
  }
 }
  </style>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
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
		<h5>Invoice</h5>
		<hr>
		
        	<?php
                                 
                                                      
        $invoiceno= $_GET['invno'];
         $no=1;
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM billdetails WHERE invoiceno=$invoiceno";;
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $name=$row["name"];
                            $mobile=$row["mobile"];
                             $date=$row["date"];
									$saletype=$row['saletype'];
									$advdbamt=$row["advamt"];
									$advamtdeducted=$row["advdeducted"];
                             }
                             } else {
                             echo "0 results";
                              }
                     $conn->close();
        
        ?>
 <br>
	<?php
	if($saletype=="ssale"){}
	else{
	?>
    Name :  <?php echo $name;?> <br>
    Mobile :  <?php echo $mobile;
				
	}?> <br>
    Invoice Number: <?php echo $invoiceno;?>   <br>
     Date: <?php echo $date;?>  <br>
 
                     
                    <?php
                    $no=1;
                    $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM billdetails WHERE invoiceno=$invoiceno";;
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:80%" id="t01">
																<?php
																      echo "<tr class=\"show-on-print\"><th colspan=\"5\">".$companyName."</th></tr>";
																						echo "<tr class=\"show-on-print\"><td>Name: ".$name."</td></tr>";
															      	echo "<tr class=\"show-on-print\"><td>Mobile:".$mobile."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td>Invoice no. :".$invoiceno."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td>Date :".$date."</td></tr>";
																			?>
           <tr>
                <th>S.No</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Net Amount</th>
                
          </tr>
                            <?php
                           while($row = $result->fetch_assoc()) {
                              echo "<tr><td>$no</td>";
																														if($row["itemqty"]>=1000){
															 $itemquanty=$row["itemqty"]/1000;
															  if($row["itemtype"]=="ml"){
															   $itemtype="litre";
															  }
																 if($row["itemtype"]=="grams"){
															   $itemtype="kg";
															  }
														 }
														 else {
															$itemquanty=$row["itemqty"];
															$itemtype=$row["itemtype"];
														 }
                             echo "<td>". $row["itemname"]. " - ". $itemquanty." ". $itemtype."</td>";
							echo "<td>". $row["quantity"]. "</td>";
                            echo "<td>". $row["price"]. "</td>";
                            echo "<td>". $row["quantity"]*$row["price"]. "</td></tr>";
								$discount=$row["discount"];
                               $net=$row["nettotal"];
                                $gross =$row["grosstotal"];
                                $cash =$row["cash"];
                                 $credit =$row["credit"];
                                $cashrecv=$row["cashrecv"];
								$change=$row['changem'];
								$saletype=$row['saletype'];
                                 $no++;
                             }
                             } else {
                             echo "0 results";
                              }
                     $conn->close();
                         ?>
               	<?php
																$saletext="";
																	if($saletype=="csale"){
										  $saletext="Counter Sale";
									}
									else if($saletype=="delivery"){
										$saletext="Delivery";
									}
									else if($saletype=="ssale"){
										$saletext="Shop Sales";
									}
																     		echo "<tr class=\"show-on-print\"><td> Sale Type : ".$saletext."</td></tr>";
																								echo "<tr class=\"show-on-print\"><td> Discount: ".$discount."</td></tr>";
																									echo "<tr class=\"show-on-print\"><td> Net total : ".$net."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td> Gross total : ".$gross."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td>Cash received  : ".$cashrecv."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td> Change given : ".$change."</td></tr>";
																						
	if($saletype=="ssale"){}
	else{
	
																						echo "<tr class=\"show-on-print\"><td>  Amount Paid for Invoice : ".$cash."</td></tr>";
																						echo "<tr class=\"show-on-print\"><td>  Amount Due for Invoice : ".$credit."</td></tr>";
                                                                                       echo "<tr class=\"show-on-print\"><td>   Advance Amount deducted for this invoice : ".$advamtdeducted."</td></tr>"; 
                                                                                       echo "<tr class=\"show-on-print\"><td>   Advance amt :". $advdbamt."</td></tr>";
	}
																			?>
         
        </table><br>
        <p align="right">
									Sale Type : <?php
										echo $saletext;
									
								?> <br>
         Gross total  : <?php echo $gross;?> <br>
									Discount  : <?php echo $discount;?> <br>
									Net Total : <?php echo $net;?> <br>
								
									 Cash received:  <?php echo $cashrecv;?>  <br>
											Change to be given: <?php echo $change;?> <br>
											<?php
	if($saletype=="ssale"){}
	else{
	?>	Advance Amount deducted for this invoice : <?php echo $advamtdeducted; ?><br>
            Amount Paid for Invoice: <?php echo $cash;?> <br>
												Amount Due for Invoice: <?php echo $credit;?><br>
													Advance amt : <?php echo $advdbamt;?> <br>
												<?php }  ?>
														<!--	 <button onclick="goBack()">Go Back</button> &nbsp;  &nbsp; &nbsp; -->
																<button type="button" id="print" class="commonButton" onclick="printData()">
					<i class="fas fa-save"></i>&nbsp;Print
				</button>
        </p> 
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