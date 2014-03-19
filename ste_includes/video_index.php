<?php
session_start();

$bar = "<ul class='pull-right'>
    </ul>
    <ul class='pull-right'>	
		<a href='http://localhost/OnlineSchool/ste_includes/signup/'>Sign Up</a>	
		&#8226;
		<a href='#launch' data-toggle='modal'>Log In</a>
		</ul>";
$OKbar = "";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
    $username = $row['user_name'];
	$password = $row['password'];	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "				
			  <ul class='pull-right'>
				  &nbsp;&nbsp;
				  </ul>         
          <ul class='pull-right'>  
          <a id='hi'>&nbsp;Hi&nbsp;$username</a>
          <img class='brdUsrIMG' src='http://localhost/OnlineSchool/ste_includes/ste_content/img/sign_img/$id.jpg' alt='$username'/>
          </ul>
          ";
		$bar = "";
	}
}
}
?>
<?php
	include "ste_content/connect.php";
	
	//initialize value
	$catlist="";
	$sublist="";
	$list="";

	$catSQL = "SELECT * FROM `category` ORDER BY Category_id";
	$crs = mysql_query($catSQL);
	
			
	while($row = mysql_fetch_array($crs)) {
	$catTitle = $row['Category_name'];
	$catID = $row['Category_id'];

	
	$subcatSQL = "SELECT * FROM `subcategory` WHERE `Category_id`=$catID";
	$srs = mysql_query($subcatSQL);
	
	while($row = mysql_fetch_array($srs)) {
	$subcatTitle = $row['Subcategory_name'];
	
	$sublist .= "<li><a style='color:#5f76a9' href = 'video_tuto_list.php?Subcategory_id=". $row['Subcategory_id'] ."'>" . $subcatTitle ."</a></li>";

	}
	
	
	$catlist = "$catTitle";

	$list .= "<div class='accordion-group'>
				<div class='accordion-heading'>
				<a class='accordion-toggle' id='accordionInside' data-toggle='collapse' data-parent='#accordion2' href='#collapse$catID' align='center'>$catlist</a>
				</div>
				<div id='collapse$catID' class='accordion-body collapse'>
					<div class='accordion-inner'>
						<ul>
						$sublist
						</ul>
					</div>
				</div>
				</div>";			  
	$sublist="";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Video</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="ste_content/css/new.css" rel="stylesheet">
    <link href="ste_content/ss/new-responsive.css" rel="stylesheet">
	<link href="ste_content/css/index.css" rel="stylesheet">  
   	<link href="ste_content/css/video_index.css" rel="stylesheet">  		 
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="ste_content/img/favicon.ico">
</head>
<body>

<section id="launch" class="modal hide fade">
	<header class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3 align="center">Log In</h3>
	</header>

	<div class="modal-body">
		<p>
		<form class="form-horizontal" action="http://localhost/OnlineSchool/ste_includes/login/index.php" method="POST">
			
			<p align="center"><b>Don't have an account?</b> <a href="http://localhost/OnlineSchool/ste_includes/signup/">Sign Up</a></p>
			<div class="control-group">
				<label class="control-label" for="inputName">Username</label>
			<div class="controls">
				<input type="text" id="inputName" name="username" placeholder="Username">
			</div>
			</div>
			
  			<div class="control-group">
				<label class="control-label" for="inputPassword">Password</label>
    		<div class="controls">
				<input type="password" id="inputPassword" name="password" placeholder="Password">
    		</div>
  			</div>
			
  			<div class="control-group">
    		<div class="controls">
				<label class="checkbox">
					<input type="checkbox"> Remember me
				</label>
				<button type="submit" class="btn btn-primary">Sign in</button>
				
    		</div>
  			</div>
		</form>
		</p>
	</div>
	<footer class="modal-footer">
		<button class="btn" data-dismiss="modal">Close</button>
	</footer>
</section>


<div class="row-fluid">

   <div class="span12" >
   <div class="well well-large">
      <div class="span3">
      	<a class="btn" href="http://localhost/OnlineSchool/">Online School - Home</a>
	   </div>
	   
	   <div class="span7">
	   <div class="input-append">
             <input class="input-xxlarge" id="appendedInput" type="text"> <!-- Search bar-->
               <a class="btn"width="50%" height="70%"><img src="ste_content/img/g.png" width="17" height="16"/></a> <!-- Search Image-->
             </div>
	   </div>
	   
	   <div class="span2">
	              <div class="media">     <!-- User Profile Picture -->
        <div class="media-body">  
        <span class="media-heading"><?php echo $bar; ?> &nbsp;&nbsp;<?php echo $OKbar; ?></span>
        
         
        <!-- Nested media object -->
        <div class="media">
        
        </div>
        </div>
        </div>
	   		
	  
	  </div>
       </div>
       <div class="featurette">
        <img class="img-circle featurette-image pull-right" src="ste_content/img/vid_tuto.png">
        <h2 class="featurette-heading">Watch world's best video tutorials <span class="muted">It'll blow your mind.</span></h2>
        <p class="lead">A good video lesson is perfect to learn something and easier to get everything. </p>
    </div>	  
	</div>
	</div>
   	</div>

    <div class="row-fluid">
        <div class="span12" id='WrapperField'>
		<div class="span3" id='sidebar'>
 
	 	<div class="accordion" id="accordion2">		
		<?php echo $list; ?>
		</div>
	    </div>
	    
	   <div class="span7" style="float:left;">
	     <ul class="nav nav-tabs nav-stacked" >

<?php	  
include "ste_content/connect.php";

$per_page=3;  //for pagination  How many video will be displayed in main page
$a=mysql_query("SELECT count(`List_id`) FROM `video_links`"); // getting total number of videos
$pages=ceil(mysql_result($a,0)/$per_page);// dividing and get total number of pages

if(isset($_GET['page_id'])){  
$page=$_GET['page_id'];
}
else{
$page=1;
}

$start=($page-1)*$per_page;	  
	  
$sql = mysql_query("SELECT * FROM `video_links` ORDER BY `Subcategory_id` DESC LIMIT $start,$per_page");
	  
while($row = mysql_fetch_assoc($sql)){	 
	 $link_desc = $row['Link_desc']; //get information for displaying each videos info in video index page
	 $link_title = $row['List_title'];  
	 $view = $row['views']; 
	 $time_since_post = $row['time_since_post'];
	 $video_list = $row['List_id'];
	 $Subcategory_id = $row['Subcategory_id'];
	
	 $time=time(); // for calculating time
	 $diff=$time-$time_since_post;
					
     switch (1){
		case ($diff<60); /// for calculating time Since post
        $count=$diff;				
		
		if($count==0)
			$count='A Moment';
		else if ($count==1)
			$suffix="Second";
		else 
			$suffix="Seconds";
			break;
				 
		case ($diff>60 && $diff<3600);
        $count=floor($diff/60);				
			 
		if ($count==1)
			$suffix="Minute";
		else 
			$suffix="Minutes";
			break;
				 
		case ($diff>3600 && $diff<86400);
        $count=floor($diff/3600);				
			    
		if ($count==1)
			$suffix="Hour";
		else 
			$suffix="Hours";
			break;
				 
		case ($diff>86400 && $diff<2629769);
        $count=floor($diff/86400);				
			    
		if ($count==1)
			$suffix="day";
		else 
			$suffix="days";
			break;
		}
	      
	 //each user info and video info 
		 $each_vedio_item ="
		<li class='inside'>
			<div class='span12' id='mainList'>
			    <div class='media'>
        	
        	<div class='media-body'>
      
        <!-- Nested media object -->
        <div class='vid'>
		  <div class='span6'>
		  	<a href='http://localhost/OnlineSchool/ste_includes/tv.php?List_id=$video_list&Subcategory_id=$Subcategory_id' id='video'>
        	<video id='myVideo' controlsposter='$video_list.jpg' width='300' height='180'>
				<source src='ste_content/vid/vid$video_list.ogv' type='video/ogg' />
			</video>
			</a>

			<p class='vidTitle'><span class='title_heading'>&nbsp; &nbsp;Uploaded: </span>&nbsp;$count $suffix ago&nbsp;&nbsp;&nbsp;
			<span class='title_heading'>Duration:</span> &nbsp;14:12<p>
			<br/>
		 </div>
		 <div class='span6'>
		 <a href='http://localhost/OnlineSchool/ste_includes/tv.php?List_id=$video_list&Subcategory_id=$Subcategory_id'><h4>$link_title</h4></a>
		 <h5>$link_desc </h5>
		 <h5>$view views</h5>		 
        </div>

		</a>
        </div>
        </div>
		</div>
        </div>				
		</li>";
		echo  $each_vedio_item;
	}
?>

    </ul>
	</div>
	   
	</div>
	</div>
        
    <div class="span12">
      <center>
		 <div class="pagination">
        <ul width="100%">         <!-- -for pagination-->
		<?php  $i=$page+1; $j=$page-1;?>
        <li><a href="?page_id=<?php echo $j;?>">Prev</a></li>
        <li><a href="?page_id=1">1</a></li>
        <li><a href="?page_id=2">2</a></li>
        <li><a href="?page_id=3">3</a></li>
        <li><a href="?page_id=4">4</a></li>
        <li><a href="?page_id=4">5</a></li>
        <li><a href="?page_id=<?php echo $i;?>">Next</a></li>
        </ul>
        </div><!-- -footer content-->
		</center>
    </div>      
 </div>

<br/><br/><br/><br/>
 <div class="footer" style="position:auto;">
	 <!-- FOOTER -->
	 <fieldset>
      <footer class='foot'>
       <p> <span class="footer_text">&copy; 2012 Online School.</span> &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
	  </fieldset>
	</div>
<script src="ste_content/js/jquery.js"></script>
<script src="ste_content/js/new.js"></script>
</body>
</html>