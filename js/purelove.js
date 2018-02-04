jQuery(document).ready(function($) {
$('#aio_swc span').mouseover(function(){ 
	$(this).addClass("on").siblings().removeClass(); 
	$("."+$(this).attr("id")).fadeIn(650).siblings().hide();  
});
$('.menu li').hover(function(){   
$(this).find('ul:first').slideDown(200);
$(this).addClass("hover");   
},function(){   
$(this).find('ul').css('display','none');   
$(this).removeClass("hover");   
});   
function hide_submenu(){   
$('.menu li li').find('ul').css('display','none');   
}   
$('.menu li li:has(ul)').find("a:first").append(" &raquo; ");   
document.onclick = hide_submenu; 

	$(function() {
    $("a").each(function(b) {
        if (this.title) {
            var c = this.title;
            var a = 30;
            $(this).mouseover(function(d) {
                this.title = "";
                $("body").append('<div id="tooltip">' + c + "</div>");
                $("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: d.pageY + "px",
                    opacity: "0.8"
                }).show(250)
            }).mouseout(function() {
                this.title = c;
                $("#tooltip").remove()
            }).mousemove(function(d) {
                $("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: d.pageY + "px"
                })
            })
        }
    })
    });

jQuery(document).ready(function(){
jQuery('#bak_top').click(function(){jQuery('html,body').animate({scrollTop: '0px'}, 800);}); 
});	

jQuery(function () {
jQuery('.postspicbox a img').hover(
function() {jQuery(this).fadeTo("fast", 0.6);},
function() {jQuery(this).fadeTo("fast", 1);
});
});


jQuery('h2 a').click(function(){
    jQuery(this).text(' 正在载入本文...');
    window.location = jQuery(this).attr('href');
    });

});  

function killErrors() {
  return true;
}

window.onscroll=function(){
     document.documentElement.scrollTop+document.body.scrollTop>100?document.getElementById("bak_top").style.display="block":
     document.getElementById("bak_top").style.display="none";
}
