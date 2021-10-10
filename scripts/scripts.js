function appendinputTypeClasses(){ 
	if (!document.getElementsByTagName ) 
		return; 
	var oe = document.getElementsByTagName('input'); 
	var oeLen = oe.length; 
	for ( var i=0;i<oeLen;i++ ) { 
		if ( oe[i].getAttribute('type') ) 
			oe[i].className += ' '+oe[i].getAttribute('type'); 
	}
	// activate dropdown menu
	var oe = document.getElementById('top_navi').getElementsByTagName('div'); 
	var oeLen = oe.length; 
	for (i=0;i<oeLen;i++){
		if (oe[i].className=="sub_nav")
			oe[i].parentNode.onmouseover=function(){ddShow(this);};
	}
   if (typeof signUp=='undefined'){
      addEvent(document.getElementById('live_btn'),'click',
         function(e){
            window.location="http://live.educator.com/";
         }
      );
      // update session every 10 minutes
      var timerSession=setInterval(function(){
         var randNum = Math.floor(Math.random()*999);
         if (document.images.keepUpdated)
            document.images.keepUpdated.src ="/live/incl/session_update.php?img="+randNum;
      },10*60*1000);
   }
   // multi-user footer popout
   var me=document.getElementById('mu_footer');
   if (me!=null){
      $('#mu_footer').find('a').click(
         function(ev){
            popout(this,ev);
         }
      );
   }
}
function showLogin(evt){
   stopProp(evt);
   var lb=document.getElementById('login_box');
   //var la=document.getElementById('login_btn').getElementsByTagName('a').item(0);
   var ll=document.getElementById('login_btn').offsetLeft;
   if (typeof showLogin.url=='undefined'){
      showLogin.url=lb.getElementsByTagName('form').item(0).action;
      addEvent(lb.getElementsByTagName('select').item(0),'change',
         function(e){
            var os=lb.getElementsByTagName('select').item(0);
            lb.getElementsByTagName('form').item(0).action=os.options[os.selectedIndex].value;
            document.getElementById('lbForgotPw').setAttribute('href',os.options[os.selectedIndex].value);
         }
      ,false);
      addEvent(lb,'mouseout',showLogin,false);
   }
   if (lb.style.display=='block'){
      posX=mPos(evt,'x');limitX=lb.offsetLeft+lb.offsetParent.offsetLeft;
      posY=mPos(evt,'y');limitY=lb.offsetTop+lb.offsetHeight-2;
      if (posX>0 && (posX<limitX || posY>limitY || posX>limitX+lb.offsetWidth)){
         lb.style.display='none';
         //la.style.borderBottom='1px solid transparent';
      }
   }else{
      lb.style.left=(ll+7).toString()+'px';
      lb.style.display='block';
      lb.getElementsByTagName('input').item(0).focus();
      //la.style.borderBottom='1px solid white';
   }
}
function share(s){
	with (document.location) {var u=encodeURIComponent(protocol+"//"+host+pathname)};
	var t=encodeURIComponent(document.title);var o='toolbar=0,status=0,resizable=1,scrollbars=1,width=675,height=436';
	var d=document.getElementsByName('description');
	switch (s) {
		case 'fb':window.open('http://www.facebook.com/sharer.php?u='+u+'&t='+t,'sharer',o);break;
		case 'ds':window.open('http://delicious.com/save?v=5&noui&jump=close&url='+u+'&title='+t, 'delicious',o);break;
		case 'su':window.open('http://www.stumbleupon.com/submit?url='+u+'&title='+t, 'stumbleupon',o);break;
		case 'mx':window.open('http://www.mixx.com/submit?page_url='+u, 'mixx',o);break;
		case 'dg':window.open('http://digg.com/submit?url='+u+'&title='+t+'&bodytext='+encodeURIComponent(d[0].content)+'&media=news&topic=educational', 'digg',o);break;
		case 'go':window.open('http://www.google.com/bookmarks/mark?op=edit&bkmk='+u+'&title='+t, 'google',o);break;
		case 'rd':window.open('http://www.reddit.com/submit?url='+u, 'reddit',o);break;
		case 'em':window.open('/email_friend.php?url='+u+'&title='+t, 'email',o);break;
		case 'nl':window.open('/newsletter.php?title='+t, 'newsletter',o);break;
	};
	return false;}

