<?php include 'logincheck.php';?><?php include 'functions.php';?>
<?php
        $addamt=$_POST["addamt"];                           
        $invoiceno= $_POST["invno"];
        $date=$_POST["date"];
        $cusid=$_POST["vid"];
        $page = $_GET['page']; 
              $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM transactpurchase WHERE invoiceno=$invoiceno";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                               $vendorname=$row["vendorname"];
                             $totalamt=$row["totalamt"];
                             $amtpaid=$row["amtpaid"];
                             $balpay=$row["baldueamt"];
                         }
                             } else {
                             echo "0 results";
                              }
        //---------------------------------------------------------------------------------------------
        $newcash=$amtpaid+$addamt;
        $newcredit= $balpay-$addamt;
        $sql = "INSERT INTO creditpurchasehistory(invoiceno,vendorname,totalamt,amtpaid,baldueamt,addedamt,date) VALUES ('$invoiceno','$vendorname','$totalamt','$newcash','$newcredit',$addamt,'$date')";
        $conn->query($sql);
        echo("Error description: " . $conn -> error);
        $sql = "UPDATE transactpurchase SET amtpaid='$newcash',baldueamt='$newcredit' WHERE invoiceno=$invoiceno";
        $result = $conn->query($sql);
         echo("Error description: " . $conn -> error);
       // $sql = "UPDATE billdetails SET cash='$newcash',credit='$newcredit' WHERE invoiceno=$invoiceno";
        // $result = $conn->query($sql);
               // ------------------------------------------------get the customer details-------------------------------------------
 $sql = "SELECT * FROM vendor WHERE id=$cusid";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
	
	$pendingpay=$row["totalamtdue"];
	
                             }
                             } else {
                             echo "0 results";
                              }

$updatecredit=$pendingpay-$addamt;
$lastransdate=$date;

 $sql = "UPDATE vendor SET totalamtdue ='$updatecredit',lasttransactiondate='$lastransdate' WHERE id=$cusid";
 $conn->query($sql);

//------------------------------------------------------------------------------------------------------------------
        $conn->close();
header('Location:ListPurchase.php?s=2&page='.$page);
        ?>
