function increaseMaxZoomFactor() {
	var w = window.screen.width;
	var h = window.screen.height;

	var scale = 0;
	var wp = w / 640;
	var hp = h / 1080;
	var element = document.createElement('meta');
	element.name = "viewport";
    element.content = "width=640, initial-scale=" + wp + ", maximum-scale=" + wp + ", minimum-scale=" + wp + ", user-scalable=no";
	var head = document.getElementsByTagName('head')[0];
	head.appendChild(element);
}

function increaseAndroidMaxZoomFactor() {
	var device_w = window.screen.width;
	var device_w = getDivW()?getDivW():window.screen.width;
	var device_p = window.devicePixelRatio;
	var dpi = (680/(device_w)) * device_p * 160;
	
	var element = document.createElement('meta');
	element.name = "viewport";
	element.content = "target-densitydpi="+dpi+",user-scalable=no";
	var head = document.getElementsByTagName('head')[0];
	head.appendChild(element);

	
	var temp_dpi = "device-dpi";
	if(window.devicePixelRatio >= 1.5){
	    temp_dpi = "high-dpi";
	}
	else if(window.devicePixelRatio == 0.75){
	    temp_dpi = "low-dpi";
	}
	else{
	    temp_dpi = "medium-dpi";
	}

}

var Platform_check = {
	IsIos : /(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent),
	IsAndroid : /(Android)/i.test(navigator.userAgent)
};

if (Platform_check.IsAndroid){
	increaseAndroidMaxZoomFactor();
}
else{
	increaseMaxZoomFactor();
}