function sbar_load(li){
	var sbar_c = document.createElement('div'); sbar_c.id="social_cont"; document.body.appendChild(sbar_c);
	var sbar = document.createElement('div'); sbar.id="social"; sbar_c.appendChild(sbar);
	var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
	x.onreadystatechange=function(){
		if(x.readyState==4&&x.status==200){
			sbar.innerHTML=x.responseText;
			sbar.style.backgroundImage = 'none';
			var sbtn = document.getElementById( "social_toggle_btn" );
			var page = (location.href);
			page = page.substring(page.lastIndexOf('/') + 1);
			if((page=="index.php"||page=="")&&!li){
				sbtn.title='close';
			} else {
				sbtn.title='close';
			};
			sbar_toggle(sbtn);
			//sbar.style.width="auto";
		}
	};
	x.open('GET','/sociable.html',1); x.send(null)
}

function spop_load(s){
	var o=document.getElementById( "social_"+s );
	o.style.backgroundImage='url(/images/sociable/soc-loader.gif)';
	var sbar_c=document.getElementById("social_cont");
	var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
	x.onreadystatechange=function(){
		if(x.readyState==4&&x.status==200){
			sbar_c.innerHTML+=x.responseText;
			setTimeout(function(){
				var o=document.getElementById( "social_"+s );
				o.style.backgroundImage='url(/images/sociable/'+s+'.jpg)';
				spop_pop(s)
			},1000);
		}
	};
	x.open('GET','/sociable-'+s+'.html',1); x.send(null)
}

var si,st,pi;
function sbar_size(s,w,d,i){
	var ow=s.offsetWidth;
	if((ow-w)*d>=-8){
		i.style.width = "auto";
		s.style.width = "auto";
		clearInterval(si);
	} else {
		s.style.width=ow+Math.ceil((w-ow)/3)+'px';
	}
}
function onNews(){
   var nbox=document.getElementById('social_npopup');
   var sbar=document.getElementById("social_toggle_btn");
   sbarClosed=sbar.getAttribute('title')=='open';
   if (nbox) nboxClosed=nbox.style.display=='none';
   else {
      nboxClosed=true;
   }
   okToClose=!(!sbarClosed && nboxClosed);
   onNews.closed= sbarClosed || onNews.closed;
   if (onNews.closed && okToClose){
      sbar_toggle(sbar);
      delayMs=300;
   }else{
      delayMs=10;
   }
   setTimeout(
      function(){
         if (sbar.getAttribute('title')=='close') spop_pop('n');
      }
      ,delayMs
   );
   return false;
}
function sbar_toggle(obj){
	var sbar = document.getElementById("social");
	var sbar_i = document.getElementById("social_bar");
	var parent, sbar_c, sbar_o;
	parent = obj.parentNode;
	sbar_c = document.getElementById( "social_closed" );
	sbar_o = document.getElementById( "social_opened" );
	clearInterval(si);
	sbar.style.width=sbar.offsetWidth+'px';
	sbar_i.style.width='632px';
	if (obj.title == "close"){
		obj.title = "open";
		parent.style.backgroundPosition = "right center";
		spop_pop('c');
		sbar_c.style.display = "block";
		sbar_o.style.display = "none";
		sbar_i.style.width=parent.offsetWidth+sbar_c.offsetWidth+15+'px';
		si=setInterval(function(){sbar_size(sbar,90,-1,sbar_i);}, 20);
	} else {
		obj.title = "close";
		parent.style.backgroundPosition = "left center";
		//sbar_o.style.width=sbar_c.offsetWidth+'px';
		sbar_c.style.display = "none";
		sbar_o.style.display = "block";
		sbar_i.style.width=parent.offsetWidth+sbar_o.offsetWidth+20+'px';
		si=setInterval(function(){sbar_size(sbar,582,1,sbar_i);}, 20);
	}
}

