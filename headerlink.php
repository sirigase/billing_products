 <?php if($_SESSION["user"]!=""){
                
              ?>
              <div class="headermenu eight columns noleftmarg">
		<nav id="nav-wrap">
		<ul id="main-menu" class="nav-bar sf-menu">
			<li class="current">
			<a href="Dashboard.php">Dashboard</a>
			<ul>
				<!-- <li><a href="index2.html">Without slider</a></li> -->
			</ul>
			</li>
			<li>
			<a href="#">Vendor</a>
			<ul>
     
			<li><a href="Add_Vendor.php">Manage Vendor</a></li>
    <li>  <a href="ListPurchase.php?s=0">Purchase History</a></li>
				</ul>
			</li>
   	<li>
			<a href="#">Customer</a>
			<ul>
    <li><a href="Add_Customer.php">Add Customer</a></li>
				<li><a href="ListCustomer.php">Customer List</a></li>
    <li><a href="Invoice.php?s=5">ShopSales</a></li>
    	</ul>
			</li>
			<li>
			<a href="#">View Invoice</a>
			<ul>
               <li> <a href="ListDelivery.php?s=0">Delivery Invoice</a></li>
    <li> <a href="ListCounterSale.php?s=0">Counter Sales Invoice</a></li>
     <li><a href="ListShopSale.php?s=0">Shopsales Sale Invoice</a></li>
			
			</ul>
			</li>
			<li>
			<a href="#">Reports</a>
			<ul>
           <li> <a href="ListCredit.php?s=0">Credit Report</a></li>
        <li><a href="RecordSearch.php?s=0">Record Search</a></li>
				
			</ul>
			</li>
   	<li>
			<a href="#">Others</a>
			<ul>
             
       <li><a href="Production.php?s=0">Production</a></li>
   <li>  <a href="ListItems.php?s=0">Add Products</a></li>
   <li> <a href="Add_Category.php?s=0">Add Category</a></li>
   <li> <a href="Settings.php?s=0">Settings</a></li>
   <li> <a href="backup.php">BackUp Database</a></li>
				</ul>
			</li>
			<li>
			  <a href="Logout.php?s=0">Logout</a>
			</li>
		</ul>
		</nav>
	</div>
    
  
    <?php
     }else{
    
    ?>
   <!-- <li><a href="Login.php">LogIn</a></li> -->
 <?php
     }
    
    ?>