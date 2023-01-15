<?php include 'logincheck.php';?>
<?php include 'functions.php';?>

<?php
$q = $_GET['q'];
 $sql="SELECT * FROM customer WHERE name LIKE '%$q%' OR mobile LIKE '%$q%'";
    $conn = new mysqli($servername, $username, $password, $dbname);
       
    $result = mysqli_query($conn, $sql);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
           <tr>
                  <th>+Invoice</th>
                 <th>S.No</th>
                <th>Customer Name</th>
					 <th>Place</th>
					 <th>Mobile</th>
					 <th>Amt Purchased</th>
					 <th>Amt Pending</th>
					<th>Edit</th>
      <th>Delete</th>  
          </tr> 
                            <?php
                           while($row = $result->fetch_assoc()) {
                             if($row["id"]!="1"){
									 echo "<tr><td><a href=Invoice.php?s=3&id=". $row["id"]. ">+Invoice</a></td>";
											 }
											 else{
												 echo "<tr><td><a href=Invoice.php?s=5>+Invoice</a></td>";
											 }
                             echo "<td>". $no. "</td>";
                             echo "<td><a href=viewcustomer.php?id=". $row["id"]. ">". $row["name"]. "</a></td>";
									   echo "<td>". $row["place"]. "</td>";
										 echo "<td>". $row["mobile"]. "</td>";
										   if($row["id"]!="1"){
										  echo "<td>". $row["totalamtpurchased"]. "</td>";
											}else{
												echo "<td></td>";
											}
											 if($row["id"]!="1"){
										   echo "<td>". $row["totalamtdue"]. "</td>";
											 }else{
													echo "<td></td>";
											}
											
          // echo "<td><a href=viewcustomer.php?id=". $row["id"]. ">View</a></td>";
          echo "<td><a href=Editcustomer.php?id=". $row["id"]. "&page=$page>Edit</a></td>";
          echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
        //  echo "<td><a href=ListCustomer.php?s=4&id=". $row["id"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "No Customers in Database";
                              }
       //------------------------------------------------------------------
     echo "</table>";