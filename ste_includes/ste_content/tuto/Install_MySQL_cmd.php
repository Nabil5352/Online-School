<!doctype HTML>

<html>
	<head>
		<title>Using MySQL through windows command prompt</title>
	</head>
	
	<body>
		<p>
		First open command prompt through Run. You can open Run option from start menu or pressing windows key+r from keyboard.

		Now write 'cmd' on the bar and click OK or press Enter.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/1.png" width="450" height="300" /><br/><br/>
		
		Now it's open command prompt.<br/>
		write mysql and press enter. It shows a message that it won't identify as any system call.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/2.png" width="650" height="450" /><br/><br/>
		
		So we need to do some thing to make mysql familiar to PC. Open your installation directory and find mysql.exe under mysql server>bin folder.<br/>
		In my case I installed it in a folder named 'MySQL' in C:\ drive. Click to see it's property. Copy it's location path as show in this image.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/3.png" width="400" height="500" /><br/><br/>
		
		Now go to My Computer's property.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/4.png" width="450" height="350" /><br/><br/>
		
		Click on 'Advanced system settings'
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/5.png" width="750" height="450" /><br/><br/>
		
		Under 'Advanced' tab click on 'Environment Variables'
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/6.png" width="550" height="500" /><br/><br/>
		
		Under 'System Variables' system scroll down sidebar and find 'path' option. Click on it and then click 'edit'
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/7.png" width="550" height="500" /><br/><br/>
		
		Put a semicolon(;) at the end of the line and paste mysql.exe path.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/8.png" width="550" height="500" /><br/><br/>
		
		Click OK to finish this.<br/> Now reboot the Operating System.<br/>
		After that again open command prompt and write mysql...press Enter.<br/>
		This time you found some error message. It means it found mysql but can't let us access it because of it's settings(because we
		don't use any password).<br/>
		Then write this command on the window... <span style="color:green"><b><code>mysql -h localhost -u root -p</code></b></span>
		<br/>
		<span style="color:green"><b><code>-h</code></b></span> means host as our host is localhost.<br/>
		<span style="color:green"><b><code>-u</code></b></span> means username as our default username is root.<br/>
		<span style="color:green"><b><code>-p</code></b></span> means we want to give a password.<br/>
		press Enter and give the same password which give you ducring mysql installation then press again Enter.
		<br/><br/><img src="http://localhost/OnlineSchool/ste_includes/ste_content/tuto/img/mysql-cmd/9.png" width="550" height="500" /><br/><br/>
		<span style="color:red">tadaaa</span> You can access whole mysql through command prompt. Use sql to access the database. like 
		<span style="color:green"><b><code>show database;</code></b></span><br/> Keep it in mind that in command prompt after every sql command you must
		put a semicolon(;), otherwise machine can not understand that command given is end.
		</p>
		
		<br/><br/><br/>
		
		
	</body>
</html>