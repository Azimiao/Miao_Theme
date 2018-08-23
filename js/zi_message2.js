/**
 * 模仿ACFUN通知条
 * @authors 野兔 (admin@azimiao.com)
 * @date    2017-10-20 10:43:00
 * @modify  2018-08-20 10:00:00
 * @version 0.1.3
 */

var zi_notify = zi_notify || {};

zi_notify.ENotifyType = {
    nomal:-1,
    main:0,
    warning:1,
    cute:2,
    heavy:3
};

zi_notify.colorData = {
    green:{
        fontColor : "#FBFBFF",
	    mainColor : "#95ba12",
        borderColor : "#86a710"
    },
    red:{
        fontColor : "#FBFBFF",
	    mainColor : "#e74c3c",
	    borderColor : "#e43422"
    },
    blue:{
        fontColor : "#FBFBFF",
	    mainColor : "#055f95",
	    borderColor : "#055586"
    },
    pink:{
        fontColor : "#FBFBFF",
	    mainColor : "#f78fa7",
        borderColor : "#ff86a2"
    },
    main:{
        fontColor : "#FBFBFF",
	    mainColor : "#ff8c83",
        borderColor : "#fa8072"
    }
};



zi_notify.cssData = "./main.css";

//showNotify function code by qwq.moe 
zi_notify.showNotify = function(messageType = -1,messageContent = null){
    if(zi_notify.checkUserUA()){
        return;
    }
    if(document.querySelector('.notify-container') == null){
        var notify_container = new DOMParser().parseFromString('<div class="notify-container"></div>',"text/html").querySelector(".notify-container");
        document.body.insertBefore(notify_container,document.body.children[0]);
    }

    var ne = zi_notify.getContentDOM(messageType,messageContent);
    if(ne.length != 0){
        document.querySelector('.notify-container').appendChild(ne);
        setTimeout(function(){ne.remove()},4500);
    }
};

zi_notify.checkUserUA = function() {
    return (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent));
};

zi_notify.getContentDOM = function(messageType,messageContent){

    var colorTemp;
    var contentDom = {length:0};
    var domStr = "";

    if(messageContent == null && messageType == zi_notify.ENotifyType.main){
        messageContent = {title:"你好",content:"世界"};
    }else if(messageContent == null){
        console.log("messageContent is null");
        return contentDom;
    }

    switch(messageType){
        case "":case "undefined":case undefined :case null:case zi_notify.ENotifyType.nomal:
		{
            colorTemp = zi_notify.colorData.green;
			break;
        }
        case zi_notify.ENotifyType.heavy:
        {
            colorTemp = zi_notify.colorData.blue;
            break;
        }
        case zi_notify.ENotifyType.cute:
        {
            colorTemp = zi_notify.colorData.pink;
            break;

        }
        case zi_notify.ENotifyType.warning:
        {
            colorTemp = zi_notify.colorData.red;
            break;

        }
        case zi_notify.ENotifyType.main:
        {
            colorTemp = zi_notify.colorData.main;
            break;
        }
    }

    domStr = '<div class="notify" style="background-color: '+ colorTemp.mainColor + ';border-left: 7px solid '+ colorTemp.borderColor +';color: white;"><div class="title">'+ messageContent.title +'</div><div class="content" style= "color: '+ colorTemp.fontColor +';">'+ messageContent.content +'</div></div>';
    contentDom = new DOMParser().parseFromString(domStr,"text/html").querySelector(".notify");
    return contentDom;
};



