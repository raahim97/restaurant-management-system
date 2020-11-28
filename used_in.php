<?php
	include 'page_2.php';
	//if(isset(submit_usedin)){
		$item=$_POST['item_name'];
		$food=$_POST['food'];
		$Qty=$_POST['Qty_used'];
		$sql="SELECT QuantityInStock from raw_material WHERE item_name='$item'";
		$qty=0;
		$qtyInStock=0;
		$qty_available=0;
		$q=0;
		$pdo=Database::connect();
		try{
			foreach($pdo->query($sql) as $row){
				$qtyInStock=$row['QuantityInStock'];
			}
		}catch(Exception $e){
			echo "<script>alert('Unable to interact with database')</script>";
		}
		if($qtyInStock>$Qty){
			$qty=$qtyInStock-$Qty;
			$sql1="UPDATE raw_material SET QuantityInStock='$qty' WHERE item_name='$item'";
			$sql2="INSERT INTO used_in(item_name, food_item, Qty_used) VALUES('$item', '$food', '$Qty')";
			$sql3="SELECT Qty_available from food WHERE food_item='$food'";
			try{
				$pdo->query($sql1);
				$pdo->query($sql2);
			}catch(Exception $e){
				echo "<script>alert('Unable to insert or update values in database')</script>";
			}
			try{
				foreach($pdo->query($sql3) as $row){
					$qty_available=$row['Qty_available'];
				}
				$q=$qty_available+1;
			$sql4="UPDATE food SET Qty_available='$q' WHERE food_item='$food'";
				$pdo->query($sql4);
				echo "<script>alert('Values inserted into database successfully')</script>";
			}catch(Exception $e){
				echo "<script>alert('Unable to insert or update values in database')</script>";
			}
		}else{
			echo "<script>alert('Quantity Used is greater than Quantity In Stock')</script>";
		}
		//header("location: page_2.php");
	//}

?>