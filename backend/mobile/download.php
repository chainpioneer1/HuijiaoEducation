<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>下载慧教乐学移动端</title>
    <meta name="viewport" id="viewport"
          content="width=device-width, user-scalable=no, minimum-scale=1, maximum-scale=1"/>
    <meta name="apple-mobile-web-app-capable"/>
    <!--<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />-->
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

    <style>
        body {
            font-family: "Helvetica";
            padding: 0;
            margin: 0;
			overflow: hidden;
        }

        a {
            position: relative;
            display: inline-block;
            text-decoration: none;
            width: calc(14vh);
            height: calc(5.5vh);
            margin: 0 calc(6vh);
        }

        #btn11 {
            background: url(android.png);
            background-size: 100% 100% !important;
        }

        #btn12 {
            /*background: url(ios.png);*/
            background-size: 100% 100% !important;
        }

        a:hover {
            opacity: 0.8;
        }

        p {
            text-align: center;
            position: absolute;
            top: calc(75vh);
            left: 0;
            width: 100%;
            font-size: calc(2.5vh);
        }

        #btn20{
            position: absolute;
            top:88%;
            left:0;
            width:100%;
            height:12%;
            background:transparent;
        }

    </style>
</head>
<body style="background:black;">
<div syle="position:absolute;top:0;left:0;width:100%;height:100%;padding:0;margin:0;">
    <img src="bg.png"
         style="position:absolute; background:white;left:50%;top:0;transform:translateX(-50%);width:auto;height:calc(100vh);">
</div>
<p>
    <a href="http://qdzyxm.hulalaedu.com/mobile/huijiaolexue.apk" id="btn11" download="慧教乐学.apk"></a>
    <!--  <a href="#" onclick="installApp(2)" id="btn12" style=""></a> -->
    <!--    <a href="#" onclick="openApp();">启动应用程序</a> -->
</p>
<!--    <a href="https://qdzyxm.hulalaedu.com" id="btn20"></a>   -->
</body>

<script>
    var QueryString = function () {
        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [query_string[pair[0]], pair[1]];
                query_string[pair[0]] = arr;
            } else {
                query_string[pair[0]].push(pair[1]);
            }
        }
        return query_string;
    }();

    function installApp(id) {
        if (id == 2)
            location.href = "itms-services://?action=download-manifest&url=https://kebenju.hulalaedu.com/uploads/package/manifest.plist";
        else
            location.href = "http://qdzyxm.hulalaedu.com/mobile/huijiaolexue.apk";
    }

    function openApp() {

        var customSchemeURL = QueryString.customSchemeURL;
        var customParams = "";
        var separador = "";
        for (var key in QueryString) {
            if (["customSchemeURL", "storeURL"].indexOf(key) < 0) {
                customParams += separador + key + "=" + QueryString[key];
                separador = "&";
            }
        }
        var appURL = QueryString.customSchemeURL + "?" + customParams;
        appURL = "Student://?a=1";
//        window.location = appURL;
        var frame = document.createElement("iframe");
        frame.src = appURL;
        document.body.appendChild(frame);
//	    	document.location.href = appURL ;
        //alert("Opening URL: " + appURL) ;

    }

    function is_weixin() {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
        } else {
            return false;
        }
    }

    function DetectIOSDevice() {
        var uagent = navigator.userAgent.toLowerCase();
        if (uagent.search("iphone") > -1)
            return 'iphone';
        else if (uagent.search("ipad") > -1)
            return 'ipad';
        else if (uagent.search("ipod") > -1)
            return 'ipod';
        else
            return 'android';
    }
</script>

</html>
