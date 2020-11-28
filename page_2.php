<?php
	include 'database.php';
	session_start();
	$sessionno=session_id();
	if($_SESSION['sid']=session_id()){
	/*echo "<a id='logout' onclick='confirmation()' href='logout.php'>Logout</a>";*/
	}else{
		header("location: verify.php");
	}
/*	$pdo=Database::connect();
	$food=array();
	$sql="SELECT food_item from food";
	
	$row=$pdo->fetchAll(PDO::FETCH_ASSOC);
	$nRows = $pdo->query('select count(food_items) from food');
	if($nRows>0){
		foreach($row as $food[]);
	}*/
	/*$result=$pdo->query($sql);
	$nRows = $pdo->query('select count(food_items) from food'); 
	if($nRows>0){
			$i=0;
			while($rows[$i]=PDO::FETCH_ASSOC($result)){
				$food[$i]=$rows[$i];
				$i++;
			}
	Database::disconnect();
	}*/
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="style1.css">

<style>
	table
	{
		border-collapse:collapse;
		border: 1px solid black;
		background-color: white;
		width:50%;
		color:black;
		margin:auto auto;
		padding: 0px;

	}
	
	tr:nth-child(even)
	{
		background-color:#bbbaba;
	}
	
	th
	{
		border: 1px solid black;
		background-color: #383838;
		color:white;
	}
	
	#fooditem
	{
		width:50%;
	}
	
	#price
	{
		width:20%;
	}
	
	td
	{
		padding: 10px;
		text-align: center;
		border: 1px solid black;
	}

</style>

</head>
<body onload="tab_disable()">
<h1 style= text-align:center>Restaurant Management System</h1>
<a id='logout' onclick='confirmation()' href='#'>Logout</a>
<hr>
<div id="abc">
<ul>
	<li><a onclick="disable_all()" href="page_2.php">Home</a></li>
	<li><a>About</a>
		<ul>
			<li><a>Our team</a></li>
			<li><a>Our Mission</a></li>
		</ul>
	</li>
	<li id="mngr"><a>Manager</a>
		<ul>
			<li><a onclick="enchkfooditems()" href="#">Check Menu</a></li><!--href="page_2.php" onclick="chkfooditems()"-->
			<li><a onclick="ensalesform()" href="#">Sales</a></li>
		</ul>
	</li>
	<li id="admin"><a>Admin</a>
		<ul>
		<li><a onclick="enChkSales()" href="#">Sales Report</a></li>
		<li><a onclick="enPurchase()" href="#">Raw Item Purchase</a></li>
		<li><a onclick="enUsedIn()" href="#">Raw Material used</a></li>
		</ul>
	</li>
</ul>

<div style="padding-top:100px;">
<table id="chkfooditems">
		<!--<thead>-->
		<tr>
			<th id="fooditem">Food Item</th>
			<th id="price">Price</th>
			<th>Quantity Available</th>
		</tr>
		<!--</thead>-->
		<!--<tbody>-->
		<?php
		$pdo=Database::connect();
		$sql="SELECT * FROM food ORDER BY price, Qty_available";
		foreach($pdo->query($sql) as $row){
		echo '<tr>';
		echo '<td>'.$row['food_item']. '</td>';
		echo '<td>'.$row['price']. '</td>';
		echo '<td>'.$row['Qty_available']. '</td>';
		echo '</tr>';
		}
		Database::disconnect();
		?>
		<!--</tbody>-->
		</table>
		</div>
	<div style="border:2px solid white;" id="salesform">
<form style="width:100%; height:380px;" action="mngr_sales.php" method='POST' name='sales'>
	<h3 id="salesoffood">Sales of Food Items</h3>
	<div class="margins"><label style="margin-right:10px;">Sellor</label><input type="username" name="mngr_username" disabled value="<?php echo $_SESSION['$username'];?>"><br></div>
	<div class="margins"><label style="margin-left:-25px;">Food Item</label>
	<select name="food_items" style="width:186px;">
	<?php
	$pdo=Database::connect();
	$sql1="SELECT food_item from food";
	foreach($pdo->query($sql1) as $row){
		echo '<option value='.$row['food_item'].'>'.$row['food_item'].'</option>';
	}
	?>
	</select><br></div>
	<div class="margins"><label style="margin-left:-51px; margin-right:7px;">Quantity Sold</label><input type="number" min=1 max=10 name="qty_sold" required><br></div>
	<div class="margins"><label style="margin-left:11px; margin-right:7px;">Date</label><input style="width:186px;" type="date" name="sale_date" required><br></div>
	<input style="width:186px; margin-top:40px; padding:7px;" type="submit" name="submit_sales" value="Enter Sales">
