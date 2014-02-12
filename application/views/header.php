<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="<?php $seo_keywords;?>" name="keywords">
<meta content="<?php $seo_description;?>" name="description">
<?php if(isset($cid)){?>
<link href="/api/feed/<?php echo $cid;?>" title="<?php $seo_title;?> - <?php $web_title;?>" type="application/rss+xml" rel="alternate">
<?php }?>
<title><?php $seo_title;?> - <?php $web_title;?></title>
<link title="电驴资源" href="/api/opensearch" type="application/opensearchdescription+xml" rel="search">

<link rel="stylesheet" href="<?php echo $css_url;?>global.css?v=<?php echo $version;?>" type="text/css">
<script type="text/javascript" src="<?php echo $js_url;?>jquery-1.7.2.js?v=<?php echo $version;?>"></script>
<script type="text/javascript" src="<?php echo $js_url;?>global.js?v=<?php echo $version;?>"></script>

</head>
<body>
<a style="display: none;" id="gotop" href="#" title="返回顶部"
	onfocus="this.blur()"> <span><em class="tr">♦</em><em
	class="tube">▐</em></span></a>
<div style="height: 31px;">
<div id="header_div"><iframe scrolling="no" frameborder="no"
	src="about:blank" class="topbar_iframe"></iframe>
<div class="mainDiv" id="notice_wrapper">
<ul class="header_link clearfix">
	<li class="link_item"><a href="http://www.verycd.com/"
		onclick="VeryCD.TrackEvent('首页', 'toplink', '首页');" class="hover_red"><strong>首页</strong></a></li>
	</ul>
<?php if(0){ ?>
<div id="header_login">
<span class="link_box">
<ul>
	<li type="history" name="dropmenu" class="watching" status="hide"
		original_class="watching"><a
		onclick="VeryCD.TrackEvent('首页', 'toplink', '我正在看');"
		class="watching_item" href="javascript: void(0);">我正在看<span
		class="top_arrow"></span></a></li>
</ul>
</span></div>
<?php } ?>
</div>
</div>
</div>
<div id="banner_div">
<div class="mainDiv block">
<div id="logo_div"><a href="/" title="<?php echo $web_title;?> - 分享互联网"
	target="_top" id="index_logo"><img alt="<?php echo $web_title;?> - 分享互联网"
	src="<?php echo $img_url;?>emulogo.jpg?v=<?php echo $version;?>"
	class="png_image"></a></div>
<div id="new_search_bar_div">
<div class="clearfix">
<?php if(0){ ?>
<div id="top_add" class="top_add"><a
	onclick="showTopAddOptions(this);return false;"
	class="top_add_link" href="#">分享</a>
<div style="display: none;" id="top_add_options"
	class="top_add_options png"><a class="top_add_article"
	onclick="VeryCD.Track('/stat/topAddArticle/');" href="/articles/add/">
文章 </a> <a class="top_add_entry"
	onclick="VeryCD.Track('/stat/topAddEntry/');" href="/base/add"> 资料
</a> <a class="top_add_topic"
	onclick="VeryCD.Track('/stat/topAddTopic/');VeryCD.goPublish();return false"
	href="/topics/post"> 资源 </a></div>
<?php } ?>
</div>
<div id="top-search">
<form action="/search/entries/" onsubmit="VeryCD.search();return false;"
	class="block"><span id="search-module-toggle"> <img
	onload="this.onload=''; if(this.style.filter) { this.src='http://v4.vcimg.com/images/0.gif'; this.width=18; this.height=18; }"
	style=""
	src="<?php echo $img_url;?>entries.png?v=<?php echo $version;?>"
	alt="" id="current-search-module-img"> </span> <input type="text"
	tabindex="1" onwebkitspeechchange="VeryCD.search();"
	x-webkit-grammar="builtin:translate" x-webkit-speech=""
	onblur="if(this.value=='')this.value='搜索资料标题、内容...';this.style.color='#999';"
	onfocus="if(this.value=='搜索资料标题、内容...'){this.value=''};this.style.color='#000';"
	autocomplete="off" class="top-search-input" value="" name="kw"
	id="search_keyword"> <input type="hidden" value="entries"
	id="search_type">
<button class="top-search-button" id="top-search-button" type="submit">搜索</button>
<button
	onclick="location.href='http://www.verycd.com/search#advanced';return false;"
	class="top-search-button" id="top-search-advance" type="button">高级搜索</button>
</form>
</div>

<div class="link_line hot_search_keywords">热门搜索：&nbsp;

<a target="_blank" href="/search/entries/%E7%88%B1%E6%83%85%E5%85%AC%E5%AF%934" style="text-decoration: none;">爱情公寓4</a>&nbsp;&nbsp;

</div>
</div>
</div>
</div>

<div class="mainDiv">
<div id="nav_div">
<ul id="header_ul_big" class="ul big">
	<li><a onclick="" href="/">首页</a></li>
<?php foreach($rootCate as $row){
?>
                <li><a href="<?php echo $row['url'];?>" onclick=""><?php echo $row['name'];?></a></li>
<?php
} ?>
</ul>

</div>
</div>
<div class="mainDiv">
<div style="float: right; padding-right: 12px;" id="addfavorite_div">
<a onclick="addfavorite('<?php echo $base_url;?>','<?php echo $web_title;?>');return false;"
	style="color: #555" rel="sidebar" href="<?php echo $base_url;?>">+ 将本站加入收藏夹</a></div>
<div id="location_div">您的位置：<a href="/">电驴大全</a> &gt; <a
	href="/base/tv/">剧集</a> <a href="http://www.verycd.com/base/tv/feed"
	title="使用RSS订阅本栏更新"><img align="absmiddle"
	src="<?php echo $img_url;?>feeds.gif?v=<?php echo $version;?>" alt="feed" style="vertical-align: top;"></a></div>
</div>
<div class="mainDiv">
