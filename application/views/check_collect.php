<!DOCTYPE html>
<html lang="zh-cn">
<meta charset="utf-8" />
<meta name="robots" content="all" />
<meta name="author" content="emubt.com" />
<head>
<title>加入收藏</title>
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>
<a class="addFav" title="<?php if( !$uinfo['uid']){echo '请先登录!';}?>收藏<?php echo $title;?>资源" alt="收藏<?php echo $title;?>资源" id="addFav"><img src="<?php echo $img_url,$isCollect?'del':'','favorite.gif';?>" id="addFavBtn" alt="收藏<?php echo $title;?>资源" /></a>
<script>
var article_id = '<?php echo $aid;?>';
var login_uid = '<?php echo $uid;?>';
var cdn_url = '<?php echo $cdn_url;?>';
var img_url = '<?php echo $img_url;?>';
</script>
<script src="<?php echo $js_url;?>check_collect.js?v=<?php echo $version;?>"></script>
</body>
</html>
