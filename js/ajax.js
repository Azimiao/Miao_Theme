
var ajaxhome = 'azimiao.com';
var ajaxcontent = new Array("navigation","content");
var ajaxsearch_class = 'searchform';
var ajaxignore_string = new String('#comments,#, /wp-, .pdf, .zip, .rar, /goto');
var ajaxignore = ajaxignore_string.split(', ');
var ajaxloading_code = 'loading';
var ajaxloading_error_code = 'error';
var ajaxreloadDocumentReady = false;
var ajaxtrack_analytics = false
var ajaxscroll_top = true
var ajaxisLoad = false;
var ajaxstarted = false;
var ajaxsearchPath = null;
var ajaxua = jQuery.browser;
jQuery(document).ready(function () {
    ajaxloadPageInit("");
});
window.onpopstate = function (event) {
    if (ajaxstarted === true && ajaxcheck_ignore(document.location.toString()) == true) {
        ajaxloadPage(document.location.toString(), 1);
    }
};

function ajaxloadPageInit(scope) {
    jQuery(scope + "a").click(function (event) {
        if (this.href.indexOf(ajaxhome) >= 0 && ajaxcheck_ignore(this.href) == true) {
            event.preventDefault();
            this.blur();
            var caption = this.title || this.name || "";
            var group = this.rel || false;
            try {
                ajaxclick_code(this);
            } catch (err) {
            }
            ajaxloadPage(this.href);
        }
    });

    jQuery('.' + ajaxsearch_class).each(function (index) {
        if (jQuery(this).attr("action")) {
            ajaxsearchPath = jQuery(this).attr("action");;
            jQuery(this).submit(function () {
                submitSearch(jQuery(this).serialize());
                return false;
            });
        }
    });
    if (jQuery('.' + ajaxsearch_class).attr("action")) { } else {
    }
}

function ajaxloadPage(url, push, getData) {
    if (!ajaxisLoad) {
        if (ajaxscroll_top == true) {
            jQuery('html,body').animate({ scrollTop: 0 }, 1500);
        }
        ajaxisLoad = true;
        ajaxstarted = true;
        nohttp = url.replace("http://", "").replace("https://", "");
        firstsla = nohttp.indexOf("/");
        pathpos = url.indexOf(nohttp);
        path = url.substring(pathpos + firstsla);
        if (push != 1) {
            if (typeof window.history.pushState == "function") {
                var stateObj = { foo: 1000 + Math.random() * 1001 };
                history.pushState(stateObj, "ajax page loaded...", path);
            } else {
            }
        }

        if (!jQuery('#' + ajaxcontent[0])) {
            return;
        }

        jQuery('#' + ajaxcontent[0]).fadeTo("slow", 0.4, function () {
            jQuery('#' + ajaxcontent[0]).fadeIn("slow", function () {
                jQuery.ajax({
                    type: "GET",
                    url: url,
                    data: getData,
                    cache: false,
                    dataType: "html",
                    success: function (data) {
                        ajaxisLoad = false;
                        datax = data.split('<title>');
                        titlesx = data.split('</title>');
                        if (datax.length == 2 || titlesx.length == 2) {
                            dataf = data.split('<title>')[1];
                            titles = dataf.split('</title>')[0];
                            jQuery(document).attr('title', (jQuery("<div/>").html(titles).text()));
                        } else {
                        }

                        if (ajaxtrack_analytics == true) {
                            if (typeof _gaq != "undefined") {
                                if (typeof getData == "undefined") {
                                    getData = "";
                                } else {
                                    getData = "?" + getData;
                                }
                                _gaq.push(['_trackPageview', path + getData]);
                            }
                        }

                        var htmlData = new DOMParser().parseFromString(data, "text/html");

                        for (var ii = 0; ii < ajaxcontent.length; ii++) {


                            var temp = htmlData.querySelector("#" + ajaxcontent[ii]);
                            var output = temp.innerHTML;
                            document.getElementById(ajaxcontent[ii]).innerHTML = output;
                            jQuery('#' + ajaxcontent[ii]).css("position", "absolute");
                            jQuery('#' + ajaxcontent[ii]).css("left", "20000px");
                            jQuery('#' + ajaxcontent[ii]).show();
                            ajaxloadPageInit("#" + ajaxcontent[ii] + " ");
                            jQuery('#' + ajaxcontent[ii]).hide();
                            jQuery('#' + ajaxcontent[ii]).css("position", "");
                            jQuery('#' + ajaxcontent[ii]).css("left", "");
                            jQuery('#' + ajaxcontent[ii]).fadeTo("slow", 1, function () { });
                        }


                        if (ajaxreloadDocumentReady == true) {
                            jQuery(document).trigger("ready");
                        }
                        try {
                            ajaxreload_code();
                        } catch (err) {
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        ajaxisLoad = false;
                        document.title = "Error loading requested page!";
                        //document.getElementById(ajaxcontent[0]).innerHTML = ajaxloading_error_code;
                        alert("获取失败:" + ajaxloading_error_code);
                    }
                });
            });
        });
    }



}
function submitSearch(param) {
    if (!ajaxisLoad) {
        ajaxloadPage(ajaxsearchPath, 0, param);
    }
}
function ajaxcheck_ignore(url) {
    for (var i in ajaxignore) {
        if (url.indexOf(ajaxignore[i]) >= 0) {
            return false;
        }
    }
    return true;
}
function ajaxreload_code() {
    //add code 
    PureLoveThemeInit();
    try {
        GetViewsNum();
    } catch (error) {
        console.log(error);
    }
    try {
        CommentInit();
    } catch (error) {
        console.log(error);
    }
    try {
        GetViewsNumSingle();
    } catch (error) {
        console.log(error);
    }
    SliderInit();


}
function ajaxclick_code(thiss) {
    jQuery('ul.nav li').each(function () {
        jQuery(this).removeClass('current-menu-item');
    });
    jQuery(thiss).parents('li').addClass('current-menu-item');
}