function spop_pop(s){
	s=s.substr(0,1);
	clearTimeout(st);
	var spop;
	if(s=='c'){ // clear all
		spop=document.getElementById('social_npopup');
		spop==null||spop.style.bottom=='-170px'?s='s':s='n'
	} else { // remove other popup if it exists
		s=='s'?spop=document.getElementById('social_npopup'):spop=document.getElementById('social_spopup');
		if(spop!==null){spop.style.bottom='-170px'; spop.style.display='none';spop.style.right='auto'};
	}
	spop = document.getElementById('social_'+s+'popup');
	var sbtn = document.getElementById( "social_toggle_btn" );
	if(spop==null){
		if(sbtn.title=='close'){
			s=='s'?s='share':s='newsletter';
			spop_load(s)
		}
	} else {
		with (spop.style) {var ob=Number(bottom.substr(0,bottom.length-2))};
		if(ob<-144&&sbtn.title=='close'){
			clearInterval(pi);
			if(s=='n') spop.style.right='8px';
			spop.style.bottom='-144px';spop.style.display='block';
			pi=setInterval(function(){spop_pos(spop,31)},20);
		} else {
			if(ob==31){
				spop.style.opacity=1;
				clearInterval(pi);
				pi=setInterval(function(){spop_fade(spop)},20);
			}
		}
	}
}

function spop_pos(s,b){
	with (s.style) {var ob=Number(bottom.substr(0,bottom.length-2))};
	if(b-ob<=0) clearInterval(pi);
	else s.style.bottom=ob+Math.ceil((b-ob)/5)+'px';
}

function spop_fade(s){
	var ot=Math.round(s.style.opacity*100);
	if(ot<5){
		clearInterval(pi);
		s.style.bottom='-170px'; s.style.display='none';
		s.style.opacity=1; s.style.filter='alpha(opacity=100)'
	} else {
		var t=ot-Math.ceil(ot/5);
		s.style.opacity=t/100; s.style.filter='alpha(opacity='+t+')'
	}
}

function spop_wait(s){
	clearTimeout(st);
	st=setTimeout(function(){spop_pop(s)},2000);
}

function LoadImage(imageName,imageFile){
  if (!document.images) return;
  document.images[imageName].src = imageFile;
}

function inputFocus(m,o,e,s){
	if(o.value==m&&e){o.value='';o.style.color='#0A0202';o.style.fontWeight=(typeof s=='undefined')?'normal':s}
	if(o.value==''&&!e){o.style.color='dimgray';o.style.fontWeight='normal';o.value=m}
}
function showToggle(obj){
    var parent;
    var toggleDetails;
    
    // changes the image state 
    if (obj.className == "toggle")
        obj.className = "toggleSelected"; 
    else 
        obj.className = "toggle";

	// for interface header collapse
	if (obj.innerHTML=="Lecture Description")
		document.getElementById('flash_hdr').style.height=(obj.className=="toggle")?'0px':'auto';
    
    // shows the toggleDetails 
    parent = obj.parentNode;
    for (var item in parent.childNodes)
    {
        if (parent.childNodes[item].className == "toggleDetails")
        {
            toggleDetails = parent.childNodes[item];
            if (toggleDetails.style.display == "none" || toggleDetails.style.display == "")
            {
                toggleDetails.style.display = "block";
            }
            else
            {
                toggleDetails.style.display = "none";
            }
            
            return; 
        }
    }
}

function CheckForm1(f) {
	var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
	if (!email_re.test(f.email.value)) {
		alert("Please enter your valid email address.");
		f.email.focus();
		return false;
	}
	return true;
}

// Flash Player Version Detection - Rev 1.6
// Detect Client Browser type
// Copyright(c) 2005-2006 Adobe Macromedia Software, LLC. All rights reserved.
var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;

