<!--
        Meta Tage
    ============================ -->
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="呼啦啦教育出版社">
	<meta name="keywords" content="慧教乐学,呼啦啦,教育,小学,中学,高中,宫菲,ExIdeaTech,huijiaolexue"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1"/>
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">

<!--
    Favicon
============================ -->
<link rel="shortcut icon" href="<?= base_url('assets/images/logo-icon.png') ?>" type="image/x-icon"/>

<title><?= $this->lang->line('frontend_title') ?></title>
<!--
    All Stylesheet Here
============================ -->

<!-- Style Sheets -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
<!-- Font Icons -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/frontend/vplayer.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
<link rel="stylesheet"
      href="<?= base_url('assets/admin/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') ?>">
<!-- Font Icons -->
<!--
    Custom Stylesheet
============================ -->

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/frontend/custom.css') ?>">
<script src="<?= base_url('assets/js/jquery-1.12.3.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/frontend/vplayer.js') ?>"></script>

<?php
$CONF = [
    "courseCnt" => 4,
    "coursewareCnt" => 52,
];

?>
<script type="text/javascript">
    var base_url = "<?= base_url() ?>";
    var baseURL = "<?= base_url() ?>";

    var CONF = {
        isRecording: false,
        coursewareCnt: parseInt("<?=$CONF['coursewareCnt']?>"),
        courseCnt: parseInt("<?=$CONF['courseCnt']?>"),
        tmrID: [],
        progress: 0,
        loginUserId: "<?= '' . $this->session->userdata('loginuserID')?>",
        loginUserSchoolId: "<?= '' . $this->session->userdata('user_school_id')?>"
    };
    function sendCommand2APP(cmmd, param) {
//            alert(cmmd);
        try {
            switch (cmmd) {
                case 'audiorecordstart':
                    window.location = 'audiorecordstart://1';
                    break;
                case 'audiorecordstop':
                    window.location = 'audiorecordstop://1';
                    break;
                case 'audioplay':
                    window.location = 'audioplay://1';
                    break;
                case 'audiostop':
                    window.location = 'audiostop://1';
                    break;
                case 'audiodownload':
                    window.location = 'audiodownload://1';
                    break;
                case 'camerastart':
                    window.location = 'camerastart://1';
                    break;
                case 'cameracapture':
                    window.location = 'cameracapture://1';
                    break;
            }
            alert(cmmd);
        } catch (e) {
            console.log(e.message);
        }
    }

    var isMobile = false;
    var osStatus = 'unknown';

    function getMobileOperatingSystem() {
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Windows Phone must come first because its UA also contains "Android"
        if (/windows phone/i.test(userAgent)) {
            return "Windows Phone";
        }
        if (/android/i.test(userAgent)) {
            return "Android";
        }
        // iOS detection from: http://stackoverflow.com/a/9039885/177710
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            return "iOS";
        }
        return "unknown";
    }

    osStatus = getMobileOperatingSystem();
    if (osStatus === 'Android' || osStatus === 'iOS') isMobile = true;

    if(!localStorage.getItem('session_info_id') && "<?= $this->session->userdata('loginuserID');?>"!=""){
        $.ajax({
            type: 'post',
            url: baseURL + 'apimobile/setLogin',
            dataType: 'json',
            data: JSON.stringify({type: (isMobile)?"mweb":"pcweb"}),
            success: function(result){
                console.log(result);
            },error: function(err){
                console.log(err);
            }
        })
    }
    localStorage.setItem('session_info_id',"<?= '' . $this->session->userdata('loginuserID')?>");
    function closeApp() {
        if (osStatus == 'Android') {

        } else if (osStatus == 'iOS') {

        }
        JavaFx.closeApp();
        console.log('Close requested');
    }

    function minimizeApp() {
        if (osStatus == 'Android') {

        } else if (osStatus == 'iOS') {

        }
        JavaFx.minimizeApp();
        console.log('Minimize requested');
    }
</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="<?= base_url('assets/js/jquery-2.2.3.min.js') ?>"></script>
<![endif]-->
<script>
    var initailHeight = $(window).height();
    var loginUserId = '<?=$this->session->userdata('loginuserID');?>';
    function getSessionUserInfo(){

    }
</script>