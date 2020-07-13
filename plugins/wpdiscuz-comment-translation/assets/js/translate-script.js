jQuery(document).ready(function ($) {
    var disOpt = wpdiscuzAjaxObj;
    var detectLengAjax;
    var translateAjax;

    function showTrnsLangBoard(button) {
        $('+ .lang-board', button).fadeIn(500);
        button.addClass('opened');
        $('+ .lang-board', button).addClass('opened-board');
    }


    function showAllLangList(id) {
        var langFrom = $('#trns-' + id).attr('data-lang');

        $.each(disOpt.trns_lang_list, function (langKey, lang) {
            $('.all-lang-board').find('.trns-' + langKey).attr('id', langKey + '-' + id);
        });
        $('.all-lang-board').find('#' + langFrom + '-' + id).hide();
        $('.all-lang-board').fadeIn(500);
    }


    function hideTrnsLangBoard() {
        $('.opened-board').fadeOut(500);
        $('.all-lang-board').hide();
        $('.trns-moderate-comment').removeClass('opened');
        $('.lang-board').removeClass('opened-board');
        $('.all-lang-board').find('span').show(50);
    }


    function lastCommentMarginButtom(height) {
        if (!height)
            height = 13;
        else
            height = height - 13;
        var wcThreadWrapper = '.wpd-thread-list';
        if ($('.wc-thread-wrapper-search').find('.search-result').length)
            wcThreadWrapper = '.wc-thread-wrapper-search';
        $(wcThreadWrapper).find('.wpd-comment:last').css({'margin-bottom': height + 'px'});
    }


    $(document).mouseup(function (e) {
        if ($(e.target).closest('.opened').length || $(e.target).closest('.all-lang-content').length)
            return;
        hideTrnsLangBoard();
        lastCommentMarginButtom();
    });



    $(document).delegate('.trns-into-cr', 'click', function () {
        hideTrnsLangBoard();
    });


    $(document).delegate('.original-text', 'click', function () {
        var id = $(this).attr('id').split("-")[1];
        var wcThreadWrapper = '.wpd-thread-list';
        if ($('.wc-thread-wrapper-search').find('.search-result').length)
            wcThreadWrapper = '.wc-thread-wrapper-search';

        if ($('#comment-' + id).find('#wpdiscuz-edit-form').length) {
            var originalComment = $('#comment-' + id).find('#wpdiscuz-edit-form').find('.wc_comment_original').val();
            $('#comment-' + id).find('#wpdiscuz-edit-form').find('.wc_edit_comment').val(originalComment);
        } else {
            $(wcThreadWrapper).find('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').show();
            $(wcThreadWrapper).find('.translated-' + id).hide();
        }
        $(this).hide();
        $(wcThreadWrapper).find('#mod-' + id).show();
    });


    $(document).delegate('.trns-moderate-comment', 'click', function () {
        var button = $(this);
        var id = button.attr('id').split("-")[1];
        var wcThreadWrapper = '.wpd-thread-list';
        if ($('.wc-thread-wrapper-search').find('.search-result').length)
            wcThreadWrapper = '.wc-thread-wrapper-search';
        var lastElementId = $(wcThreadWrapper).find('.wpd-comment:last').attr('id').split("-")[2].split("_")[0];

        if (button.next('.lang-board').find('.trns-temporary').is('span')) {
            var tempID = button.next('.lang-board').find('.trns-temporary').attr('id').split("-")[0];
            if (button.next('.lang-board').find('#' + tempID + '-' + id).hasClass('trns-primary'))
                button.next('.lang-board').find('.trns-temporary').remove();
            else
                button.next('.lang-board').find('.trns-temporary').attr('id', tempID + '-' + id);
        }

        if (button.attr('data-lang') !== 'untranslatable') {
            if (button.attr('data-lang') === 'none') {
                $('.wpdiscuz-loading-bar').show();
                if (detectLengAjax)
                    detectLengAjax.abort();
                detectLengAjax = $.ajax({
                    type: 'post',
                    url: wpdiscuzAjaxObj.url,
                    data: {
                        'action': 'discuz-trns',
                        'action_kind': 'detect-lang',
                        'comm_id': id
                    }
                }).done(function (data) {
                    try {
                        var response = $.parseJSON(data);
                        $('.wpdiscuz-loading-bar').hide();
                        if (response.lang) {
                            var langFrom = response.lang;
                            if (langFrom !== 'und') {
                                button.attr('data-lang', langFrom);
                                $('#' + langFrom + '-' + id).remove();
                                if (button.next('.lang-board').find('.translate-buttons > span').length > 1)
                                    showTrnsLangBoard(button);
                                else
                                    showAllLangList(id);
                                if (lastElementId == id) {
                                    var height = button.next('.lang-board').outerHeight();
                                    lastCommentMarginButtom(height);
                                }
                            } else if (langFrom === 'und') {
                                wpdiscuzAjaxObj.setCommentMessage(button, 'trns-error-dialog', disOpt.trns_error_dialog, false);
                                button.attr('data-lang', 'untranslatable');
                            }
                        } else
                            console.warn(response.error);
                    } catch (e) {
                        console.warn(e);
                    }
                });//end AJAX
            } else {
                if (button.next('.lang-board').find('.translate-buttons > span').length > 1) {
                    $('.translate-buttons').find('#' + button.attr('data-lang') + '-' + id).remove();
                    showTrnsLangBoard(button);
                    if (lastElementId === id) {
                        var height = button.next('.lang-board').outerHeight();
                        lastCommentMarginButtom(height);
                    }
                } else
                    showAllLangList(id);
            }
        } else {
            $('.wpdiscuz-loading-bar').hide();
            wpdiscuzAjaxObj.setCommentMessage(button, 'trns-error-dialog', disOpt.trns_error_dialog, false);
        }
    });


    $(document).delegate('.trns-lang', 'click', function () {
        var button = $(this);
        var langAndId = button.attr('id').split("-");
        var langTo = langAndId[0].replace('_', '-');
        var id = langAndId[1];
        var langFrom = $('#trns-' + id).attr('data-lang');
        var wcThreadWrapper = '.wpd-thread-list';
        if ($('.wc-thread-wrapper-search').find('.search-result').length)
            wcThreadWrapper = '.wc-thread-wrapper-search';

        hideTrnsLangBoard();
        if (button.hasClass('lang-now')) {
            $('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').hide();
            $('#comment-' + id).find('.wc-comment-translated-text').toggle();
            $('#comment-' + id).find('.trns-moderate-comments').toggle();
            $('#comment-' + id).find('.original-text').toggle();
        } else if (button.attr('data-lang') !== 'untranslatable') {
            if (langFrom !== langTo) {
                if (!$(wcThreadWrapper).find('#trns-' + langTo + '-' + id).length) {
                    $('.wpdiscuz-loading-bar').show();
                    var text = $('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').text();
                    if (translateAjax)
                        translateAjax.abort();
                    translateAjax = $.ajax({
                        type: 'post',
                        url: wpdiscuzAjaxObj.url,
                        data: {
                            'action': 'discuz-trns',
                            'action_kind': 'trns-comm',
                            'comm_id': id,
                            'lang_from': langFrom,
                            'lang_to': langTo
                        }
                    }).done(function (data) {
                        try {
                            var response = $.parseJSON(data);
                            $('.wpdiscuz-loading-bar').hide();
                            if (response.trnsComment) {
                                if ($('#comment-' + id).find('#wpdiscuz-edit-form').length) {
                                    var originalComment = $('#comment-' + id).find('#wpdiscuz-edit-form').find('.wc_edit_comment').val();
                                    $('#comment-' + id).find('#wpdiscuz-edit-form').find('.wc_edit_comment').after('<textarea class="wc_comment_original" style="display:none;">' + originalComment + '</textarea>');
                                    $('#comment-' + id).find('#wpdiscuz-edit-form').find('.wc_edit_comment').val(response.trnsComment);
                                } else {
                                    $('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').hide();
                                    $('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').after('<div title="' + text + '" class="wpd-comment-text wc-comment-translated-text translated-' + id + '" id="trns-' + langTo + '-' + id + '">' + response.trnsComment + '</div>');
                                    $(wcThreadWrapper).find('#trns-' + langTo + '-' + id).show();
                                }
                                $(wcThreadWrapper).find('#comment-' + id).find('.trns-moderate-comments').hide();
                                $('#comment-' + id).find('.single-trns-lang').addClass('lang-now');
                                $('#orig-' + id).attr('title', disOpt.trns_lang_list[langFrom]);
                                $(wcThreadWrapper).find('#orig-' + id).show();
                            } else {
                                wpdiscuzAjaxObj.setCommentMessage(button, 'trns-error-dialog', disOpt.trns_error_dialog, false);
                                console.warn(response.error);
                                button.attr('data-lang', 'untranslatable');
                            }
                        } catch (e) {
                            console.warn(e);
                        }
                    });//end AJAX
                } else {
                    $(wcThreadWrapper).find('#comment-' + id).find('.wpd-comment-text').not('.wc-comment-translated-text').hide();
                    $(wcThreadWrapper).find('#trns-' + langTo + '-' + id).show();
                    $(wcThreadWrapper).find('#comment-' + id).find('.trns-moderate-comments').hide();
                    $(wcThreadWrapper).find('#orig-' + id).show();
                }
            } else
                wpdiscuzAjaxObj.setCommentMessage($('#all-' + id), 'trns-error-dialog', disOpt.trns_same_lang_msg + ' ' + disOpt.trns_lang_list[langFrom], false);
        } else
            wpdiscuzAjaxObj.setCommentMessage(button, 'trns-error-dialog', disOpt.trns_error_dialog, false);
        // end IF (button)
    }); //end DELEGATE


    $(document).delegate('.show-all-langs', 'click', function () {
        var id = $(this).attr('id').split("-")[1];
        showAllLangList(id);
    });


    $(document).delegate('.trns-lang-all', 'hover', function () {
        if ($(window).width() > 330) {
            var lang_to = $(this).text();
            $('.trns-into').find('.trns-into-cl > font').html(lang_to);
            $('.trns-into').find('.trns-into-cl > font').toggle();
        }
    });


    $(document).delegate('.trns-lang-all', 'click', function () {
        var lang = $(this).attr('id').split("-")[0];
        var date = new Date(new Date().getTime() + 1800000);
        var outer = $(this).get(0).outerHTML;

        outer = outer.replace(/id=[\'\"](\w+)-\d+[\'\"]/, 'id="$1-0"');
        outer = outer.replace('trns-lang-all', 'trns-temporary');
        $('.trns-temporary').remove();
        $('.lang-board').find('.show-all-langs').before(outer);
        if (wpdiscuzAjaxObj.isCookiesEnabled) {
            document.cookie = 'translateLanguage=' + lang + '; expires=' + date;
        }
    });

    $(document).delegate('.wpd_editable_comment', 'click', function () {
        $(this).parents('.wpd-comment').find('.wc-comment-translated-text').remove();
        $(this).parents('.wpd-comment').find('.original-text').hide();
        $(this).parents('.wpd-comment').find('.trns-moderate-comments').show();
        $(this).parents('.wpd-comment').find('.wpd-comment-text').show();
    });

    $(document).delegate('.wpd_save_edited_comment', 'mousedown', function () {
        $(this).parents('.wpd-comment').find('.original-text').hide();
        $(this).parents('.wpd-comment').find('.trns-moderate-comments').show();
        $(this).parents('.wpd-comment').find('.trns-moderate-comment').attr('data-lang', 'none');
    });
}); // end