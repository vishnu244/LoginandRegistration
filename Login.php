<!DOCTYPE html>
<html>
<head>
	<title>  Login form </title>
    <link rel = 'stylesheet' type="text/css" href="style.css">
</head>
<body> 
<form action = "index.php" method = "POST" >
        
        <div class = "input-group">
            <label> EmailID </label>
            <input type = "Email" Name="EmailID" placeholder = "EmailID"  required > <br><br>
        </div>
        <div class = "input-group">
            <label> Password </label>
            <input type = "Password" Name="Password" placeholder = "Password"  required > <br><br>
        </div>
        <div class = "input-group">
        <button type = "Submit" name = "save" class = "btn"><a href="index.php"> Login </a> </button>   
        </div>


</body>
</html>