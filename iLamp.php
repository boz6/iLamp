<!DOCTYPE html>
<html lang="hu" >
<head>
    <meta charset="utf-8">
    <title>iLampSystem - Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="stylesheet" href="css/runeui.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="iLamp">
	<meta name="application-name" content="iLamp">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.knob.js"></script>	
	<script src="js/jscolor.js"></script>
	<script type="text/javascript">
function dec2Hex(i)
{
    var res="00";
    if(i>=0 && i<=15) { res="0" + i.toString(16); }
    else if (i>=16 && i<=255) { res=i.toString(16); }
    return res.toUpperCase();
}

function sendData() 
{
var value = "#1" + $("#rgb1").val() + $("#rgb2").val() + "\x0d";
$.post("send.php",
{
	rgb: value
},
function(data, status)
{
//alert(data);
var res=data.split("&");
document.getElementById('d_no-txt').value=res[0]; //Number of Pack
document.getElementById('d_id-txt').value=res[1]; //ID
document.getElementById('d_ls-txt').value=res[2]; //LihtSensor
document.getElementById('d_temp-txt').value=res[3]; //Temperature
document.getElementById('d_rgb-txt').value=res[4]; //RGB
document.getElementById('d_ms-txt').value=res[5]; //MotionSensor
});
alert(callback)};

function sendData1() 
{
var value = "#1" + dec2Hex(parseInt($("#kn1").val(),10)) + dec2Hex(parseInt($("#kn2").val(),10)) + dec2Hex(parseInt($("#kn3").val(),10)) + dec2Hex(parseInt($("#kn4").val(),10)) + dec2Hex(parseInt($("#kn5").val(),10)) + dec2Hex(parseInt($("#kn6").val(),10)) + "\x0d";
$.post("send.php",
{
	rgb: value
},
function(data, status)
{
//alert(data);
var res=data.split("&");
document.getElementById('d_no-txt').value=res[0]; //Number of Pack
document.getElementById('d_id-txt').value=res[1]; //ID
document.getElementById('d_ls-txt').value=res[2]; //LihtSensor
document.getElementById('d_temp-txt').value=res[3]; //Temperature
document.getElementById('d_rgb-txt').value=res[4]; //RGB
document.getElementById('d_ms-txt').value=res[5]; //MotionSensor
});
alert(callback)};

function sendAllOff() 
{
var value = "#1000000000000\x0d";
$.post("send.php",
{
	rgb: value
},
function(data, status)
{
//alert(data);
var res=data.split("&");
document.getElementById('d_no-txt').value=res[0]; //Number of Pack
document.getElementById('d_id-txt').value=res[1]; //ID
document.getElementById('d_ls-txt').value=res[2]; //LihtSensor
document.getElementById('d_temp-txt').value=res[3]; //Temperature
document.getElementById('d_rgb-txt').value=res[4]; //RGB
document.getElementById('d_ms-txt').value=res[5]; //MotionSensor
});
alert(callback)};

function refreshData() 
{
var value = "#?\x0d";
$.post("send.php",
{
	rgb: value
},
function(data, status)
{
//alert(data);
var res=data.split("&");
document.getElementById('d_no-txt').value=res[0]; //Number of Pack
document.getElementById('d_id-txt').value=res[1]; //ID
document.getElementById('d_ls-txt').value=res[2]; //LihtSensor
document.getElementById('d_temp-txt').value=res[3]; //Temperature
document.getElementById('d_rgb-txt').value=res[4]; //RGB
document.getElementById('d_ms-txt').value=res[5]; //MotionSensor
});
alert(callback)};

$(function() {
  $(".knob").knob();

  // Example of infinite knob, iPod click wheel
  var val,up=0,down=0,i=0
      ,$idir = $("div.idir")
      ,$ival = $("div.ival")
      ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
      ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
      $("input.infinite").knob(
        {
            'min':0
            ,'max':255
            ,'stopper':false
            ,'change':function(v){
                if(val>v){
                    if(up){
                        decr();
                        up=0;
                    }else{up=1;down=0;}
                }else{
                    if(down){
                        incr();
                        down=0;
                    }else{down=1;up=0;}
                }
                val=v;
            }
        }
      )
	});
	

