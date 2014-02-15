</div>
<div id="advertisement_bottom" class="mainDiv">
<div class="line_space"></div>
</div>

<div class="clear"></div>
<div class="mainDiv">
<div id="bottom_div">
<br>
&copy;2013 - <script>
   var copyrightdate = new Date();
   document.write(copyrightdate.getFullYear());
</script> 
如果侵犯了你的权益，请通知我们，我们会及时删除侵权内容，谢谢合作！ 联系信箱：<?php echo $admin_email;?><br />
<?php echo $domain;?> Inc. All rights reserved Powered <?php echo $web_title;?>

</div>
</div>
</div>
</div>
</div>
</div>
<div id="#show_msg_div_" ></div>
<div style="display:none;">
<script type="text/javascript">
$(document).ready(function(){
<?php if(in_array($_a,array('index','lists','topic','search'))){ ?>
$("img.lazy").show().lazyload({ 
    effect : "fadeIn",
    //placeholder : "img/grey.gif",
    placeholder : '<?php echo $errorimg;?>',
    threshold : 60
});
function show404(){
var img=event.srcElement;
img.src='/public/images/show404.jpg';
img.onerror=null; 控制不要一直跳动
}
<?php } ?>
<?php if(in_array($_a,array('topic'))){ ?>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
<?php } ?>
<?php if('index' == $_a){ ?>
function _loadIndex(){$.get("/index/index");}
window.setTimeout(_loadIndex,5000);
<?php } ?>
});
</script>
<script  src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20110603&style=3&showcount=1&width=130&height=30" charset="utf-8" defer="defer" ></script>
<script>var _hmt = _hmt || [];(function() {  var hm = document.createElement("script");  hm.src = "//hm.baidu.com/hm.js?268a910d12a04866f4f834ce95825591";  var s = document.getElementsByTagName("script")[0];   s.parentNode.insertBefore(hm, s);})();</script>
</div>
</body>
</html>
