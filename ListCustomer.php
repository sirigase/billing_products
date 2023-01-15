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
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="2px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
     //document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>
			<script> 
		function deleteFormItem(x) {
		
    var r = confirm("Delete Customer proceed?");
if (r == true) {
 
  window.location.href = "ListCustomer.php?s=4&id="+x;
  
} 
   
   }
   </script> 
		
         <script>
function showCustomertable(str) {
 //this shall be discarded
  if (str == "") {
		window.location.href = "ListCustomer.php";
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
   xmlhttp.open("GET","customersearch.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
		<script>
        function validateForm()
   {
            
   }
   function validateSearchForm()
   {
            if(document.getElementById("searchcus").value =="")
      {
           alert("Please Enter Any Word in Search");
           document.getElementById("searchcus").focus();
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
		<h5>Customer List</h5>
		<hr>
		 <form>
		  <div class="three columns"> <input type="text" size="30" placeholder="search" class="smoothborder" onkeyup="showCustomertable(this.value)"></div>
    <div id="customertable"></div>
		 </form><br>
		 <div id="alldatatable">
    <?php
	 $tag= $_GET['s'];
	 $id= $_GET['id'];
	 //echo $id;
	 
   if(isset($id) && $tag==4)
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
      $sql = "DELETE FROM customer WHERE id=$id";
if(trim($id)=="1"){
		//echo "Inside 1";
		 header('Location:ListCustomer.php?s=6');
	 }
	 else{
     if ($conn->query($sql) === TRUE) {
       //echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
			$sql = "DELETE FROM transaction WHERE cusid=$id";
			 if ($conn->query($sql) === TRUE) {
       //echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
				$sql = "DELETE FROM credithistory WHERE cusid=$id";
			 if ($conn->query($sql) === TRUE) {
       //echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
				$sql = "DELETE FROM billdetails WHERE cusid=$id";
			 if ($conn->query($sql) === TRUE) {
       //echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
            $conn->close();
        header('Location:ListCustomer.php?s=3');
    }
		}
   
    if($tag=="1")
    {
          echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Customer added successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="2")
    {
          echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Customer edited successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="4")
    {
          echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Customer Deleted & All Information removed from database<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
		 if($tag=="6")
    {
          echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Shop sales account cannot be deleted<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    ?>
    <br><?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
                              //--------------------------------------------------------------------------
    $results_per_page = $rcus;
    if($tag=="5")
    {
      $query = "select *from customer WHERE name LIKE '%$search%'";  
       // $search
    }else{
      $query = "select *from customer";  
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
    
      $query = "SELECT *FROM customer order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;
    
       
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
           <thead>  <tr>
                 <th>S.No</th>
                <th>Customer Name</th>
					 <th>Place</th>
					 <th>Mobile</th>
					 <th>Amt Purchased</th>
					 <th>Amt Pending</th>
					 <th>+Invoice</th>
     
      <th>Edit</th>
      <th>Delete</th> 
          </tr></thead> 
                            <?php
                           while($row = $result->fetch_assoc()) {
                             echo "<tr><td>". $no. "</td>";
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
											 if($row["id"]!="1"){
									 echo "<td><a href=Invoice.php?s=3&id=". $row["id"]. ">+Invoice</a></td>";
											 }
											 else{
												 echo "<td><a href=Invoice.php?s=5>+Invoice</a></td>";
											 }
         // echo "<td><a href=viewcustomer.php?id=". $row["id"]. ">View</a></td>";
           echo "<td><a href=Editcustomer.php?id=". $row["id"]. "&page=$page>Edit</a></td>";
					 echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
         // echo "<td><a href=ListCustomer.php?s=4&id=". $row["id"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "No Customers in Database";
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "ListCustomer.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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