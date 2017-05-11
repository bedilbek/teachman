<?php
require_once "start.php";
$request = new Request();
if ($request->reg) {$message = "Registration is Succesful, you can continue by logging in"; $text="text-success";} else $text="text-danger";
if($request->session == "0") $message = "Your session has expired, log in one more time";
if (!session_id()) session_start();
if (!empty($_SESSION["auth_login"]) && !empty($_SESSION["auth_password"])) {
    $username = $_SESSION["auth_login"];
    $password = $_SESSION["auth_password"];
    $user = UserDB::authUser($request->username, $request->password);
    if ($user instanceof UserDB) header("Location: dashboard.php");
    else $message = "Incorrect Login or Password";

}
if ($request->login) {
    $user = UserDB::authUser($request->username, $request->password);
    if ($user instanceof UserDB) header("Location: dashboard.php");
    else $message = "Incorrect Login or Password";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="styles/loginstyle.css" media="all" />
	<link rel="stylesheet" type="text/css" href="styles/lgstyle.css" media="all" />
    <!-- Bootstrap -->
    <link href="styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/bootstrap/css/bootstrap-select.css" rel="stylesheet">
</head>
<body>

<div id="container">
	<header>
				<h1>Sign in</h1>
    </header> 
   
   <div class="form">
   	    <form name="auth" id="signin" action="login.php" method="post">
   			<p class="contact"><label for="username">Username </label></p>
   			<input id="username" name="username" placeholder="username" required="" type="text">
            <p class="contact"><label for="password">Password </label></p> 
            <input type="password" id="password" name="password" required=""> 			
            <p><input type="checkbox" name="rememberme" id="rememberme" value="rememberme">Remember me</p>		
            <p ><input type="hidden" name="login" value="1"> </p>
            <p ><input type="submit" name="Sign in" value="Sign in!" class="signinbtm"> </p>
            <?php if (isset($message))  { ?> <label class="<?=$text?>"><?=$message?></label> <?php }?>
            <h1 class="changelink"><a href="reg.php" class="toregister"> Register</a> </h1>
       </form>
   </div> 
	
</div>

</body>
</html>