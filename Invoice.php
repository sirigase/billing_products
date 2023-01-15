<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
// Taking back this page, compare with Invoice.php and add the modifications done
//---------------------------------------------------------
    $conn2 = new mysqli($servername, $username, $password, $dbname);
    $sql2 = "SELECT invoiceno FROM generate";
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
 if($tag=="5" || $tag=="6"){
  $cusid=1;
 }else{
  $cusid= $_GET['id'];
 }


   //echo "var x;x=\"\"";
    if($tag=="2" || $tag=="6")
          {
            //$deleteitem= $_GET['d'];
            $Itemslist=$_POST["Itemslist"];
            $qty=$_POST["qty"];
            $allItems=$_POST["allItems"];
            $deleteId=$_POST["deleteid"];
             if(!$deleteId==""){
              // delete operation need to be performed
              $combineAll=$allItems;
             }else{
              // no delete operation
               $combineAll=$Itemslist."|".$qty.";".$allItems;  
             // echo "combine All :";
             // echo $combineAll;
             }
           
             $eachItemsplit=explode(";",$combineAll);
              
               
            // print_r($eachItemsplit);
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
               // print_r($eachItemsplit);
            }
           
          }
      if($tag=="2" || $tag=="3" || $tag=="5"|| $tag=="6"){
          $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM customer WHERE id=$cusid";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $name=$row["name"];
                             $mobile=$row["mobile"];
                             $place=$row["place"];
                              $address=$row["address"];
                              $amountdueforcus=$row["totalamtdue"];
                              	$advdbamt=$row["advamt"];
                             }
                             } else {
                             //echo "0 results for customer";
                              }
                     $conn->close();
                     if($advdbamt==""){
                      $advdbamt=0;
                     }
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

</head>
<body>
    <script>
     function submitFormaddItems() {
     document.getElementById("addItemsform").submit(); 
    }
    function myDiscount() {
      var discount=parseInt(document.getElementById("discount").value);
      if (isNaN(document.getElementById("discount").value)) {
        alert("Please Enter Number in discount");
      }
      var gross=parseInt(document.getElementById("grosstotal").value);
      var z=gross-discount;
      if (z>0) {
        document.getElementById("net").value=z;
      }
     
    }
    function myFunction() {
      var net=parseInt(document.getElementById("net").value);
      var cashrecv=parseInt(document.getElementById("cashrecv").value);
      if(isNaN(document.getElementById("cashrecv").value)){
           document.getElementById("cashrecv").value=0;
           alert("Please Enter Number in cash");
           document.getElementById("cashrecv").focus();
           return false;
      } 
       var x=cashrecv-net;
      if (x>0) {
       document.getElementById("cash").value=net;  
       document.getElementById("changem").value=x;
        document.getElementById("credit").value=0;
      }
      else{
          document.getElementById("cash").value= document.getElementById("cashrecv").value;
          document.getElementById("changem").value=0;
         document.getElementById("credit").value=(x*(-1));
      }
   
}

    function myFunctiondis() {
      var net=parseInt(document.getElementById("net").value);
      var cashrecv=parseInt(document.getElementById("cashrecv").value);
      if(isNaN(document.getElementById("cashrecv").value)){
           document.getElementById("cashrecv").value=0;
           alert("Please Enter Number in cash");
           document.getElementById("cashrecv").focus();
           return false;
      } 
       var x=cashrecv-net;
      if (x>=0) {
            document.getElementById("changem").value=x;
             }
      else{
         alert("Please Collect Full Amount - No Credit for ShopSales") ;
         document.getElementById("changem").value=0;
         document.getElementById("cashrecv").value=0;
         document.getElementById("cashrecv").focus();
            
         }
         
}

   function validateForm()
   {
   if(document.getElementById('delivery').checked==false && document.getElementById('csale').checked==false)
      {
           alert("Please select Delivery or Counter Sale");
           return false;
      }
      var gross=parseInt(document.getElementById("grosstotal").value);
      var cashrecv=parseInt(document.getElementById("cashrecv").value);
      if(isNaN(document.getElementById("cashrecv").value)){
           document.getElementById("cashrecv").value=0;
           alert("Please Enter Number in cash");
           document.getElementById("cashrecv").focus();
           return false;
      }
      
   }
   
    function validateFormItem()
   {
  
      if(parseInt(document.getElementById("qty").value)<=0)
      {
           alert("Please select qty");
           return false;
      }
      
   }
   
   function deleteFormItem(x) {
     document.getElementById("deleteid").value=x;
     document.getElementById("addItemsform").submit(); 
     // alert("Delte Item "+c);
    // alert("Item to be deleted "+x);
     
   }
