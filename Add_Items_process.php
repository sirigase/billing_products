<?php include 'logincheck.php';?><?php include 'functions.php';?>
<?php
$itemName=$_POST["itemname"];
$price=$_POST["price"];
$category=$_POST["category"];
$qty=$_POST["qty"];
$type=$_POST["type"];
$category=$_POST["category"];
$qty=$_POST["qty"];
$type=$_POST["type"];

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO Items(itemname,price,categoryname,itemqty,itemtype) VALUES ('$itemName','$price','$category','$qty','$type')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 header('Location:ListItems.php?s=1');

?>