<?php
require_once "start.php";
$request = new Request();
if ($request->reg ==1) {
    //print_r($request);
    //print"<br>";
        $formProcessor = new FormProcessor($request);
        $user_old_1 = new UserDB();
        $message_error = new Message(Config::FILE_MESSAGES);

        $user_old_1->loadOnEmail($request->email);

        $user_old_2 = new UserDB();
        $user_old_2->loadOnLogin($request->username);
        //print($user_old_1->isSaved());
        //print($user_old_2->isSaved());

        $checks[] = array($request->password, $request->repassword, "ERROR_PASSWORD_CONFIRM");
        $checks[] = array($user_old_1->isSaved(), false, "ERROR_EMAIL_ALREADY_EXISTS");
        $checks[] = array($user_old_2->isSaved(), false, "ERROR_USERNAME_ALREADY_EXISTS");
        $user = new UserDB();
        $fields = array("firstname", "lastname", "username", "email", "gender", "phone", "dob", array("setPassword()", $request->password));
        $user = $formProcessor->process("register", $user, $fields, $checks);
        if ($user instanceof UserDB) {
            header("Location: login.php?reg=1");
        }
        else $message_error = $message_error->get($_SESSION["message"]["register"]);
    }
    else {
    if(!session_id()) session_start();
    session_unset();
    session_destroy();
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Form</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="styles/reg1.css" media="all" />
    <link rel="stylesheet" type="text/css" href="styles/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/reg2.css" media="all"/>
    <script src="scripts/valid.js" type="text/javascript"></script>
</head>
<body>
<div class="container">

		      <h1>Registration Form </h1>
      <div  class="form">
      
    		<form name="reg" action="reg.php" method="post" enctype="multipart/form-data" id="contactform">
    			<?php if(isset($message_error)) { ?><h1 class="text-danger text-center"><?=$message_error?></h1> <?php } ?>

                <p class="contact"><label for="name">Name</label></p>
    			<input id="name" name="firstname" placeholder="First name" required="" tabindex="1" type="text">

                <p class="contact"><label for="last">Last Name</label></p>
                <input id="lname" name="lastname" placeholder="Last name" required="" tabindex="2" type="text">
    			 
    			<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" placeholder="example@domain.com" required="" tabindex="3" type="email">

                <p class="contact"><label for="dob">DOB</label></p>
                <input id="dob" name="dob" required="" tabindex="4" type="date">

                <p class="contact"><label for="username">Create a username</label></p> 
    			<input id="username" name="username" placeholder="username" required="" tabindex="5" type="text">
    			 
                <p class="contact"><label for="password">Create a password</label></p>
    			<input type="password" id="password" name="password" tabindex="6" required="">

                <p class="contact"><label for="repassword">Confirm your password</label></p> 
    			<input type="password" id="repassword" name="repassword" tabindex="7" required="">

                <p class="contact"><label for="phone">Mobile phone</label></p>
                <input id="phone" name="phone" placeholder="phone number" tabindex="8" required="" type="text"> <br>

                <div class="form-group">
                    <label class="col-lg-5 col-sm-5"><input type="radio"tabindex="9" name="gender" value="1" > Male </label>
                    <label class="col-lg-5 col-sm-5"><input type="radio" name="gender" tabindex="9" value="0" size="10">Female</label>
                </div>

                <input name="reg" type="hidden" value="1">
                <div class="form-group">
                    <input class="btn btn-group-vertical btn-success" name="submit" id="submit" tabindex="10" value="Sign up!" type="submit">
                </div>
   </form> 
</div>      
</div>

</body>
</html>
