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
		function deleteFormItem(x,s) {
    var r = confirm("Delete Invoice No - "+x);
if (r == true) {
   window.location.href = "DeleteInvoice.php?invno="+x+"&page="+s+"&p=t";
  
} else {
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
		<h5>Shop Sale Invoice</h5>
		<hr>
		
        <?php
    $tag= $_GET['s'];
    if($tag=="1")
    {
           echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Invoice added successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="2")
    {
           echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Invoice Updated successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="3")
    {
           echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Invoice Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    ?>
   
    
                     
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                        //--------------------------------------------------------------------------
           $results_per_page = $rcsale;  
      $query = "select *from transaction WHERE saletype='ssale'";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT *FROM transaction  WHERE saletype='ssale' order by INVOICENO DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
                         //--------------------------------------------------------------------------
                            // $sql = "SELECT * FROM transaction";
                            //$result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            ?>
                             <table style="width:80%" id="t01">
           <thead>  <tr>
                 <th>Date</th>
                <th>Invoice No.</th>
                
                <th>Amount</th>
               <th>View Invoice</th>
               <th>Delete</th> 
          </tr></thead> 
                            <?php
                           while($row = $result->fetch_assoc()) {
                           echo "<tr><td>". $row["date"]. "</td>";
                             echo "<td>". $row["invoiceno"]. "</td>";
                           
							if($row["nettotal"]==0){
								echo "<td>". $row["grosstotal"]. "</td>";
							}else{
                             echo "<td>". $row["nettotal"]. "</td>";
							}
                            echo "<td><a href=ViewInvoice.php?invno=". $row["invoiceno"]. ">View</a></td>";
							 echo "<td><a href=# onclick=\"deleteFormItem(".$row["invoiceno"].",".$page.")\">Delete</a></td></tr>";
                          //  echo "<td><a href=DeleteInvoice.php?invno=". $row["invoiceno"]. "&page=".$page."&p=t>Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                                  echo "<div class=\"five columns\">";
                             echo "<div class=\"alert-box alert\">Zero Invoices in Shop sale Sales<a href=\"\" class=\"close\">x</a></div>";
                              echo"</div>";
                              }
    //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "ListShopSale.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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