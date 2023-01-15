 <?php include 'logincheck.php';?><?php include 'functions.php';?>
 <?php

$invno= $_GET['invno'];
$pageredirect = $_GET['p'];
$topage="";
if($pageredirect=="r"){
  $topage="ListDelivery.php";
}
if($pageredirect=="s"){
 $topage="ListCounterSale.php";
}
if($pageredirect=="t"){
 $topage="ListShopSale.php";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM billdetails WHERE invoiceno=$invno";

if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}
// ------------------------------------------------get the customer details-------------------------------------------
 $sql = "SELECT * FROM transaction WHERE invoiceno=$invno";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
	$nettotal=$row["nettotal"];
	$advdeducted=$row["advdeducted"];
	$advamtt=$row["advamt"];
 $credit=$row["credit"];
 $cusid=$row["cusid"];
                             }
                             } else {
                             echo "0 results";
                              }
        if($nettotal=="")
        {
         $nettotal=0;
        }
        if($advdeducted==""){
         $advdeducted=0;
        }
        if($advamtt==""){
         $advamtt=0;
        }
        
 //-----------------------------------------------------------------------------------------------------------------------
  $sql = "SELECT * FROM customer WHERE id=$cusid";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
		$amtpurchased=$row["totalamtpurchased"];
	$pendingpay=$row["totalamtdue"];
	 $advamtc=$row["advamt"];
                             }
                             } else {
                             echo "0 results";
                              }
if($advamtc==""){
         $advamtc=0;
        }
// calculation begins
$amtpurchased=$amtpurchased-($nettotal+$advdeducted);
$pendingpay=$pendingpay-$credit;
$advamt=$advamtc+$advamtt+$advdeducted;
 
$sql = "UPDATE customer SET totalamtpurchased='$amtpurchased',totalamtdue='$pendingpay',advamt='$advamt'  WHERE id=$cusid";

if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}
 
 //-----------------------------------------------------------------------------------------------------------------------
$sql = "DELETE FROM transaction WHERE invoiceno=$invno";
if (!$conn -> query($sql)) {
  echo("Error description: " . $conn -> error);
}

$conn->close();
header('Location:'.$topage.'?s=3');
?> 