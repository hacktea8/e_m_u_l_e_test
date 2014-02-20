<div class="mainDiv">
    <div class="leftDiv">
        <div class="box_7">
            <div style="height:25px" class="titleDiv">
                <h1>资料</h1>
            </div>
            <div class="main" style="padding:10px;">
                <div style="margin-top:10px;padding:3px;background: #ffffd8">请以<span class="red">第三人称</span>撰写，保持中立观点，并遵守我们的规定，帮助保持页面清洁。</div>
<div class="clear"></div>
<br>

<style type="text/css">
#myform {padding-left:78px;}
#myform td{ padding: 3px; }
</style>

<form method="post" name="myform" id="myform" onsubmit="post_entry();return false;" onkeydown="VeryCD.check_hotkey(event, 'submit_button')" action="/base/ajax/entry/do_add_history">
    <input type="hidden" name="Action" value="">
    <input type="hidden" name="body[catalog_id]" id="catalog_id" value="14">
    <input type="hidden" name="id" value="0">
    <table border="0" cellpadding="3" cellspacing="0">
    <tbody><tr>
        <td style="width:70px;font-size:14px;">分类:</td>
        <td style="font-weight:bold;">电影        </td>
    </tr>
	<tr>
        <td style="width:70px;font-size:14px;">中文名称:</td>
        <td><input type="text" id="cname" name="body[cname]" value="" class="input_1" style="width:200px"></td>
    </tr>
    <tr>
        <td style="font-size:14px;">英文名称:</td>
        <td><input type="text" id="ename" name="body[ename]" value="" class="input_1" style="width:200px"></td>
    </tr>
    <tr>
        <td style="font-size:14px;">别名:</td>
        <td><input type="text" id="alias" name="body[alias]" value="" class="input_1" style="width:200px"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top"><span style="color:#999;">如有其它名字可在这里填写，以“,”分隔。</span></td>
    </tr>
    <tr valign="top">
        <td style="font-size:14px;">类型:</td>
        <td>
        <select name="body[kind][]" size="6" class="input_1" style="width:208px;" multiple="multiple">
<option value="movie.Action">动作</option>
</select>        </td>
    </tr>
    <tr>
        <td style="font-size:14px;">IMDb号:</td>
        <td>12390875<input type="hidden" name="body[imdb_id]" value="12390875"></td>
    </tr>
     <tr>
        <td style="font-size:14px;">上映日期:</td>
        <td><input type="text" id="release_date" name="body[release_date]" value="" class="input_1" style="width:200px"></td>
    </tr>
    <tr>
        <td></td>
        <td valign="top"><span style="color:#999;">该电影上映日期，格式为:年-月-日(如：2007-04-19)</span></td>
    </tr>
    <tr>
        <td style="font-size:14px;"></td>
        <td><input type="text" id="release_date_china" name="body[release_date_china]" value="" class="input_1" style="width:200px"> (中国)</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top"><span style="color:#999;">该电影中国大陆上映日期，国内未上映则无需填写</span></td>
    </tr>
    <tr>
        <td style="font-size:14px;"></td>
        <td><input type="text" id="release_date_reproduction" name="body[release_date_reproduction]" value="" class="input_1" style="width:200px"> (重制版)</td>
    </tr>
    <tr>
        <td></td>
        <td valign="top"><span style="color:#999;">该电影重制版上映日期，无重制版本计划则无需填写</span></td>
    </tr>
    <tr valign="top">
        <td style="font-size:14px;">导演:</td>
        <td><textarea id="director" name="body[director]" cols="80" rows="16" class="input_1" style="width:520px;height:8em;"></textarea></td>
    </tr>
    <tr valign="top">
        <td style="font-size:14px;">编剧:</td>
        <td><textarea id="writer" name="body[writer]" cols="80" rows="16" class="input_1" style="width:520px;height:8em;"></textarea></td>
    </tr>
    <tr valign="top">
        <td style="font-size:14px;">演员:</td>
        <td><textarea id="actor" name="body[actor]" cols="80" rows="16" class="input_1" style="width:520px;height:8em;"></textarea></td>
    </tr>    <tr>
        <td style="font-size:14px;">官网:</td>
        <td><input type="text" id="homepage" name="body[homepage]" value="" class="input_1" style="width:400px"></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top">地区:</td>
        <td><select name="body[country][]" size="6" class="input_1" style="width:208px;" multiple="multiple">
<option value="germany">德国</option>
</select></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top">语言:</td>
        <td><select name="body[language][]" size="6" class="input_1" style="width:208px;" multiple="multiple">
<option value="chinese_simplified">简体中文</option>
<option value="chinese_traditional">繁体中文</option>
</select></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top">简介:</td>
        <td><textarea id="contents" name="body[contents]" cols="80" rows="16" class="input_1" style="width:520px;height:16em;"></textarea></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top">来源:</td>
        <td><input type="text" id="references" name="body[references]" value="" class="input_1" style="width:400px"></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top"></td>
        <td height="50">
        <!-- <input type="submit" class="button2" id="submit-button" value="预览"> -->
        <input type="submit" class="button" id="submit_button" value="保存">
        <input type="checkbox" value="1" checked="true" id="smartgbk" name="smartgbk">
        <label for="smartgbk">自动转换繁体字为简体</label>
        </td>
    </tr>
    </tbody></table>
    <script type="text/javascript">
    setTimeout('Sizzle("#submit_button")[0].disabled=false;',10);
    </script>
</form>


            </div>
        </div>
    </div>
    <div class="rightDiv">
        <div class="box_7">
            <div class="main" style="padding:0 10px 10px;">
                <div id="postNote" style="position: static; width: auto;">
    <h4>请在编辑前阅读以下说明：</h4>
    <div id="interdiction">
        <p>1、提交的内容不得违反版权规定。</p>
		<p>2、描述应以第三人称撰写，内容属实而无偏见，无个人观点。</p>
		<p>3、本页面用于书写内容，不可放入其他网站的链接。</p>
    </div>
    <h4>禁止发布:</h4>
    <div id="interdiction">
        <p>1、禁止添加色情，反动的内容。</p>
    	<p>2、禁止添加与资料内容无关的广告和链接。</p>
    	<p>3、禁止创建非电影、剧集、动漫、综艺、游戏、公开课资料。</p>
    	<p>4、禁止创建已经存在的重复资料。</p>
    </div>
    <h4>发布指南:</h4>
    <div id="policy">
        <p>1、所有填写内容必须为简体中文。</p>
        <p>2、中文名以大陆官方为准，无官方中文名则以大陆地区约定俗成的翻译为准。</p>
        <p>3、英文名以官方原名为准，若无官方英文名则可不填写，中文拼音（包括拼音首字母）不作为英文名。</p>
        <p>4、非英文原名、其他译名以及简称应填入别名栏，多个名称时以半角“,”分隔。</p>
        <p>5、发行时间需精确到日期，并且填写最早发行时间。</p>
        <p>6、导演、编剧、原作、演员、主持人、讲师或者制作发行公司存在多个时，一行一个。</p>
        <p>7、学院名称必须填写完整。如“哈佛大学”，不可简写为“哈佛”。学院名不可填写英文名。</p>
        <p>8、官网链接一定指向官方主页，不可填写其他资料站链接，若无官方网站可不填。</p>
        <p>9、语言以及地区以制作或发行公司所在地区为准，若无官方中文，则不选择中文选项。</p>
        <p>10、简介必须为简体中文，主要以介绍为主，不可填写个人评论，不可重复填写上方表单中已填写的内容。</p>
        <p>11、资料内容为转载时，必须填上转载来源的网页地址。</p>
    </div>
</div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
