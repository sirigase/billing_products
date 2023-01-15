<?php include 'logincheck.php';?><?php include 'functions.php';?>
<?php
$category=$_POST["category"];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO category(categoryname) VALUES ('$category')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 header('Location:Add_Category.php?s=1');

?>