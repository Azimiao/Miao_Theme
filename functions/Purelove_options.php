<?php
	class pureOptions {
	function getOptions() {
		$options = get_option('pure_options');
		if (!is_array($options)) {
			$options['beianhao'] = '';
			$options['puredescription'] = '';
			$options['purekeyword'] = '';
			$options['tongjicode'] = '';
			$options['feedrss'] = false;
			$options['feedrss_content'] = '';
			$options['twitter'] = false;
			$options['twitter_url'] = '';
			$options['gplus'] = false;
			$options['gplus_url'] = '';
			$options['facebook'] = false;
			$options['facebook_url'] = '';
			$options['lover'] = false;
			$options['lover_url'] = '';
			update_option('pure_options', $options);
		}
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		if(isset($_POST['pure_save'])) {
			$options = pureOptions::getOptions();
			$options['beianhao'] = stripslashes($_POST['beianhao']);
			$options['puredescription'] = stripslashes($_POST['puredescription']);
			$options['purekeyword'] = stripslashes($_POST['purekeyword']);
			$options['tongjicode'] = stripslashes($_POST['tongjicode']);
			if ($_POST['feedrss']) { $options['feedrss'] = (bool)true; } else { $options['feedrss'] = (bool)false; }		
			$options['feedrss_content'] = stripslashes($_POST['feedrss_content']);
			if ($_POST['twitter']) { $options['twitter'] = (bool)true; } else { $options['twitter'] = (bool)false; }		
			$options['twitter_url'] = stripslashes($_POST['twitter_url']);
			if ($_POST['gplus']) { $options['gplus'] = (bool)true; } else { $options['gplus'] = (bool)false; }		
			$options['gplus_url'] = stripslashes($_POST['gplus_url']);
			if ($_POST['facebook']) { $options['facebook'] = (bool)true; } else { $options['facebook'] = (bool)false; }		
			$options['facebook_url'] = stripslashes($_POST['facebook_url']);
			if ($_POST['lover']) { $options['lover'] = (bool)true; } else { $options['lover'] = (bool)false; }		
			$options['lover_url'] = stripslashes($_POST['lover_url']);
			update_option('pure_options', $options);
			echo "<div id='message' class='updated fade'><p><strong>数据已更新</strong></p></div>";
		} else {pureOptions::getOptions();	}
		add_theme_page("主题设置", "主题设置", 'edit_themes', basename(__FILE__), array('pureOptions', 'display'));
	}
	/* -- 标签页 -- */
	function display() {
		$options = pureOptions::getOptions();
?>
<style type="text/css">
#pure_form{font-family:"Century Gothic", "Segoe UI", Arial, "Microsoft YaHei",Sans-Serif;}
.wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
.otakutable td{vertical-align:top;text-align: left;border:none ;font-size:12px; }
.top td{vertical-align: middle;text-align: left; border:none;font-size:12px;}
table{border:none;font-size:12px;}
pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
strong{ color:#666}
textarea{ width:100%; margin:0 20px 0 0; overflow:auto;}
.none{display:none;}
fieldset{ width: 800px;margin: 5px 0 10px;
padding: 10px 10px 20px 10px;
-moz-border-radius: 5px;
-khtml-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
border-radius: 0 0 0 15px;
border: 3px solid #39f;}
fieldset:hover{border-color:#bbb;}
fieldset legend{color: #777;
font-size: 14px;
font-weight: 700;
cursor: pointer;
display: block;
text-shadow: 1px 1px 1px #fff;
min-width: 90px;
padding: 0 3px 0 3px;
border: 1px solid #95abff;
text-align: center;
line-height: 30px;}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
fieldset textarea{ padding:5px 5px;border:1px solid #ABADB3;line-height:150%;margin:1px;-moz-border-radius:0px;-khtml-border-radius:0px;-webkit-border-radius:0px;border-radius:0px; resize:vertical;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($){  
$(".toggle").click(function(){$(this).next().slideToggle('normal')});
});
</script>
<form action="#" method="post" enctype="multipart/form-data" name="pure_form" id="pure_form" />
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Purelove设置</h2><br>	
<fieldset>
<legend class="toggle">Pure模版介绍</legend>
	<div>
		<table width="800" border="1" class="otakutable">
		  <tr>
          	<td width="360">模版名称</td>
		    <td>Purelove</td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		   <tr>
		    <td width="360">作者</td>
		    <td><a href="http://www.wysafe.com">梦月酱</a></td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		   <tr>
		  		    <td width="360">我的专用联系QQ</td>
		    <td>使用者请加670742182<br />方便我的后续更新以及其他支持<br />未来的计划是为了更加的个性化，所以，来吧！</td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		  <tr>
		    <td>特别提醒</td>
		    <td>1：使用主题记得开启评论翻页，否则无法正常排序评论<br />2：社交化增加的是比较常见的SNS<br />
			3：因为自带TagsSEO，方便了SEO<br />
			4：缩略图的问题，在文章中使用特色图像即可</td>
	      </tr>
   			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		 <tr>
		    <td>本次更新时间：</td>
		    <td>2013-08-20</td>
	      </tr>
         
		</table>
      <br>
       	</div>
</fieldset>
<fieldset>
<legend class="toggle">站点信息设置</legend>
	<div>
		<table width="800" border="1" class="otakutable">
		  <tr>
          	<td width="360">备案号 （显示在底部的版权信息处）</td>
		    <td><label><textarea name="beianhao" rows="1" style="width:410px;"><?php echo($options['beianhao']); ?></textarea></label></td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		    <td width="360">网站首页描述 （最好200字以内）</td>
		    <td><label><textarea name="puredescription" rows="3" style="width:410px;"><?php echo($options['puredescription']); ?></textarea></label></td>
	      </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		  <tr>
		    <td>网站首页关键词 （多个关键词用英文的逗号隔开）</td>
		    <td><label><textarea name="purekeyword" rows="3" style="width:410px;"><?php echo($options['purekeyword']); ?></textarea></label></td>
	      </tr>
   			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		 <tr>
		    <td>网站统计代码</td>
		    <td><label><textarea name="tongjicode" rows="3" style="width:410px;"><?php echo($options['tongjicode']); ?></textarea></label></td>
	      </tr>
   			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
          <tr class="top">
          	<td >是否需要自定义feed地址？</td>
            <td><label><input name="feedrss" type="checkbox" value="checkbox" <?php if($options['feedrss']) echo "checked='checked'"; ?> /> 我需要</label></td>
          </tr>
        
           <tr class="top">
          	<td>如需要，请填写feed地址（加上http://）</td>
            <td> <textarea name="feedrss_content" rows="1" style="width:410px;"  ><?php echo($options['feedrss_content']); ?></textarea></td>
          </tr>
         
		</table>
      <br>
       	</div>
</fieldset>
<fieldset>
	<legend class="toggle">Gay都最爱SNS</legend>
    <table width="800" border="1" class="otakutable">
		<tr class="top"><td  width="360">展示Twitter图标</td><td><label><input name="twitter" type="checkbox" value="checkbox" <?php if($options['twitter']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的Twitter地址（加上http://）</td><td> <textarea name="twitter_url"  rows="1"  style="width:410px;"  ><?php echo($options['twitter_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>展示Google+图标</td><td><label><input name="gplus" type="checkbox" value="checkbox" <?php if($options['gplus']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的Google+地址（加上http://）</td><td> <textarea name="gplus_url"  rows="1"  style="width:410px;"  ><?php echo($options['gplus_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>展示Facebook图标</td><td><label><input name="facebook" type="checkbox" value="checkbox" <?php if($options['facebook']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你的Facebook地址（加上http://）</td><td> <textarea name="facebook_url"  rows="1"  style="width:410px;"  ><?php echo($options['facebook_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr class="top"><td>展示你最爱的人的图标</td><td><label><input name="lover" type="checkbox" value="checkbox" <?php if($options['lover']) echo "checked='checked'"; ?> /> 确定</label></td></tr>
        <tr class="top"><td>填写你最爱的人的空间或者微博（加上http://）</td><td> <textarea name="lover_url"  rows="1"  style="width:410px;"  ><?php echo($options['lover_url']); ?></textarea></td>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    </table>
</fieldset>
<!-- 提交按钮 -->
		<p class="submit">
			<input type="submit" name="pure_save" value="更新设置" />
		</p>
</div> 
</form>
 
<?php
	}
}	
/* 登记初始化方法 */
add_action('admin_menu', array('pureOptions', 'init'));
?>