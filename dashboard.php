<?php
   require('includes/connect.inc.php');
   require('includes/redirect.inc.php');
	session_start();

   if(check($_SESSION['email'])){ //if logging again
      $email=$_SESSION['email'];
      $query = $link->query("SELECT * FROM `users` WHERE `email`='$email'") or terminate(ERR::QUERY_CODE);
      $obj = getObj($query,ERR::SERVER_DATA);
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
<link href="css/dashboard.css" rel="stylesheet">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>
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
                  <?php
                     $default = "http://s28.postimg.org/6k1j18nzh/default.png";
                     $size = 100;
                     $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                     
                     echo '<img id="avatar" src="'.$grav_url.'" alt="" class="circle" />'
                  ?>
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
         <div id="pane" class="col s12 m8 l8 z-depth-1 offset-m2 offset-l2" style="padding:0 !important;">
         	<ul class="collection" style="border:0; margin:0 !important" >
         	</ul>
         	<div class="preloader-wrapper">
         		<div class="spinner-layer spinner-blue-only">
               	<div class="circle-clipper left">
               		<div class="circle"></div>
                	</div><div class="gap-patch">
                  	<div class="circle"></div>
                	</div><div class="circle-clipper right">
                  	<div class="circle"></div>
                	</div>
            	</div>
         	</div>
         </div>
   		<div class="col s12 m2 l2 center" style="margin-top:70px;">
      	   <a href="#add_modal" class="modal-trigger btn-floating btn-large waves-effect waves-light yellow darken-3"><i class="material-icons">add</i></a>
   		</div>
   	  <!-- Modal Structure -->
   	   <div id="add_modal" class="modal modal-fixed-footer">
   	     <div class="modal-content">
   	       <h4>Add a new board</h4>
   	       <div class="row">
   	          <form id="addform" class="col s12">
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
   	       <a href="#!" id="addform_btn" class="modal-action waves-effect waves-green btn-flat ">Add</a>
   	     </div>
   	   </div>
   </div>
</body>
</html>