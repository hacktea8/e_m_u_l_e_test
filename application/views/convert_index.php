<div id="wrap">
 <div id="content">
  <form action="" method="POST" id="form-url">
   <ul>
   <li>请输入普通链接或者迅雷、快车、旋风的链接地址:</li>
   <li><input type=text name="url" size="80" style="height:30px; line-height:30px; font-size:18px;"></li>
   <li><input type=submit value="转换[convert]"></li>
   </ul>
  </form>
  <div class="hide" id="show_url_div">
   <p>实际地址：<a href="" target="_blank" class="show_url" id="origin_url"></a> [<a href="#" class="copy_code" vid="origin_url">点击复制</a>]
   <p>迅雷链接：<a href="" target="_blank" class="show_url" id="thunder_url"></a> [<a href="#" class="copy_code" vid="thunder_url">点击复制</a>]
   <p>快车链接：<a href="" target="_blank" class="show_url" id="flashget_url"></a> [<a href="#" class="copy_code" vid="flashget_url">点击复制</a>]
   <p>旋风链接：<a href="" target="_blank" class="show_url" id="qqdl_url"></a> [<a href="#" class="copy_code" vid="qqdl_url">点击复制</a>]
  </div>
 </div>
</div>
<script type="text/javascript" src="<?php echo $js_url;?>ZeroClipboard.js"></script>
<script type="text/javascript">
$('.copy_code').addClass('hide');
 ZeroClipboard.setMoviePath(cdn_url+'/public/js/ZeroClipboard.swf');
function copyToClipboard(txt){
 //set path
 //create client
 var clip = new ZeroClipboard.Client();
 clip.setHandCursor( true ); // 设置鼠标为手型
 //event
 clip.setText(txt);
 clip.addEventListener('complete',function(client,text) {
  alert('copied: ' + text);
 });
 //alert(txt);
 //glue it to the button
 //clip.glue('copy_qqdl_url');
}
$(document).ready(function(){
 $('#form-url').submit(function(){
  $.ajax({
  type: 'POST',
  url: '/ajax/convert_url/',
  data: $(this).serialize(),
  success: function(data){
   if(1 != data.flag){
    $('.show_url').attr('href','').text('');
    alert('转换URL失败,Convert url failed');
    return false;
   }
   $('#show_url_div').removeClass('hide');
   $('#origin_url').attr('href',data.origin).text(data.origin);
   $('#thunder_url').attr('href',data.thunder).text(data.thunder);
   $('#flashget_url').attr('href',data.flashget).text(data.flashget);
   $('#qqdl_url').attr('href',data.qqdl).text(data.qqdl);
  },
  dataType: 'json'
  });
  return false;
 });
 $('.copy_code').click(function(){
  var id = $(this).attr('vid');
  var txt = $('#'+id).attr('href');
  copyToClipboard(txt);
 });
});
</script>
