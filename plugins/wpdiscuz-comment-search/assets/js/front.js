jQuery(document).ready(function ($) {
    var xhr = 0;
    var searchText, input_value, input_name, hidden_value, hidden_name, printed_data, post_id, thisEl;

    function printSearchData(isPage, page, container, hidden_name, allComm, object, printed_data) {

        if (allComm) {
            post_id = 0;
            searchText = $.trim($(object).val());
        } else {
            post_id = wpdiscuzAjaxObj.wc_post_id;
            searchText = $.trim($('.wpdiscuz-comm-search').val());
        }

        if (searchText.length >= search_ajax.searchTextMinLength && searchText.length <= 50) {

            if (allComm) {
                $(object).parent().parent().find('.wpdiscuz-all-search-img').removeClass("fa-search").addClass("fa-spinner fa-pulse");
            } else {
                $('#wpdiscuz-search-img').removeClass("fa-search");
                $('#wpdiscuz-search-img').addClass("fa-spinner fa-pulse");
                hidden_name = $('#wpdiscuz-search-setting-wrap .search-by').attr('name');

            }
            if (!hidden_name) {
                hidden_name = search_ajax.searchDefaultField;
            }

            if (xhr != 0) {
                xhr.abort();
                xhr = 0;
            }

            xhr = $.ajax({
                type: 'POST',
                url: search_ajax.url,
                data: {
                    action: 'wpdiscuz_search_data',
                    page: page,
                    is_page: isPage,
                    search_data: searchText,
                    searchBy: hidden_name,
                    post_id: post_id,
                    allComm: allComm,
                    printed_data: printed_data
                }
            }).done(function (response) {

                if (allComm) {
                    $(object).parent().parent().parent().parent().parent().find('.wpdiscuz-comm-search-all').hide();
                    $(object).parent().parent().parent().parent().parent().find(container).html(response);
                    $(object).parent().parent().find('.wpdiscuz-all-search-img').removeClass("fa-spinner fa-pulse").addClass("fa-search");
                } else {
                    $('.wpd-thread-list').hide();
                    $('.wpdiscuz-front-actions').hide();
                    $(container).html(response);
                    $('#wpdiscuz-search-img').removeClass("fa-spinner fa-pulse");
                    $('#wpdiscuz-search-img').addClass("fa-search");
                }
            });
        } else {
            if (allComm) {
                $(object).parent().parent().parent().parent().parent().find('.wpdiscuz-all-serch-cont').html('');
                $(object).parent().parent().parent().parent().parent().find('.wpdiscuz-comm-search-all').show();
                $(object).parent().parent().find('.wpdiscuz-all-search-img').removeClass("fa-spinner fa-pulse").addClass("fa-search");
            } else {
                $('#wpdiscuz-search-container').html('');
                $('.wpdiscuz-front-actions').show();
                $('.wpd-thread-list').show();
                $('#wpdiscuz-search-img').removeClass("fa-spinner fa-pulse");
                $('#wpdiscuz-search-img').addClass("fa-search");
            }
        }
    }

    $('.wpdiscuz-all-comm-search').keyup(function () {
        hidden_name = $(this).parent().parent().parent().parent().find('.wpdiscuz-search-by').attr('name');
        printSearchData(0, 1, '.wpdiscuz-all-serch-cont', hidden_name, true, this);
    });

    $('.wpdiscuz-comm-search').keyup(function () {
        printSearchData(0, 1, '#wpdiscuz-search-container');
    });

    $(document).delegate('.wpdiscuz-search-pagination-item:not(.pagination-current-page)', 'click', function () {
        var pagination_item_id = $(this).attr('id');
        var pagination_id = pagination_item_id.replace("pagination-", "");
        printSearchData('1', pagination_id, '.search-result');
        $('#wpdiscuz-search-pagination>span').removeClass("pagination-current-page");
        $(this).addClass("pagination-current-page");
    });

    $(document).delegate('.wpdiscuz-search-widget-loadmore', 'click', function () {
        hidden_name = $(this).parent().parent().parent().find('.wpdiscuz-search-by').attr('name');
        var page_id = $(this).attr('data-id');
        ++page_id;
        var this_parent = $(this).parent();
        thisEl = $(this).parent().parent().find('.wpdiscuz-all-comm-search');
        $(this).remove();
        printed_data = this_parent.parent().find(".wpdiscuz-all-serch-cont").html();
        printSearchData('1', page_id, '.wpdiscuz-all-serch-cont', hidden_name, true, thisEl, printed_data);
    });

    $('#wpdiscuz-search-setting-img').click(function () {
        $('#wpdiscuz-search-setting-wrap').slideToggle(200);
        $('#wpdiscuz-search-setting-wrap').addClass('wpdsquz-search-dialog-opened');
    });

    $(document).mouseup(function (e) {
        if ($(e.target).closest("#wpdiscuz-search-setting-img").length)
            return;
        $('#wpdiscuz-search-setting-wrap').slideUp(200);
    });

    $('.wpdiscuz-all-search-setting-img').click(function () {
        $(this).parent().parent().parent().find('.wpdiscuz-search-setting').slideToggle(200);
        $(this).parent().parent().parent().find('.wpdiscuz-search-setting').addClass('wpdsquz-search-dialog-opened');
    });

    $(document).mouseup(function (e) {
        if ($(e.target).closest(".wpdiscuz-all-search-setting-img").length)
            return;
        $('.wpdiscuz-all-search-setting-wrap').slideUp(200);
    });

    $(document).delegate('#wpdiscuz-search-setting-wrap>p', 'click', function () {
        var clicked = $(this);
        var elem = $(':input', clicked);
        input_value = elem.val();
        input_name = elem.attr('name');
        hidden_value = $('#wpdiscuz-search-setting-wrap .search-by').val();
        hidden_name = $('#wpdiscuz-search-setting-wrap .search-by').attr('name');
        $('#wpdiscuz-search-setting-wrap .search-by').val(input_value);
        $('#wpdiscuz-search-setting-wrap .search-by').attr('name', input_name);
        $(this).children().val(hidden_value);
        $(this).children().attr('name', hidden_name);
        if ($('.wpdiscuz-comm-search').val() != '') {
            printSearchData(0, 1, '#wpdiscuz-search-container');
        }
        $('#wpdiscuz-search-setting-wrap').slideUp(200);
    });

    $(document).delegate('.wpdiscuz-all-search-setting-wrap>p', 'click', function () {
        var clicked = $(this);
        var elem = $(':input', clicked);
        var elemSearchBy = $(this).parents('.wpdiscuz-search-widget').find('.wpdiscuz-search-by');
        input_value = elem.val();
        input_name = elem.attr('name');
        hidden_value = elemSearchBy.val();
        hidden_name = elemSearchBy.attr('name');
        elemSearchBy.val(input_value);
        elemSearchBy.attr('name', input_name);
        elem.val(hidden_value);
        elem.attr('name', hidden_name);
        hidden_value = elemSearchBy.val();
        hidden_name = elemSearchBy.attr('name');
        thisEl = $(this).parent().parent().find('.wpdiscuz-all-comm-search');
        if ($('.wpdiscuz-all-comm-search').val() != '') {
            printSearchData(0, 1, '.wpdiscuz-all-serch-cont', hidden_name, true, thisEl);
        }
        $(this).parent('.wpdiscuz-all-search-setting-wrap').slideUp(200);
    });

});