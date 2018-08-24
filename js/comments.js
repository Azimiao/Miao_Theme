jQuery.noConflict();

var i = 0,
got = -1,
len = document.getElementsByTagName('script').length;
while (i <= len && got == -1) {
	var js_url = document.getElementsByTagName('script')[i].src,
	got = js_url.indexOf('/comments.js');
	i++
}
var edit_mode = '1',
ajax_php_url = js_url.replace('/comments.js', '/../functions/Purelove_comments.php'),
wp_url = js_url.substr(0, js_url.indexOf('wp-content')),
txt1 = '<div id="loading">正在提交, 请稍候...</div>',
txt2 = '<div id="error">#</div>',
txt3 = '">提交成功',
edt1 = ', 刷新页面之前可以<a rel="nofollow" class="comment-reply-link" href="#edit" onclick=\'return addComment.moveForm("',
edt2 = ')\'>再编辑</a>',
cancel_edit = '取消编辑',
edit,
num = 1,
comm_array = [];
comm_array.push('');

jQuery(document).ready(function($) {
	
	$('.commentlist dt .url').attr('target', '_blank');
	$('#comment-author-info p input').focus(function() {
		$(this).parent('p').addClass('on')
	});
	$('#comment-author-info p input').blur(function() {
		$(this).parent('p').removeClass('on')
	});

	$('#tab-author').click(function() {
		$('#author-info').hide();
		$('#comment-author-info').show();
		$('#author').focus();
		
	})
	
	$('#comment').focus(function(){
		$('.post-area').addClass('post-area-hover');
	})
	$('#comment').blur(function(){
		$('.post-area').removeClass('post-area-hover');
	})
	
	$('#comment-smiley').click(function(){
		$('#smileys').toggle();
	})
	
	$('#smileys a').click(function(){
		$(this).parent().hide();
	})
	
	function addEditor(a, b, c) {
		if (document.selection) {
			a.focus();
			sel = document.selection.createRange();
			c ? sel.text = b + sel.text + c: sel.text = b;
			a.focus()
		} else if (a.selectionStart || a.selectionStart == '0') {
			var d = a.selectionStart;
			var e = a.selectionEnd;
			var f = e;
			c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
			c ? f += b.length + c.length: f += b.length - e + d;
			if (d == e && c) f -= c.length;
			a.focus();
			a.selectionStart = f;
			a.selectionEnd = f
		} else {
			a.value += b + c;
			a.focus()
		}
	}
	var myDate = new Date();
	var mytime=myDate.toLocaleTimeString()
	var g = document.getElementById('comment') || 0;
	var h = {
		daka: function() {
			addEditor(g, '<blockquote>签到成功！签到时间：' + mytime, '，每日打卡，生活更精彩哦~</blockquote>')
			$('.comment-editor').hide();
		},
		good: function() {
			addEditor(g, '<blockquote> :grin:  :grin: 好羞射，文章真的好赞啊，顶博主！', '</blockquote>')
			$('.comment-editor').hide();
		},
		bad: function() {
			addEditor(g, '<blockquote> :twisted:  :twisted: 有点看不懂哦，希望下次写的简单易懂一点！', '</blockquote>')
			$('.comment-editor').hide();
		},
		pre: function() {
			addEditor(g, '<pre>', '</pre>')
		}
	};
	window['SIMPALED'] = {};
	window['SIMPALED']['Editor'] = h
	
	$comments = $('#comments-title');
	$cancel = $('#cancel-comment-reply-link');
	cancel_text = $cancel.text();
	$submit = $('#commentform #submit');
	$submit.attr('disabled', false);
	$('#comment').after(txt1 + txt2);
	$('#loading').hide();
	$('#error').hide();
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
	$('#commentform').submit(function() {
		$('#loading').slideDown();
		$submit.attr('disabled', true).fadeTo('slow', 0.5);
		if (edit) $('#comment').after('<input type="text" name="edit_id" id="edit_id" value="' + edit + '" style="display:none;" />');
		$.ajax({
			url: ajax_php_url,
			data: $(this).serialize(),
			type: $(this).attr('method'),
			error: function(request) {
				var resContent;
				if(request.status != 405){
					var errInfo = new DOMParser().parseFromString(request.responseText, "text/html").querySelector("p");
					resContent = errInfo.innerText;
				}else{
					resContent = request.responseText;
				}
				$('#loading').slideUp();
				$('#error').slideDown().html(request.resContent);
				setTimeout(function() {
					$submit.attr('disabled', false).fadeTo('slow', 1);
					$('#error').slideUp()
				},
				3000)
			},
			success: function(data) {
				$('#loading').hide();
				comm_array.push($('#comment').val());
				$('textarea').each(function() {
					this.value = ''
				});
				var t = addComment,
				cancel = t.I('cancel-comment-reply-link'),
				temp = t.I('wp-temp-form-div'),
				respond = t.I(t.respondId),
				post = t.I('comment_post_ID').value,
				parent = t.I('comment_parent').value;
				if (!edit && $comments.length) {
					n = parseInt($comments.text().match(/\d+/));
					$comments.text($comments.text().replace(n, n + 1))
				}
				new_htm = '" id="new_comm_' + num + '"></';
				new_htm = (parent == '0') ? ('\n<ol style="clear:both;" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');
				ok_htm = '\n<span id="success_' + num + txt3;
				if (edit_mode == '1') {
					div_ = (document.body.innerHTML.indexOf('div-comment-') == -1) ? '': ((document.body.innerHTML.indexOf('li-comment-') == -1) ? 'div-': '');
					ok_htm = ok_htm.concat(edt1, div_, 'comment-', parent, '", "', parent, '", "respond", "', post, '", ', num, edt2)
				}
				ok_htm += '</span><span></span>\n';
				$('#respond').before(new_htm);
				$('#new_comm_' + num).hide().append(data);
				$('#new_comm_' + num + ' li').append(ok_htm);
				$('#new_comm_' + num).fadeIn(4000);
				$body.animate({
					scrollTop: $('#new_comm_' + num).offset().top - 200
				},
				900);
				countdown();
				num++;
				edit = '';
				$('*').remove('#edit_id');
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		});
		return false
	});
	addComment = {
		moveForm: function(commId, parentId, respondId, postId, num) {
			var t = this,
			div, comm = t.I(commId),
			respond = t.I(respondId),
			cancel = t.I('cancel-comment-reply-link'),
			parent = t.I('comment_parent'),
			post = t.I('comment_post_ID');
			if (edit) exit_prev_edit();
			num ? (t.I('comment').value = comm_array[num], edit = t.I('new_comm_' + num).innerHTML.match(/(comment-)(\d+)/)[2], $new_sucs = $('#success_' + num), $new_sucs.hide(), $new_comm = $('#new_comm_' + num), $new_comm.hide(), $cancel.text(cancel_edit)) : $cancel.text(cancel_text);
			t.respondId = respondId;
			postId = postId || false;
			if (!t.I('wp-temp-form-div')) {
				div = document.createElement('div');
				div.id = 'wp-temp-form-div';
				div.style.display = 'none';
				respond.parentNode.insertBefore(div, respond)
			} ! comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
			$body.animate({
				scrollTop: $('#respond').offset().top - 180
			},
			400);
			if (post && postId) post.value = postId;
			parent.value = parentId;
			cancel.style.display = '';
			cancel.onclick = function() {
				if (edit) exit_prev_edit();
				var t = addComment,
				temp = t.I('wp-temp-form-div'),
				respond = t.I(t.respondId);
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
				this.style.display = 'none';
				this.onclick = null;
				return false
			};
			try {
				t.I('comment').focus()
			} catch(e) {}
			return false
		},
		I: function(e) {
			return document.getElementById(e)
		}
	};
	function exit_prev_edit() {
		$new_comm.show();
		$new_sucs.show();
		$('textarea').each(function() {
			this.value = ''
		});
		edit = ''
	}
	var wait = 15,
	submit_val = $submit.val();
	function countdown() {
		if (wait > 0) {
			$submit.val(wait);
			wait--;
			setTimeout(countdown, 1000)
		} else {
			$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
			wait = 15
		}
	}

	function isie6() {
		if ($.browser.msie) {
			if ($.browser.version == "6.0") return true;
		}
		return false;
	}
	
    $body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');$('.pagenav a').live('click', function(e){e.preventDefault();$.ajax({type: "GET",url: $(this).attr('href'),beforeSend: function(){$('.pagenav').remove();$('.commentlist').remove();$('#loading-comments').slideDown();},dataType: "html",success: function(out){result = $(out).find('.commentlist');nextlink = $(out).find('.pagenav');$('#loading-comments').slideUp(500);$('#loading-comments').after(result.fadeIn(800));$('.commentlist').after(nextlink);}});})
});

function grin(tag) {
	tag = ' ' + tag + ' ';
	myField = document.getElementById('comment');
	document.selection ? (myField.focus(), sel = document.selection.createRange(), sel.text = tag, myField.focus()) : insertTag(tag)
}
function insertTag(tag) {
	myField = document.getElementById('comment');
	myField.selectionStart || myField.selectionStart == '0' ? (startPos = myField.selectionStart, endPos = myField.selectionEnd, cursorPos = startPos, myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length), cursorPos += tag.length, myField.focus(), myField.selectionStart = cursorPos, myField.selectionEnd = cursorPos) : (myField.value += tag, myField.focus())
}