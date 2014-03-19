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

$id = $_GET['id'];

$SQL = mysql_query("SELECT * FROM `subcategory` where Category_id=$id");
$last_post = "";
$last_post_usr = "";
$list = "";
$count="";
$tme = "";
$view=0;
	
while($row = mysql_fetch_array($SQL)) {
$Subcategory_id = $row['Subcategory_id'];
$Subcategory_name = $row['Subcategory_name'];
$meta = $row['meta'];

$secondSQL = mysql_query("SELECT count(Subcategory_id) FROM `forum_topic` WHERE `Subcategory_id`='$Subcategory_id'");
$count = mysql_result($secondSQL,0);

$thirdSQL = mysql_query("SELECT * FROM `forum_topic` WHERE `Subcategory_id`='$Subcategory_id'");
while($row = mysql_fetch_array($thirdSQL)){
$view = $row['views']+$view;
}

//last post
$ltsPostSQL = mysql_query("SELECT * FROM `forum_topic`");

while($row = mysql_fetch_array($ltsPostSQL)) {
$Sc_id = $row['Subcategory_id'];
$user_id = $row['user_id'];
$post_id = $row['post_id'];
$post_title = $row['post_title'];
$post = $row['post'];
$time = $row['time'];

$usrSQL = mysql_query("SELECT * FROM `user` WHERE user_id=$user_id");
while($row = mysql_fetch_array($usrSQL)) {
$user_name = $row['user_name'];
}


if($Subcategory_id==$Sc_id){
$last_post .= "<a href='#'>$post_title</a>";
$last_post_usr .= "$user_name";
$tme .= "$time";
}
else{
$last_post .= "";
$last_post_usr .= "";
$tme .= "";
}
}

$list .= "<tr>
	    <td width='81' height='54' class='window0'><img class='windowIcon' src='../ste_content/img/Developer.png'alt='ico'></td>
	    <td width='443' class='window'>
			<p><a href='view_post_list.php?sid=$Subcategory_id&id=$id'>$Subcategory_name</a></p>
			<p>$meta</p>
		</td>
	    <td width='98' class='window0' align='center'>$count</td>
	    <td width='99' class='window' align='center'>$view</td>
	    <td width='305' class='window0'>
			<p><b>In:</b> $last_post</p>
			<p><b>By:</b> $last_post_usr <b>At:</b> $time </p>
		</td>
      </tr>";	
$count="";
$last_post = "";
$last_post_usr = "";
$time = "";
$view=0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Online School | Topics </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
    <link href="../ste_content/css/new.css" rel="stylesheet">
    <link href="../ste_content/css/new-responsive.css" rel="stylesheet">
	<link href="../ste_content/css/index.css" rel="stylesheet">
	<link href="../ste_content/css/new.css" rel="stylesheet" />
	<link href="../ste_content/css/new-responsive.css" rel="stylesheet" /> 
	<link href="../ste_content/css/forum_topic.css" rel="stylesheet">	

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
		
		<div class="container-fluid">
		<div class="row-fluid">
		<nav class="span12">
			<ul class="breadcrumb">
  				<li><a href="http://localhost/OnlineSchool/ste_includes/forum/" title="Forum home"> Board Index </a>
				<span class="divider">&#187;</span></li>
  				<li class="active"> Topics </li>
			</ul>
		</nav>
		</div>
		</div>
		
		<div class="middleBar">
		</div>
		
		<div class="SubHeader2">
			<?php
			
			echo $bar;
			echo $OKbar;
			
			?>
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
			&nbsp;&nbsp;<span class="headerText"><b>Shoutbox</b></span>
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
			<p><a href="#">Forum Rulez</a></p>
			<p>Read Forum Rulez Carefully.</p>
		</td>
	    <td width="98" class="window0"></td>
	    <td width="99" class="window">&nbsp;</td>
	    <td width="305" class="window0">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="55" class="window0"><img class="windowIcon" src="../ste_content/img/ok-icon.png"alt="ico"></td>
	    <td class="window">
			<p><a href="#">Comments / Complaints / Suggestions</a></p>
			<p>Have a Comment or Suggestion or a Complaint ? ...Post them here And Let Us Know!.</p>
		</td>
	    <td class="window0">&nbsp;</td>
	    <td class="window">&nbsp;</td>
	    <td class="window0">&nbsp;</td>
      </tr>
	  <tr>
	    <td height="55" class="window0"><img class="windowIcon" src="../ste_content/img/ok-icon.png"alt="ico"></td>
	    <td class="window">
			<p><a href="#">Request for Tutorials-Articles-Manuels</a></p>
			<p>If you need or have any request or advice for any type of Tutorials, Articles, Guides or Manuels then post here.
			Let us know about your interest.</p>
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
		<td width="307" height="40" class="tablehead"><a class='new_post_link'	href='new_post.php?id=<?php echo $id; ?>'>Add new post</a></td>
      </tr>
	  <tr>
	    <td width="532" class="tablehead2" align="center">Topics</td>
	    <td width="101" class="tablehead2" align="center">Post</td>
	    <td width="102" class="tablehead2" align="center">View</td>
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