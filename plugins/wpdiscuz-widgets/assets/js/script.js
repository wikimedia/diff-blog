jQuery(document).ready(function ($) {
    $(".wpdiscuz-widgets-body > li > a").hide();

    $(".widget-comments-container").each(function () {
        var eachWidget = $(this),
                eachWidgetTabs = $(this).find(".wpdiscuz-widgets-tab-title-list").children("li"),
                minOrderNumber = $(eachWidgetTabs[0]).data("tab-order"),
                defaultTab = $(eachWidgetTabs[0]);

        eachWidgetTabs.each(function (i) {
            if ($(this).data("tab-order") < minOrderNumber) {
                minOrderNumber = $(this).data("tab-order");
                defaultTab = $(this);
            }
        });
        defaultTab.addClass("tab-title-list-active-item");

        var currentTab = eachWidget.find(".tab-title-list-active-item").children().attr("href");
        if (currentTab) {
            eachWidget.find(currentTab).addClass("active-tab-content");
        } else {
            eachWidget.find(".wpdiscuz-widgets-content").children().addClass("active-tab-content");
        }

    });

    if ($(".wpd_widgets_slider_wrapper .wpd_widgets_items_wrapper").length) {
        $(".wpd_widgets_slider_wrapper .wpd_widgets_items_wrapper").slick({
            slidesToShow: 1,
            prevArrow: '<button type="button" class="slick-prev"><span class="fas fa-angle-left"></span></button>',
            nextArrow: '<button type="button" class="slick-next"><span class="fas fa-angle-right"></span></button>',
            autoplay: true,
            dots: true
        });
    }
    /**
     *  to cancel prevent options of links
     */
    $('body').delegate(".wpdiscuz-widgets-tab-title-list li a", 'click', function (e) {
        e.preventDefault();

    });

    $('body').delegate(".wpdiscuz-widgets-tab-title-list li:not(.tab-title-list-active-item)", 'click', function (e) {
        // getting a widget's parent
        var curWidgetParentClass = $(this).parents('div.widget-comments-container').parent();
        var curentItemClass = $(this).attr('class');
        curWidgetParentClass.find('li.tab-title-list-active-item').removeClass('tab-title-list-active-item');
        $(this).addClass('tab-title-list-active-item');
        curWidgetParentClass.find("div.active-tab-content").removeClass("active-tab-content");
        curWidgetParentClass.find("div." + curentItemClass).addClass("active-tab-content");
    });

    /**
     * MEDIA QUERIES
     */
    var widgetOuterWidth = $("#widget-comments-container").outerWidth();

    if (widgetOuterWidth < 280) {
        $(".wpdiscuz-widget-icon-show-box").css({
            "min-width": "30px",
            "height": "30px",
            "font-size": "22px",
            "padding": "3px 2px 2px"
        });
        $("#widget-comments-container .wpd-widget-comment-top > div.wpdiscuz-widget-avatar-box").css({
            "max-width": "40px"

        });
        $(".wpdiscuz-widget-about-comment-right").css({
            "flex": "30 1 10px"
        });

        $(".popular-comment-author-disp-name").css({
            "margin-bottom": "4px"
        });
    }

    if (widgetOuterWidth < 200) {
        $(".wpdiscuz-widgets-tab-title-list li a .fas").css({
            "font-size": "20px"
        });
        $("ul.wpdiscuz-widgets-tab-title-list li a").css({
            "padding": "7px"
        });
        $(".wpdiscuz-widget-icon-show-box").css({
            "min-width": "20px",
            "font-size": "18px",
            "padding": "9px 2px"
        });
    }


});