function ControlVersion()
{
	var version;
	var axo;
	var e;

	// NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn't in the registry

	try {
		// version will be set for 7.X or greater players
		axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		version = axo.GetVariable("$version");
	} catch (e) {
	}

	if (!version)
	{
		try {
			// version will be set for 6.X players only
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
			
			// installed player is some revision of 6.0
			// GetVariable("$version") crashes for versions 6.0.22 through 6.0.29,
			// so we have to be careful. 
			
			// default to the first public version
			version = "WIN 6,0,21,0";

			// throws if AllowScripAccess does not exist (introduced in 6.0r47)		
			axo.AllowScriptAccess = "always";

			// safe to call for 6.0r47 or greater
			version = axo.GetVariable("$version");

		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 4.X or 5.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = axo.GetVariable("$version");
		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 3.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
			version = "WIN 3,0,18,0";
		} catch (e) {
		}
	}

	if (!version)
	{
		try {
			// version will be set for 2.X player
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
			version = "WIN 2,0,0,11";
		} catch (e) {
			version = -1;
		}
	}
	
	return version;
}

// JavaScript helper required to detect Flash Player PlugIn version information
function GetSwfVer(){
	// NS/Opera version >= 3 check for Flash plugin in plugin array
	var flashVer = -1;
	
	if (navigator.plugins != null && navigator.plugins.length > 0) {
		if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
			var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
			var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
			var descArray = flashDescription.split(" ");
			var tempArrayMajor = descArray[2].split(".");			
			var versionMajor = tempArrayMajor[0];
			var versionMinor = tempArrayMajor[1];
			var versionRevision = descArray[3];
			if (versionRevision == "") {
				versionRevision = descArray[4];
			}
			if (versionRevision[0] == "d") {
				versionRevision = versionRevision.substring(1);
			} else if (versionRevision[0] == "r") {
				versionRevision = versionRevision.substring(1);
				if (versionRevision.indexOf("d") > 0) {
					versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
				}
			} else if (versionRevision[0] == "b") {
				versionRevision = versionRevision.substring(1);
			}
			var flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
		}
	}
	// MSN/WebTV 2.6 supports Flash 4
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
	// WebTV 2.5 supports Flash 3
	else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
	// older WebTV supports Flash 2
	else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
	else if ( isIE && isWin && !isOpera ) {
		flashVer = ControlVersion();
	}
	return flashVer;
}

// When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
{
	versionStr = GetSwfVer();
	if (versionStr == -1 ) {
		return false;
	} else if (versionStr != 0) {
		if(isIE && isWin && !isOpera) {
			// Given "WIN 2,0,0,11"
			tempArray         = versionStr.split(" "); 	// ["WIN", "2,0,0,11"]
			tempString        = tempArray[1];			// "2,0,0,11"
			versionArray      = tempString.split(",");	// ['2', '0', '0', '11']
		} else {
			versionArray      = versionStr.split(".");
		}
		var versionMajor      = versionArray[0];
		var versionMinor      = versionArray[1];
		var versionRevision   = versionArray[2];

        	// is the major.revision >= requested major.revision AND the minor version >= requested minor
		if (versionMajor > parseFloat(reqMajorVer)) {
			return true;
		} else if (versionMajor == parseFloat(reqMajorVer)) {
			if (versionMinor > parseFloat(reqMinorVer))
				return true;
			else if (versionMinor == parseFloat(reqMinorVer)) {
				if (versionRevision >= parseFloat(reqRevision))
					return true;
			}
		}
		return false;
	}
}

function AC_AddExtension(src, ext)
{
  var qIndex = src.indexOf('?');
  if ( qIndex != -1)
  {
    // Add the extention (if needed) before the query params
    var path = src.substring(0, qIndex);
    if (path.length >= ext.length && path.lastIndexOf(ext) == (path.length - ext.length))
      return src;
    else
      return src.replace(/\?/, ext+'?'); 
  }
  else
  {
    // Add the extension (if needed) to the end of the URL
    if (src.length >= ext.length && src.lastIndexOf(ext) == (src.length - ext.length))
      return src;  // Already have extension
    else
      return src + ext;
  }
}

