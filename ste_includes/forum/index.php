<?php
session_start();

$bar = "<form action='../login/index.php' name='myForm' id='myForm' method='POST'>
			<input name='username' type='text' id='username' size='15' maxlength='15'/>
			<input name='password' type='password' id='password' size='15' maxlength='15'/>
			<br/>
			<input name='submit' type='submit' value='Sign In'/> 
			&nbsp;&nbsp;Don't have an account? &nbsp;<a href='#'>Sign Up</a>
			</form>";
$OKbar = "";
$welbar = "New to the forum? <a href='#'>Sign up</a> to get in touch with many experts and developers.";

if(isset($_SESSION["user"])&& isset($_SESSION["password"])){
	
$user = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["user"]);
$pass = preg_replace('#[^0-9A-Za-z]#i','',$_SESSION["password"]);

include "../ste_content/connect.php";

$sql = mysql_query("SELECT * from user Where user_name='$user' AND password='$pass' LIMIT 1");

if(mysql_num_rows($sql) > 0){

while($row = mysql_fetch_array($sql)) {
    $id = $row['user_id'];
    $username = $row['user_name'];
	$password = $row['password'];
	$log_in_time = $row['log_in_time'];	
	}   
	
if(strcmp($username,$user)==0 && strcmp($password,$pass)==0)
	{
		$OKbar = "<p class='logUsr'>Logged in as <a href='#'>$username</a> ( <a href='../login/logout.php'> Log Out </a> )</p>";
		$bar = "";
		$welbar = "Your last visit was : <strong><i>$log_in_time</i></strong>";
	}
}

}
?>
<?php

include "../ste_content/connect.php";

$list ="";
$count="";
$last_post_cat = "";
$last_post_usr = "";
	
$SQL = mysql_query("SELECT * FROM `category`");

