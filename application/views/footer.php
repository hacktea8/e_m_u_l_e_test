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
<script type="text/javascript">
$(document).ready(function(){
<?php if(in_array($_a,array('index','lists','topic','search'))){ ?>
$("img.lazy").show().lazyload({ 
    effect : "fadeIn",
    //placeholder : "img/grey.gif",
    placeholder : "http://img.hacktea8.com/showpic.php?key=3958009_0000671092.jpg",
    threshold : 60
});

<?php } ?>
});
</script>
</body>
</html>
