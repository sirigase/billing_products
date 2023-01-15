<?php include 'logincheck.php';?>
<?php include 'functions.php';?>
<?php
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

?>
<?php
$tag= $_GET['s'];
 if($tag=="5" || $tag=="6"){
  $cusid=1;
 }else{
  $cusid= $_POST['cusid'];
  $advamt=$_POST["advamt"];
$advamtdeducted=$_POST["advamtdeducted"];
 }

$name=$_POST["name"];
$mobile=$_POST["mobile"];
//$invoiceno=$_POST["invoiceno"];
$invoiceno=$lastid;
$saletype=$_POST["saletype"];
$date=$_POST["date"];
// item, qty, price,  process arrays
$grosstotal=$_POST["grosstotal"];
$cash=$_POST["cash"];
$credit=$_POST["credit"];
$formcount=$_POST["formcount"];
$cashrecv=$_POST["cashrecv"];
$changem=$_POST["changem"];
$discount=$_POST["discount"];
$net=$_POST["net"];


//echo "formcount - ".$formcount;
$conn = new mysqli($servername, $username, $password, $dbname);

//$sql = "INSERT INTO billdetails(name,mobile,itemname,quantity) VALUES ('$name','$mobile','$item','$qty')";
$sql = "INSERT INTO generate(data) VALUES ('$invoiceno')";
$conn->query($sql);
$cflag=0;
if($credit>0){
  $cflag=1;

}
$sql = "INSERT INTO transaction(invoiceno,name,mobile,grosstotal,cash,credit,saletype,cflag,cusid,date,discount,nettotal,advamt,advdeducted) VALUES ('$invoiceno','$name','$mobile','$grosstotal','$cash','$credit','$saletype','$cflag','$cusid','$date','$discount','$net','$advamt','$advamtdeducted')";
       if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}
  $sql = "INSERT INTO credithistory(invoiceno,name,mobile,grosstotal,cash,credit,saletype,givenamt,date,cusid,discount,nettotal,advamt,advdeducted) VALUES ('$invoiceno','$name','$mobile','$grosstotal','$cash','$credit','$saletype','0','$date','$cusid','$discount','$net','$advamt','$advamtdeducted')";
       if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}
echo "FC : ".$formcount;
for ($x = 1; $x <= $formcount; $x++) {
 echo $x;
 $item=$_POST["item$x"];
  $qty=$_POST["qty$x"];
$price=$_POST["price$x"];
  $category=$_POST["category$x"];
$itemqty=$_POST["itemqty$x"];
$type=$_POST["type$x"];
$sale=$itemqty*$qty;
echo "item : ".$item;
echo "category: ".$category;
   if($qty >0){
    
      $sql1 = "INSERT INTO billdetails(name,mobile,itemname,quantity,invoiceno,grosstotal,cash,credit,price,saletype,categoryname,itemqty,itemtype,sale,cashrecv,changem,cusid,date,discount,nettotal,advamt,advdeducted) VALUES ('$name','$mobile','$item','$qty','$invoiceno','$grosstotal','$cash','$credit','$price','$saletype','$category','$itemqty','$type','$sale','$cashrecv','$changem','$cusid','$date','$discount','$net','$advamt','$advamtdeducted')";
  // echo $sql1;
        if (!$conn -> query($sql1)) {
  echo("Error description: " . $conn -> error);
}
  }
 
}
// ------------------------------------------------get the customer details-------------------------------------------
 $sql = "SELECT * FROM customer WHERE id=$cusid";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
	$amtpurchased=$row["totalamtpurchased"];
	$pendingpay=$row["totalamtdue"];
	$advdbamt=$row["advamt"];
                             }
                             } else {
                             echo "0 results";
                              }
if($advdbamt==""){
 $advdbamt=0;
}
if($cusid=="1"){
 $advamt=0;
 $advamtdeducted=0;
 $advdbamt=0;
}
if($advamt>0){

          $advamtone=$advdbamt-$advamtdeducted+$advamt;                    
}


 $updatenewamt=$net+$amtpurchased+$advamtdeducted;
$updatecredit=$credit+$pendingpay;
$lastransdate=date("d-m-Y");

 $sql = "UPDATE customer SET totalamtpurchased ='$updatenewamt',totalamtdue ='$updatecredit',lasttransactiondate='$lastransdate',advamt='$advamtone' WHERE id=$cusid";
      
 if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}

//------------------------------------------------------------------------------------------------------------------



$conn->close();
header('Location:ViewInvoice.php?invno='.$invoiceno);

?>
