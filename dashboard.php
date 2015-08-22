<?php
   require('connect.inc.php');
   require('check.inc.php');
   require('redirect.inc.php');
	session_start();

   if(check($_SESSION['email'])){ //if logging again
      $email=$_SESSION['email'];
      $query = $link->query("SELECT * FROM `users` WHERE `email`='$email'") or die("ERROR EXECUTING QUERY");
      if($query->num_rows==0){
         die("INCORRECT SESSION DATA");
      }else if($query->num_rows==1){ //login successful
         $obj=$query->fetch_object(); //fetch the user object
      }else{
         die("2 USERS WITH SAME DATA?! IMPOSSIBRU!");
      }
   }else{ //not posting or already logging
      redirect('login.php');
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
<style type="text/css">
	body {
	  background-color: #EDECED;
	}
	h3{
		color:#EE6E73;
		margin-bottom:30px;
	}
	#header{
		color:#FFF;color:rgba(255,255,255,0.9);
		font-size:1.1em;
	}
	#top_bar{	
		height: 20px;
	}
	#middle_bar{
      height:61px;
	}
	#middle_bar::after{
		position: absolute;
		content:'';
		left:0;
		top:0;
		width:100%;
		height:200px;
		background: inherit;
		z-index:-1;
		box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.16), 0px 2px 10px 0px rgba(0, 0, 0, 0.12);

	}
	#current{
		padding:0;
		font-weight: 500;
	}
	#current i,span{
      vertical-align: middle;
		cursor: pointer;
	}
	#pane{
		background: #FFF;
		min-height:400px;
		border-radius: 4px;
      padding:0px !important;
	}
   #pane li{
      width:100%;

   }
	.modal{
		overflow-x:hidden;
	}
   #avatar{
      max-width:40px;
      height:auto;
      vertical-align: middle;
   }
   .settings{
      display: none;
   }
   .status{
      width:1.3em;
      height:1.3em;
      border-radius: 50%;
   }
</style>
<script type="text/javascript" src="js/app.js"></script>
</head>
<body>
   <div id="header" class="row">
      <div class="col s12 red darken-4" id="top_bar"></div>
      <div class="col s12 red darken-3 valign-wrapper" id="middle_bar">
         <div class="col s6 valign-wrapper">
         	<p class="dropdown-button waves-effect waves-light valign" data-activates='menu' id="current"><i class="material-icons">reorder</i><span> Overview</span><p>
         	<!-- Dropdown Structuref -->
         	  <ul id='menu' class='dropdown-content'>
         	    <li><a href="#!">Overview</a></li>
         	    <li class="divider"></li>
         	    <li><a href="#!">Help</a></li>
         	    <li><a href="mailto:aleksa.d.ilic@gmail.com">Contact</a></li>
         	  </ul>
         </div>
         <div class="col s6 right-align valign">
               <div  style="padding:0 10px;" class="dropdown-button waves-effect waves-light" data-activates='settings'>
                  <p style="display:inline-block; margin-right:5px;"><?php echo $obj->name; ?> </p>
                  <img id="avatar" src="avatars/default.png" alt="" class="circle"> 
               </div>
               <!-- Dropdown Structuref -->
               <ul id='settings' class='dropdown-content'>
                  <li><a href="#!">Settings</a></li>
                  <li class="divider"></li>
                  <li><a href="logout.php">Log-out</a></li>
               </ul>
            </div>
      </div>
   </div>
   <div class="row" >
   	  <ul class="col s12 m8 l8 z-depth-1 offset-m2 offset-l2 collection" id="pane" >
	      <li class="item waves-effect collection-item avatar">
	            <img src="img/avatar.png" alt="" class="circle">
	            <span class="title">Aleksin Alarm</span>
	            <p>Dnevna Soba <br>
	               D8BS-L3V1-0915
	            </p>
	            <a href="#!" class="secondary-content"><div class="status green"></div></a>
	       </li>
          <li class="collection-item settings"><a class="waves-effect waves-light btn green">Start</a> <a class="waves-effect waves-light btn red">Delete</a></li>
	       <li class="item collection-item avatar">
	             <img src="img/avatar.png" alt="" class="circle">
	             <span class="title">Name</span>
	             <p>Location <br>
	                Serial
	             </p>
	             <a href="#!" class="secondary-content"><div class="status red"></div></a>
	        </li>
   	  </ul>
   	  <div class="col s12 m2 l2 center" style="margin-top:65px;">
   	  	  <a href="#add_modal" class="modal-trigger btn-floating btn-large waves-effect waves-light yellow darken-3"><i class="material-icons">add</i></a>
   	  </div>
   	  <!-- Modal Structure -->
   	   <div id="add_modal" class="modal modal-fixed-footer">
   	     <div class="modal-content">
   	       <h4>Add a new board</h4>
   	       <div class="row">
   	          <form class="col s12">
   	            <div class="row">
   	              <div class="input-field col s12">
   	                <input id="name" type="text" class="validate">
   	                <label for="name">Board Name</label>
   	              </div>
   	            </div>
   	            <div class="row">
   	              <div class="input-field col s12">
   	                <input id="serial" type="text" class="validate">
   	                <label for="serial">Serial</label>
   	              </div>
   	            </div>
   	            <div class="row">
   	              <div class="input-field col s12">
   	                <input id="location" type="text" class="validate">
   	                <label for="location">Location</label>
   	              </div>
   	            </div>
   	            <p class="range-field" style="padding: 0 10px;">
   	 			  <label for="sensitivity">Sensitivity</label>
			      <input type="range" id="sensitivity" min="0" max="100" />
			    </p>
   	            <div class="switch">
   	               <label style="padding:0 10px">Status: </label>
   	               <label>
   	                 Off
   	                 <input id="status" type="checkbox">
   	                 <span class="lever"></span>
   	                 On
   	               </label>
   	            </div>
   	          </form>
   	        </div>
   	              
   	     </div>
   	     <div class="modal-footer">
   	       <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
   	       <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Add</a>
   	     </div>
   	   </div>
   </div>
</body>
</html>