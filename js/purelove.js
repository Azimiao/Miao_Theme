var ThemeConfig = ThemeConfig||{
    ajaxHome:"azimiao.com",
    ajaxPath:"http://localhost/wp-admin/admin-ajax.php",
};

function PureLoveThemeInit() {
    try {
        jQuery("#tooltip").remove();
    } catch (error) {

    }
    jQuery('#aio_swc span').mouseover(function () {
        jQuery(this).addClass("on").siblings().removeClass();
        jQuery("." + jQuery(this).attr("id")).fadeIn(650).siblings().hide();
    });
    jQuery('.menu li').hover(function () {
        jQuery(this).find('ul:first').slideDown(200);
        jQuery(this).addClass("hover");
    }, function () {
        jQuery(this).find('ul').css('display', 'none');
        jQuery(this).removeClass("hover");
    });
    jQuery('.menu li li:has(ul)').find("a:first").append(" &raquo; ");
    document.onclick = hide_submenu;

    jQuery("a").each(function (b) {
        if (this.title) {
            var c = this.title;
            var a = 30;
            jQuery(this).mouseover(function (d) {
                this.title = "";
                jQuery("body").append('<div id="tooltip">' + c + "</div>");
                jQuery("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: d.pageY + "px",
                    opacity: "0.8"
                }).show(250)
            }).mouseout(function () {
                this.title = c;
                jQuery("#tooltip").remove()
            }).mousemove(function (d) {
                jQuery("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: d.pageY + "px"
                })
            })
        }
    });

    jQuery('#bak_top').click(function () { jQuery('html,body').animate({ scrollTop: '0px' }, 800); });

    jQuery('.postspicbox a img').hover(
        function () { jQuery(this).fadeTo("fast", 0.6); },
        function () {
            jQuery(this).fadeTo("fast", 1);
        });
    jQuery('h2 a').click(function () {
        jQuery(this).text(' 正在载入本文...');
        window.location = jQuery(this).attr('href');
    });
}
function hide_submenu() {
    jQuery('.menu li li').find('ul').css('display', 'none');
}
function killErrors() {
    return true;
}

window.onscroll = function () {
    document.documentElement.scrollTop + document.body.scrollTop > 100 ? document.getElementById("bak_top").style.display = "block" :
        document.getElementById("bak_top").style.display = "none";
}


function SliderInit() {
    if (!jQuery("#slider")) {
        return;
    }
    jQuery("#slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        pauseControls: true,
        pager: true,
        manualControls: "auto",
        namespace: "slide"
    });
    //幻灯片导航
    jQuery(".mySliderBar").hover(function () { jQuery(".slide_nav").fadeIn(200) }, function () { jQuery(".slide_nav").fadeOut(200) });
}

function GetViewsNum() {
    var mData = document.getElementsByName("viewsNum");
    if (typeof (mData) == "undefined" || mData == null || mData.length <= 0) {
        return;
    }
    for (var i = 0; i < mData.length; i++) {
        var tempID = mData[i].id;
        var tempIDNum = tempID.substring(9);
        GetViewNumAjax(tempID, tempIDNum, mData[i]);
    }
}

function GetViewsNumSingle() {
    ele = document.getElementById("viewsNum");
    if (typeof (ele) == "undefined" || ele == null) {
        return;
    }
    jQuery.ajax({
        type: "GET",
        url: ThemeConfig.ajaxPath,
        data: { action: "SetVisitors", post_id: ele.attributes["name"].value },
        dataType: "json",
        success: function (data) {
            ele.innerHTML = data;
        }
    })
}


function GetViewNumAjax(tempID, tempIDNum, mElement = null) {
    jQuery.ajax({
        type: "GET",
        url: ThemeConfig.ajaxPath,
        data: { action: "GetVisitors", post_id: tempIDNum },
        dataType: "json",
        success: function (data) {
            if (mElement == null) {
                jQuery("#" + tempID).html(data);
                return;
            }
            mElement.innerHTML = data;
        }
    })
}

jQuery(document).ready(function ($) {
    //初始化
    PureLoveThemeInit();
    //幻灯片
    SliderInit();
    //首页浏览计数
    GetViewsNum();
    //文章浏览计数
    GetViewsNumSingle();
});
