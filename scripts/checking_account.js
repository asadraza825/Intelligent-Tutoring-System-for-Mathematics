// JavaScript Document
function checking_accout(email,pass)
{
			var str="";
			if(window.XMLHttpRequest)
		    {
			  xmlhttp=new XMLHttpRequest;
		    }
		    else
		    {
			   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		    }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
		if(xmlhttp.responseText == "false")
		{
			document.getElementById("msg").innerHTML="Sorry Your Email and password are incorrect";
		}
        else
		{
			document.location="index.php";
		}
  }
		
  }
xmlhttp.open("GET","std_login_submit.php?email="+email+"&password="+pass,true);
xmlhttp.send();
}
function checking_accouts(email,pass)
{
	var tp_id=document.getElementById("tp_id").value;
	var t_id =document.getElementById("t_id").value;
			var str="";
			if(window.XMLHttpRequest)
		    {
			  xmlhttp=new XMLHttpRequest;
		    }
		    else
		    {
			   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		    }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
		if(xmlhttp.responseText == "false")
		{
			document.getElementById("msg").innerHTML="Sorry Your Email and password are incorrect";
		}
        else
		{
			document.location="topic_info.php?topic_id="+tp_id+"&teacher_id="+t_id;
		}
  }
		
  }
xmlhttp.open("GET","std_login_submit.php?email="+email+"&password="+pass,true);
xmlhttp.send()
}