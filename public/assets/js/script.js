// Strict Mode
"use strict";
checkActiveMode();
// Window Load Event
$(window).on("load", function() {
	// Loader Fade Out
    $(".crt-loader").fadeOut();
    return false;
});

function checkActiveMode() {
    // Dark/Light mode condition
    const modeActivated = localStorage.getItem('mode_activated');
    if (modeActivated === 'darkMode') {
        $("link[title]").attr("href","assets/css/dark_style.css");
        $('.crt-theme-style a').text("Light Mode");
    } else {
        $("link[title]").attr("href","assets/css/light_style.css");
        $('.crt-theme-style a').text("Dark Mode");
    }
}

// Header Sticky JS
$(window).on('scroll', function() {
	if ($(this).scrollTop() > 150) {
        $('.crt-header').addClass("crt-boxed__shadow");
	}
	else {
        $('.crt-header').removeClass("crt-boxed__shadow");
	}
});

// Mobile Menu
$(".crt-header-mobile i").on("click",function() {
	if ($(".crt-menu").css("left") !== "0px") {
		$(".crt-menu").css("left","0px");
		$(this).text("close");
	} else {
		$(".crt-menu").css("left","-100%");
		$(this).text("menu");
	}
});

// Search Form
$(".crt-search-btn i").on("click",function(){
	$(".crt-header-content > div").css("opacity","0.0");
	$(".crt-header-search").css({"display":"block","opacity":"1.0"});
	$(".crt-header-search input[type='text']").focus();
});
// $(".material-icons").on("click",function(){
// 	$(".crt-header-search input[type='text']").val('');

// });
$(".crt-header-search input[type='button']").on("click",function(){
	$(".crt-header-content > div").css("opacity","1.0");
	$(".crt-header-search").css({"display":"none"});
});

// Swicth Mode
$(".crt-theme-style a").on("click",function(){
	if ($("link[title]").attr("href") !== "assets/css/light_style.css") {
		$("link[title]").attr("href","assets/css/light_style.css");
        $(this).text("Dark Mode");
        localStorage.setItem('mode_activated', 'lightMode');
	}
	else {
		$("link[title]").attr("href","assets/css/dark_style.css");
        $(this).text("Light Mode");
        localStorage.setItem('mode_activated', 'darkMode');
	}
});


// Search item
$('#crt__search').jsLocalSearch({
    "searchinput": ".crt__search-item",
    "container": "contsearch3",
    "containersearch": "gsearch",
    "action": "Show",
    "html_search": true,
    "mark_text": "si"
});

// Logo submission
function logo_submit() {
	window.location.href= "/submission";
}
