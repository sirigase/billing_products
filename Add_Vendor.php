<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
 $id= $_GET['id'];
 $tag= $_GET['s'];
 if($tag==4){
	$cusname=$_POST["cusname"];
	$place=$_POST["place"];
	$mobile=$_POST["mobile"];
	$address=$_POST["address"];
	$amtpurchased=$_POST["amtpurchased"];
	$pendingpay=$_POST["pendingpay"];
	$lastransdate=$_POST["lastransdate"];

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO vendor(name,place,mobile,address,totalamtpurchased,totalamtdue,lasttransactiondate) VALUES ('$cusname','$place','$mobile','$address','$amtpurchased','$pendingpay','$lastransdate')";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 header('Location:Add_Vendor.php?s=1');
	
	
	
 }
  if($tag=="5")
    {
        $search=$_POST["searchven"];
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
<title>Vendor</title>
<!-- CSS Files-->

<?php include 'headerscripts.php';?>
	<script> 
		function deleteFormItem(x) {
		
    var r = confirm("Delete Vendor proceed?");
if (r == true) {
 
  window.location.href = "Add_Vendor.php?s=3&id="+x;
  
} 
   
   }
   </script> 
		<script>
        function validateForm()
   {
            if(document.getElementById("category").value =="")
      {
           alert("Please Enter Category");
           document.getElementById("category").focus();
           return false;
      }
   }
   function validateSearchForm()
   {
            if(document.getElementById("searchven").value =="")
      {
           alert("Please Enter Any Word in Search");
           document.getElementById("searchven").focus();
           return false;
      }
   }
</script>
   <script>
function showCustomertable(str) {
 //this shall be discarded
  if (str == "") {
		window.location.href = "Add_Vendor.php";
    //document.getElementById("customertable").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("customertable").innerHTML = this.responseText;
				document.getElementById("alldatatable").innerHTML = "";
				}
    };
   xmlhttp.open("GET","vendorsearch.php?q="+str,true);
    xmlhttp.send();
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
		<h5>Manage Vendor</h5>
		<hr>
			<form action="Add_Vendor.php?s=4" method="post" onsubmit="return validateForm()">
       <fieldset>
         <legend>Add Vendor </legend>
  <div class="three columns"> <label>Vendor Name :  </label>   <input type="text" name="cusname" id="cusname" class="smoothborder"  size="30" maxlength="90"></div>
	<div class="three columns"> <label>	Place:  </label><input type="text" name="place" id="place" size="20" class="smoothborder" maxlength="190"></div>
<div class="three columns"> <label>Mobile:  </label>		<input type="text" name="mobile" id="mobile" size="20" class="smoothborder" maxlength="15"></div>
<div class="three columns"> 	<label>Address:</label>	 <input type="text" name="address" id="address" size="30" class="smoothborder"  maxlength="190"></div>
	<div class="three columns"> <label>Total Amt Purchased: </label>	 <input type="text" name="amtpurchased" id="amtpurchased" size="10" class="smoothborder" maxlength="8" value="0"></div>
	<div class="three columns"> <label>Payment Pending:</label>	 <input type="text" name="pendingpay" id="pendingpay" size="10" class="smoothborder" maxlength="8" value="0"></div>
<div class="three columns"> 	<label>	Last transaction date: </label> <input type="text" name="lastransdate" id="lastransdate" size="10" class="smoothborder"  maxlength="15" value="<?php  echo date("d-m-Y") ?>"></div>
  <div class="three columns">  <br>    <input type="submit" class="button" value="Submit">  &nbsp;&nbsp;&nbsp;<input class="button" type="reset"></div>
        </fieldset>
       
    </form>
                  </div>
            <?php
   
    if(isset($id) && $tag==3)
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
      $sql = "DELETE FROM vendor WHERE id=$id";

     if ($conn->query($sql) === TRUE) {
       //echo "Record deleted successfully";
          } else {
       //  echo "Error deleting record: " . $conn->error;
           }
     $sql = "DELETE FROM transactpurchase WHERE vid=$id";
			$conn->query($sql);
				$sql = "DELETE FROM creditpurchasehistory WHERE vid=$id";
			$conn->query($sql);
				$sql = "DELETE FROM purchasebill WHERE vid=$id";
			$conn->query($sql);
            $conn->close();
         header('Location:Add_Vendor.php?s=3');
    }
   
    if($tag=="1")
    {
         echo "<div class=\"three columns\">";
        echo "<div class=\"alert-box success\">Vendor added successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
    }
     if($tag=="2")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Vendor edited successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
    }
    if($tag=="3")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Vendor Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
    }
    ?>
   </div>
  <div class="row">
	<div class="twelve columns">
     <form>
         <div class="form">
		 <div class="three columns"> <input type="text" class="smoothborder" size="30" placeholder="search" onkeyup="showCustomertable(this.value)"> </div>
         </div>
    <div id="customertable"></div>
		 </form><br>
  
    <div id="alldatatable">
    <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
                              //--------------------------------------------------------------------------
    $results_per_page = $rcus;  
   
    if($tag=="5")
    {
      $query = "select *from vendor WHERE name LIKE '%$search%'";  
       // $search
    }else{
      $query = "select *from vendor";  
    }
   
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    } 
    $page_first_result = ($page-1) * $results_per_page;
    if($tag=="5")
    {
      $query = "SELECT *FROM vendor  WHERE name LIKE '%$search%' LIMIT " . $page_first_result . ',' . $results_per_page;
       // $search
    }else{
      $query = "SELECT *FROM vendor LIMIT " . $page_first_result . ',' . $results_per_page;
    }
     
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
           <thead>   <tr>
                 <th>S.No</th>
                <th>Vendor Name</th>
					 <th>Place</th>
					 <th>Mobile</th>
					 <th>Amt Purchased</th>
					 <th>Amt Pending</th>
					 <th>+Purchase</th>
      <th>View</th>
      <th>Edit</th>
       <th>Delete</th>
          </tr> </thead> 
                            <?php
                           while($row = $result->fetch_assoc()) {
                             echo "<tr><td>".$no. "</td>";
                             echo "<td>". $row["name"]. "</td>";
									   echo "<td>". $row["place"]. "</td>";
										 echo "<td>". $row["mobile"]. "</td>";
										  echo "<td>". $row["totalamtpurchased"]. "</td>";
										   echo "<td>". $row["totalamtdue"]. "</td>";
									 echo "<td><a href=Purchase.php?s=3&id=". $row["id"]. ">+Purchase</a></td>";
           echo "<td><a href=viewvendor.php?id=". $row["id"]. ">View</a></td>";
             echo "<td><a href=EditVendor.php?id=". $row["id"]. "&page=$page>Edit</a></td>";
             echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
            //echo "<td><a href=Add_Vendor.php?s=2&id=". $row["id"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                                echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">No Vendor in Database<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
                             
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "Add_Vendor.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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