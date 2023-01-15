<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
$tag= $_GET['s'];
if($tag==2){
	$item=$_POST["item"];
	$date=$_POST["date"];
	$oilwt=$_POST["oilwt"];
	$oilcakewt=$_POST["oilcakewt"];
	$waswt=$_POST["waswt"];
	$totwt=$_POST["totwt"];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO production(items,date,oilweight,oilcakeweight,wasteweight,totalwt) VALUES ('$item','$date','$oilwt','$oilcakewt','$waswt','$totwt')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 header('Location:Production.php?s=1');
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
<title></title>
<!-- CSS Files-->
<?php include 'headerscripts.php';?>
<script> 
		function deleteFormItem(x) {
		
    var r = confirm("Delete Production Item proceed?");
if (r == true) {
 
  window.location.href = "Production.php?s=4&id="+x;
  
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
		<h5>Production</h5>
		<hr>
		<form action="Production.php?s=2" method="post">
             <div class="form">
       <div class="six columns"> <label> Item : </label> <input type="text" class="smoothborder" name="item" id="item" size="70" maxlength="90"></div>
	 <div class="six columns"> <label>	 Date : </label> <input type="text" class="smoothborder" name="date" id="date" size="10" maxlength="15" value="<?php  echo date("d-m-Y") ?>"></div>
	 <div class="six columns"> <label>	 Oil Weight: </label> <input type="text" class="smoothborder" name="oilwt" id="oilwt" size="10" maxlength="15"></div>
	 <div class="six columns"> <label>	 Oil Cake Weight: </label> <input type="text" class="smoothborder" name="oilcakewt" id="oilcakewt" size="10" maxlength="15"></div>
	 <div class="six columns"> <label>	 Waste Weight:</label>  <input type="text" class="smoothborder" name="waswt" id="waswt" size="10" maxlength="15"></div>
	 <div class="six columns"> <label>		 Total Weight: </label> <input type="text" class="smoothborder" name="totwt" id="totwt" size="10" maxlength="15"></div>
        <input type="submit" class="button"value="Submit">  &nbsp;&nbsp;&nbsp;<input class="button" type="reset">
       </div>
    </form>
    <?php
    $id= $_GET['id'];
        if(isset($id) && $tag==4)
    {
        $conn = new mysqli($servername, $username, $password, $dbname);
       if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
      $sql = "DELETE FROM production WHERE id=$id";

     if ($conn->query($sql) === TRUE) {
       echo "Record deleted successfully";
          } else {
         echo "Error deleting record: " . $conn->error;
           }
            $conn->close();
         header('Location:Production.php?s=3');
    }
    $tag= $_GET['s'];
    if($tag=="1")
    {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Production item added successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
             }
    if($tag=="3")
    {
         echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box alert\">Production item Deleted successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
       
    }
				 if($tag=="5")
    {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Production edited successfully<a href=\"\" class=\"close\">x</a></div>";
           echo"</div>";
      
    }
    ?>
    <br><?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                           
                              //--------------------------------------------------------------------------
           $results_per_page = 50;  
      $query = "select *from production";  
    $result = mysqli_query($conn, $query);  
    $number_of_result = mysqli_num_rows($result);  
      $number_of_page = ceil ($number_of_result / $results_per_page);  
      if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    } 
    $page_first_result = ($page-1) * $results_per_page;  
     $query = "SELECT *FROM production order by id DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($conn, $query);
    $no=$page_first_result++;
    $no++;
         
                           if ($result->num_rows > 0) {
                            ?>
                            <table style="width:90%" id="t01">
           <thread> <tr>
                 <th>S.No</th>
                <th>Date</th>
					 <th>Item</th>
					 <th>Oil Weight</th>
					 <th>Oil Cake Weight</th>
					 <th>Waste Weight</th>
						 <th>Total Weight</th>
								 <th>Edit</th>
                <th>Delete</th>
          </tr></thread>
                            <?php
                           while($row = $result->fetch_assoc()) {
                             echo "<tr><td>$no</td>";
                             echo "<td>". $row["date"]. "</td>";
									  echo "<td>". $row["items"]. "</td>";
									  echo "<td>". $row["oilweight"]. "</td>";
									  echo "<td>". $row["oilcakeweight"]. "</td>";
									  echo "<td>". $row["wasteweight"]. "</td>";
											echo "<td>". $row["totalwt"]. "</td>";
											 echo "<td><a href=EditProduction.php?id=". $row["id"]. "&page=$page>Edit</a></td>";
												 echo "<td><a href=# onclick=\"deleteFormItem(".$row["id"].")\">Delete</a></td></tr>";
          // echo "<td><a href=Production.php?s=4&id=". $row["id"]. ">Delete</a></td></tr>";
                             $no++;
                             }
                             } else {
                             echo "No Items in Production";
                              }
       //------------------------------------------------------------------
     echo "</table><br><p align=left>Page:&nbsp;";
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "Production.php?s=0&page=' . $page . '">' . $page . ' </a>&nbsp;&nbsp;';  
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