/**
 * Minified by jsDelivr using UglifyJS v3.4.4.
 * Original file: /npm/js-cookie@2.2.0/src/js.cookie.js
 * 
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(e){var n=!1;if("function"==typeof define&&define.amd&&(define(e),n=!0),"object"==typeof exports&&(module.exports=e(),n=!0),!n){var o=window.Cookies,t=window.Cookies=e();t.noConflict=function(){return window.Cookies=o,t}}}(function(){function g(){for(var e=0,n={};e<arguments.length;e++){var o=arguments[e];for(var t in o)n[t]=o[t]}return n}return function e(l){function C(e,n,o){var t;if("undefined"!=typeof document){if(1<arguments.length){if("number"==typeof(o=g({path:"/"},C.defaults,o)).expires){var r=new Date;r.setMilliseconds(r.getMilliseconds()+864e5*o.expires),o.expires=r}o.expires=o.expires?o.expires.toUTCString():"";try{t=JSON.stringify(n),/^[\{\[]/.test(t)&&(n=t)}catch(e){}n=l.write?l.write(n,e):encodeURIComponent(String(n)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),e=(e=(e=encodeURIComponent(String(e))).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent)).replace(/[\(\)]/g,escape);var i="";for(var c in o)o[c]&&(i+="; "+c,!0!==o[c]&&(i+="="+o[c]));return document.cookie=e+"="+n+i}e||(t={});for(var a=document.cookie?document.cookie.split("; "):[],s=/(%[0-9A-Z]{2})+/g,f=0;f<a.length;f++){var p=a[f].split("="),d=p.slice(1).join("=");this.json||'"'!==d.charAt(0)||(d=d.slice(1,-1));try{var u=p[0].replace(s,decodeURIComponent);if(d=l.read?l.read(d,u):l(d,u)||d.replace(s,decodeURIComponent),this.json)try{d=JSON.parse(d)}catch(e){}if(e===u){t=d;break}e||(t[u]=d)}catch(e){}}return t}}return(C.set=C).get=function(e){return C.call(C,e)},C.getJSON=function(){return C.apply({json:!0},[].slice.call(arguments))},C.defaults={},C.remove=function(e,n){C(e,"",g(n,{expires:-1}))},C.withConverter=e,C}(function(){})});



//require js.cookie.min.js
var zi_welcome = zi_welcome || {};
zi_welcome.m_domain = "azimiao.com";
zi_welcome.siteData = [
    ["azimiao.com","梓喵出没"],
    ["baidu.com","百度"],
    ["bdimg.com","百度"],
    ["google","google"],
    ["qq.com","腾讯QQ"],
    ["xema07.pw","xema"],
    ["xema.ink","xema"],
    ["c0smx.com","c0smx"],
    ["xjh.me","岁月小筑"],
    ["canxi.cc","未满残曦"],
    ["bfdz.ink","bfdz"],
    ["weicn.org","WeiCN"],
    ["hd9990.tk","HD9990"],
    ["myloveru.cn","梦想博客"],
    ["skyblond.info","天空Blond"],
    ["himiku.com","MIKUSA"]
];

zi_welcome.setCookie = function(name,myRefer){
    console.log("setCookies");
    Cookies.set("username", escape(name),{path:"/",domain:zi_welcome.m_domain});
	Cookies.set("myRefer", escape(myRefer),{path:"/",domain:zi_welcome.m_domain});
}

zi_welcome.getWhereYouAre = function(allSiteData){
    if(!Array.isArray(allSiteData) || allSiteData.length <= 0){
        console.log("siteData error");
        return "未知网站";
    }
    if(document.referrer != "null" && document.referrer != "")
    {
    	for(var i = 0;i < allSiteData.length; i++)
    		{
    			if(document.referrer.indexOf(allSiteData[i][0]) != -1)
    			{
    				console.log(document.referrer);
    				return "来自"+ theWeb[i][1];
    			}
    		}
    	return "未知网站";
    }
    else
    {
    	return "直接访问";
    }
};

zi_welcome.checkCookie = function(){
    var username = Cookies.get("username");
	var refer = Cookies.get("myRefer");
	if(username != null && username != "")
	{
		console.log("读取到cookie");
        //nothing to do
	}
	else
	{
		console.log("准备设置cookie");
        username = "fangke";
        var _ref = zi_welcome.getWhereYouAre(zi_welcome.siteData);
		zi_welcome.setCookie(username,_ref);
        //弹出消息
        var tempContent = {
            title:"Welcome",
            content:"欢迎" + _ref + "的朋友!"
        };
        setTimeout(() => {
            zi_notify.showNotify(zi_notify.ENotifyType.main,tempContent);
        }, 1000);
        
	}
};

/**
 .messagebox {
	position: fixed;
	z-index: 99999;
	text-align: left;
	height: 24px;
	padding: 0 16px 0 4px;
	font-weight: bold;
	line-height: 24px;
	font-size: 13px;
	text-shadow: none;
	font-family: 'Helvetica Neue',Helvetica,Arial,STHeiti,'Microsoft Yahei',sans-serif;
	border-left: 4px solid "+MessageBox.borderColor+" !important;
	left: -150px;
	bottom: 90px;
	transition: left 0.6s;
	color: "+MessageBox.fontColor+";
	background-color: "+MessageBox.mainColor+";
	box-shadow: 0px 1px 1px #bcbcbc;
}

.messagebox:hover {
	left: -1px !important;
}
 */



 /*
<div class="notify" style="style">
    <div class="title">title</div>
    <div class="content">content</div>
</div>
*/

/*
.notify-container {
    position: fixed;
    display: flex;
    padding: 0;
    align-items: flex-end;
    flex-direction: column-reverse;
    width: 20vw;
    z-index: 11;
    pointer-events: none;
    transition: all 0.5s;
    height: 100vh;
    left: 0vw;
  }
  .notify-container .notify {
    background-color: rgba(15, 15, 15, 0.6);
    animation: notify-show-hide 5s ease-in-out;
    border-left: 7px solid rgba(0, 0, 0, 0.4);
    transition: all 0.5s;
    color: white;
    box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.15);
    margin-bottom: 15px;
    padding: 13px 15px;
    height: 72px;
  }
  .notify-container .notify .title {
    font-size: 1.1rem;
  }
  .notify-container .notify .content {
    margin-top: 5px;
    color: #eee;
    font-size: 0.85rem;
  }
  @keyframes notify-show-hide {
    0% {
      opacity: 0;
      transform: translate(100vw, 0);
      margin-bottom: 15px;
    }
    15% {
      opacity: 1;
      transform: translate(0, 0);
      margin-bottom: 15px;
    }
    85% {
      opacity: 1;
      transform: translate(0, 0);
      margin-bottom: 15px;
    }
    100% {
      opacity: 0;
      margin-bottom: -72px;
    }
  }


*/
