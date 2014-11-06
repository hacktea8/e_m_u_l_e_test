stLight.options({publisher: "7ff4f18b-2f13-450e-ad6c-8d6a4487f639", doNotHash: false, doNotCopy: false, hashAddressBar: false});
var options={ "publisher": "7ff4f18b-2f13-450e-ad6c-8d6a4487f639", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "googleplus", "baidu", "sina", "twitter", "linkedin", "pinterest", "sharethis"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
function show_hide_tab(show,hide){
  $('.'+hide).hide();
  $('.group-mods ul li').removeClass('current');
  $('#'+show).parent().addClass('current');
  $('#con_'+show).show();
}
function _loadTopic(){
$.get("/ajaxapi/article_pv/<?php echo $aid;?>");
}
$(document).ready(function(){
 window.setTimeout("_loadTopic()",5000);
 $("#emu_comment p a").bind('mouseover',function(){
  href = $(this).attr('href');
  if(href.indexOf('duoshuo.com')){
   $(this).attr('href','');
  }
 });
 $("#ujian-hook a").mouseover(function(){
  href = $(this).attr('href');
  if(href.indexOf('ujian.cc')){
   $(this).attr('href','');
  }
 });
 $('#addFav').click(function(){
  if(uid){alert('抱歉！您还未登录。请先登录!!');return false;}
  $.get("/index/addCollect/"+uid, function(result){
   if(result.status==1){
    $('#addFavBtn').attr("src","<?php echo $img_url;?>delfavorite.gif");
   }else{
    $('#addFavBtn').attr("src","<?php echo $img_url;?>favorite.gif");
   }
  },'json');
 });
});
