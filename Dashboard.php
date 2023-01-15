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
		   function validateFormdailysales() {
         document.getElementById("dailysalesform").submit(); 
     /     
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
		<h5>Dashboard</h5>
		<hr>
		<?php 	$tag= $_GET['s'];
							
							?>
                            
                            
                            <form action="Dashboard.php?s=1" name="dailysalesform" method="post" onsubmit="return validateFormdailysales()">
						 <div class="form">
   <div class="three columns"> 
                        <input type="date" id="fromdate" class="smoothborder" size="15" name="fromdate">
  
        	 <input type="submit" class="button" value="View Report">  </div><br><br><br><br>
                         </div>
		</form>
		 <br>
		<?php
		 if($tag==1){
				  $date1=$_POST["fromdate"];
        $date_arr = explode('/',$date1);
    $date= date("d-m-Y", strtotime($date_arr[2].$date_arr[1].$date_arr[0]));
		 }
		 else
		 {
			 date_default_timezone_set('Asia/Kolkata');
			$date=date("d-m-Y");
			 
		 }
		//echo $date;
		?>
				<table style="width:60%" id="t02">
             <?php
			
                       
              $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }            
                         //  $sql = "SELECT SUM(cash) FROM transaction";
                         //  $result = $conn->query($sql);
                           $ressales = mysqli_query($conn,"SELECT sum(nettotal)+sum(advdeducted)  FROM transaction WHERE date='$date' AND saletype='csale'");
                           $rowsales = mysqli_fetch_row($ressales);
                           $sumsales = $rowsales[0];
									if($sumsales==""){
										$sumsales=0;
									}
								  
						    echo "<tr><td colspan=2><h5>Sales Report on ".$date."</h5></td></tr> ";
                           echo "<tr><td>Total amount for Counter Sale </td><td> Rs.".$sumsales."</td></tr> ";
                           
									$resamt =mysqli_query($conn,"SELECT sum(nettotal)+sum(advdeducted)  FROM transaction WHERE date='$date' AND saletype='delivery'");
						   $rowamt = mysqli_fetch_row($resamt);
                           $sumamt = $rowamt[0];
									if($sumamt=="")
									{
										$sumamt=0;
									}
                            echo "<tr><td>Total amount for Delivery</td><td> Rs.".$sumamt." </td></tr>";
									$resamt =mysqli_query($conn,"SELECT sum(nettotal) FROM transaction WHERE date LIKE '$date'  AND saletype='ssale'");
						   $rowamt = mysqli_fetch_row($resamt);
                           $sumamt = $rowamt[0];
									if($sumamt=="")
									{
										$sumamt=0;
									}
                            echo "<tr><td>Total amount for Shop Sale </td><td> Rs.".$sumamt." </td></tr>";
                       
						   //--------------------------------------------------------------------------------------
						 
						    if($tag==1){
								  $date1=$_POST["fromdate"];
        $date_arr = explode('/',$date1);
    $date2= date("m-Y", strtotime($date_arr[1].$date_arr[0]));
						  $date="%-".$date2; 
							}else{
							 $date2="".date("m")."-".date("Y");
							}
						
						   
							
							   echo "<tr><td colspan=2><h5>Sales Report for ".$date2."</h5></td></tr> ";
							
						    $resamt =mysqli_query($conn,"SELECT sum(nettotal)+sum(advdeducted)  FROM transaction WHERE date LIKE '$date'  AND saletype='csale'");
						   $rowamt = mysqli_fetch_row($resamt);
                           $sumamt = $rowamt[0];
									if($sumamt=="")
									{
										$sumamt=0;
									}
                            echo "<tr><td>Total amount for Counter Sale </td><td> Rs.".$sumamt." </td></tr>";
                            
                        $rescredit =mysqli_query($conn,"SELECT sum(nettotal)+sum(advdeducted) FROM transaction WHERE date LIKE '$date' AND saletype='delivery'");
						$rowcredit = mysqli_fetch_row($rescredit);
                           $sumcredit = $rowcredit[0];
									if($sumcredit=="")
									{
										$sumcredit=0;
									}
                           echo "<tr><td>Total amount for Delivery </td><td> Rs.".$sumcredit." </td></tr>";
									  $resamt =mysqli_query($conn,"SELECT sum(nettotal) FROM transaction WHERE date LIKE '$date'  AND saletype='ssale'");
						   $rowamt = mysqli_fetch_row($resamt);
                           $sumamt = $rowamt[0];
									if($sumamt=="")
									{
										$sumamt=0;
									}
                            echo "<tr><td>Total amount for Shop Sale </td><td> Rs.".$sumamt." </td></tr></table>";
						   
						   //-----------------------------------------------------------------------------------------
                     /*       echo "<tr><td colspan=2>Other Details</td></tr> ";
                           $resultprod = mysqli_query($conn,"SELECT * FROM items");
                            $rowsprod = mysqli_num_rows($resultprod);
									 if($rowsprod=="")
									{
										$rowsprod=0;
									}
                        echo "<tr><td>Total products  </td><td>" . $rowsprod . " </td></tr>";

                         $resulttrans = mysqli_query($conn,"SELECT * FROM transaction");
                            $rowstrans = mysqli_num_rows($resulttrans);
									 if($rowstrans=="")
									{
										$rowstrans=0;
									}
                        echo "<tr><td>Total transaction </td> <td>" . $rowstrans . "  </td></tr>";
                        */
		            
                         $sql = "SELECT * FROM category";
                         $result = $conn->query($sql);
                          $total=$result->num_rows;
                         
                          $no=1;
                           if ($total > 0) {
                            while($row = $result->fetch_assoc()) {
                              $category[$no]=$row["categoryname"];
                               $no++;
                            }
                           }
                           
                           
						   ?>
                         
						 <?php /*
						 echo "<br><table style=\"width:50%\" id=\"t02\">";
                           for($i=1;$i<=$total;$i++){
                            $totalItem=0;$totalqty=0;
                              $resultprod = mysqli_query($conn,"SELECT * FROM billdetails WHERE categoryname='$category[$i]'");
                            // $rowsprod = mysqli_num_rows($resultprod);
                             echo "<tr><td>".$category[$i]. "</td>"; //. $rowsprod . "<br> ";
                             while($row = $resultprod->fetch_assoc()) {
                              //echo $row["itemqty"];
                              $totalqty=$row["sale"];
                             $totalItem=($totalItem+$totalqty);
                             }
                             echo "<td>Total Qty Sales - ".intdiv($totalItem,1000)." </td></tr>";
                           }
						    echo "</table> ";
                         */  ?>
                           <br><h5>Monthly Sales Report</h5>	<br>
						   <?php
                         echo "";                      
                         for($i=1;$i<=$total;$i++){
                             $sql = "select itemtype,date_format(reg_date,'%Y') as Calculated_Year,date_format(reg_date,'%M') as Calculated_Date,sum(sale) as Sale from billdetails WHERE categoryname='$category[$i]' group by year(reg_date),month(reg_date) order by year(reg_date),month(reg_date) DESC LIMIT 5";
                             // $sql = "select year(reg_date),month(reg_date),sum(sale) from billdetails WHERE categoryname='$category[$i]' group by year(reg_date),month(reg_date) order by year(reg_date),month(reg_date);";
                             $result = mysqli_query($conn, $sql);
							  if ($result->num_rows > 0) {
							echo "Sales of ".$category[$i];
							echo "<br><table style=\"width:40%\" id=\"t03\">";
                            foreach($conn->query($sql) as $row){
								echo "<tr><td>".$row['Calculated_Year']."</td>";
                             echo "<td>".$row['Calculated_Date']."</td>";
									  if($row['Sale']<1000){
										 $showsale=$row['Sale'];
										 $typetext=$row['itemtype'];
									  }
									  else{
										$showsale=intdiv($row['Sale'],1000);
										 if($row['itemtype']=="grams")
									  {
										 $typetext="Kilogram";
									  }else{
										 $typetext="Litre";
									  }
									  }
									 
                             echo "<td>".$showsale."-".$typetext." </td></tr>";
                            }
                             echo "</table><br>";
                           }
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