</script>		
</head>
<body>
	<div class="boxed-group">
		<legend>&nbsp;&nbsp;&nbsp;iLamp</legend>
		<br><span class="help-block">A simple page for demonstrate iLamp functionality and controll.</span>
	</div>
	<div class="knobs row">
	    <div class="col-md-4">
		<div class="boxed-group">
			<legend>&nbsp;&nbsp;&nbsp;RGB Channel(s)</legend><br><div style="width:300px;padding:20px">
			Channel 1: <input id="rgb1" class="jscolor" value="ab2567"><br><br>
			Channel 2: <input id="rgb2" class="jscolor" value="FF6B09"><br>			
			<br><input class="btn btn-primary" type="button" onclick="sendData()" value="Send">
			<br><br><div class="text-info"><span class="help-block">If the channels collect to two RGB strings. The coloures are not calibrated for RGB LEDs coloures. It is a screen coloures.</span></div>
		</div></div></div>
		<div class="col-md-4">
		<div class="boxed-group">
			<legend>&nbsp;&nbsp;&nbsp;Channels One by One</legend><div style="width:300px;padding:10px">
			<input id="kn1" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="64" onclick="document.getElementById('rgb1').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn1').value,10))+dec2Hex(parseInt(document.getElementById('kn2').value,10))+dec2Hex(parseInt(document.getElementById('kn3').value,10)))">
			<input id="kn2" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="150" onclick="document.getElementById('rgb1').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn1').value,10))+dec2Hex(parseInt(document.getElementById('kn2').value,10))+dec2Hex(parseInt(document.getElementById('kn3').value,10)))">
			<input id="kn3" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="94" onclick="document.getElementById('rgb1').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn1').value,10))+dec2Hex(parseInt(document.getElementById('kn2').value,10))+dec2Hex(parseInt(document.getElementById('kn3').value,10)))">
			<br>
			<input id="kn4" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="255" onclick="document.getElementById('rgb2').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn4').value,10))+dec2Hex(parseInt(document.getElementById('kn5').value,10))+dec2Hex(parseInt(document.getElementById('kn6').value,10)))">
			<input id="kn5" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="107" onclick="document.getElementById('rgb2').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn4').value,10))+dec2Hex(parseInt(document.getElementById('kn5').value,10))+dec2Hex(parseInt(document.getElementById('kn6').value,10)))">
			<input id="kn6" class="knob" data-max="255" data-min="0" data-width="75" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-thickness=".2" value="9" onclick="document.getElementById('rgb2').jscolor.fromString(dec2Hex(parseInt(document.getElementById('kn4').value,10))+dec2Hex(parseInt(document.getElementById('kn5').value,10))+dec2Hex(parseInt(document.getElementById('kn6').value,10)))">
			<br><br><input class="btn btn-primary" type="button" onclick="sendData1()" value="Send"><br><span class="help-block">
			The single channel 3W white LEDs start at 64 and 35W white LEDs start at 95.</span>
		</div></div></div>

		<div class="col-md-4">
		   <div class="boxed-group">
			  <legend>&nbsp;&nbsp;&nbsp;Base Config </legend><div style="width:250px;padding:20px">
			  IP: <input id="ip-txt" type="text" value="192.168.1.107" maxlength="16" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" class="form-control osk-trigger input-lg" disabled required />
			  Port: <input id="port-txt" type="text" value="8899" maxlength="5" type="readonly" class="form-control osk-trigger input-lg" disabled required /><br>
			  <input class="btn btn-default" type="button" onclick="sendAllOff()" value="All Off"><br><span class="help-block">
			  <span class="help-block">The device first run IP and Port address is: 10.10.100.254:8899.</span>&nbsp;
			</div></div>
		</div></div>

		<div class="boxed-group"><div class="row">
			<legend>&nbsp;&nbsp;&nbsp;Device Info </legend>
			<div class="col-md-4"><div style="width:200px;padding:20px">
			<span class="help-block">
		   		Pack No:<input id="d_no-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
				Device ID:<input id="d_id-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
				Light sensor:<input id="d_ls-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
			</div></div>
			<div class="col-md-4"><div style="width:200px;padding:10px">
			<span class="help-block">
				Temperature:<input id="d_temp-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
				LED Data:<input id="d_rgb-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
				Motionsensor:<input id="d_ms-txt" type="text" value="" maxlength="10" type="readonly" class="form-control osk-trigger input-lg" disabled/><br>
				</span><input class="btn btn-primary" type="button" onclick="refreshData()" value="Refresh">
			</div></div>
			<div class="col-md-4"><div style="width:300px;padding:20px">
			<span class="help-block"><strong>Legend</strong><br><br>&nbsp;The packs numbers is a number of packs. (in HEX)<br>&nbsp;The device ID is a discrete identificator.<br>&nbsp;The Light sensor value is indicate the ambient illumination. It is a number of 0 to 1023 (in HEX)<br>&nbsp;The temperature is a temperature value for the LED block. The over temperature damage the power LED block(s). (>80Co) The block will automaticaly decrease or raise the LED light. But the block won't put it in back.<br>&nbsp;The LED data is data of LED chanel in HEX.<br>&nbsp;The motionsensor is state of motionsensor. (M - move, S - stall.)</span>
			</div></div>
		</div>
	</div>
<?php

//class="col-md-4" style="float:left;width:300px;height:300px;background-color:#222;color:#FFF;padding:20px"
//<span class="help-block">Manually set the IP address.</span>
//Manually set the Port number.
?>
</body>
</html>