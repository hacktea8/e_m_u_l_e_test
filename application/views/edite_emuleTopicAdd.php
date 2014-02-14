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

<script type="text/javascript">
function post_entry(){
    Sizzle('#submit_button')[0].disabled='disabled';
    VeryCD.show_loading();
    //繁转简
    changeEncode();

    var myform = document.forms['myform'];
    $.ajax({
        url: myform.action,
        type: 'post',
        data: $(myform).serialize(),
        dataType: 'json',
        success: function(rs) {
        	VeryCD.hidden_loading();
            Sizzle('#submit_button')[0].disabled=false;
            if (rs.code === 0) {
                try{
                    var data = eval('('+rs.msg+')');
                    if (typeof data != 'object')throw new Error('');
                                            var url = '/entries/'+data.entry_id+'/';
                                                if(data.achievement_html) VeryCD.popMsg(data.achievement_html,url);
                        document.location.href = url;
                                    }catch(e){
                                            var url = '/entries/'+rs.msg+'/';
                        VeryCD.Msg('恭喜，保存成功！',url);
                                    }
            }else if (rs.code === -2) {
                VeryCD.error('抱歉  你没有权限执行该操作');
            }else if (rs.code === -3) {
                VeryCD.error('提交的数据有问题 ');
            }else if (rs.code === -4) {
                VeryCD.error('中文名和英文名至少填一项！');
            }else if (rs.code === -6) {
                VeryCD.error('保存失败，有可能数据库超载，<br>请重试或联系管理员！',400);
        	}else if (rs.code === -9) {
                VeryCD.error('IMDb号为'+myform['body[imdb_id]'].value+'的电影已创建，<br><a href="'+rs.msg+'" target="_blank">点击查看>></a>',400);
        	}else if (rs.code === -10) {
                VeryCD.error(rs.msg);
        	}else{
                VeryCD.error('未知错误，请联系管理员！');
        	}
		},
      	beforeSend: function(){
      		VeryCD.show_loading();
      	},
      	error: function() {
      		Sizzle('#submit_button')[0].disabled=false;
            VeryCD.error('抱歉，保存失败，请稍后再试！');
            VeryCD.hidden_loading();
      	}
	});
}
function changeAction(action){
    var myform = document.forms['myform'];
    myform.target = '';
    myform.elements.Action.value = 'editCatalog';
    myform.action = document.location;
    myform.submit();
}
function gbk_convert(cc, mod){
    var str = '';
    var tmpidx;
    var convert_src;
    var convert_des;
    var convert_sp  = '皑蔼碍爱翱袄奥坝罢摆败颁办绊帮绑镑谤剥饱宝报鲍辈贝钡狈备惫绷笔毕毙币闭边编贬变辩辫标鳖别瘪濒滨宾摈饼并并并拨钵铂驳卜补财参蚕残惭惨灿苍舱仓沧厕侧册测层诧搀掺蝉馋谗缠铲产阐颤场尝长偿肠厂畅钞车彻尘陈衬撑称惩诚骋痴迟驰耻齿炽冲虫宠畴踌筹绸丑橱厨锄雏础储触处传疮闯创锤纯绰辞词赐聪葱囱从丛凑蹿窜错达带贷担单郸掸胆惮诞弹当挡党荡档捣岛祷导盗灯邓敌涤递缔颠点垫电淀钓调迭谍叠钉顶锭订丢东动栋冻斗犊独读赌镀锻断缎兑队对吨顿钝夺堕鹅额讹恶饿儿尔饵贰发罚阀珐矾钒烦范贩饭访纺飞诽废费纷坟奋愤粪丰枫锋风疯冯缝讽凤肤辐抚辅赋复负讣妇缚该钙盖干赶秆赣冈刚钢纲岗皋镐搁鸽阁铬个给龚宫巩贡钩沟构购够蛊顾剐关观馆惯贯广规硅归龟闺轨诡柜贵刽辊滚锅国过骇韩汉号阂鹤贺横恒轰鸿红后壶护沪户哗华画划话怀坏欢环还缓换唤痪焕涣黄谎挥辉毁贿秽会烩汇讳诲绘荤浑伙获货祸击机积饥迹讥鸡绩缉极辑级挤几蓟剂济计记际继纪夹荚颊贾钾价驾歼监坚笺间艰缄茧检碱硷拣捡简俭减荐槛鉴践贱见键舰剑饯渐溅涧将浆蒋桨奖讲酱胶浇骄娇搅铰矫侥脚饺缴绞轿较秸阶节杰洁结诫届紧锦仅谨进晋烬尽劲荆茎鲸惊经颈静镜径痉竞净纠厩旧驹举据锯惧剧鹃绢觉决诀绝钧军骏开凯颗壳课垦恳抠库裤夸块侩宽矿旷况亏岿窥馈溃扩阔蜡腊莱来赖蓝栏拦篮阑兰澜谰揽览懒缆烂滥捞劳涝乐镭垒类泪棱篱离里鲤礼丽厉励砾历沥隶俩联莲连镰怜涟帘敛脸链恋炼练粮凉两辆谅疗辽镣猎临邻鳞凛赁龄铃凌灵岭领馏刘龙聋咙笼垄拢陇楼娄搂篓芦卢颅庐炉掳卤虏鲁赂禄录陆驴吕铝侣屡缕虑滤绿峦挛孪滦乱抡轮伦仑沦纶论萝罗逻锣箩骡骆络妈玛码蚂马骂吗买麦卖迈脉瞒馒蛮满谩猫锚铆贸么没镁门闷们锰梦眯谜弥觅幂绵缅庙灭悯闽鸣铭谬谋亩呐钠纳难挠脑恼闹馁内拟腻撵捻酿鸟聂啮镊镍柠狞宁拧泞钮纽脓浓农疟诺欧鸥殴呕沤盘庞赔喷鹏骗飘频贫苹凭评泼颇扑铺仆朴谱栖凄脐齐骑岂启气弃讫牵扦钎铅迁签谦钱钳潜浅谴堑枪呛墙蔷强抢锹桥乔侨翘窍窃钦亲寝轻氢倾顷请庆琼穷趋区躯驱龋颧权劝却鹊确让饶扰绕热韧认纫荣绒软锐闰润洒萨鳃赛伞丧骚扫涩杀刹纱筛晒删闪陕赡缮伤赏烧绍赊舍摄慑设绅审婶肾渗声绳胜圣师狮湿诗尸时蚀实识驶势适释饰视试寿兽枢输书赎属术树竖数帅双谁税顺说硕烁丝饲耸怂颂讼诵擞苏诉肃虽随绥岁孙损笋缩琐锁獭挞抬态摊贪瘫滩坛谭谈叹汤烫涛绦讨藤腾誊锑题体屉条贴铁厅听烃铜统头秃图涂团颓蜕脱鸵驮驼椭洼袜弯湾顽万网韦违围为为潍维苇伟伪纬谓卫温闻纹稳问瓮挝蜗涡窝卧呜钨乌污诬无芜吴坞雾务误锡牺袭习铣戏细虾辖峡侠狭厦吓锨鲜纤咸贤衔闲显险现献县馅羡宪线厢镶乡详响项萧嚣销晓啸蝎协挟携胁谐写泄泻谢锌衅兴汹锈绣虚嘘须许叙绪续轩悬选癣绚学勋询寻驯训讯逊压鸦鸭哑亚讶阉烟盐严岩颜阎艳厌砚彦谚验鸯杨扬疡阳痒养样瑶摇尧遥窑谣药爷页业叶医铱颐遗仪彝蚁艺亿忆义诣议谊译异绎荫阴银饮隐樱婴鹰应缨莹萤营荧蝇赢颖哟拥佣痈踊咏涌优忧邮铀犹游诱舆鱼渔娱与屿语吁御狱誉预驭鸳渊辕园员圆缘远愿约跃钥岳粤悦阅云郧匀陨运蕴酝晕韵杂灾载攒暂赞赃脏凿枣灶责择则泽贼赠扎札轧铡闸栅诈斋债毡盏斩辗崭栈战绽张涨帐账胀赵蛰辙锗这贞针侦诊镇阵挣睁狰争帧郑证织职执纸挚掷帜质滞钟终种肿众诌轴皱昼骤猪诸诛烛瞩嘱贮铸筑驻专砖转赚桩庄装妆壮状锥赘坠缀谆浊兹资渍踪综总纵邹诅组钻制致浏签注撷复';
    var convert_big = '皚藹礙愛翺襖奧壩罷擺敗頒辦絆幫綁鎊謗剝飽寶報鮑輩貝鋇狽備憊繃筆畢斃幣閉邊編貶變辯辮標鼈別癟瀕濱賓擯餅並併竝撥缽鉑駁蔔補財參蠶殘慚慘燦蒼艙倉滄廁側冊測層詫攙摻蟬饞讒纏鏟產闡顫場嘗長償腸廠暢鈔車徹塵陳襯撐稱懲誠騁癡遲馳恥齒熾沖蟲寵疇躊籌綢醜櫥廚鋤雛礎儲觸處傳瘡闖創錘純綽辭詞賜聰蔥囪從叢湊躥竄錯達帶貸擔單鄲撣膽憚誕彈當擋黨蕩檔搗島禱導盜燈鄧敵滌遞締顛點墊電澱釣調叠諜疊釘頂錠訂丟東動棟凍鬥犢獨讀賭鍍鍛斷緞兌隊對噸頓鈍奪墮鵝額訛惡餓兒爾餌貳發罰閥琺礬釩煩範販飯訪紡飛誹廢費紛墳奮憤糞豐楓鋒風瘋馮縫諷鳳膚輻撫輔賦復負訃婦縛該鈣蓋幹趕稈贛岡剛鋼綱崗臯鎬擱鴿閣鉻個給龔宮鞏貢鈎溝構購夠蠱顧剮關觀館慣貫廣規矽歸龜閨軌詭櫃貴劊輥滾鍋國過駭韓漢號閡鶴賀橫恆轟鴻紅後壺護滬戶嘩華畫劃話懷壞歡環還緩換喚瘓煥渙黃謊揮輝毀賄穢會燴彙諱誨繪葷渾夥獲貨禍擊機積饑跡譏雞績緝極輯級擠幾薊劑濟計記際繼紀夾莢頰賈鉀價駕殲監堅箋間艱緘繭檢堿鹼揀撿簡儉減薦檻鑒踐賤見鍵艦劍餞漸濺澗將漿蔣槳獎講醬膠澆驕嬌攪鉸矯僥腳餃繳絞轎較稭階節傑潔結誡屆緊錦僅謹進晉燼盡勁荊莖鯨驚經頸靜鏡徑痙競淨糾廄舊駒舉據鋸懼劇鵑絹覺決訣絕鈞軍駿開凱顆殼課墾懇摳庫褲誇塊儈寬礦曠況虧巋窺饋潰擴闊蠟臘萊來賴藍欄攔籃闌蘭瀾讕攬覽懶纜爛濫撈勞澇樂鐳壘類淚稜籬離裡鯉禮麗厲勵礫歷瀝隸倆聯蓮連鐮憐漣簾斂臉鏈戀煉練糧涼兩輛諒療遼鐐獵臨鄰鱗凜賃齡鈴淩靈嶺領餾劉龍聾嚨籠壟攏隴樓婁摟簍蘆盧顱廬爐擄鹵虜魯賂祿錄陸驢呂鋁侶屢縷慮濾綠巒攣孿灤亂掄輪倫侖淪綸論蘿羅邏鑼籮騾駱絡媽瑪碼螞馬罵嗎買麥賣邁脈瞞饅蠻滿謾貓錨鉚貿麼沒鎂門悶們錳夢瞇謎彌覓冪綿緬廟滅憫閩鳴銘謬謀畝吶鈉納難撓腦惱鬧餒內擬膩攆撚釀鳥聶嚙鑷鎳檸獰寧擰濘鈕紐膿濃農瘧諾歐鷗毆嘔漚盤龐賠噴鵬騙飄頻貧蘋憑評潑頗撲鋪僕樸譜棲淒臍齊騎豈啓氣棄訖牽扡釺鉛遷簽謙錢鉗潛淺譴塹槍嗆牆薔強搶鍬橋喬僑翹竅竊欽親寢輕氫傾頃請慶瓊窮趨區軀驅齲顴權勸卻鵲確讓饒擾繞熱韌認紉榮絨軟銳閏潤灑薩鰓賽傘喪騷掃澀殺剎紗篩曬刪閃陝贍繕傷賞燒紹賒捨攝懾設紳審嬸腎滲聲繩勝聖師獅濕詩屍時蝕實識駛勢適釋飾視試壽獸樞輸書贖屬術樹豎數帥雙誰稅順說碩爍絲飼聳慫頌訟誦擻蘇訴肅雖隨綏歲孫損筍縮瑣鎖獺撻擡態攤貪癱灘壇譚談歎湯燙濤絛討籐騰謄銻題體屜條貼鐵廳聽烴銅統頭禿圖塗團頹蛻脫鴕馱駝橢窪襪彎灣頑萬網韋違圍為爲濰維葦偉偽緯謂衛溫聞紋穩問甕撾蝸渦窩臥嗚鎢烏汙誣無蕪吳塢霧務誤錫犧襲習銑戲細蝦轄峽俠狹廈嚇鍁鮮纖鹹賢銜閑顯險現獻縣餡羨憲線廂鑲鄉詳響項蕭囂銷曉嘯蠍協挾攜脅諧寫洩瀉謝鋅釁興洶銹繡虛噓須許敘緒續軒懸選癬絢學勳詢尋馴訓訊遜壓鴉鴨啞亞訝閹煙鹽嚴巖顏閻艷厭硯彥諺驗鴦楊揚瘍陽癢養樣瑤搖堯遙窯謠藥爺頁業葉醫銥頤遺儀彜蟻藝億憶義詣議誼譯異繹蔭陰銀飲隱櫻嬰鷹應纓瑩螢營熒蠅贏穎喲擁傭癰踴詠湧優憂郵鈾猶遊誘輿魚漁娛與嶼語籲禦獄譽預馭鴛淵轅園員圓緣遠願約躍鑰嶽粵悅閱雲鄖勻隕運蘊醞暈韻雜災載攢暫贊贓髒鑿棗竈責擇則澤賊贈紮劄軋鍘閘柵詐齋債氈盞斬輾嶄棧戰綻張漲帳賬脹趙蟄轍鍺這貞針偵診鎮陣掙睜猙爭幀鄭證織職執紙摯擲幟質滯鍾終種腫衆謅軸皺晝驟豬諸誅燭矚囑貯鑄築駐專磚轉賺樁莊裝妝壯狀錐贅墜綴諄濁茲資漬蹤綜總縱鄒詛組鑽製緻瀏籤註擷複';

    if (1 == mod) {
        convert_src = convert_sp;
        convert_des = convert_big;
    } else {
        convert_des = convert_sp;
        convert_src = convert_big;
    }

    for(var i = 0; i < cc.length; i++){
        tmpidx = convert_src.indexOf(cc.charAt(i));
        if(tmpidx != -1) {
            str += convert_des.charAt(tmpidx);
        } else {
            str += cc.charAt(i);
        }
    }
    return str;
}