function AC_Generateobj(objAttrs, params, embedAttrs) 
{ 
    var str = '';
    if (isIE && isWin && !isOpera)
    {
  		str += '<object ';
  		for (var i in objAttrs)
  			str += i + '="' + objAttrs[i] + '" ';
  		str += '>';
  		for (var i in params)
  			str += '<param name="' + i + '" value="' + params[i] + '" /> ';
  		str += '</object>';
    } else {
  		str += '<embed ';
  		for (var i in embedAttrs)
  			str += i + '="' + embedAttrs[i] + '" ';
  		str += '> </embed>';
    }

    document.write(str);
}

function AC_FL_RunContent(){
  var ret = 
    AC_GetArgs
    (  arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
     , "application/x-shockwave-flash"
    );
  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
}

function AC_GetArgs(args, ext, srcParamName, classid, mimeType){
  var ret = new Object();
  ret.embedAttrs = new Object();
  ret.params = new Object();
  ret.objAttrs = new Object();
  for (var i=0; i < args.length; i=i+2){
    var currArg = args[i].toLowerCase();    

    switch (currArg){	
      case "classid":
        break;
      case "pluginspage":
        ret.embedAttrs[args[i]] = args[i+1];
        break;
      case "src":
      case "movie":	
        args[i+1] = AC_AddExtension(args[i+1], ext);
        ret.embedAttrs["src"] = args[i+1];
        ret.params[srcParamName] = args[i+1];
        break;
      case "onafterupdate":
      case "onbeforeupdate":
      case "onblur":
      case "oncellchange":
      case "onclick":
      case "ondblClick":
      case "ondrag":
      case "ondragend":
      case "ondragenter":
      case "ondragleave":
      case "ondragover":
      case "ondrop":
      case "onfinish":
      case "onfocus":
      case "onhelp":
      case "onmousedown":
      case "onmouseup":
      case "onmouseover":
      case "onmousemove":
      case "onmouseout":
      case "onkeypress":
      case "onkeydown":
      case "onkeyup":
      case "onload":
      case "onlosecapture":
      case "onpropertychange":
      case "onreadystatechange":
      case "onrowsdelete":
      case "onrowenter":
      case "onrowexit":
      case "onrowsinserted":
      case "onstart":
      case "onscroll":
      case "onbeforeeditfocus":
      case "onactivate":
      case "onbeforedeactivate":
      case "ondeactivate":
      case "type":
      case "codebase":
        ret.objAttrs[args[i]] = args[i+1];
        break;
      case "id":
      case "width":
      case "height":
      case "align":
      case "vspace": 
      case "hspace":
      case "class":
      case "title":
      case "accesskey":
      case "name":
      case "tabindex":
        ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
        break;
      default:
        ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
    }
  }
  ret.objAttrs["classid"] = classid;
  if (mimeType) ret.embedAttrs["type"] = mimeType;
  return ret;
}

// This function returns the appropriate reference,
// depending on the browser.
function getFlexApp(appName)
{
	if (navigator.appName.indexOf ("Microsoft") !=-1)
	{
	   return window[appName];
	}
	else
	{
	   return document[appName];
	}
}

