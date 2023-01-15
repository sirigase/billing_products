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
		function deleteFormItem(x) {
		
    var r = confirm("Delete Purchase proceed?");
if (r == true) {
   window.location.href = "ListPurchase.php?invno="+x;
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
		<h5>Purchase History</h5>
		<hr>
		<?php
				$id= $_GET['invno'];
    
    if(isset($id))
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
      $sql = "DELETE FROM transactpurchase WHERE invoiceno=$id";

     if ($conn->query($sql) === TRUE) {
       echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
            $conn->close();
         header('Location:ListPurchase.php?s=3');
    }
    
    $tag= $_GET['s'];
    if($tag=="1")
    {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Purchase added successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
       
    }
	 if($tag=="2")
    {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Amount updated successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
        
    }
    if($tag=="3")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Purchase Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
        
    }
                         $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
      //--------------------------------------------------------------------------
           $results_per_page = $rpur;  
      $query = "select *from transactpurchase";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    } 
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT *FROM transactpurchase order by INVOICENO DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
          <thead> <tr>
                 <th>Invoice no</th>
                <th>Vendor Name</th>
					 <th>Date</th>
					 <th>Total Amt</th>
					 <th>Amount Paid</th>
					  <th>Balance Payment</th>
					  <th>History</th>
					<th>View</th>
					<th>Update</th>
					 <th>Delete</th>
          </tr></thead> 
                            <?php
                           while($row = $result->fetch_assoc()) {
                             echo "<tr><td>".$row["invoiceno"]."</td>";
                             echo "<td>". $row["vendorname"]. "</td>";
									  echo "<td>". $row["date"]. "</td>";
									  echo "<td>". $row["totalamt"]. "</td>";
									  echo "<td>". $row["amtpaid"]. "</td>";
									  echo "<td>". $row["baldueamt"]. "</td>";
									  echo "<td><a href=creditpurchasehistory.php?id=".$row["invoiceno"]. "&page=".$page.">History</a></td>";
									  echo "<td><a href=ViewPurchase.php?id=". $row["invoiceno"]. ">View</a></td>";
									  
									   if($row["baldueamt"]>0){
							echo "<td><a href=UpdateAmtPurchase.php?id=". $row["invoiceno"]. "&page=".$page.">Update</a></td>";
							}else{
								echo "<td></td>";
							}
									   
							 echo "<td><a href=# onclick=\"deleteFormItem(".$row["invoiceno"].")\">Delete</a></td></tr>";		  
								//	  echo "<td><a href=ListPurchase.php?invno=". $row["invoiceno"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "<br>No Purchases<br>";
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "ListPurchase.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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