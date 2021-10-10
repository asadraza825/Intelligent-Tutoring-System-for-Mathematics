// JavaScript Document
/* validate form elemets*/
function check_user_name(str)
{
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
    document.getElementById("username").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","check_user_name.php?user_name="+str);
xmlhttp.send();
}