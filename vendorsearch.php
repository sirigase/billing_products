<?php include 'logincheck.php';?>
<?php include 'functions.php';?>

<?php
$q = $_GET['q'];
 $sql="SELECT * FROM vendor WHERE name LIKE '%$q%' OR mobile LIKE '%$q%'";
    $conn = new mysqli($servername, $username, $password, $dbname);
       
    $result = mysqli_query($conn, $sql);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
           <thead>    <tr>
                  <th>+Purchase</th>
                 <th>S.No</th>
                <th>Customer Name</th>
					 <th>Place</th>
					 <th>Mobile</th>
					 <th>Amt Purchased</th>
					 <th>Amt Pending</th>
					
       <th>View</th>
      <th>Edit</th>
      <th>Delete</th>  
          </tr>  </thead>   
                            <?php
                           while($row = $result->fetch_assoc()) {
                           
           echo "<tr><td><a href=Purchase.php?s=3&id=". $row["id"]. ">+Purchase</a></td>";
									// echo "<tr><td><a href=Invoice.php?s=3&id=". $row["id"]. ">+Invoice</a></td>";
											
                             echo "<td>". $no. "</td>";
                             echo "<td>". $row["name"]. "</td>";
									   echo "<td>". $row["place"]. "</td>";
										 echo "<td>". $row["mobile"]. "</td>";
										  echo "<td>". $row["totalamtpurchased"]. "</td>";
										   echo "<td>". $row["totalamtdue"]. "</td>";
											echo "<td><a href=viewvendor.php?id=". $row["id"]. ">View</a></td>";
             echo "<td><a href=EditVendor.php?id=". $row["id"]. "&page=$page>Edit</a></td>";
           echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
        //  echo "<td><a href=ListCustomer.php?s=4&id=". $row["id"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "No Customers in Database";
                              }
       //------------------------------------------------------------------
     echo "</table>";