// Drop down sliding menus
// (c) MAC 2010
ddPar = {
	MO_DEL : 300, // mouseout delay
	MV_DEL : 200, // mouseover delay
	PPF : 15, // pixel movement per frame
	ADJ:25,	// adjust position from menu
	GDN:1,	//"going down"
	GUP:-1	//"going up"
};
var dropDs={currD:null};
var dropD=function(om){
	var e=om.getElementsByTagName("div");
	var pcn="sub_nav";
	this.id=om.id;
	this.pos=findPos(om);
	this.intT=this.timH=this.timS=null;	//interval timer, hide/show timeout
	this.mm=ddPar.GUP*2;	// closed
	
	for (var item=0;item<e.length;item++){
		if (e[item].className==pcn){
			this.dd=e[item];
			break;
		}
	}
	if (this.dd!="undefined"){
		var oSnf=document.getElementById(pcn+"_frame");
		this.h=this.dd.offsetHeight;
		oSnf.appendChild(this.dd);
		this.dd.id="sub_"+this.id;
		this.dd.style.display="none";		
		this.dd.style.left=this.pos[0]-1+"px";
		this.dd.style.top=this.pos[1]-this.h+ddPar.ADJ+"px";
		this.dd.style.visibility="inherit";
		var id=this.id, delay=ddPar.MO_DEL/3;
		this.dd.onmouseover=function(){dropD.onMouseOver(id);};
		this.dd.onmouseout=function(){dropD.onMouseOut(id,delay);};
		om.onmouseout=function(){dropD.onMouseOut(id);};
		om.onclick=function(){dropD.onClick(id);};
		// disable links for shopping cart page 2
		if (location.href.indexOf("/membership/")!=-1 && location.href.search(/profile.php|member.php|sign-up.php|history.php|progress.php|multi-user/)==-1){
			var a = this.dd.getElementsByTagName('a'); 
			for (item=0;item<a.length;item++)
				a[item].removeAttribute("href");
			a = document.getElementById('nav_home').getElementsByTagName('a');
			a[0].removeAttribute("href");
		}
	}

	this.clearTo=function(){
		clearTimeout(this.timS);clearTimeout(this.timH);	// remove pending show/hide 
	}

	this.dDown=function(d){
		this.clearTo();
        this.pos=findPos(om);
        if (d==ddPar.GDN){
			var dwb=document.width;	// get doc width before dd show 
			this.dd.style.display='';	// enable dd width
			if (this.pos[0]+this.dd.offsetWidth>dwb){
				this.dd.style.left=this.pos[0]-(this.dd.offsetWidth-om.offsetWidth)+"px";
			}else{
				this.dd.style.left=this.pos[0]-1+"px";
			}
		}
		
		var dir=this.mm/Math.abs(this.mm);	// whether running or finished
		if (dir==d) return;			// same direction
		clearInterval(this.intT); 	// in case going the other way
		this.mm=d;
		this.dd.style.zIndex=String(2+(1+d)/2);
		this.slide();
	}

	this.slide=function(){
		var p=this.pos[1]+ddPar.ADJ;var o=this;
		this.intT=setInterval(function(){slide(o,p)},20);
	}
	
}
dropD.onMouseOver=function(id){
	var dd=dropDs[id];
	if (dd.mm==ddPar.GUP){
		dd.dDown(ddPar.GDN);
	} else {
		dd.clearTo();
	}
	document.getElementById(id).className="hover";
}
dropD.onMouseOut=function(id,d){
	var dd=dropDs[id];
	var delay=(d==null) ? ddPar.MO_DEL : d;
	dd.clearTo();
	dd.timH=setTimeout("dropDs."+id+".dDown("+ddPar.GUP+")",delay);
	document.getElementById(id).className="";
}
dropD.onClick=function(id){
	var dd=dropDs[id];
	if (dd==null)
		return;
	var s=Math.abs(dd.mm);
	dd.dDown(-dd.mm/s);
}