</script> 
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
	<div class="four columns">
		<h5>Invoice</h5>
		<hr>
		
         <?php
    
    if($tag=="1")
    {
        echo "<br>Invoice added successfully<br>";
    }
  
  
   if($tag=="5" || $tag=="6")
          {
            echo "<form action=\"Invoice.php?s=6\" name=\"addItemsform\" id=\"addItemsform\" method=\"post\" onsubmit=\"return validateFormItem()\">";
            // echo "<fieldset><legend>Add Items </legend>";
            echo "<div class=\"form\">";
          }else{
    ?>
    
			<form action="Invoice.php?s=2&id=<?php echo $cusid; ?>" name="addItemsform" id="addItemsform" method="post" onsubmit="return validateFormItem()">
        <?php
        //echo "<fieldset><legend>Add Items</legend>";
         echo "<div class=\"form\">";
          }
           if($tag=="2" || $tag=="6" || $tag=="5")
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
         <div class="six columns">       <label>Items:</label>
       <select name="Itemslist" class="smoothborder" id="Itemslist">
       <?php
                     $no=1;
                      $noitems=0;
                       $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM items order by categoryname ASC";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
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
                              echo "<option value=\"".$row["categoryname"]."|".$row["itemqty"]."|".$row["itemtype"]."|". $row["itemname"]. "|".$row["price"]."\">". $row["itemname"]." - ".$itemquanty." ".$itemtype."</option>";
                           //  echo "<td><input type=hidden name=item". $no. " id=item". $no. " value=". $row["itemname"]. ">". $row["itemname"]. "</td>";
                            // echo "<td><input type=number name=qty". $no. " id=qty". $no. " maxlength=2 min=0 max=50 size=2 value=0 onchange=\"myFunction();\"></td>";
                            //echo "<input type=hidden name=price". $no. " id=price". $no. " value=". $row["price"]. " size=5>". $row["price"]. "";
                            // echo "<td><input type=text name=netamount". $no. " id=netamount". $no. " size=5 disabled></td></tr>";
                             $no++;
                             }
                             } else {
                              $noitems=1;
                            // echo "0 results";
                              }
                     $conn->close();
                         ?>
               </select>
         </div> 
     <?php if(!$noitems=0){   ?>
      <div class="six columns"> <label> Qty:</label>
        <select class="smoothborder" name="qty" id="qty">
         <?php
         for($f=1;$f<=$invqty;$f++){
          echo "<option value=".$f.">".$f."</option>";
         echo "<option value=".$f+0.5.">".$f+0.5."</option>";
         }
         ?>
       </div>
        <input type="submit" class="secondary button" value="Add Item">
       </div>
    
         </form>
         <?php }  ?>
          </div>
</div>
<div class="row">
	<div class="six columns"> 
  
 <?php
         if($tag=="5" || $tag=="6"){
          echo  "<form action=\"Invoice_process.php?s=5\" method=\"post\">";
          echo " <input type=hidden name=name id=name maxlength=29 value=\"".$name."\" readonly>";
          echo "<input type=hidden name=mobile id=mobile maxlength=14 value=\"".$mobile."\" readonly>";
          echo "<input type=hidden name=addr id=addr maxlength=190 value=\"".$address."\" readonly>";
          echo "<input type=hidden name=place id=place maxlength=190 value=\"".$place."\" readonly>";  
         }else
         {
          if($tag=="2" || $tag=="3")
          { // include customer id as hidden field
           echo  "<form action=\"Invoice_process.php\" method=\"post\">";
             echo "<div class=\"form\">";
            echo "<div class=\"six columns\"><label> Customer Name :</label> <input type=text class=smoothborder name=name id=name maxlength=29 value=\"".$name."\" readonly></div>";
           
            echo "<div class=\"six columns\"><label>  Mobile Number :</label> <input type=text class=smoothborder name=mobile id=mobile maxlength=14 value=\"".$mobile."\" readonly></div>";
            echo "<div class=\"six columns\"><label>  Address :</label> <input type=text name=addr class=smoothborder id=addr maxlength=190 value=\"".$address."\" readonly></div>";
           echo "<div class=\"six columns\"><label>  Place :</label> <input type=text name=place id=place class=smoothborder maxlength=190 value=\"".$place."\" readonly></div>";
           echo "</div>";
          }
         }
          echo "<input type=\"hidden\" name=cusid id=cusid value=\"".$cusid."\">";
            ?>
      
        <input type="hidden" name="formcount" id="formcount" value="<?php
        if($tag=="2" || $tag=="6")
          {
        echo count($eachItemsplit)-1;}
        else{
          //  echo "0";
        }
        
        ?>">
    </div>
