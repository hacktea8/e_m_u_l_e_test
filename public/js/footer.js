function show404(img){
var img=this;//event.srcElement;
img.src=_errpic;
//img.onerror=null; 控制不要一直跳动
}
var allow_action = new Array('index','lists','fav','topic','search');
if(allow_action.in_array(_action)){
 $(function() {
 $("img.lazy").lazyload({
  event : "sporty",
  effect : "fadeIn",
  //placeholder : "img/grey.gif",
  placeholder : _errpic,
  threshold : 60
 });
 });
 $(window).bind("load", function() {
  var timeout = setTimeout(function() { $("img.lazy").trigger("sporty") }, 5000);
 });
}
function _Userlogin(){
  var timer=null;
  var _hide=function(){
    $('.iconList').hide();$('.dropMenu').hide();}
  var init=function(){
    $('#user_login').mouseout(function(){
      timer=setTimeout(_hide,500);});
    $('#user_login').mouseover(function(){
     clearTimeout(timer);
     if($('.iconList').is(":visible") || $('.dropMenu').is(":visible")){
       return false;}
     $.get('/index/isUserInfo/',function(data){
       if(data.status==1){
         $('.iconList').show();$('.dropMenu').hide();
       }else{
         $('.iconList').hide();$('.dropMenu').show();}
      },"json");});}
  init();
}
function _loadIndex(){$.get("/index/index");}
//$(document).ready(function(){
 if('index' == _action){
  window.setTimeout("_loadIndex()",5000);
 }
 if('topic' == _action){
  window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
 }
 _Userlogin();
 var _hmt = _hmt || [];
 (function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2aa08b1d43f64c36e842be1951a04c25";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
 })();
//});