</form>
	</div>
	
									<!-- ADMIN-->
	
	
	<div id="purchaseform">
		<form action="adm_purchase.php" method='POST' name='purchase'>
		<div class="form">
			<h3 id="PurchasingRawItem">Purchasing Raw Item</h3>
			<div class="Amargins"><label class="a" style="margin-left:50px;">Purchaser</label><input type="username" name="admin_username" disabled value="<?php echo $_SESSION['$username'];?>"><br></div>
			<div class="Amargins"><label class="a" style="margin-left:-7px;">Item to Purchased</label><select name="item_name" style="width:50%;">
	<?php
	$pdo=Database::connect();
	$sql1="SELECT item_name from raw_material";
	foreach($pdo->query($sql1) as $row){
		echo '<option value='.$row['item_name'].'>'.$row['item_name'].'</option>';
	}
	?>
	</select><br>
	</div>
				<div class="Amargins"><label class="a"style="margin-left:-26px;">Quantity to Purchase</label><input style="width:50%;" type="number" min=1 max=10 name="Qty_purchased"><br></div>
				<div class="Amargins"><label class="a" style="margin-left:17px;">Purchase Date</label><input style="width:50%;" type="date" name="purchase_date" required></div>
				<div id="EnterPurchaseDetails"><input type="submit" name="purchasing" value="Enter Purchase Details" action="adm_purchase.php"></div>
	</div>
		</form>
		</div>
	
	<div id="chksales">
        <h3 style="text-align:center;">Sales Report</h3>
	<table>
		<thead>
		<tr>
			<th>Manager</th>
			<th>Food item</th>
			<th>Sales Date</th>
			<th>Quantity Sold</th>
			<th>Price Per Item</th>
			<th>Amount</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$TotalAmount=0;
		$pdo=Database::connect();
		$sql="SELECT S.*, F.price AS PricePerItem, F.price*Qty_sold AS Amount FROM selling AS S, food AS F WHERE F.food_item=S.food_item ORDER BY sale_date";
		foreach($pdo->query($sql) as $row){
		echo '<tr>';
		echo '<td>'.'  '.$row['mngr_username']. '</td>';
		echo '<td>'.'  '.$row['food_item']. '</td>';
		echo '<td>'.'  '.$row['sale_date']. '</td>';
		echo '<td>'.'  '.$row['Qty_sold']. '</td>';
		echo '<td>'.'  '.$row['PricePerItem']. '</td>';
		echo '<td>'.'  '.$row['Amount']. '</td>';
		echo '</tr>';
		$TotalAmount=$TotalAmount+$row['Amount'];
		}
		echo '<br>';
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>'.'Total Amount= '. $TotalAmount.'</td>';
		echo '</tr>';
		Database::disconnect();
		?>
		</tbody>
		</table>
		</div>
		<div id="UsedIn">
		<form action="used_in.php" method="POST" name="used_in">
		<div class="form">
		<h3 id="materialUsed">Raw Material Used In each food item</h3>
		<div id="rawItem"><label>Raw Item</label>
		<select style="width:42%;" name='item_name'>
	<?php
	$pdo=Database::connect();
	$sql="SELECT item_name from raw_material";
	foreach($pdo->query($sql) as $row){
		echo '<option value='.$row['item_name'].'>'.$row['item_name'].'</option>';
	}
	Database::disconnect();
	?>
	</select><br></div>
	<div id="foodItem"><label>Food Item</label>
	<select name='food'>
	<?php
	Database::connect();
	$sql1="SELECT food_item from food";
	foreach($pdo->query($sql1) as $row){
		echo '<option value='.$row['food_item'].'>'.$row['food_item'].'</option>';
	}
	Database::disconnect();
	?>
	</select><br></div>
	<div class="Amargins"><label style="margin-left:-18px; margin-right:5px;">Quantity of Raw Material</label><input style="width:32%;" type="number" name="Qty_used" min=1 max=10><br></div>
	<input type="submit" name="submit_usedin" value="Enter Record">
	</div>
		</form>
		</div>
</div>
<script>
function tab_disable(){
		var role="<?php echo $_SESSION['$role'];?>";
		if(role=='Admin'){
		document.getElementById("mngr").style.pointerEvents="none";
	//	document.getElementById("mngr").style.text-decoration="line-through";
	}else if(role=='Manager'){
		document.getElementById("admin").style.pointerEvents="none";
	//	document.getElementById("admin").style.text-decoration="line-through";
	}
}
function enchkfooditems(){
	disable_all();
	document.getElementById("chkfooditems").style.display="block";
}
function ensalesform(){
	disable_all();
	document.getElementById("salesform").style.display="block";
}
function disable_all(){
	document.getElementById("chkfooditems").style.display="none";
	document.getElementById("salesform").style.display="none";
	document.getElementById("purchaseform").style.display="none";
	document.getElementById("chksales").style.display="none";
	document.getElementById("UsedIn").style.display="none";
}
function enPurchase(){
	disable_all();
	document.getElementById("purchaseform").style.display="block";
}
function enChkSales(){
		disable_all();	
	document.getElementById("chksales").style.display="block";
}
function enUsedIn(){
	disable_all();
	document.getElementById("UsedIn").style.display="block";
}
function confirmation(){
	if(confirm('Are you sure you want to log out?'))
	{
		window.location.href="login.html";
	}
}		
</script>		
</body>
</html>


