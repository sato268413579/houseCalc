document.addEventListener('DOMContentLoaded', function() {
    if (location.pathname != '/') {
        $(".nav-item.active").removeClass("active");
        $('#' + location.pathname.replace('/', '', location.pathname)).addClass("active");
    }
}, false);