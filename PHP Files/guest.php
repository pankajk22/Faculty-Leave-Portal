<html>
	<head>
		<title>FACULTY PORTAL</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>
	<body>
		<div class="img0">
			<div id="nav">
				<ul>
                <li><a href="home.php">HOME</a></li>
					<li><a href="login.php">LOGIN</a></li>					
					<li><a href="register.php">REGISTER</a></li>
                    <li><a href="DBadmin.php">DB-ADMIN</a></li>
                    <li class ="active"><a href="guest.php">GUEST</a></li>
					<li><a href="details.php">INFO</a></li>
                    
				</ul>
			</div>
			<form action="display.php" method="post">
				<input type="text" name="show" placeholder="faculty/hod/crosscutting/director" required>
				<input type="submit" value="DISPLAY">
			</form>
		</div>
	</body>
</html>













