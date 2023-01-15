<?php include 'logincheck.php';?><?php include 'functions.php';?>
<?php
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

?>
<?php
$vendorname=$_POST["vendorname"];

$date=$_POST["date"];
$formcount=$_POST["formcount"];
$totalamt=$_POST["totalamt"];
$amtpaid=$_POST["amtpaid"];
$balpay=$_POST["balpay"];
$invoiceno=$lastid;
//$invoiceno=$_POST["invoiceno"];
$cusid=$_POST["cusid"];

$conn = new mysqli($servername, $username, $password, $dbname);

//$sql = "INSERT INTO billdetails(name,mobile,itemname,quantity) VALUES ('$name','$mobile','$item','$qty')";
$sql = "INSERT INTO generatepurchase(data) VALUES ('$invoiceno')";
$conn->query($sql);
$cflag=0;
if($balpay>0){
  $cflag=1;

}
$sql = "INSERT INTO transactpurchase(invoiceno,vendorname,totalamt,amtpaid,baldueamt,cflag,date,vid) VALUES ('$invoiceno','$vendorname','$totalamt','$amtpaid','$balpay','$cflag','$date','$cusid')";
$conn->query($sql);
$sql = "INSERT INTO creditpurchasehistory(invoiceno,vendorname,totalamt,amtpaid,baldueamt,addedamt,date,vid) VALUES ('$invoiceno','$vendorname','$totalamt','$amtpaid','$balpay','0','$date','$cusid')";
$conn->query($sql);
for ($x = 1; $x <= $formcount; $x++) {
 $itemname=$_POST["item$x"];
$qty=$_POST["qty$x"];
$bags=$_POST["bags$x"];
$price=$_POST["price$x"];
$pricekg=$_POST["pricekg$x"];
   $sql = "INSERT INTO purchasebill(invoiceno,vendorname,itempurchase,date,qty,bags,price,totalamt,amtpaid,baldueamt,vid,pricekg) VALUES ('$invoiceno','$vendorname','$itemname','$date','$qty','$bags','$price','$totalamt','$amtpaid','$balpay','$cusid','$pricekg')";
    // $conn->query($sql1);
       if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}
}
// ------------------------------------------------get the customer details-------------------------------------------
 $sql = "SELECT * FROM vendor WHERE id=$cusid";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
	$amtpurchased=$row["totalamtpurchased"];
	$pendingpay=$row["totalamtdue"];
	
                             }
                             } else {
                             echo "0 results";
                              }
$updatenewamt=$totalamt+$amtpurchased;
$updatecredit=$balpay+$pendingpay;
$lastransdate=date("d-m-Y");

 $sql = "UPDATE vendor SET totalamtpurchased ='$updatenewamt',totalamtdue ='$updatecredit',lasttransactiondate='$lastransdate' WHERE id=$cusid";
       $conn->query($sql);

//------------------------------------------------------------------------------------------------------------------


$conn->close();
 header('Location:ViewPurchase.php?id='.$invoiceno);

?>