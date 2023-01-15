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
		<h5>Vendor Details</h5>
		<hr>
		<?php
                                 
         $id= $_GET['id'];                                              
         $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           $sql = "SELECT * FROM vendor WHERE id=$id";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $name=$row["name"];
                             	
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
 
	          Vendor Id : <?php echo  $id; ?>				<br>														
												Name :  <?php echo $name;?> <br>
			           Place  :  <?php echo $place;?> <br>
														Mobile			:  <?php echo $mobile;?> <br>
															Address		:  <?php echo $address;?> <br>
														Total Amt Purchased			:  <?php echo $amtpurchased;?> <br>
														Payment Pending			:  <?php echo $pendingpay;?> <br>
													Last transaction date				:  <?php echo $lastransdate;?> <br>
															  <?php
                         $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                             //--------------------------------------------------------------------------
           $results_per_page = $rcgiven;  
      $query = "SELECT * FROM transactpurchase WHERE vid=$id";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT * FROM transactpurchase WHERE vid=$id LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
                         //--------------------------------------------------------------------------
                           // $sql = "SELECT * FROM transaction";
                           //$result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            ?>
                             <hr>
                             <h5> Vendor - Invoice Details </h5>	
                        
                            <table style="width:100%" id="t01">
         <thead><tr>
                 <th>S.No</th>
                <th>Invoice No.</th>
                <th>Name</th>
				<th>Date</th>
                <th>Total Amount</th>
               <th>Amount Paid</th>
                <th>Amount Due</th>
               <th>Credit History</th>
               <th>Update Amount</th>
          </tr></thead>   
            <?php
                           while($row = $result->fetch_assoc()) {
                            //if($row["credit"]>0)
                           // {
                             echo "<tr><td>$no</td>";
                             echo "<td>". $row["invoiceno"]. "</td>";
                            echo "<td>". $row["vendorname"]. "</td>";
							 echo "<td>". $row["date"]. "</td>";
                             echo "<td>". $row["totalamt"]. "</td>";
                              echo "<td>". $row["amtpaid"]. "</td>";
                            echo "<td>". $row["baldueamt"]. "</td>";
                            echo "<td><a href=creditpurchasehistory.php?id=". $row["invoiceno"] ."&page=".$page.">History</a></td>";
                          if($row["baldueamt"]>0){
								echo "<td><a href=UpdateAmtPurchase.php?id=". $row["invoiceno"] ."&page=".$page.">Update</a></td></tr>";
							}else{
								echo "<td></td></tr>";
								}
																									
                               $no++;
                           // }
                             }
                             } else {
                             echo "No Purchase Records for this vendor";
                              }
      //------------------------------------------------------------------
     echo " </table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "ViewVendor.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
    }
    echo "</p>";
    //------------------------------------------------------------------    
                     $conn->close();
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