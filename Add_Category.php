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
<title>Category</title>
<!-- CSS Files-->
<?php include 'headerscripts.php';?>
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
</script>
		<script> 
		function deleteFormItem(x) {
		
    var r = confirm("Delete Category proceed?");
if (r == true) {
 
  window.location.href = "Add_Category.php?id="+x;
  
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
		<h5>Category</h5>
		<hr><p>
    <div class="wrapcontact">
			<form action="Add_Category_process.php" method="post" onsubmit="return validateForm()">
          <div class="form">
                     <div class="six columns">
      <label>Category : </label><input type="text" name="category" class="smoothborder" id="category" size="30" maxlength="90">
		 
        <input type="submit" value="Submit">  &nbsp;&nbsp;&nbsp;<input type="reset">
    </form></div>
     <br><br><br>
    </div>
   
    <?php
    $id= $_GET['id'];
    $catname= $_GET['cn'];
    if(isset($id))
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
      $sql = "DELETE FROM category WHERE id=$id"; ?>

  
  <?php
     if ($conn->query($sql) === TRUE) {
      echo "<div class=\"five columns\">";
       echo "<div class=\"alert-box alert\">Category Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
       echo"</div>";
       //  echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
            $conn->close();
         header('Location:Add_Category.php?s=3');
    }
    $tag= $_GET['s'];
    if($tag=="1")
    {
      echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Category added successfully<a href=\"\" class=\"close\">x</a></div>";
         echo"</div>";
    }
    if($tag=="3")
    {
       // echo "<div class=\"alert-box alert\">Category Deleted successfully</div>";
    }
    ?>
 
    <br><?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
                              //--------------------------------------------------------------------------
           $results_per_page = $rcat;  
      $query = "select *from category";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    } 
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT *FROM category LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?> <br><br><br>
                            <table style="width:50%" id="t01">
          <thead>  <tr>
                 <th>S.No</th>
                <th>Category Name</th>
                <th>Delete</th>
          </tr></thead>
                            <?php
                           while($row = $result->fetch_assoc()) {
                             echo "<tr><td>$no</td>";
                             echo "<td>". $row["categoryname"]. "</td>";
                             //echo "<td><a href=Add_Category.php?id=". $row["id"]. "&cn=".$row["categoryname"].">Delete</a></td></tr>";
                             echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
									  $no++;
                             }
                             } else {
                             echo "No Categories";
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "Add_Category.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
    }
    echo "</p>";
    //------------------------------------------------------------------                       
           $conn->close();
                         ?>
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