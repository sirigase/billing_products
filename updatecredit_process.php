<?php include 'logincheck.php';?><?php include 'functions.php';?>
<?php
        $addamt=$_POST["addamt"];                           
        $invoiceno= $_POST["invno"];
        $date=$_POST["date"];
        $cusid=$_POST["cusid"];
        $page = $_GET['page']; 
              $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM transaction WHERE invoiceno=$invoiceno";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $grosstotal=$row["grosstotal"];
                             $cash=$row["cash"];
                             $credit=$row["credit"];
                             $name=$row["name"];
                             $mobile=$row["mobile"];
                             $discount=$row["discount"];
                               $net=$row["nettotal"];
                             }
                             } else {
                             echo "0 results";
                              }
        //---------------------------------------------------------------------------------------------
        $newcash=$cash+$addamt;
        $newcredit= $credit-$addamt;
        $sql = "INSERT INTO credithistory(invoiceno,name,mobile,grosstotal,cash,credit,saletype,givenamt,cusid,date,discount,nettotal) VALUES ('$invoiceno','$name','$mobile','$grosstotal','$newcash','$newcredit','$saletype','$addamt','$cusid','$date','$discount','$net')";
        $conn->query($sql);
       
        $sql = "UPDATE transaction SET cash='$newcash',credit='$newcredit' WHERE invoiceno=$invoiceno";
        $result = $conn->query($sql);
    
        // ------------------------------------------------get the customer details-------------------------------------------
 $sql = "SELECT * FROM customer WHERE id=$cusid";
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

 $sql = "UPDATE customer SET totalamtdue ='$updatecredit',lasttransactiondate='$lastransdate' WHERE id=$cusid";
       $conn->query($sql);

//------------------------------------------------------------------------------------------------------------------
        $conn->close();
        header('Location:ListCredit.php?s=1&page='.$page);
        ?>
