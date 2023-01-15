 <?php
    //Report all errors except warnings.
error_reporting(E_ALL ^ E_WARNING);
session_start();
$expireAfter = 60; //minutes
if($_SESSION["user"]==""){
// remove all session variables
session_unset();
// destroy the session
session_destroy();
header('Location:Login.php');
}
if(isset($_SESSION['user'])){
 $secondsInactive = time() - $_SESSION['user'];
 $expireAfterSeconds = $expireAfter * 60;
 if($secondsInactive >= $expireAfterSeconds){
        session_unset();
        session_destroy();
        header('Location:Login.php');
    }
    else{
     $_SESSION['user'] = time();
    }
}

  ?>
   <!--
   <a href="Dashboard.php">Dashboard</a>&nbsp;&nbsp;
   <a href="Invoice.php?s=0">+Invoice</a>&nbsp;&nbsp;
    <a href="Invoice2.php?s=0">Invoice2</a>&nbsp;&nbsp; 
    <a href="ListItems.php?s=0">+Products</a>&nbsp;&nbsp;
     <a href="Add_Category.php?s=0">+Category</a>&nbsp;&nbsp;
    <a href="ListRetail.php?s=0">Retail</a>&nbsp;&nbsp;
    <a href="ListCounterSale.php?s=0">Counter Sale</a>&nbsp;&nbsp;
    <a href="ListCredit.php?s=0">Amount Due</a>&nbsp;&nbsp;
    <a href="Settings.php?s=0">Settings</a>&nbsp;&nbsp;
    
     -->
     
    