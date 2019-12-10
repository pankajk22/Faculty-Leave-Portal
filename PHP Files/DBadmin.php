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
                    <li class ="active"><a href="DBadmin.php">DB-ADMIN</a></li>
					<li><a href="guest.php"> GUEST</a><li>
					<li><a href="details.php">INFO</a></li>
                    
				</ul>
			</div>
			<form action="admin.php" method="post">
				<input type="password" name="Password" placeholder="Password" required>
				<input type="submit" value="ADMIN-LOGIN">
			</form>
		</div>
	</body>
</html>













