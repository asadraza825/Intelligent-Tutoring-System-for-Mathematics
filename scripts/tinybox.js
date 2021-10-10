var TINY={};
var timerID = null, interID=null, divPPc=null, cntPP=0;

function InitializeTimer() {
	var oIface=T$('interface');
	if (oIface!=null){
	  var timerSecs = 45000;
	  if (navigator.userAgent.indexOf("Firefox/3.6") != -1) timerSecs=30000;
	  timerID = self.setTimeout("OnLoadSWF()", timerSecs);
	  cntPP=0;
	  interID = setInterval("CheckPP()",100);
	  var fhd_pos=getY(T$('flash_hdr'));
	  var ifc_pos=getY(oIface);
	  oIface.style.backgroundImage="url(/css/images/if-grad-top.jpg)";
	  oIface.style.backgroundRepeat="repeat-x";
	  oIface.style.backgroundPosition="0 "+String(fhd_pos-ifc_pos-48)+"px";
	}
}
function getY(oElement){
	var iReturnValue = 0;
	while( oElement != null ) {
	iReturnValue += oElement.offsetTop;
	oElement = oElement.offsetParent;
	}
	return iReturnValue;
}
function CheckPP(){
	if (T$("ppload")){
		clearInterval(interID);
		divPPc=document.createElement('div'); divPPc.id='pp_counter';
		divPPc.innerHTML=cntPP+'%';
		T$("ppload").appendChild(divPPc);
		interID = setInterval("FlashCounter()",1000);
	}
}
function FlashCounter() {
	cntPP=(cntPP<110)?Math.round(1+cntPP+4*Math.random()):0;
	divPPc.innerHTML=((cntPP>99)?99:cntPP)+'%';	// cap at 99 till it is >110
	if (navigator.userAgent.indexOf('Firefox/3.6')!=-1){
		divPPc.innerHTML+='<p>Please use Google Chrome for fastest load time.</p>';
	} else {
		divPPc.innerHTML+='<p>(If load time exceeds 15 seconds, please close and reopen browser)</p>';
	}
}
InitializeTimer();

function T$(i){return document.getElementById(i)}

function OnLoadSWF() {
	//T$('flash_cont').style.zIndex = '1';
	//T$('flash').style.backgroundImage = 'none';
	clearTimeout(timerID);
	clearInterval(interID);
	T$('ppload').style.display = 'none';
}

function OnErrorSWF(m) {
	//T$('flash_cont').style.zIndex = '-1';
	//T$('flash').style.backgroundImage = 'none';
	T$('ppload').style.backgroundImage = 'none';
	T$('ppload').style.display = 'block';
	T$('ppload').style.color = 'red';
	T$('ppload').innerHTML = m;
}

// dim the lights
function OnDim() {
   var id='dimMask';
   var ed=document.getElementById(id);
   var ef=document.getElementById('flash_cont');
   if (!ed){
      ed=document.createElement('div');ed.id=id;
      ed.style.position='absolute';ed.style.top='0';
      ed.style.backgroundColor='black';
      ed.style.display='none';ed.style.zIndex='101';
      if (navigator.appName.indexOf ("Microsoft") !=-1)
         ed.style.filter='alpha(opacity=52)';
      else
         ed.style.opacity='0.52';
      document.body.appendChild(ed);
      addEvent(ed,'click',OnDim);
   }
   ed.style.height=document.body.offsetHeight+'px';
   ed.style.width=document.body.offsetWidth+'px';
   if (ed.style.display=='none'){
      getFlexApp('educator').flexDimHandler(true);
      ef.style.zIndex='105';
      ed.style.display='block';
   } else {
      ef.style.zIndex='';
      ed.style.display='none';
      getFlexApp('educator').flexDimHandler(false);
   }
}