while($row = mysql_fetch_array($SQL)) {
$Category_name = $row['Category_name'];
$Category_id = $row['Category_id'];
$Category_desc = $row['Category_desc'];


$secondSQL = mysql_query("SELECT count(Subcategory_id) FROM `subcategory` WHERE `Category_id`=$Category_id");
$count = mysql_result($secondSQL,0);

$thirdSQL = mysql_query("SELECT COUNT(post_id) FROM  `forum_topic` WHERE forum_topic.Subcategory_id IN 
						(SELECT Subcategory_id from `subcategory` WHERE `Category_id`=$Category_id)");
$count2 = mysql_result($thirdSQL,0);


//last post
$ltsPostSQL = mysql_query("SELECT * 
FROM  `subcategory` AS s
INNER JOIN  `forum_topic` AS f
WHERE s.`Subcategory_id` = f.`Subcategory_id` 
AND TIME = ( 
SELECT MAX( TIME ) 
FROM subcategory AS s1, forum_topic AS t1
WHERE s1.Subcategory_id = t1.Subcategory_id
AND s1.Category_id = s.Category_id )");

while($row = mysql_fetch_array($ltsPostSQL)) {
$Subcategory_id = $row['Subcategory_id'];
$user_id = $row['user_id'];
$Subcategory_name = $row['Subcategory_name'];
$Ct_id = $row['Category_id'];

$usrSQL = mysql_query("SELECT * FROM `user` WHERE user_id=$user_id");
while($row = mysql_fetch_array($usrSQL)) {
$user_name = $row['user_name'];
}


if($Category_id==$Ct_id){
$last_post_cat .= "<a href='#'>$Subcategory_name</a>";
$last_post_usr .= "$user_name";
}
else{
$last_post_cat .= "";
$last_post_usr .= "";
}
}

$list .= "<tr>
	    <td width='81' height='54' class='window0'><img class='windowIcon' src='../ste_content/img/Developer.png'alt='ico'></td>
	    <td width='443' class='window'>
			<p><a href='topic.php?id=$Category_id''>$Category_name</a></p>
			<p>$Category_desc</p>
		</td>
	    <td width='98' class='window0' align='center'>$count</td>
	    <td width='99' class='window' align='center'>$count2</td>
	    <td width='305' class='window0'>
			<p><b>In:</b> $last_post_cat</p>
			<p><b>By:</b> $last_post_usr</p>
		</td>
      </tr>";	

$count="";
$last_post_cat = "";
$last_post_usr = "";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Forum </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet">
	<link href="../ste_content/css/forum.css" rel="stylesheet"> 	

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav icon -->
    <link rel="shortcut icon" href="../ste_content/img/favicon.ico">
</head>

<body>


	<div class="header">
		&nbsp;<a href="http://localhost/OnlineSchool/ste_includes/forum/"><img class="header_image" src="../ste_content/img/forum_icon.jpg"></a>
		<div class="SubHeader1">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="link1" href="http://localhost/OnlineSchool/">Home</a>&nbsp;
			<a class="link2" href="#">Rules</a>&nbsp;
			<span class="H1pan1" align="right">
			<a class="link3" href="#">Gallery</a>&nbsp;
			<a class="link4" href="#">Members</a>&nbsp;
			<a class="link5" href="#">FAQ</a>&nbsp;
			<a class="link5" href="#">Search</a>&nbsp;
			<a class="link6" href="#">Help</a>
			</span>
		</div>
		
		<div class="middleBar">
		</div>
		
		<div class="SubHeader2">
			<div class="InsideSubHeader2">
			<?php
			
			echo $bar;
			echo $OKbar;
			
			?>
		</div>
		</div>
	</div>
	
	<div class="body">
	<div class="title">
	<img src="../ste_content/img/djja.png" width="25" height="25"/>
	&nbsp;<span class="Welcometext"><b>Welcome</b></span>
	</div>
		<div class="Inside">
		&nbsp;&nbsp;&nbsp;
			<?php echo $welbar; ?>
		<div class="">
		&nbsp;&nbsp;&nbsp;
		Online school forum Top news: <a href="#">Something</a>
		</div>
		</div>	
		
		<div class="middleBar">
		</div>
		
	<div class="table1">
	<table width="100%" border="0">
	  <tr>
	    <td width="535" height="41" class="tablehead">
			<img class="headerIcon" src="../ste_content/img/arrow_64.png"alt="ico">
			&nbsp;&nbsp;<span class="headerText"><b>Notices</b></span>
		</td>
		<td width="99" height="41" class="tablehead">&nbsp;</td>
		<td width="102" height="41" class="tablehead">&nbsp;</td>
		<td width="306" height="41" class="tablehead">&nbsp;</td>
      </tr>
	  <tr>
        <td width="535" class="tablehead2" align="center">Forum</td>
	    <td width="99" class="tablehead2" align="center">Topics</td>
	    <td width="102" class="tablehead2" align="center">Post</td>
	    <td width="306" class="tablehead2" align="center">Last post</td>
      </tr>
	  </table>
	  <table width="100%" border="1">
	  <tr>
	    <td width="81" height="54" class="window0"><img class="windowIcon" src="../ste_content/img/ok-icon.png"alt="ico"></td>
	    <td width="443" class="window">
			<p><a href="#">Annonuncement & news</a></p>
			<p>Announcement & news, All forum updates, news will be posted here. Browse this forum first to find out
			anything old & new about online school or something that you missed.</p>
		</td>
	    <td width="98" class="window0"></td>
	    <td width="99" class="window">&nbsp;</td>
	    <td width="305" class="window0">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="55" class="window0"><img class="windowIcon" src="../ste_content/img/ok-icon.png"alt="ico"></td>
	    <td class="window">
			<p><a href="#">Tutorial news & updates</a></p>
			<p>Latest tutorial(video and artice) news & update will be discussed here.</p>
		</td>
	    <td class="window0">&nbsp;</td>
	    <td class="window">&nbsp;</td>
	    <td class="window0">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="55" class="window0"><img class="windowIcon" src="../ste_content/img/ok-icon.png"alt="ico"></td>
	    <td class="window">
			<p><a href="#">Tutorial Articles-Interviews-Guides</a></p>
			<p>Artices, Interviews, Guides and reviews to help you with manageing your programming clan and just a general guide
			about those programs.</p>
		</td>
	    <td class="window0">&nbsp;</td>
	    <td class="window">&nbsp;</td>
	    <td class="window0">&nbsp;</td>
      </tr>
	  </table>
	</div>
	
	<div class="middleBar">
	
	</div>
		
	<div class="table2">
	<table width="100%" border="0">
	  <tr>
	    <td width="532" height="41" class="tablehead">
		  <img class="headerIcon" src="../ste_content/img/arrow_64.png"alt="ico">
		  &nbsp;&nbsp;<span class="headerText"><b>Online School Community</b></span>
		</td>
		<td width="101" height="40" class="tablehead">&nbsp;</td>
		<td width="102" height="40" class="tablehead">&nbsp;</td>
		<td width="307" height="40" class="tablehead">&nbsp;</td>
      </tr>
	  <tr>
	    <td width="532" class="tablehead2" align="center">Forum</td>
	    <td width="101" class="tablehead2" align="center">Topics</td>
	    <td width="102" class="tablehead2" align="center">Post</td>
	    <td width="307" class="tablehead2" align="center">Last post</td>
      </tr>
	  </table>
	  <table width="100%" border="1">
      
	  <?php
	  echo $list;
	  ?>
	  
	  </table>
	</div>
	
	<br/><br/><br/><br/><br/>
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

    <script src="../ste_content/js/jquery.js"></script>
    <script src="../ste_content/js/new.js"></script>


</body>
</html>