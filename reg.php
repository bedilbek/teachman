<?php
require_once "start.php";
$req = new Request();
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Form</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="styles/reg1.css" media="all" />
    <link rel="stylesheet" type="text/css" href="styles/reg2.css" media="all" />
    <script src="scripts/valid.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
			
		      <h1>Registration Form </h1>
      <div  class="form">
      
    		<form name="reg" action="login.php" method="get" enctype="multipart/form-data" id="contactform">
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="first_name" placeholder="First name" required="" tabindex="1" type="text">

          <p class="contact"><label for="last">Last Name</label></p> 
          <input id="lname" name="last_name" placeholder="Last name" required="" tabindex="2" type="text">
    			 
    			<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" placeholder="example@domain.com" required="" type="email"> 
                
                <p class="contact"><label for="username">Create a username</label></p> 
    			<input id="username" name="username" placeholder="username" required="" tabindex="3" type="text"> 
    			 
                <p class="contact"><label for="password">Create a password</label></p> 
    			<input type="password" id="password" name="password" required=""> 
                <p class="contact"><label for="repassword">Confirm your password</label></p> 
    			<input type="password" id="repassword" name="repassword" required=""> 

        
               <fieldset>
                 <label>Birthday</label>
                  <label class="month"> 
                  <select class="select-style" name="BirthMonth">
                  <option value="">Month</option>
                  <option id="01" value="01">January</option>
                  <option id="02" value="02">February</option>
                  <option id="03" value="03" >March</option>
                  <option id="04" value="04">April</option>
                  <option id="05" value="05">May</option>
                  <option id="06" value="06">June</option>
                  <option id="07" value="07">July</option>
                  <option id="08" value="08">August</option>
                  <option  id="09" value="09">September</option>
                  <option id="10" value="10">October</option>
                  <option id="11" value="11">November</option>
                  <option id="12" value="12" >December</option>
                  </label>
                 </select>    
                <label>Day<input id="date" class="birthday" maxlength="2" name="BirthDay"  placeholder="Day" required=""></label>
                <label>Year <input class="birthyear" maxlength="4" name="BirthYear" placeholder="Year" required=""></label>
              </fieldset>
  

        <label ><input type="radio"  name="gender" value="1" > Male </label>
       
        <label><input type="radio" name="gender" value="0" size="10">Female</label>

           



            <p class="contact"><label for="phone">Mobile phone</label></p>
           
            <input id="phone" name="phone" placeholder="phone number" required="" type="text"> <br>
                <input name="reg" type="hidden" value="1">
            <input class="buttom" name="submit" id="submit" tabindex="6" value="Sign up!" type="submit"> 

   </form> 
</div>      
</div>

</body>
</html>