TINY.box=function(){
	var p,m,b,fn,ic,iu,iw,ih,ia,f=0,tl,ts;
	return{
		show:function(c,u,w,h,a,t){
			if(!f){
				p=document.createElement('div'); p.id='tinybox';
				m=document.createElement('div'); m.id='tinymask';
				b=document.createElement('div'); b.id='tinycontent';
				tl=document.createElement('div'); tl.id='tinyclose';
				ts=document.createElement('div'); ts.id='tinystart';
				tl.innerHTML='<a href="javascript:TINY.box.hide()">close</a>';
				ts.innerHTML='<img src="/images/preload.gif"> Loading...';
				document.body.appendChild(m); document.body.appendChild(p); p.appendChild(tl); p.appendChild(ts); p.appendChild(b);
				m.onclick=TINY.box.hide; window.onresize=TINY.box.resize; f=1
			}
			if(!a&&!u){
				p.style.width=w?w+'px':'auto'; p.style.height=h?h+'px':'auto';
				p.style.backgroundImage='none'; b.innerHTML=c
			}else{
				ts.style.display='block'; b.style.display='none'; p.style.width='580px'; p.style.height='270px'
			}
			this.mask();
			ic=c; iu=u; iw=w; ih=h; ia=a; this.alpha(m,1,80,3);
			if(t){setTimeout(function(){TINY.box.hide()},1000*t)}
		},
		fill:function(c,u,w,h,a){
			if(u){
				p.style.backgroundImage='';
				var x=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
				x.onreadystatechange=function(){
					if(x.readyState==4&&x.status==200){TINY.box.psh(x.responseText,w,h,a)}
				};
				x.open('GET',c,1); x.send(null)
			}else{
				this.psh(c,w,h,a)
			}
		},
		psh:function(c,w,h,a){
			if(a){
				if(!w||!h){
					var x=p.style.width, y=p.style.height; b.innerHTML=c;
					p.style.width=w?w+'px':''; p.style.height=h?h+'px':'';
					b.style.display='';
					w=parseInt(b.offsetWidth); h=parseInt(b.offsetHeight);
					b.style.display='none'; p.style.width=x; p.style.height=y;
				}else{
					b.innerHTML=c
				}
				this.size(p,w,h,4)
			}else{
				p.style.backgroundImage='none'
			}
		},
		hide:function(){
			TINY.box.alpha(p,-1,0,3)
		},
		resize:function(){
			TINY.box.pos(); TINY.box.mask()
		},
		mask:function(){
			m.style.height=TINY.page.theight()+'px';
			m.style.width=''; m.style.width=TINY.page.twidth()+'px'
		},
		pos:function(){
			var t=(TINY.page.height()/2)-(p.offsetHeight/2); t=t<10?10:t;
			p.style.top=(t+TINY.page.top())+'px';
			p.style.left=(TINY.page.width()/2)-(p.offsetWidth/2)+'px'
		},
		alpha:function(e,d,a,s){
			clearInterval(e.ai);
			if(d==1){
				e.style.opacity=0; e.style.filter='alpha(opacity=0)';
				e.style.display='block'; this.pos()
			}
			e.ai=setInterval(function(){TINY.box.twalpha(e,a,d,s)},20)
		},
		twalpha:function(e,a,d,s){
			var o=Math.round(e.style.opacity*100);
			if(o==a){
				clearInterval(e.ai);
				if(d==-1){
					e.style.display='none';
					e==p?TINY.box.alpha(m,-1,0,2):b.innerHTML=p.style.backgroundImage=''
				}else{
					e==m?this.alpha(p,1,100,5):TINY.box.fill(ic,iu,iw,ih,ia)
				}
			}else{
				var n=o+Math.ceil(Math.abs(a-o)/s)*d;
				e.style.opacity=n/100; e.style.filter='alpha(opacity='+n+')'
			}
		},
		size:function(e,w,h,s){
			e=typeof e=='object'?e:T$(e); clearInterval(e.si);
			var ow=e.offsetWidth, oh=e.offsetHeight,
			wo=ow-parseInt(e.style.width), ho=oh-parseInt(e.style.height);
			var wd=ow-wo>w?-1:1, hd=(oh-ho>h)?-1:1;
			e.si=setInterval(function(){TINY.box.twsize(e,w,wo,wd,h,ho,hd,s)},20)
		},
		twsize:function(e,w,wo,wd,h,ho,hd,s){
			var ow=e.offsetWidth-wo, oh=e.offsetHeight-ho;
			if(ow==w&&oh==h){
				clearInterval(e.si); p.style.backgroundImage='none'; ts.style.display='none'; b.style.display='block';
				p.style.height='auto'
			}else{
				if(ow!=w){e.style.width=ow+(Math.ceil(Math.abs(w-ow)/s)*wd)+'px'}
				if(oh!=h){e.style.height=oh+(Math.ceil(Math.abs(h-oh)/s)*hd)+'px'}
				this.pos()
			}
		}
	}
}();

TINY.page=function(){
	return{
		top:function(){return document.body.scrollTop||document.documentElement.scrollTop},
		width:function(){return self.innerWidth||document.documentElement.clientWidth},
		height:function(){return self.innerHeight||document.documentElement.clientHeight},
		theight:function(){
			var d=document, b=d.body, e=d.documentElement;
			return Math.max(Math.max(b.scrollHeight,e.scrollHeight),Math.max(b.clientHeight,e.clientHeight))
		},
		twidth:function(){
			var d=document, b=d.body, e=d.documentElement;
			return Math.max(Math.max(b.scrollWidth,e.scrollWidth),Math.max(b.clientWidth,e.clientWidth))
		}
	}
}();