function changeEncode() {
	//  繁简转换
    if(Sizzle('#smartgbk')[0].checked==true){
        var elements = document.myform.elements;
        for(var i=0;i<elements.length;i++){
            if(elements[i].type == 'text' || elements[i].type == 'textarea') {
                elements[i].value=gbk_convert(elements[i].value);
            }
        }
    }
}
</script>

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
<option value="movie.Comedy">喜剧</option>
<option value="movie.Romance">爱情</option>
<option value="movie.Horror">恐怖</option>
<option value="movie.Drama">剧情</option>
<option value="movie.War">战争</option>
<option value="movie.Thriller">惊悚</option>
<option value="movie.Short">短片</option>
<option value="movie.Documentary">纪录片</option>
<option value="movie.Crime">犯罪</option>
<option value="movie.Adventure">冒险</option>
<option value="movie.Mystery">悬疑</option>
<option value="movie.Animation">动画</option>
<option value="movie.Family">家庭</option>
<option value="movie.Fantasy">奇幻</option>
<option value="movie.Sci-Fi">科幻</option>
<option value="movie.Musical">歌舞</option>
<option value="movie.Western">西部</option>
<option value="movie.Music">音乐</option>
<option value="movie.Biography">传记</option>
<option value="movie.History">历史</option>
<option value="movie.Sport">运动</option>
<option value="movie.Adult">成人</option>
<option value="movie.Ancient-Costume">古装</option>
<option value="movie.Martial-Arts">武侠</option>
<option value="movie.Opera">戏曲</option>
<option value="movie.Kids">儿童</option>
<option value="movie.Erotica">情色</option>
<option value="movie.Stage-Art">舞台艺术</option>
<option value="movie.Film-Noir">黑色电影</option>
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
<option value="china">大陆</option>
<option value="hongkong">香港</option>
<option value="taiwan">台湾</option>
<option value="usa">美国</option>
<option value="japan">日本</option>
<option value="southkorea">韩国</option>
<option value="uk">英国</option>
<option value="france">法国</option>
<option value="thailand">泰国</option>
<option value="germany">德国</option>
<option value="italy">意大利</option>
<option value="russia">俄罗斯</option>
<option value="australia">澳大利亚</option>
<option value="canada">加拿大</option>
<option value="spain">西班牙</option>
<option value="newzealand">新西兰</option>
<option value="poland">波兰</option>
<option value="denmark">丹麦</option>
<option value="greece">希腊</option>
<option value="ireland">爱尔兰</option>
<option value="finland">芬兰</option>
<option value="norway">挪威</option>
<option value="iceland">冰岛</option>
<option value="netherlands">荷兰</option>
<option value="sweden">瑞典</option>
<option value="switzerland">瑞士</option>
<option value="austria">奥地利</option>
<option value="hungary">匈牙利</option>
<option value="portugal">葡萄牙</option>
<option value="belgium">比利时</option>
<option value="bulgaria">保加利亚</option>
<option value="romania">罗马尼亚</option>
<option value="croatia">克罗地亚</option>
<option value="estonia">爱沙尼亚</option>
<option value="latvia">拉脱维亚</option>
<option value="czechrepublic">捷克</option>
<option value="slovak">斯洛伐克</option>
<option value="slovenia">斯洛文尼亚</option>
<option value="lithuania">立陶宛</option>
<option value="turkey">土耳其</option>
<option value="yugoslavia">南斯拉夫</option>
<option value="iran">伊朗</option>
<option value="israel">以色列</option>
<option value="palestine">巴勒斯坦</option>
<option value="mongolia">蒙古</option>
<option value="korea">朝鲜</option>
<option value="macau">澳门</option>
<option value="singapore">新加坡</option>
<option value="india">印度</option>
<option value="pakistan">巴基斯坦</option>
<option value="philippines">菲律宾</option>
<option value="malaysia">马来西亚</option>
<option value="indonesia">印度尼西亚</option>
<option value="vietnam">越南</option>
<option value="laos">老挝</option>
<option value="cambodia">柬埔寨</option>
<option value="mexico">墨西哥</option>
<option value="argentina">阿根廷</option>
<option value="brazil">巴西</option>
<option value="colombia">哥伦比亚</option>
<option value="paraguay">巴拉圭</option>
<option value="chile">智利</option>
<option value="cuba">古巴</option>
<option value="bolivia">玻利维亚</option>
<option value="egypt">埃及</option>
<option value="cameroon">喀麦隆</option>
<option value="southafrica">南非</option>
<option value="monaco">摩纳哥</option>
<option value="others">其它</option>
</select></td>
    </tr>
    <tr>
        <td style="font-size:14px;" valign="top">语言:</td>
        <td><select name="body[language][]" size="6" class="input_1" style="width:208px;" multiple="multiple">
