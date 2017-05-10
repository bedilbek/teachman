<?php
require_once "start.php";
$request = new Request();
if ($request->reg ==1) {
    $user = new UserDB();
    $user->firstname = $request->first_name;
    $user->lastname = $request->last_name;
    $user->dob = $request->BirthYear."-".$request->BirthMonth."-".$request->BirthDay;
    $user->username = $request->username;
    $user->setPassword($request->password);
    $user->email = $request->email;
    $user->gender = $request->gender;
    $user->phone = $request->phone;
    $user->save();
    if ($user->isSaved()) print_r($user);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="styles/loginstyle.css" media="all" />
	<link rel="stylesheet" type="text/css" href="styles/lgstyle.css" media="all" />
</head>
<body>

<div id="container">
	<header>
				<h1>Sign in</h1>
    </header> 
   
   <div class="form">
   	    <form name="auth" id="signin" action="dashboard.php" method="post">
   			<p class="contact"><label for="username">Username </label></p>
   			<input id="username" name="username" placeholder="username" required="" type="text">
            <p class="contact"><label for="password">Password </label></p> 
            <input type="password" id="password" name="password" required=""> 			
            <p><input type="checkbox" name="rememberme" id="rememberme" value="rememberme">Remember me</p>		
            <p ><input type="hidden" name="firsttime" value="1"> </p>
            <p ><input type="submit" name="Sign in" value="Sign in!" class="signinbtm"> </p>
            <?php if($request->session == "0") { ?> <label>Your session has expired, log in one more time</label> <?php }?>
            <h1 class="changelink"><a href="reg.php" class="toregister"> Register</a> </h1>
       </form>
   </div> 
	
</div>

</body>
</html>