<?php
   include 'page_2.php';
	   $mngr=$_SESSION['$username'];
	   $food_items=$_POST['food_items'];
	   $qty_sold=$_POST['qty_sold'];
	   $saledate=$_POST['sale_date'];
	$pdo=Database::connect();
	$sql0="SELECT COUNT(mngr_username) AS record from selling WHERE mngr_username='$mngr' AND sale_date='$saledate' AND food_item='$food_items'";
	foreach($pdo->query($sql0) as $row){
		if($row['record']>0){
		echo "<script>window.alert('Record already present in database')</script>";
	}else{
				$sql="SELECT Qty_available from food WHERE food_item='$food_items'";
	$result=0;
	try{
		foreach($pdo->query($sql) as $row){
			$result=$row['Qty_available'];
		}
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}
		$final_qty=$result-$qty_sold;
		if($final_qty<=0){
			echo "<script>window.alert('The food Item is Empty')</script>";
		}else{
   $sql1="INSERT INTO selling(mngr_username, sale_date, food_item, Qty_sold) VALUES('$mngr', '$saledate', '$food_items', '$qty_sold')";
		try{
			$pdo->query($sql1);
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}
		$sql2="UPDATE food SET Qty_available='$final_qty' WHERE food_item='$food_items'";
		try{
			$pdo->query($sql2);
				echo "<script>window.alert('Record inserted into database')</script>";
		}catch(Exception $e){
			echo "<script>window.alert('Unable to insert record into database')</script>";
		}

	}
	}
	}
   
   Database::disconnect();
   
   
?>