<option value="chinese_simplified">简体中文</option>
<option value="chinese_traditional">繁体中文</option>
<option value="cantonese">粤语</option>
<option value="taiwanese">闽南语</option>
<option value="english">英文</option>
<option value="japanese">日文</option>
<option value="korean">朝鲜文</option>
<option value="franch">法文</option>
<option value="thai">泰文</option>
<option value="italian">意大利文</option>
<option value="russian">俄文</option>
<option value="germen">德文</option>
<option value="spainish">西班牙文</option>
<option value="portuguese">葡萄牙文</option>
<option value="polish">波兰文</option>
<option value="danish">丹麦文</option>
<option value="greek">希腊文</option>
<option value="hindi">印地文</option>
<option value="finnish">芬兰文</option>
<option value="norwegian">挪威文</option>
<option value="icelandic">冰岛文</option>
<option value="dutch">荷兰文</option>
<option value="swedish">瑞典文</option>
<option value="czech">捷克文</option>
<option value="hungarian">匈牙利文</option>
<option value="ukrainnian">乌克兰文</option>
<option value="latin">拉丁文</option>
<option value="turkish">土耳其文</option>
<option value="arabic">阿拉伯文</option>
<option value="hebrew">希伯来文</option>
<option value="persian">波斯文</option>
<option value="bulgarian">保加利亚文</option>
<option value="latvian">拉脱维亚文</option>
<option value="slovak">斯洛伐克文</option>
<option value="slovenian">斯洛文尼亚文</option>
<option value="lithuanian">立陶宛文</option>
<option value="serbian">塞尔维亚文</option>
<option value="armenian">亚马尼亚文</option>
<option value="catalan">加泰罗尼亚文</option>
<option value="croatian">克罗地亚文</option>
<option value="estonian">爱沙尼亚文</option>
<option value="vietmamese">越南文</option>
<option value="filipino">菲律宾文</option>
<option value="indonesian">印度尼西亚文</option>
<option value="romanian">罗马尼亚文</option>
<option value="multi-language">多语言</option>
<option value="others">其它</option>
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
