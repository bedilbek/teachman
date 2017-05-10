window.onload=function(){
	//var frm=document.getElementById("contactform");
	var nm=document.getElementById("name");
	var lname=document.getElementById("lname");
    var tel=document.getElementById("phone");
	var submit=document.getElementById('submit');
	var date=document.getElementById("date");
	submit.onclick=makesubmit;

    nm.onkeydown=function(ev)
	{
		console.log(ev.key);
		if(ev.key.match(/\d/)) ev.preventDefault();
	}

	    lname.onkeydown=function(ev)
	{
		console.log(ev.key);
		if(ev.key.match(/\d/)) ev.preventDefault();
	}
	 tel.onkeydown=function(ev)
	{
		console.log(ev.key);
		if((ev.key.match(/^[A-Za-z]$/)) ) ev.preventDefault();
	}

	

}

function makesubmit()
{
	var tel=window.document.getElementById("phone");
	var password=window.document.getElementById("password");
	var repassword=window.document.getElementById("repassword");
     


if((password.value)!=(repassword.value))
	{
		
		alert("Password Don`t Match!");
		//repassword.style.color="red";
		return false;
	}else if((password.length)<6)
	{
		alert("Password should be minimum 6 character");
	}
	else if( (!(password.value).match(/[A-Za-z]/)) || (!(password.value).match(/\d/)) )
	{
		alert("Password should contain alphanumeric string");
	}

var regtel=/\?d{12}/;
if( regtel.test(tel.value))
	{
		alert("Invalid Phone Number");
		tel.focus();
		return false;
	}

	


}