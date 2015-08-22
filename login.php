<?php
	require('connect.inc.php');
	require('check.inc.php');
	require('redirect.inc.php');
	session_start();

	$err=0;
	if(check($_POST['email']) && check($_POST['password'])){ //if there is post data
	   $email=$_POST['email'];$pw=$_POST['password'];
	   $query = $link->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pw'") or die("ERROR EXECUTING QUERY");
	   if($query->num_rows==0){
	      $err=1;
	   }else if($query->num_rows==1){ //login successful
	      $obj=$query->fetch_object(); //fetch the user object
	      $_SESSION['email']=$obj->email; //login is correct so set new session
	      redirect('dashboard.php');
	   }else{
	      die("2 USERS WITH SAME DATA?! IMPOSSIBRU!");
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
	var err=<?php echo $err; ?>;
	$(document).ready(function(){
		if(err){
			Materialize.toast("Incorrect login data!",6000);
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
	    <form class="col s12 m6 offset-m3" action="login.php" method="POST">
	      <h3 class="center ">Please sign in</h3>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="email" name="email" type="email" class="validate">
	          <label for="email">Email</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
	          <input id="password" name="password" type="password" class="validate">
	          <label for="password">Password</label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col s12">
		      	<input type="checkbox" class="filled-in" id="remember_me" checked="checked" />
		        <label for="remember_me">Remember me</label>
		    </div>
	      </div>
	      <div class="row">
	        <div class="col s6">
	      		<button class="btn waves-effect waves-light" type="submit" name="action">Submit <i class="material-icons right">send</i></button>
	      	</div>
	        <div class="col s6 right-align">
	      		<a href="register.php">Don't have an account?</a>
	      	</div>
	      </div>
	    </form>
	</div>
</body>
</html>