function ddShow(ol){
	if (dropDs[ol.id]==null)
		dropDs[ol.id]=new dropD(ol);

	var dd=dropDs[ol.id];
	var dc=dropDs.currD;
	if (dc && dc!=dd)
		dc.dDown(ddPar.GUP);

	dropDs.currD=dd;
	//dd.dDown(ddPar.GDN);
	dd.clearTo();
	dd.timS=setTimeout("dropDs."+ol.id+".dDown("+ddPar.GDN+")",ddPar.MV_DEL);
}
function ddHide(ol){
	var dd=dropDs[ol.id];
	dd.clearTo();
	dd.timH=setTimeout("dropDs."+ol.id+".dDown("+ddPar.GUP+")",ddPar.MO_DEL);
}
function slide(s,p){
	var ot=s.dd.offsetTop;
	if((p-ot)*s.mm<=ddPar.PPF+(s.mm-1)*s.h/2){
		s.dd.style.top = p-((1-s.mm)*s.h/2)+'px';
		clearInterval(s.intT);
		if (s.mm==ddPar.GUP)
			s.dd.style.display='none';
		s.mm=s.mm*2;	// completed up or down
	} else {
		s.dd.style.top=ot+s.mm*ddPar.PPF+'px';
	}
}
function findPos(obj){
	var curleft = curtop = 0;
	if (obj.offsetParent){
		do {
			curleft += obj.offsetLeft;
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
		return [curleft,curtop];
	}
}
function addEvent(el, eType, fn, uC) {
   if (el.addEventListener) {
      el.addEventListener(eType, fn, uC);
      return true;
   } else if (el.attachEvent) {
      return el.attachEvent('on' + eType, fn);
   } else {
      el['on' + eType] = fn;
   }
} 
function stopProp(e) {
   if (e && e.stopPropagation) e.stopPropagation();
   else if (window.event && window.event.cancelBubble)
      window.event.cancelBubble = true;
}
function stopDef(e) {
   if (e &&e.preventDefault) e.preventDefault();
   else if (window.event && window.event.returnValue)
      window.event.returnValue = false;
} 
function mPos(e,xy) {
   if (window.event){
      if (xy=='x') return window.event.clientX;
      else return window.event.clientY;
   }else if (e){
      if (xy=='x') return e.clientX;
      else return e.clientY;
   }
}

var SCROLLTIMER = 3;
var SCROLLSPEED = 3;
// handles manual scrolling of the content //
function scrollContent(btn,dir) {
   btn.style.backgroundColor='#ffffe5';
   var ul=btn.parentNode.getElementsByTagName('ul');
  var div = ul[0];
  clearInterval(div.timer);
  var limit;
  if(dir == -1) {
    limit = 0;
  } else {
     limit = div.offsetHeight - div.parentNode.offsetHeight + 5;
  }
  div.timer = setInterval( function() { scrollAnimate(div,dir,limit) }, SCROLLTIMER);
  if (div.offsetHeight>div.parentNode.offsetHeight){
     btn=(dir<1)?'scrollBot':'scrollTop';
     scrollBtn(btn,div,true);
  }
}

function scrollAnimate(div,dir,limit) {
  div.style.top = div.style.top || '0px';
  var top = div.style.top.replace('px','');
  if(dir == 1) {
	if(limit - Math.abs(top) <= SCROLLSPEED) {
	  scrollLimit(div,dir);
	  div.style.top = '-' + limit + 'px';
	} else {
	  div.style.top = top - SCROLLSPEED + 'px';
	}
  } else {
	if(Math.abs(top) - limit <= SCROLLSPEED) {
	  scrollLimit(div,dir);
	  div.style.top = limit + 'px';
	} else {
	  div.style.top = parseInt(top) + SCROLLSPEED + 'px';
	}
  }
   top=Math.abs(parseInt(div.style.top));
   div.style.clip = 'rect('+top+'px,184px,'+(269+top)+'px,0px)';
}

function scrollLimit(div,dir){
   clearTimeout(div.timer);
   var btn=(dir==1)?'scrollBot':'scrollTop';
   scrollBtn(btn,div,false);
}
function scrollBtn(btn,div,enable){
   var divs=div.parentNode.parentNode.childNodes;
   var zi=(enable)?'14':'9';
   for (i=0;i<divs.length;i++){
      if (divs[i].nodeType==1){
         if (divs[i].className==btn) divs[i].style.zIndex=zi;
      }
   }
}

// cancel the scrolling on mouseout //
function cancelScroll(btn) {
   btn.style.backgroundColor='';
   var ul=btn.parentNode.getElementsByTagName('ul');
   var div = ul[0];
   clearTimeout(div.timer);
}

// popout for signup footer links
function popout(te,ev) {
   whref=te.getAttribute('href');
   wname=te.getAttribute('title').replace(/ /,'_');
   window.open(whref,wname,'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=1024');
   stopDef(ev);
   return false;
}
