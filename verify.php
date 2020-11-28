<?php
include 'database.php';
//Couldn't erase the commented code lines because every code line is a sweet child of mine!!!
/*session_start();
if(isset($_SESSION['Login']) && $_SESSION['Login']==true){
	header("location: page_2.php");
}*/
if(isset($_POST['username'])&& isset($_POST['password'])&& isset($_POST['dropdown'])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			$role=$_POST['dropdown'];
			$pdo=Database::connect();
//			if($_POST['username']==$username &&$_POST['password']==$password){
	if($role=='Admin'){
		$sql="SELECT admin_userName, password FROM admin WHERE admin_userName='$username' AND password='$password'";
		$q=$pdo->prepare($sql);
		$q->execute();
		$row=$q->fetch(PDO::FETCH_ASSOC);
//		$row=PDOStatment::fetchAll($result);
		if($row['admin_userName']==$username && $row['password']==$password){
			session_start();
			$_SESSION['sid']=session_id();
			$_SESSION['$role']=$role;
			$_SESSION['$username']=$username;
			Database::disconnect();
			header("location: page_2.php");
}else{
	
	echo "<script>alert('Incorrect Username or password')</script>";
	echo "<script>window.location.href='login.html'</script>";
}
	}else if($role=='Manager'){
		$sql="SELECT userName, password FROM manager WHERE userName='$username' AND password='$password'";
		$q=$pdo->prepare($sql);
		$q->execute();
		$row=$q->fetch(PDO::FETCH_ASSOC);
		
//		$row=PDOStatment::fetchAll($result);
		if($row['userName']==$username && $row['password']==$password){
			session_start();
			$_SESSION['sid']=session_id();
			$_SESSION['$role']=$role;
			$_SESSION['$username']=$username;
			Database::disconnect();
			header("location: page_2.php");
}else{
	echo "<script>alert('Incorrect Username or password')</script>";
	echo "<script>window.location.href='login.html'</script>";
	}
	}
}
	Database::disconnect();
/*$username=stripcslashes($username);
$username=stripcslashes($password);
$username=mysql_real_escape_string($username);
$password=mysql_real_escape_string($password);*/

//$row=$pdo->FETCH_ARRAY($result);

	
?>