</div>
<div class="row">
	<div class="nine columns">   
        Invoice Number: <?php echo  "".$lastid; ?> <input type="hidden" name="invoiceno" id="invoiceno" value="<?php echo  "".$lastid; ?>">
       <?php   if($tag=="2" || $tag=="6"){
        if((count($eachItemsplit))>0){
        ?>
         <table style="width:100%" id="t01">
           <thead><tr>
                 <th>SNo</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
              <th>Amount</th>
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
         
               $gross=$gross+($separateItems[4]*$separateItems[5]);
                // print_r ($separateItems);
                echo "<tr><td>".$no."</td>";
                if($separateItems[1]>=1000){
															 $itemquanty=$separateItems[1]/1000;
															  if($separateItems[2]=="ml"){
															   $itemtype="litre";
															  }
																 if($separateItems[2]=="grams"){
															   $itemtype="kg";
															  }
														 }
														 else {
															$itemquanty=$separateItems[1];
															$itemtype=$separateItems[2];
														 }
                echo "<td>".$separateItems[3]." - ".$itemquanty." ".$itemtype."</td>"; //itemname-itemqty itemtype
                echo "<td>".$separateItems[5]."</td>"; //qty
                 echo "<td>".$separateItems[4]."</td>"; //unit price
                 echo "<td>".$separateItems[5]*$separateItems[4]."</td>"; //net amount
                 echo "<td><a onclick=\"deleteFormItem(".$no.")\"><img src=images/delete.ico width=15 height=15></a></td></tr>";
               //echo "<td><input type=button onclick=\"deleteFormItem(".$no.")\" value=\"Delete\"></td></tr>";
              
                echo "<input type=hidden name=item". $no. " id=item". $no. " value=\"".$separateItems[3]."\">";
                echo "<input type=hidden name=qty". $no. " id=qty". $no. " maxlength=2 min=0 max=50 size=2 value=\"".$separateItems[5]."\">";
                echo "<input type=hidden name=price". $no. " id=price". $no. " value=\"".$separateItems[4]."\" size=5>";
                echo "<input type=hidden name=netamount". $no. " id=netamount". $no. " value=\"".$separateItems[5]*$separateItems[4]."\" size=5 >";
                echo "<input type=hidden name=category". $no. " id=category". $no. " value=\"". $separateItems[0]."\">";
                echo "<input type=hidden name=itemqty". $no. " id=itemqty". $no. " value=\"". $separateItems[1]."\">";
                 echo "<input type=hidden name=type". $no. " id=type". $no. " value=\"". $separateItems[2]."\">";
                    $no++;
            }
            echo "</table>";
      }
     ?>
        <div class="three columns"> <label>  Date : <input type="text" name="date" class=smoothborder id="date" size="10" maxlength="15" value="<?php  echo date("d-m-Y") ?>">	</div>
       <?php
           if(!($tag=="5" || $tag=="6")){ // no shopa sale operation only for customer
         ?>
         <div class="three columns"> <label>     Gross total  : </label>   <input type="text" name="grosstotal" class=smoothborder id="grosstotal" value="<?php
             $advamtdisplay=$gross-$advdbamt;
             if($advamtdisplay>0){
             echo $advamtdisplay;
             }else{
              //echo $gross;
              echo "0";
             }
             ?>" readonly>
             </div>
            
        
       <?php 
        ?>
       <div class="three columns"> <label>  Discount  : </label>   <input type="text" name="discount" class=smoothborder id="discount" value="0" maxlength=6 onkeyup="myDiscount()"></div>
      <div class="three columns"> <label>    Net total  :  </label>  <input type="text" name="net" class=smoothborder id="net" value="<?php
             $advamtdisplay=$gross-$advdbamt;
             if($advamtdisplay>0){
             echo $advamtdisplay;
             }else{
              //echo $gross;
              echo "0";
             }
             ?>" readonly></div>
       <div class="three columns"> <label>    Cash received:  </label>  <input type="text" name="cashrecv" class=smoothborder value="0" id="cashrecv" maxlength=6 min=0 onkeyup="myFunction()"> &nbsp;&nbsp;&nbsp; Payment Pending :&nbsp;<?php echo $amountdueforcus; ?></div>
        
      <div class="three columns">  <label>   Change to be given: </label>   <input type="text" name="changem" class=smoothborder value="0"  id="changem" maxlength=6 min=0></div>
           <?php
             if($advamtdisplay>0){
             echo " <div class=\"three columns\"> <fieldset><label>Advance amount :</label>  ".$advdbamt." deducted from Gross amount : ".$gross."</fieldset></div>";
             }
             else{
               $advamtdisplay=($advamtdisplay*-1);
            // echo $advamtdisplay;
              echo "<div class=\"three columns\"><fieldset> <label>Gross amount : </label> ".$gross.", deducted from advance amount ".$advdbamt.", Advance amount Pending: ".$advamtdisplay."</fieldset></div>";
             }
        
        
        ?>
          <?php
          if($advdbamt>$gross){
             echo "<div class=\"three columns\"><fieldset> <label>Advance Amt deducted for invoice : </label> ".$gross."</fieldset></div>";
                }else{
                 echo "<div class=\"three columns\"> <fieldset><label>Advance Amt deducted for invoice :</label>  ".$advdbamt."</fieldset></div>";
                }
                
                ?>
          <input type="hidden" name="advamtdeducted" id="advamtdeducted" value="<?php
        if($advdbamt>$gross){
              echo $gross;
                }else{
                 echo $advdbamt;
                } 
         ?>">
         
               
  <?php
         //- if(!($tag=="5" || $tag=="6")){
           ?>
       <div class="three columns">  <label>  Advance amount : </label>   <input type="text" class=smoothborder name="advamt" id="advamt" value="<?php
                if($advdbamt>$gross){
              echo $advdbamt-$gross;
                }
                else{
                 echo "0";
                }
          //-   }
             ?>" maxlength=6></div>
          <?php
          }
          if($tag=="5" || $tag=="6"){
           // below line only for shop sale processing
           ?>
       <div class="three columns">  <label>     Gross total  :  </label>  <input type="text" class=smoothborder name="grosstotal" id="grosstotal" value="<?php echo $gross; ?>"></div>
 <div class="three columns">  <label> Discount  :  </label>  <input type="text" name="discount" class=smoothborder id="discount" value="0" maxlength=6 onkeyup="myDiscount()"></div>
     <div class="three columns">  <label>      Net total  :   </label> <input type="text" name="net" class=smoothborder id="net" value="<?php echo $gross; ?>" readonly></div>
     <div class="three columns">  <label>      Cash received:  </label>  <input type="text" name="cashrecv" class=smoothborder value="0" id="cashrecv" maxlength=6 min=0 onchange="myFunctiondis()"> </div>
       <div class="three columns">  <label>     Change to be given:  </label>  <input type="text" name="changem" class=smoothborder value="0"  id="changem" maxlength=6 min=0></div>
        <input type="radio" id="csale" name="saletype" value="ssale" checked>&nbsp;&nbsp;&nbsp;  ShopSale
              <input type="hidden" name="cash" id="cash" maxlength=6 min=0 value=0 readonly>
       <input type="hidden" name="credit" id="credit" value=0 readonly>
           <?php
         }else
         {
          ?>
      <div class="three columns">  <label>  Amount Paid for Invoice:</label>    <input type="text" class=smoothborder name="cash" id="cash" maxlength=6 min=0 value=0></div>
     <div class="three columns">  <label>   Amount Due for Invoice: </label> <input type="text" class=smoothborder name="credit" id="credit" value="<?php
             $advamtdisplay=$gross-$advdbamt;
             if($advamtdisplay>0){
             echo $advamtdisplay;
             }else{
              //echo $gross;
              echo "0";
             }
             ?>" readonly></div>
<div class="five columns">  <input type="radio" id="csale" name="saletype" value="csale" checked>
Counter Sales
<input type="radio" id="delivery" name="saletype" value="delivery">
Delivery    </div>
<?php
         }

?>
       <div class="five columns">     <input type="submit" class="secondary button" value="Submit">  &nbsp;&nbsp;&nbsp;<input class="secondary button" type="reset"> </div>
          
            <?php }?>    
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