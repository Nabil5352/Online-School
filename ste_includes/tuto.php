<?php
session_start();

$bar = "<ul class='pull-right'>
      <li class='navbar-text'>
      </li>
    </ul>
    <ul class='pull-right'>
		<li class='navbar-text'>
		<a href='http://localhost/OnlineSchool/ste_includes/signup/'>Sign Up</a>
		</li>
		</ul>
		<ul class='pull-right'>
		<li class='navbar-text'>
		<a href='#launch' data-toggle='modal'>Log In</a>
		</li>
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
				  <li class='navbar-text'>
				  </li>
				  </ul>         
          <ul class='pull-right'>
          <li class='navbar-text'>   
          <a class='dropdown-toggle' data-toggle='dropdown' id='hi'>&nbsp;Hi&nbsp;$username<b class='caret'></b></a>
          </li>
          </ul>
          ";
		$bar = "";
	}
}
}
?>
<?php

include "ste_content/connect.php";

$topic = "";
$catlist="";
$sublist="";
$cat="";

$POSTsql = mysql_query("SELECT * FROM `tuto` ORDER BY `date` LIMIT 6");

	while($row = mysql_fetch_array($POSTsql)){
	$title = $row["Tuto_desc"];
	$subcat = $row["Subcategory_id"];
	$writer = $row["Writer"];
	$date = $row["date"];
	$tuto_id = $row["Tuto_id"];
	
	$subcSQL = mysql_query("SELECT * FROM `subcategory` WHERE `Subcategory_id` = $subcat");
	
	while($row = mysql_fetch_array($subcSQL)){
	$subTitle = $row["Subcategory_name"]; 
	$catID = $row["Category_id"];
	}
	
	$cSQL = mysql_query("SELECT * FROM `category` WHERE `Category_id` = $catID");
	
	while($row = mysql_fetch_array($cSQL)){
	$cTitle = $row["Category_name"]; 
	}

$topic .= "<table class='tab' width='80%' border='1'  cellpadding='20'>
      <tr>
        <td width='170' align='center'><img src='ste_content/img/$cTitle.png' width='120' height='100' /></td>
        <td width='460' align='left' valign='top' bgcolor='#EBEBEB'><p>$cTitle  \ <a href='tuto_list.php?Subcategory_id=$subcat'> $subTitle </a></p>
          <p>&nbsp;</p>
          <p><h2><strong><a href='reader.php?Tuto_id=$tuto_id&Subcategory_id=$subcat'>$title</a></strong></h2></p>
          <p>&nbsp;</p>
          <p><em>Written by</em>:&nbsp;<strong>$writer </strong><em>on</em><strong> $date </strong></p>
        <p>&nbsp;</p>
		</td>
      </tr>
    </table>";
	}

	$catListSQL = mysql_query("SELECT * FROM `category` ORDER BY `Category_id`");
	while($row = mysql_fetch_array($catListSQL)){
	$catTitle = $row['Category_name'];
	$catID = $row['Category_id'];
	
	$srs = mysql_query("SELECT * FROM `subcategory` WHERE `Category_id`=$catID");	
	while($row = mysql_fetch_array($srs)) {
	$subcatTitle = $row['Subcategory_name'];
	$subcatID = $row['Subcategory_id'];
	
	$sublist .= "<li><a href = 'tuto_list.php?Subcategory_id=". $subcatID ."'>" . $subcatTitle ."</a></li>";

	}
	
	$cat .= "<li class='dropdown'>
             <a href='' class='dropdown-toggle' data-toggle='dropdown'> $catTitle <b class='caret'></b></a>
             <ul class='dropdown-menu'>
                $sublist
             </ul>
			</li>";
	$sublist="";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Tutorials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="ste_content/css/new.css" rel="stylesheet">
    <link href="ste_content/css/new-responsive.css" rel="stylesheet">
    <link href="ste_content/css/index.css" rel="stylesheet">
	<link href="ste_content/css/tuto.css" rel="stylesheet">   

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
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

<!-- NAVBAR -->
    <!-- ================================================== -->

<div class="navbar-wrapper">
	
    <div class="container">

        <div class="navbar navbar-inverse">
		
        <div class="navbar-inner">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            
			<div class="nav-collapse collapse">
            <a href="http://localhost/OnlineSchool/ste_includes/tuto.php"><img class="icon_forum" src="ste_content/img/article_icon.jpg" width="200" height="80"/></a>
			<?php 
				echo $bar;
				echo $OKbar; 
			?>
            </div>

        </div>
        </div>

    </div>	  
    </div>
	
	<div class="navbar-wrapper2">
	
    <div class="container2">

        <div class="navbar navbar-inverse">		
        <div class="navbar-inner">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            
			<div class="nav-collapse collapse">
			
            <ul class="nav">
                <li class="active"><a href="http://localhost/OnlineSchool/index.php">Home</a></li>
				
				<?php
				echo $cat;
				?>
										
            </ul>			
			
            </div>
			
		<form class="navbar-search pull-right">
			<input type="text" class="search-query" placeholder="Search">
		</form>
        </div>
        </div>

    </div>	  
    </div>
<div class="all_content">
<div class="content">
	  
	<?php echo $topic; ?>
	
  </div>
<?php

include "sidebar.php";

?>
<div class="clearBoth"></div>
</div>	
	
<div class="footer" align="center">
	 <!-- FOOTER -->
	 <fieldset>
      <footer align="center" style="background-color:#27292a; height:40px;">
       <p> <span class="footer_text">&copy; 2012 Online School.</span> &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
	  </fieldset>
</div>



    <!-- javascript -->
    <!-- ================================================== -->

    <script src="ste_content/js/jquery.js"></script>
    <script src="ste_content/js/new-transition.js"></script>
    <script src="ste_content/js/new-alert.js"></script>
    <script src="ste_content/js/new-modal.js"></script>
    <script src="ste_content/js/new-dropdown.js"></script>
    <script src="ste_content/js/new-scrollspy.js"></script>
    <script src="ste_content/js/new-tab.js"></script>
    <script src="ste_content/js/new-tooltip.js"></script>
    <script src="ste_content/js/new-popover.js"></script>
    <script src="ste_content/js/new-button.js"></script>
    <script src="ste_content/js/new-collapse.js"></script>
    <script src="ste_content/js/new-carousel.js"></script>
    <script src="ste_content/js/new-typeahead.js"></script>
    <script>
      !function ($) {
        $(function(){
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
</body>

</html>