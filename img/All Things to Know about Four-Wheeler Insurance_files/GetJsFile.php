var VizuryNotificationObject=VizuryNotificationObject||{NotificationOpen:"true",IframeEle:null,IframeBottom:null,ContainerHtmlId:"vizury-notification-container",cookie:null,advid:null,ImpressionLogUrl:"https://us-ax.lemnisk.co/Impression?",TemplateId:null,flag:true,OnsiteBlurHtmlId:"vizury-notification-blur",OnsiteBlurEnabled:false,OriginalDimension:{},topPositions:[0,1,8],bottomPositions:[2,3,6],edgePositions:[5,6,7,8],responsiveConfig:{maxIfameWidth:0.8,maxIfameHeight:0.8,minimizedImageMaxWidth:0.4,minimizedImageMaxHeight:0.4,additionalIframeSizeForIcons:0.06,minimizedImageStaticStyle:"min-width:unset;min-height:unset;max-width:unset;max-height:unset;"},reset:function(){VizuryNotificationObject.NotificationOpen="true";},createDivElementLocal:function(a){VizuryNotificationObject.reset();VizuryNotificationObject.SetDivContent(a);},createDivElement:function(){var a=document.createElement("div");a.id=VizuryNotificationObject.ContainerHtmlId;document.body.appendChild(a);VizuryNotificationObject.makeAjaxCallStyle();},createDivElementSinglePage:function(){var b=document.getElementById(VizuryNotificationObject.ContainerHtmlId);if(b){b.innerHTML="";}else{var a=document.createElement("div");a.id=VizuryNotificationObject.ContainerHtmlId;document.body.appendChild(a);}VizuryNotificationObject.makeAjaxCallStyle();},openTargetLink:function(c){var a=VizuryNotificationObject.ImpressionLogUrl+"click";VizuryNotificationObject.makeAjaxCall(a,"false");var b=window.open(c,"_blank");b.focus();},makeAjaxCallIE:function(b,a){xdr=new XDomainRequest();xdr.onload=function(){var c=xdr.responseText;if(c.length>0&&a==="true"){VizuryNotificationObject.SetDivContent(c);}};xdr.open("GET",b,true);xdr.send();},makeAjaxCall:function(b,a){var c;var d=window.XDomainRequest?true:false;if(d==true){VizuryNotificationObject.makeAjaxCallIE(b,a);}else{try{c=new XMLHttpRequest();}catch(f){try{c=new ActiveXObject("Msxml2.XMLHTTP");}catch(f){try{c=new ActiveXObject("Microsoft.XMLHTTP");}catch(f){return false;}}}c.onreadystatechange=function(){if(c.readyState==4){var e=c.responseText;if(e.length>0&&a==="true"){VizuryNotificationObject.SetDivContent(e);}}};c.open("GET",b,true);c.withCredentials=true;c.send();}},getAdvid:function(){var a=pixel.detectCampaign();var b=a.substring(6,a.length);return b;},getImpressionId:function(){var b=new Date().getUTCMilliseconds();var a=Math.floor(100000000+Math.random()*900000000);var c=VizuryNotificationObject.cookie+b.toString()+a.toString();return c;},DetectUserAgent:function(){var c=navigator.userAgent,a;var b=c.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i)||[];if(/trident/i.test(b[1])){a=/\brv[ :]+(\d+)/g.exec(c)||[];return"IE"+(a[1]||"");}if(b[1]==="Chrome"){a=c.match(/\bOPR\/(\d+)/);if(a!=null){return"Opera"+a[1];}}b=b[2]?[b[1],b[2]]:[navigator.appName,navigator.appVersion,"-?"];if((a=c.match(/version\/(\d+)/i))!=null){b.splice(1,1,a[1]);}return b[0]+b[1];},DetectMobileOrDesktop:function(){if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){return"Mobile";}else{return"Desktop";}},CreateLogUrl:function(){var a=encodeURIComponent(window.location.href);var b=VizuryNotificationObject.IframeEle.contentWindow.requestId;var c="DmpId="+b+"&Id="+VizuryNotificationObject.IframeEle.contentWindow.id+"&vizid="+VizuryNotificationObject.cookie+"&force_adv_id=VIZVRM"+VizuryNotificationObject.advid+"&segid="+VizuryNotificationObject.IframeEle.contentWindow.segid+"&label="+VizuryNotificationObject.IframeEle.contentWindow.label+"&am="+VizuryNotificationObject.IframeEle.contentWindow.am+"&ie="+VizuryNotificationObject.IframeEle.contentWindow.ie+"&mr="+VizuryNotificationObject.IframeEle.contentWindow.mr+"&channelid="+VizuryNotificationObject.IframeEle.contentWindow.channelid+"&url="+a+"&pos="+VizuryNotificationObject.IframeEle.contentWindow.position+"&UserAgent="+VizuryNotificationObject.DetectUserAgent()+"&action=";VizuryNotificationObject.ImpressionLogUrl=VizuryNotificationObject.ImpressionLogUrl+c;},fetchAnalyzeParameters:function(){var c=["osn","page","user","fp2","prod","pname","online","appno","leadid","subprod","src","dest","doj","rd","ad","ch","inf","PageName","FlightCabin","FlightType","droppage"];var b={};for(var a in c){if(pixel.paramArray[c[a]]){b[c[a]]=pixel.paramArray[c[a]];}}b.deviceType=VizuryNotificationObject.DetectMobileOrDesktop();return encodeURIComponent(JSON.stringify(b));},isFirstTime:function(){return pixel.paramArray.ftu?"&ftu=1":"";},getUTMparams:function(){var b=new RegExp("(?:\\?|&)(utm_[^=]+)=(.*?)(?=&|$)","gi");var c={},a;while((a=b.exec(document.URL))!=null){c[a[1]]=a[2];}if(Object.keys(c).length>0){return"&data="+encodeURIComponent(JSON.stringify(c));}else{return"";}},makeAjaxCallStyle:function(){var a=encodeURIComponent(window.location.href);VizuryNotificationObject.cookie=pixel.getCookie("_vz");VizuryNotificationObject.advid=VizuryNotificationObject.getAdvid();VizuryNotificationObject.ImpressionLogUrl=VizuryNotificationObject.getEndpoint()+"Impression?";var c=VizuryNotificationObject.fetchAnalyzeParameters();var d=VizuryNotificationObject.getUTMparams();var e=VizuryNotificationObject.isFirstTime();var b=VizuryNotificationObject.getEndpoint()+"GetContent?vizid="+VizuryNotificationObject.cookie+"&force_adv_id=VIZVRM"+VizuryNotificationObject.advid+"&url="+a+"&analyze_params="+c+e+d;VizuryNotificationObject.makeAjaxCall(b,"true");},SetDivContent:function(b){var a=b.split("<delimiter>");var c=document.getElementById(VizuryNotificationObject.ContainerHtmlId);c.innerHTML=a[0];VizuryNotificationObject.SetIframeContent(a[1]);document.getElementById("vizury-notification-template").style.visibility="hidden";VizuryNotificationObject.CheckDeliveryWindow();},AdjustImageSize:function(){var a,b,e,d;if(VizuryNotificationObject.IframeEle.contentWindow.window.hasOwnProperty("BannerJson")){var f=VizuryNotificationObject.IframeEle.contentWindow.position;if(~VizuryNotificationObject.topPositions.indexOf(f)){VizuryNotificationObject.IframeEle.style.bottom="0px";}else{if(~VizuryNotificationObject.bottomPositions.indexOf(f)){VizuryNotificationObject.IframeEle.style.top="0px";}}var c=setInterval(function(){var h=null;var g=VizuryNotificationObject.IframeEle.contentDocument.getElementById("container-div");if(g&&g.innerHTML!==""){var j=VizuryNotificationObject.IframeEle.contentDocument.getElementsByClassName("product");j=j.length?j[0]:undefined;if(j){h=j.getElementsByTagName("img").length?j.getElementsByTagName("img")[0]:undefined;}if(h&&parseInt(j.offsetWidth)>0&&parseInt(j.offsetHeight)>0){var i=new Image();i.onload=function(){VizuryNotificationObject.ToggleOnsiteBlur(true,true);VizuryNotificationObject.CallImpressionLogger();VizuryNotificationObject.IframeEle.style.display="block";g.style.height=parseInt(j.offsetHeight).toString()+"px";g.style.width=parseInt(j.offsetWidth).toString()+"px";if(VizuryNotificationObject.TemplateId>10&&VizuryNotificationObject.TemplateId!=14&&VizuryNotificationObject.TemplateId!=15){var l=document.getElementById("AnchorText-23").getElementsByTagName("img")[0];var m=document.getElementById("AnchorText-01").getElementsByTagName("img")[0];if(~VizuryNotificationObject.edgePositions.indexOf(f)){e=parseInt(i.naturalHeight)+4;d=parseInt(i.naturalWidth)+4;}else{a=parseInt(i.naturalHeight);b=parseInt(i.naturalWidth);var n=b>a?a:b;e=a+(VizuryNotificationObject.responsiveConfig.additionalIframeSizeForIcons*n)+5,d=b+(VizuryNotificationObject.responsiveConfig.additionalIframeSizeForIcons*n)+5;}VizuryNotificationObject.OriginalDimension={notWidth:d,notHeight:e,minzed1Width:m.naturalWidth,minzed1Height:m.naturalHeight,minzed2Width:l.naturalWidth,minzed2Height:l.naturalHeight};var k=VizuryNotificationObject.getIframeDimensions();e=k.notHeight;d=k.notWidth;if(l){l.parentNode.style=VizuryNotificationObject.responsiveConfig.minimizedImageStaticStyle+"width:"+k.minzed2Width.toString()+"px;height:"+k.minzed2Height.toString()+"px;";}if(m){m.parentNode.style=VizuryNotificationObject.responsiveConfig.minimizedImageStaticStyle+"width:"+k.minzed1Width.toString()+"px;height:"+k.minzed1Height.toString()+"px;";}VizuryNotificationObject.IframeEle.style.height=(e).toString()+"px";VizuryNotificationObject.IframeEle.style.width=(d).toString()+"px";VizuryNotificationObject.IframeBottom="-"+(e).toString()+"px";VizuryNotificationObject.IframeRight="-"+(d).toString()+"px";VizuryNotificationObject.attachWindowEventListeners();}else{if(~VizuryNotificationObject.edgePositions.indexOf(f)){VizuryNotificationObject.IframeEle.style.height=(parseInt(j.offsetHeight)+4).toString()+"px";VizuryNotificationObject.IframeEle.style.width=(parseInt(j.offsetWidth)+4).toString()+"px";VizuryNotificationObject.IframeBottom="-"+(parseInt(j.offsetHeight)+4).toString()+"px";VizuryNotificationObject.IframeRight="-"+(parseInt(j.offsetWidth)+4).toString()+"px";}else{VizuryNotificationObject.IframeEle.style.height=(parseInt(j.offsetHeight)+26).toString()+"px";VizuryNotificationObject.IframeEle.style.width=(parseInt(j.offsetWidth)+21).toString()+"px";VizuryNotificationObject.IframeBottom="-"+(parseInt(j.offsetHeight)+26).toString()+"px";VizuryNotificationObject.IframeRight="-"+(parseInt(j.offsetWidth)+21).toString()+"px";}}VizuryNotificationObject.IframeEle.contentDocument.getElementById("container-div").style.border="";document.getElementById("vizury-notification-template").style.visibility="visible";VizuryNotificationObject.OpenMaximizedOrMinimized();};i.src=h.src;clearInterval(c);}}},200);}else{VizuryNotificationObject.ToggleOnsiteBlur(true,true);VizuryNotificationObject.CallImpressionLogger();var a=VizuryNotificationObject.IframeEle.contentWindow.height;var b=VizuryNotificationObject.IframeEle.contentWindow.width;var e=parseInt(a)+26;var d=parseInt(b)+21;VizuryNotificationObject.IframeEle.style.height=e.toString()+"px";VizuryNotificationObject.IframeEle.style.width=d.toString()+"px";VizuryNotificationObject.IframeBottom="-"+e.toString()+"px";var f=VizuryNotificationObject.IframeEle.contentWindow.position;if(f===0||f===1){VizuryNotificationObject.IframeEle.style.bottom=VizuryNotificationObject.IframeBottom;}else{if(f===2||f===3){VizuryNotificationObject.IframeEle.style.top=VizuryNotificationObject.IframeBottom;}}}},getIframeDimensions:function(){var e,a={notWidth:VizuryNotificationObject.OriginalDimension.notWidth,notHeight:VizuryNotificationObject.OriginalDimension.notHeight,minzed1Width:VizuryNotificationObject.OriginalDimension.minzed1Width,minzed1Height:VizuryNotificationObject.OriginalDimension.minzed1Height,minzed2Width:VizuryNotificationObject.OriginalDimension.minzed2Width,minzed2Height:VizuryNotificationObject.OriginalDimension.minzed2Height};if(a.notWidth>window.innerWidth*VizuryNotificationObject.responsiveConfig.maxIfameWidth||a.notHeight>window.innerHeight*VizuryNotificationObject.responsiveConfig.maxIfameHeight){var d=a.notHeight/a.notWidth;if(a.notHeight>window.innerHeight*VizuryNotificationObject.responsiveConfig.maxIfameHeight){a.notHeight=window.innerHeight*VizuryNotificationObject.responsiveConfig.maxIfameHeight;a.notWidth=a.notHeight/d;}if(a.notWidth>window.innerWidth*VizuryNotificationObject.responsiveConfig.maxIfameWidth){a.notWidth=window.innerWidth*VizuryNotificationObject.responsiveConfig.maxIfameWidth;a.notHeight=a.notWidth*d;}}if(!(a.minzed1Height&&a.minzed1Width)){var c=document.getElementById("AnchorText-01").getElementsByTagName("img")[0];if(c.naturalHeight){a.minzed1Height=c.naturalHeight;}if(c.naturalWidth){a.minzed1Width=c.naturalWidth;}}if(!(a.minzed2Height&&a.minzed2Width)){var b=document.getElementById("AnchorText-23").getElementsByTagName("img")[0];if(b.naturalHeight){a.minzed2Height=b.naturalHeight;}if(b.naturalWidth){a.minzed2Width=b.naturalWidth;}}if(a.minzed1Width&&a.minzed1Height){e=a.minzed1Height/a.minzed1Width;if(a.minzed1Width>a.notWidth*VizuryNotificationObject.responsiveConfig.minimizedImageMaxWidth){a.minzed1Width=a.notWidth*VizuryNotificationObject.responsiveConfig.minimizedImageMaxWidth;a.minzed1Height=a.minzed1Width*e;}if(a.minzed1Height>a.notHeight*VizuryNotificationObject.responsiveConfig.minimizedImageMaxHeight){a.minzed1Height=a.notHeight*VizuryNotificationObject.responsiveConfig.minimizedImageMaxHeight;a.minzed1Width=a.minzed1Height/e;}}if(a.minzed2Width&&a.minzed2Height){e=a.minzed2Height/a.minzed2Width;if(a.minzed2Width>a.notWidth*VizuryNotificationObject.responsiveConfig.minimizedImageMaxWidth){a.minzed2Width=a.notWidth*VizuryNotificationObject.responsiveConfig.minimizedImageMaxWidth;a.minzed2Height=a.minzed2Width*e;}if(a.minzed2Height>a.notHeight*VizuryNotificationObject.responsiveConfig.minimizedImageMaxHeight){a.minzed2Height=a.notHeight*VizuryNotificationObject.responsiveConfig.minimizedImageMaxHeight;a.minzed2Width=a.minzed2Height/e;}}return a;},attachWindowEventListeners:function(){var b=[{event:"resize",handler:VizuryNotificationObject.handleOnResizeEvent},{event:"orientationchange",handler:VizuryNotificationObject.handleOnResizeEvent}];for(var a=0;a<b.length;a++){window.addEventListener(b[a].event,b[a].handler,false);}},handleOnResizeEvent:function(){var a,d=VizuryNotificationObject.IframeEle;if(d&&d.contentWindow){a=VizuryNotificationObject.getIframeDimensions();d.setAttribute("width",a.notWidth);d.setAttribute("height",a.notHeight);d.style.width=a.notWidth.toString()+"px";d.style.height=a.notHeight.toString()+"px";var b=document.getElementById("AnchorText-23");var c=document.getElementById("AnchorText-01");if(b){b.style.width=a.minzed2Width.toString()+"px";b.style.height=a.minzed2Height.toString()+"px";}if(c){c.style.width=a.minzed1Width.toString()+"px";c.style.height=a.minzed1Height.toString()+"px";}VizuryNotificationObject.IframeBottom="-"+a.notHeight.toString()+"px";VizuryNotificationObject.IframeRight="-"+a.notWidth.toString()+"px";if("true"!=VizuryNotificationObject.NotificationOpen){if(~VizuryNotificationObject.topPositions.indexOf(VizuryNotificationObject.IframeEle.contentWindow.position)){VizuryNotificationObject.IframeEle.style.bottom=VizuryNotificationObject.IframeBottom;}else{if(~VizuryNotificationObject.bottomPositions.indexOf(VizuryNotificationObject.IframeEle.contentWindow.position)){VizuryNotificationObject.IframeEle.style.top=VizuryNotificationObject.IframeBottom;}else{if(VizuryNotificationObject.IframeEle.contentWindow.position==7){VizuryNotificationObject.IframeEle.style.left=VizuryNotificationObject.IframeRight;}else{if(VizuryNotificationObject.IframeEle.contentWindow.position==5){VizuryNotificationObject.IframeEle.style.right=VizuryNotificationObject.IframeRight;}}}}}}else{VizuryNotificationObject.resizeTimer=setTimeout(function(){VizuryNotificationObject.handleOnResizeEvent();},500);}},OpenMaximizedOrMinimized:function(){var a=VizuryNotificationObject.IframeEle.contentWindow.initialState;if(a===1){VizuryNotificationObject.ForceToggle();}},ForceToggle:function(){var b=b||VizuryNotificationObject.IframeEle.contentWindow.position;var a=VizuryNotificationObject.GetAnchorText(b);VizuryNotificationObject.AlignMinimizeForCenterPositions(b);VizuryNotificationObject.ForceDirectionHide(VizuryNotificationObject.IframeEle,b);VizuryNotificationObject.NotificationOpen="false";},InitialPosition:function(){var a=VizuryNotificationObject.IframeEle.contentWindow.position;if(a===0||a===1){VizuryNotificationObject.IframeEle.style.bottom=VizuryNotificationObject.IframeBottom;}else{if(a===2||a===3){VizuryNotificationObject.IframeEle.style.top=VizuryNotificationObject.IframeBottom;}}},CloseOrMinimize:function(){var b=VizuryNotificationObject.IframeEle;var a=a||b.contentWindow.CloseOrMinimize;if(VizuryNotificationObject.IframeEle.contentWindow.position===4){b.contentDocument.getElementById("div-minimise").style.display="none";b.contentDocument.getElementById("div-close").style.display="block";}else{if(a===0){b.contentDocument.getElementById("div-minimise").style.display="none";b.contentDocument.getElementById("div-close").style.display="block";}else{if(a===1){b.contentDocument.getElementById("div-minimise").style.display="block";if(VizuryNotificationObject.TemplateId>10&&VizuryNotificationObject.TemplateId!=14&&VizuryNotificationObject.TemplateId!=15){b.contentDocument.getElementById("div-minimise").style.right="2vmin";}b.contentDocument.getElementById("div-close").style.display="none";}else{if(VizuryNotificationObject.TemplateId>10&&VizuryNotificationObject.TemplateId!=14&&VizuryNotificationObject.TemplateId!=15){b.contentDocument.getElementById("div-minimise").style.marginRight="2px";b.contentDocument.getElementById("div-minimise").style.right="12vmin";}else{b.contentDocument.getElementById("div-minimise").style.right="30px";}}}}},ShowMinimizeImageIcon:function(){var b=b||VizuryNotificationObject.IframeEle.contentWindow.position;var a=VizuryNotificationObject.GetAnchorText(b);parent.document.getElementById(a).style.visibility="visible";},transAnimationTopAndBottom:function(c,a,e,d){var b=setInterval(function(){c.style[a]=e+"px";if(d<0){e-=2;if(e<d){c.style[a]=d+"px";VizuryNotificationObject.ShowMinimizeImageIcon();clearInterval(b);}}else{e+=2;if(e>d){c.style[a]=d+"px";clearInterval(b);}}},1);},triggerNotiBottom:function(b,a){VizuryNotificationObject.transAnimationTopAndBottom(b,"bottom",a,0);},triggerNotiTop:function(b,a){VizuryNotificationObject.transAnimationTopAndBottom(b,"top",a,0);},ForceDirectionHide:function(a,b){switch(b){case 0:case 1:case 8:a.style.bottom=parseInt(VizuryNotificationObject.IframeBottom)+"px";break;case 2:case 3:case 6:a.style.top=parseInt(VizuryNotificationObject.IframeBottom)+"px";break;case 5:a.style.right=parseInt(VizuryNotificationObject.IframeRight)+"px";break;case 7:a.style.left=parseInt(VizuryNotificationObject.IframeRight)+"px";break;}VizuryNotificationObject.ShowMinimizeImageIcon();},AnimateDirectionHide:function(a,b){switch(b){case 0:case 1:case 8:VizuryNotificationObject.transAnimationTopAndBottom(a,"bottom",0,parseInt(VizuryNotificationObject.IframeBottom));break;case 2:case 3:case 6:VizuryNotificationObject.transAnimationTopAndBottom(a,"top",0,parseInt(VizuryNotificationObject.IframeBottom));break;case 5:VizuryNotificationObject.transAnimationTopAndBottom(a,"right",0,parseInt(VizuryNotificationObject.IframeRight));break;case 7:VizuryNotificationObject.transAnimationTopAndBottom(a,"left",0,parseInt(VizuryNotificationObject.IframeRight));break;}},AnimateDirectionShow:function(a,b){switch(b){case 0:case 1:case 8:VizuryNotificationObject.transAnimationTopAndBottom(a,"bottom",parseInt(VizuryNotificationObject.IframeBottom),0);break;case 2:case 3:case 6:VizuryNotificationObject.transAnimationTopAndBottom(a,"top",parseInt(VizuryNotificationObject.IframeBottom),0);break;case 5:VizuryNotificationObject.transAnimationTopAndBottom(a,"right",parseInt(VizuryNotificationObject.IframeRight),0);break;case 7:VizuryNotificationObject.transAnimationTopAndBottom(a,"left",parseInt(VizuryNotificationObject.IframeRight),0);break;}},GetAnchorText:function(b){var a;if(b==0||b==1||b==5||b==6||b==7||b==8){a="AnchorText-01";}else{a="AnchorText-23";}return a;},Toggle:function(){var c=c||VizuryNotificationObject.IframeEle.contentWindow.position;var a=VizuryNotificationObject.GetAnchorText(c);VizuryNotificationObject.AlignMinimizeForCenterPositions(c);if(VizuryNotificationObject.NotificationOpen=="true"){VizuryNotificationObject.AnimateDirectionHide(VizuryNotificationObject.IframeEle,c);VizuryNotificationObject.NotificationOpen="false";var b="";if(VizuryNotificationObject.TemplateId==1){b=VizuryNotificationObject.ImpressionLogUrl+"minimize";}else{b=VizuryNotificationObject.IframeEle.contentWindow.window.config.impressionLogUrl+"minimize";}VizuryNotificationObject.makeAjaxCall(b,"false");VizuryNotificationObject.ToggleOnsiteBlur(false,false);}else{VizuryNotificationObject.AnimateDirectionShow(VizuryNotificationObject.IframeEle,c);document.getElementById(a).style.visibility="hidden";VizuryNotificationObject.NotificationOpen="true";var b="";if(VizuryNotificationObject.TemplateId==1){b=VizuryNotificationObject.ImpressionLogUrl+"maximize";}else{b=VizuryNotificationObject.IframeEle.contentWindow.window.config.impressionLogUrl+"maximize";}VizuryNotificationObject.makeAjaxCall(b,"false");VizuryNotificationObject.ToggleOnsiteBlur(true,false);}if(VizuryNotificationObject.TemplateId>10&&VizuryNotificationObject.TemplateId!=14&&VizuryNotificationObject.TemplateId!=15){VizuryNotificationObject.handleOnResizeEvent();}},SetIframeContent:function(a){var b=document.getElementById("vizury-notification-template").contentWindow.document;b.open();b.write("<!DOCTYPE html>");b.write(a);b.close();VizuryNotificationObject.IframeEle=parent.document.getElementById("vizury-notification-template");VizuryNotificationObject.CreateLogUrl();},close:function(){document.getElementById("vizury-notification-template").style.display="none";var a="";if(VizuryNotificationObject.TemplateId==1){a=VizuryNotificationObject.ImpressionLogUrl+"close";}else{a=VizuryNotificationObject.IframeEle.contentWindow.window.config.impressionLogUrl+"close";}VizuryNotificationObject.makeAjaxCall(a,"false");VizuryNotificationObject.ToggleOnsiteBlur(false,false);},CheckDeliveryWindow:function(){var h=VizuryNotificationObject.IframeEle.contentWindow.From;var g=VizuryNotificationObject.IframeEle.contentWindow.To;var f=new Date();var a=f.getHours();var b=f.getMinutes();var e=h.split(":");var c=g.split(":");VizuryNotificationObject.IdentifyEvent();},CallImpressionLogger:function(){var a="";if(VizuryNotificationObject.TemplateId==1){a=VizuryNotificationObject.ImpressionLogUrl+"impression";}else{a=VizuryNotificationObject.IframeEle.contentWindow.window.config.impressionLogUrl+"impression";}VizuryNotificationObject.makeAjaxCall(a,"false");},CreateOnsiteBlurDiv:function(){if(VizuryNotificationObject.IframeEle.contentWindow.notificationBlur&&VizuryNotificationObject.IframeEle.contentWindow.notificationBlur.enabled==1&&VizuryNotificationObject.IframeEle.contentWindow.notificationBlur.color){VizuryNotificationObject.OnsiteBlurEnabled=true;var a=document.createElement("div");a.id=VizuryNotificationObject.OnsiteBlurHtmlId;document.getElementById("vizury-notification-container").appendChild(a);a.style="width: 100%; height: 100%; z-index: 199999970; position: fixed; top: 0; left: 0; opacity: 0.5";a.style.visibility="hidden";a.style.backgroundColor=VizuryNotificationObject.IframeEle.contentWindow.notificationBlur.color;}},ToggleOnsiteBlur:function(b,c){if(c&&VizuryNotificationObject.IframeEle.contentWindow.initialState===1){return;}if(VizuryNotificationObject.OnsiteBlurEnabled){var a=document.getElementById(VizuryNotificationObject.OnsiteBlurHtmlId);a.style.visibility=(b)?"visible":"hidden";}},IdentifyEvent:function(){VizuryNotificationObject.TemplateId=VizuryNotificationObject.IframeEle.contentWindow.Tid;var b=(VizuryNotificationObject.IframeEle.contentWindow.eventId)?VizuryNotificationObject.IframeEle.contentWindow.eventId:0;var a=VizuryNotificationObject.IframeEle.contentWindow.notifyTrigger;if(a){b=a.id;value=a.value;}VizuryNotificationObject.CreateOnsiteBlurDiv();switch(b){case 0:VizuryNotificationObject.ExecuteEvent();break;case 1:VizuryNotificationObject.ExitEvent();break;case 2:VizuryNotificationObject.ExecuteEvent(value);break;case 3:VizuryNotificationObject.ScrollEvent(value);break;default:VizuryNotificationObject.ExecuteEvent();break;}},PullPageDown:function(){var b=document.createElement("div");b.setAttribute("id","vizury-pulldown-div");b.style.height="50px";b.style.overflow="hidden";var a=document.getElementsByTagName("body")[0];a.insertBefore(b,a.firstChild);},PullPageUp:function(){var b=document.createElement("div");b.setAttribute("id","vizury-pullup-div");b.style.height="50px";b.style.overflow="hidden";var a=document.getElementsByTagName("body")[0];a.appendChild(b);},RenderStaticOnsiteNotification:function(a){VizuryNotificationObject.CloseOrMinimize();VizuryNotificationObject.AdjustImageSize();VizuryNotificationObject.InitialPosition();if(a===0||a===1){VizuryNotificationObject.triggerNotiBottom(VizuryNotificationObject.IframeEle,parseInt(VizuryNotificationObject.IframeBottom));}else{if(a===2||a===3){VizuryNotificationObject.triggerNotiTop(VizuryNotificationObject.IframeEle,parseInt(VizuryNotificationObject.IframeBottom));}}document.getElementById("vizury-notification-template").style.visibility="visible";},AlignMinimizeForCenterPositions:function(b){if(VizuryNotificationObject.TemplateId>10&&VizuryNotificationObject.TemplateId!=14&&VizuryNotificationObject.TemplateId!=15){return;}else{if(b===5||b===7){var a="translate(0%,-"+parseInt(VizuryNotificationObject.IframeEle.style.height)/2+"px)";document.getElementById("AnchorText-01").style.transform=a;}else{if(b===6||b===8){var a="translate(-"+parseInt(VizuryNotificationObject.IframeEle.style.width)/2+"px,0%)";document.getElementById("AnchorText-01").style.transform=a;}}}},ExecuteEvent:function(b){var a=b?b*1000:1;if(VizuryNotificationObject.IframeEle&&VizuryNotificationObject.IframeEle.contentWindow){var d=d||VizuryNotificationObject.IframeEle.contentWindow.position;var c=VizuryNotificationObject.IframeEle.contentWindow.eventId;switch(VizuryNotificationObject.TemplateId){case 1:case 3:if(VizuryNotificationObject.IframeEle.contentWindow.isActive){setTimeout(function(){VizuryNotificationObject.RenderStaticOnsiteNotification(d);},a);}break;case 6:setTimeout(function(){VizuryNotificationObject.CloseOrMinimize();VizuryNotificationObject.AdjustImageSize();},a);break;default:setTimeout(function(){VizuryNotificationObject.CloseOrMinimize();VizuryNotificationObject.AdjustImageSize();},a);break;}}},ExitEvent:function(){var e=document.documentElement;e.addEventListener("mouseleave",b);e.addEventListener("keydown",c);function b(f){if(f.clientY>20){return;}a();}var d=false;function c(f){if(d){return;}else{if(!f.metaKey||f.keyCode!==76){return;}}d=true;a();}function a(){if(VizuryNotificationObject.flag==true){VizuryNotificationObject.ExecuteEvent();VizuryNotificationObject.flag=false;}}},ScrollEvent:function(c){function b(h,f,g){if(h.addEventListener){h.addEventListener(f,g,false);}else{if(h.attachEvent){h.attachEvent("on"+f,g);}}}function e(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight||0;}function a(){return window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop||0;}function d(){return Math.max(document.body.scrollHeight||0,document.documentElement.scrollHeight||0,document.body.offsetHeight||0,document.documentElement.offsetHeight||0,document.body.clientHeight||0,document.documentElement.clientHeight||0);}b(window,"scroll",function(g){var f=((a()+e())/d())*100;if(f>c&&VizuryNotificationObject.flag==true){VizuryNotificationObject.ExecuteEvent();VizuryNotificationObject.flag=false;}});},getEndpoint:function(){return pixel.onsiteEndpoint?("https://"+pixel.onsiteEndpoint):"https://us-ax.lemnisk.co/";}};
