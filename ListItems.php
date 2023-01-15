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
		
    var r = confirm("Delete Item proceed?");
if (r == true) {
 
  window.location.href = "DeleteItem.php?id="+x+"&page="+s;
  
} 
   
   }
   </script> 
		 <script>
			function cattoitemname(){
				itemname
				document.getElementById("itemname").value =document.getElementById("category").value;
			}
        function validateForm()
			
   {
            if(document.getElementById("itemname").value =="")
      {
           alert("Please Enter itemname");
           document.getElementById("itemname").focus();
           return false;
      }
       if(document.getElementById("price").value =="")
      {
           alert("Please Enter price");
           document.getElementById("price").focus();
           return false;
      }
       if(document.getElementById("qty").value =="")
      {
           alert("Please Enter Quantity");
           document.getElementById("qty").focus();
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
		<h5>Products</h5>
		<hr>
	 <form action="Add_Items_process.php" method="post" onsubmit="return validateForm()">
         <div class="form">
       
         <div class="six columns">   <label>  Category : </label>   
        <?php
                       $formdisable=false;
                       $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM category order by categoryname ASC";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            ?>
                           
                            
                            <?php
                             echo "<select id=\"category\" name=\"category\" onchange=\"cattoitemname()\">";
                           while($row = $result->fetch_assoc()) {
                              echo "<option value=\"". $row["categoryname"]."\">". $row["categoryname"]. "</option>";
                           //  echo "<td><input type=hidden name=item". $no. " id=item". $no. " value=". $row["itemname"]. ">". $row["itemname"]. "</td>";
                            // echo "<td><input type=number name=qty". $no. " id=qty". $no. " maxlength=2 min=0 max=50 size=2 value=0 onchange=\"myFunction();\"></td>";
                            //echo "<input type=hidden name=price". $no. " id=price". $no. " value=". $row["price"]. " size=5>". $row["price"]. "";
                            // echo "<td><input type=text name=netamount". $no. " id=netamount". $no. " size=5 disabled></td></tr>";
                             $no++;
                             }
                             echo "</select></div>"; //div class six cols
                                                         
                             } else {
                              $formdisable=true;
                             //echo "0 results";
                              }
                     $conn->close();
                         ?>
    
     <div class="six columns"> <label>  Item Name :</label>  <input type="text" name="itemname" class="smoothborder" id="itemname" size="50" maxlength="90"></div>
    <div class="six columns"> <label>     Price :</label>  <input type="text" name="price" class="smoothborder" id="price" size="20" maxlength="10"></div>
     <div class="six columns"> <label>     Qty :</label>   <input type="text" name="qty" class="smoothborder" id="qty" size="20" maxlength="10"></div>
         
       
     <div class="six columns"> <label>     Type : </label>  <select id="type" name="type">
   <option value="grams">grams</option>
  <option value="ml">ml</option>
    </select> &nbsp;&nbsp;&nbsp;&nbsp;  </div>
        
       <?php
           if(!$formdisable){
       ?>
     <div class="six columns">  <br><br> <input type="submit" value="Submit">  &nbsp;&nbsp;&nbsp;<input type="reset"></div>
			
       <?php
           }
           else
           {
            echo "Please add category first";
           }
       
       ?>
     </div>
    </form>
    <?php
    $tag= $_GET['s'];
    if($tag=="1")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Product added successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
      
    }
    if($tag=="2")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Product Updated successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
      
    }
    if($tag=="3")
    {echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Product Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
      
    }
    ?>
    <br>
     <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
                              //--------------------------------------------------------------------------
           $results_per_page = $rprod;  
      $query = "select * from items";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT * FROM items order by categoryname ASC LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
                         //--------------------------------------------------------------------------
                        //  $sql = "SELECT itemname,price,id FROM Items ORDER BY id";
                        // $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                            ?>
                          
                           <table style="width:80%" id="t01">
                            <thead><tr>
                 <th>S.No</th>
                <th>Item</th>
                <th>Category</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
          </tr></thead>
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
                             echo "<td>". $row["itemname"]." - ". $itemquanty." ". $itemtype."</td>";
                              echo "<td>". $row["categoryname"]. "</td>";
                            echo "<td>". $row["price"]. "</td>";
                            echo "<td><a href=EditItem.php?id=". $row["id"]. "&page=".$page.">Edit</a></td>";
                             echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].",".$page.")\">Delete</a></td></tr>";
														// echo "<td><a href=DeleteItem.php?id=". $row["id"]."&page=".$page. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "Zero Items in Database";
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "ListItems.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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