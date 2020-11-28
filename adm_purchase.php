<?php
   require 'page_2.php';
	   $admin_username=$_SESSION['$username'];
	   $item_name=$_POST['item_name'];
	   $purchase_date=$_POST['purchase_date'];
	   $Qty_purchased=$_POST['Qty_purchased'];
		$pdo=Database::connect();
	$sql0="SELECT COUNT(admin_userName) AS record from purchasing WHERE admin_userName='$admin_username' AND purchase_date='$purchase_date'";
	foreach($pdo->query($sql0) as $row){
		if($row['record']>0){
		echo "<script>window.alert('Record already present in database')</script>";
	}else{
		$sql="SELECT QuantityInStock from raw_material WHERE item_name='$item_name'";
	$result=0;
	try{
		foreach($pdo->query($sql) as $row){
			$result=$row['QuantityInStock'];
		}
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}
		$final_qty=$result+$Qty_purchased;
   $sql1="INSERT INTO purchasing(admin_userName, purchase_date, item_name, Qty_purchased) VALUES('$admin_username', '$purchase_date', '$item_name', '$Qty_purchased')";
		try{
			$pdo->query($sql1);
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}
		$sql2="UPDATE raw_material SET QuantityInStock='$final_qty' WHERE item_name='$item_name'";
		try{
			$pdo->query($sql2);
				echo "<script>window.alert('Record inserted into database')</script>";
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}
	}
	}
   Database::disconnect();
?>