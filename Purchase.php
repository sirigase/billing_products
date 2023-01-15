<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
// Taking back this page, compare with Invoice.php and add the modifications done
//---------------------------------------------------------
    $conn2 = new mysqli($servername, $username, $password, $dbname);
    $sql2 = "SELECT invoiceno FROM generatepurchase";
                         $result2 = $conn2->query($sql2);
                           if ($result2->num_rows > 0) {
                             while($row2 = $result2->fetch_assoc()) {
                                 $lastid=$row2["invoiceno"];
                                
                              }
                           }
                           else {
                             //echo "0 results";
                              }
                               $lastid++;
              $conn2->close();     
//-----------------------------------------------------------------------------------------------
$tag= $_GET['s'];
$cusid= $_GET['id'];

   //echo "var x;x=\"\"";
    if($tag=="2")
          {
            $deleteitem= $_GET['d'];
		    $itemname=$_POST["itemname"];
            $qty=$_POST["qty"];
            $bags=$_POST["bags"];
            $price=$_POST["price"];
             $pricekg=$_POST["pricekg"];
            $allItems=$_POST["allItems"];
             $deleteId=$_POST["deleteid"];
             
            if(!$deleteId==""){
              // delete operation need to be performed
              $combineAll=$allItems;
             }else{
              // no delete operation
              $combineAll=$itemname."|".$qty."|".$bags."|".$price."|".$pricekg.";".$allItems;
             // echo "combine All :";
             // echo $combineAll;
             }
            $eachItemsplit=explode(";",$combineAll);
             if(!$deleteId=="")
             {
              // delete operation need to be performed
             //- echo "Inside delete If<br>";
             //- echo "Item to be deleted is :".$deleteId."<br>";
                // $eachItemsplit2=explode(";",$combineAll);
                $itemtobedeleted=(count($eachItemsplit)-2)-$deleteId+1;
              for($x=count($eachItemsplit)-2;$x>=0;$x--)
               {
                // print_r($eachItemsplit);
                //- echo "X value : "."$x".", Item - ".$eachItemsplit[$x]."<br>";
                 if($itemtobedeleted==$x){
                 //-  echo "<br>Item to be deleted ----> ".$eachItemsplit[$x]."<br>";
                 }else{
                 //- $eachnewItem=$eachnewItem.";".$eachItemsplit[$x];
                  $eachnewItem=$eachItemsplit[$x].";".$eachnewItem;
                 }
                 
                }
               // echo "each new item :";
              // print_r($eachnewItem);
               $eachItemsplit=explode(";",$eachnewItem);
            
            //print_r($eachItemsplit);
          }
          }
           if($tag=="2" || $tag=="3"){
          $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM vendor WHERE id=$cusid";;
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $name=$row["name"];
                             $mobile=$row["mobile"];
                             $place=$row["place"];
                              $address=$row["address"];
                             }
                             } else {
                             echo "0 results for customer";
                              }
                     $conn->close();
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
   
     function submitFormaddItems() {
     document.getElementById("addItemsform").submit(); 
    }
    function myFunction() {
      var gross=parseInt(document.getElementById("totalamt").value);
      var cashrecv=parseInt(document.getElementById("amtpaid").value);
      if(isNaN(document.getElementById("amtpaid").value)){
           document.getElementById("amtpaid").value=0;
           alert("Please Enter Number in Amount Paid");
           document.getElementById("amtpaid").focus();
           return false;
      }
      var x=gross-cashrecv;
      if (x>0) {
        document.getElementById("balpay").value=x;
      }else
      {
        document.getElementById("balpay").value=0;
      }
      
   
}
function deleteFormItem(x) {
     document.getElementById("deleteid").value=x;
     document.getElementById("addItemsform").submit(); 
     // alert("Delte Item "+c);
    // alert("Item to be deleted "+x);
     
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
		<h5>Purchase</h5>
		<hr>
		 <?php	
    if($tag=="1")
    {
        echo "<div class=\"five columns\">";
        echo "<div class=\"alert-box success\">Purchase added successfully<a href=\"\" class=\"close\">x</a></div>";
          echo"</div>";
    }
    ?>
		<form action="Purchase.php?s=2&id=<?php echo $cusid; ?>" name="addItemsform" id="addItemsform" method="post" onsubmit="return validateFormItem()">
				 <?php
        
           if($tag=="2")
          {
            
           // echo "<textarea name=allItems rows=20 cols=80 id=allItems value=\"\">".$combineAll."</textarea>";
            if(!$deleteId=="")
             {
               echo "<input type=hidden name=allItems id=allItems value=\"".$eachnewItem."\">";
             }else{
            echo "<input type=hidden name=allItems id=allItems value=\"".$combineAll."\">";
             }
            echo "<input type=hidden name=deleteid id=deleteid>";
            //echo "<br>";
            //echo "combineAll - ".$combineAll."<br>";
           
          }
          
       ?>
     <div class="two columns">  <label>   Item purchased : </label> <input type="text" class=smoothborder name="itemname" id="itemname" size="100" maxlength="200"></div>
	  <div class="two columns">  <label>   Qty : </label> <input type="text" name="qty" class=smoothborder id="qty" size="5" maxlength="4"></div>
	  <div class="two columns">  <label>   Bags : </label> <input type="text" name="bags" class=smoothborder id="bags" size="5" maxlength="4"></div>
     <div class="two columns">  <label>    Price/Kg:</label>  <input type="text" name="pricekg" class=smoothborder id="pricekg" size="5" maxlength="10"></div>
    <div class="two columns">  <label>     Price: </label> <input type="text" name="price" class=smoothborder id="price" size="5" maxlength="10"></div>
    <div class="one columns">  <label>      <input type="submit" class="button" value="Submit"></div>
    </form>
  </div>
</div>
<div class="row">
	<div class="twelve columns">  
	 <form action="Purchase_process.php" method="post" onsubmit="return validateForm()">
        <?php
          if($tag=="2" || $tag=="3")
          { // include customer id as hidden field
            echo " <div class=\"three columns\">Vendor Name :<input type=text class=smoothborder name=vendorname id=vendorname maxlength=29 value=\"".$name."\" readonly></div>";
           echo " <div class=\"three columns\">Mobile Number :<input type=text class=smoothborder name=mobile id=mobile maxlength=14 value=\"".$mobile."\" readonly></div>";
            echo "<div class=\"three columns\"> Address :<input type=text name=addr class=smoothborder id=addr maxlength=190 value=\"".$address."\" readonly></div>";
            echo " <div class=\"three columns\"> Place :<input type=text name=place class=smoothborder id=place maxlength=190 value=\"".$place."\" readonly><br></div>";
            echo "<input type=\"hidden\" name=cusid id=cusid value=\"".$cusid."\">";
          }
            ?>
		 <div class="three columns">  <label>  Purchase Invoice No: <?php echo  "".$lastid; ?></div>
           <input type="hidden" name="invoiceno" id="invoiceno" value="<?php echo  "".$lastid; ?>">
		  <input type="hidden" name="formcount" id="formcount" value="<?php
        if($tag=="2")
          {
        echo count($eachItemsplit)-1;
		  }
        else{
          //  echo "0";
        }
        
        ?>">
		   <?php   if($tag=="2"){
        if((count($eachItemsplit))>0){
        ?>
         <table style="width:100%">
          <thead> <tr>
                 <th>S.No</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Bags</th>
                 <th>Price/Kg</th>
             <th>Price</th>
             <th>Delete</th> 
          </tr></thead> 
          <?php
             $no=1;
             $gross=0;
            
      
        //echo "eachItemsplit - ".count($eachItemsplit);
        // $separateItems=explode("|",$eachItemsplit);
        // print_r($separateItems);
         for($i=count($eachItemsplit)-2;$i>=0;$i--){
               $separateItems=explode("|",$eachItemsplit[$i]);
               //echo "<br>separateItemsCount - ".count($separateItems);
               // print_r ($separateItems);
         
              $gross=$gross+$separateItems[3];
                // print_r ($separateItems);
                echo "<tr><td>".$no."</td>";
                echo "<td>".$separateItems[0]."</td>"; //itemname-itemqty itemtype
                echo "<td>".$separateItems[1]."</td>"; //qty
                 echo "<td>".$separateItems[2]."</td>";
                  echo "<td>".$separateItems[4]."</td>";
                  echo "<td>".$separateItems[3]."</td>";//unit price
                   
                 echo "<td><a onclick=\"deleteFormItem(".$no.")\"><img src=images/delete.ico width=15 height=15></a></td></tr>";  
               //echo "<td><a href=Invoice2.php?s=2&d=".$no." onclick=\"submitFormaddItems()\">Delete</a></td></tr>";
                echo "<input type=hidden name=item". $no. " id=item". $no. " value=\"".$separateItems[0]."\">";
                echo "<input type=hidden name=qty". $no. " id=qty". $no. " maxlength=2 min=0 max=50 size=2 value=\"".$separateItems[1]."\">";
                echo "<input type=hidden name=bags". $no. " id=bags". $no. " value=\"".$separateItems[2]."\" size=5>";
                echo "<input type=hidden name=price". $no. " id=price". $no. " value=\"".$separateItems[3]."\" size=5>";
                 echo "<input type=hidden name=pricekg". $no. " id=pricekg". $no. " value=\"".$separateItems[4]."\" size=5>";
                         
                   $no++;
            }
            echo "</table>";
      
       }
			
    
               ?>
				<br>
		<div class="three columns">  <label>   Date :</label>  <input type="text" name="date" id="date" size="10" maxlength="15" value="<?php  echo date("d-m-Y") ?>"></div>	
		<div class="three columns">  <label>  Total Amount: </label> <input type="text" name="totalamt" id="totalamt" size="10" maxlength="10" value="<?php  echo $gross; ?>" readonly></div>
		<div class="three columns">  <label>  Amount paid : </label> <input type="text" name="amtpaid" id="amtpaid" size="10" maxlength="10" onchange="myFunction()"></div>
		<div class="three columns">  <label>  Balance Payment :</label>  <input type="text" name="balpay" id="balpay" size="10" maxlength="10" value=0></div>
		 <div class="three columns">  <label>   <input type="submit" class="button" value="Submit">  <input class="button" type="reset"> </div>
		<?php }  ?>
	 </form>
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