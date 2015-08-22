<?php
	require('connect.inc.php');
	require('check.inc.php');

	session_start();

	$err=0;
	$status=0;
	if(check($_POST['firstname']) && check($_POST['lastname']) && check($_POST['email']) && check($_POST['password'])){
		$email=$_POST["email"];
		$name=$_POST["firstname"];
		$surname=$_POST["lastname"];
		$password=$_POST["password"];

		$query = $link->query("INSERT INTO `users` (`email`,`password`,`name`,`surname`) VALUES ('$email','$password','$name','$surname')");
		if($query){
			$status=1;
			$_SESSION['email']=$email;
		}else{
			$err=1;
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<script type="text/javascript">
	var toast=<?php echo $status; ?>;
	var err=<?php echo $err; ?>;
	$(document).ready(function(){
		if(toast){
			Materialize.toast("Successfully reigstered!",6000);
			setTimeout(function(){
				Materialize.toast("You will be redirected shortly to your dashboard.",6000);
				setTimeout(function(){
					window.location.replace("dashboard.php");
				},2500);
			},500);		
		}
		if(err){
			Materialize.toast("An Error occured!",6000);
			setTimeout(function(){
				Materialize.toast("User already registered!",6000);
			},500);		
		}
	});
	
</script>

<style type="text/css">
	body {
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #FCFCFC;
	}
	h3{
		color:#EE6E73;
		margin-bottom:30px;
	}
</style>
</head>
<body>
 	<div class="row">
	    <form class="col s12 m6 offset-m3" action="register.php" method="POST">
	      <h3 class="center ">Please register</h3>
	      <div class="row">
	        <div class="input-field col s6">
	          <input id="firstname" name="firstname" type="text" class="validate">
	          <label for="firstname">First Name</label>
	        </div>
	        <div class="input-field col s6">
	          <input id="lastname" name="lastname" type="text" class="validate">
	          <label for="lastname">Last Name</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" name="email"  type="email" class="validate">
	          <label for="email">Email</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" name="password"  type="password" class="validate">
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col s6">
	      		<button class="btn waves-effect waves-light" type="submit" name="action">Submit <i class="material-icons right">send</i></button>
	      	</div>
	        <div class="col s6 right-align ">
	      		<a href="login.php">Have an account? Login here</a>
	      	</div>
	      </div>
	    </form>
	</div>
</body>
</html>