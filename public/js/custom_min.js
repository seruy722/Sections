var $head = $("#ha-header");
$(".ha-waypoint").each(function (b) {
    var a = $(this),
        c = a.data("animateDown"),
        d = a.data("animateUp");
    a.waypoint(function (e) {
        if (e === "down" && c) {
            $head.attr("class", "ha-header " + c)
        } else {
            if (e === "up" && d) {
                $head.attr("class", "ha-header " + d)
            }
        }
    }, {
        offset: "100%"
    })
});
$(function () {
    var b = $("#filter_container");
    b.isotope({
        itemSelector: ".element"
    });
    var a = $("#filter_header .option-set"),
        c = a.find("a");
    c.click(function () {
        var h = $(this);
        if (h.hasClass("selected")) {
            return false
        }
        var f = h.parents(".option-set");
        f.find(".selected").removeClass("selected");
        h.addClass("selected");
        var d = {},
            e = f.attr("data-option-key"),
            g = h.attr("data-option-value");
        g = g === "false" ? false : g;
        d[e] = g;
        if (e === "layoutMode" && typeof changeLayoutMode === "function") {
            changeLayoutMode(h, d)
        } else {
            b.isotope(d)
        }
        return false
    })
});
