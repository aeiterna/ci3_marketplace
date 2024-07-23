$(document).on("click", ".metismenu li a, .navbar-nav li a", function(e) {
    e.preventDefault();

    var page = $(this).attr("href");

    if ($(this).attr("target") == "_self") {
        window.location.href = page;
        return true;
    }

    if ($(this).attr("target") == "_blank") {
        window.open(page, "_blank");
        return true;
    }

    if (page == "javascript: void(0);") {
        return false;
    }

    // Use replaceState to update the URL without adding to browser history
    window.location.hash = page;
    window.history.replaceState({}, document.title, base_url + page);

    $(".metismenu li, .metismenu li a").removeClass("active");
    $(".metismenu ul").removeClass("in");

    $(".metismenu a").each(function() {
        var pageUrl = window.location.hash.substr(1);
        if ($(this).attr("href") == pageUrl) {
            $(this).addClass("active");
            $(this).parent().addClass("mm-active"); // add active to li of the current link
            $(this).parent().parent().addClass("mm-show");
            $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
            $(this).parent().parent().parent().addClass("mm-active");
            $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
            $(this).parent().parent().parent().parent().parent().addClass("mm-active");
        }
    });

    $(".navbar-nav a").removeClass("active");
    $(".navbar-nav li").removeClass("active");
    $(".navbar-nav a").each(function() {
        var pageUrl = window.location.hash.substr(1);
        if ($(this).attr('href') == pageUrl) {
            $(this).addClass("active");
            $(this).parent().addClass("active");
            $(this).parent().parent().addClass("active");
            $(this).parent().parent().parent().addClass("active");
            $(this).parent().parent().parent().parent().addClass("active");
            $(this).parent().parent().parent().parent().parent().addClass("active");
        }
    });

    if (page == "javascript: void(0);") {
        return false;
    }

    call_ajax_page(page.replace('/admin/view/', ''));
});

function call_ajax_page(page) {
    document.title = "Dashboard | Digivault";

    // Remove the leading and trailing slashes from the page variable
    page = page.replace(/^\/+|\/+$/g, '');

    // Update only the base URL without affecting hash
    window.history.replaceState({}, document.title, base_url + page);
    $.ajax({
        url: base_url + "admin/view/" + page,
        cache: true,
        dataType: "html",
        type: "GET",
        success: function(data) {
            $("#result").empty();
            $("#result").html(data);

            // Update hash after updating base URL
            window.location.hash = '';

            $(window).scrollTop(0);
        }
    });
}

$(document).ready(function() {
    var path = window.location.pathname;

    path = path.replace(/^\/+|\/+$/g, '');

    call_ajax_page(path.replace('/admin/view/', ''));
});

