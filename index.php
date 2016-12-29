<?php
	require_once "jssdk.php";
	define("APP_ROOT", dirname(__FILE__));
	define("ROOTLINK", 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	$jssdk = new JSSDK("wx558a83cd25d466c0", "c1a01bb3f4093069e8372cda2a1c7718");
	$signPackage = $jssdk->GetSignPackage();
	$news = array("Title" =>"一瓶小酒竟然可以做成这样！太神奇了！", "Description"=>"一瓶神奇的小酒", "PicUrl" =>ROOTLINK.'/img/husenjilogo.jpg', "Url"=>ROOTLINK);  

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta id="viewport" name="viewport" content="target-densitydpi=device-dpi,width=640,user-scalable=no">
		<script src="./js/jweixin-1.0.0.js"></script>
		<script src="./js/jquery.js"></script>
		<script src="./js/wxmoment.min.js"></script>
		<script src="./js/resolution_min.js"></script>
		<title>一瓶小酒竟然可以做成这样！太神奇了！</title>
		<style>
		
		*{margin:0;padding:0}
		html,body{height:100%;overflow: hidden;background: #F8F8F8;}
		video{position:absolute;left:0;top:0px;z-index: 9;width:640px;height:auto}
		.bg1{display:none;position: absolute;top:0;left:0;z-index:999;}
		a{width:250px;height:80px;position: fixed;bottom:30px;left:0;right:0;margin:auto;z-index:999999;display:none}
        .kkx{position: absolute;z-index: 10;left:0;right:0;top:0;bottom:0;margin:auto;-webkit-animation: tipsFlash 1s infinite ease-in-out alternate;}
        @-webkit-keyframes tipsFlash {
			0%{-webkit-transform: scale(1)}
			100% {-webkit-transform: scale(1.1)}
		}
		</style>
	</head>
	<body>
		<script type="text/javascript">
			 wx.config({
		        debug: false,
		        appId: '<?php echo $signPackage["appId"];?>',
		        timestamp: <?php echo $signPackage["timestamp"];?>,
		        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		        signature: '<?php echo $signPackage["signature"];?>',
		        jsApiList: [
		            // 所有要调用的 API 都要加到这个列表中
		            'onMenuShareTimeline',
		            'onMenuShareAppMessage'
		          ]
		    });
		    // wx.checkJsApi({
	     //        jsApiList: [
	     //            'onMenuShareTimeline',
	     //            'onMenuShareAppMessage'
	     //        ],
	     //        success: function (res) {
	     //            alert(JSON.stringify(res));
	     //        }
      //   	});
		    wx.ready(function () {
				wx.onMenuShareAppMessage({
		          title: '<?php echo $news['Title'];?>',
		          desc: '<?php echo $news['Description'];?>',
		          link: '<?php echo $news['Url'];?>',
		          imgUrl: 'http://phplin.com/kaikouxiao/img/kkx.jpeg',
		          trigger: function (res) {
		            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
		            // alert('用户点击发送给朋友');
		          },
		          success: function (res) {
		            // alert('已分享');
		          },
		          cancel: function (res) {
		            // alert('已取消');
		          },
		          fail: function (res) {
		            // alert(JSON.stringify(res));
		          }
		        });

		        wx.onMenuShareTimeline({
		          title: '<?php echo $news['Title'];?>',
		          link: '<?php echo $news['Url'];?>',
		          imgUrl: 'http://phplin.com/kaikouxiao/img/kkx.jpeg',
		          trigger: function (res) {
		            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
		            // alert('用户点击分享到朋友圈');
		          },
		          success: function (res) {
		            // alert('已分享');
		          },
		          cancel: function (res) {
		            // alert('已取消');
		          },
		          fail: function (res) {
		            // alert(JSON.stringify(res));
		          }
		        });
			});
		</script>
		<img src="img/bg.jpg" style="width:640px;height:100%;position: absolute;left:0;top:0;z-index:10;" class="bg"/>
		<img src="img/kkx.png" class="kkx"/>
		<video src="kkx_z.mp4" playsinline="" webkit-playsinline="" poster="img/bg.jpg" preload="auto" id="videoBack"></video>
		<img src="img/sm.jpg" style="width:100%;height:100%" class="bg1"/>
		<script> 
		    var myVideo=document.getElementById("videoBack");
		    myVideo.load();
		    $("body").on("click touchstart",function(e){
		      	myVideo.play();
		      	$(".kkx").hide();
			 	$("body").unbind();
			 	e.preventDefault();
		    })

			myVideo.addEventListener('ended', function () {  
			    $(".bg1").fadeIn();
			}, false);
			     
			myVideo.addEventListener('playing', function () {  
			    $(".bg").hide();
			    myVideo.play();
			    console.log(1);
			}, false);
		</script>

	</body>
</html>
