jQuery(document).ready(function ($) {
    $(document).delegate('.comment_flag', 'click', function () {
        var clicked = $(this);
        var commentId = clicked.attr('id').substring(3);
        if (clicked.hasClass('comment_flag_modal')) {
            $(".fc-popup").slideToggle(300, function () {
                $('#wpdiscuz_fc_commentid').val(commentId);
            });
        } else {
            fcReport(commentId);
        }
    });

    function fcReport(commentId) {
        var data = new FormData();
        data.append('action', 'fcReport');
        data.append('commentId', commentId);
        wpdiscuzAjaxObj.getAjaxObj(true, true, data).done(function (response) {
            try {
                var r = $.parseJSON(response);
                var clicked = $('#fc_' + commentId);
                if (r.code) {
                    clicked.css('color', wpdiscuzAjaxObj.primaryColor);
                    clicked.addClass('fc_flagged');
                } else {
                    wpdiscuzAjaxObj.setCommentMessage(r.message, 'error');
                }
            } catch (e) {
                console.log(e);
            }
            $('#wpdiscuz-loading-bar').fadeOut(250);
        });
    }


    $(document).delegate('.fc-send', 'click', function () {
        var data = new FormData();
        data.append('action', 'fcReportEmail');
        data.append('form', $('#wpdiscuz_fc_form').serialize());
        wpdiscuzAjaxObj.getAjaxObj(true, true, data).done(function (response) {
            try {
                var r = $.parseJSON(response);
                var clicked = $('#fc_' + r.commentId);
                if (r.code) {
                    clicked.css('color', wpdiscuzAjaxObj.primaryColor);
                    clicked.addClass('fc_flagged');
                    fcResetWindow(2);
                } else {
                    $(".fc_msg").removeClass("fc_success_msg");
                    $(".fc_msg").addClass("fc_error_msg").html(r.message);
                }

            } catch (e) {
                console.log(e);
            }
            $('#wpdiscuz-loading-bar').fadeOut(250);
        });
    });

    $(document).delegate('.fc-close, .fc-email', 'click', function () {
        fcResetWindow();
    });

    function fcResetWindow(a) {
        if (a != 1) {
            $(".fc-popup").slideToggle(300);
        }
        $(".fc_msg").html('');
        $('#wpdiscuz_fc_form')[0].reset();
    }

    if ($('input[name="wpdiscuz_report"]:checked').val() == 'other') {
        $('.fc-message-area').show();
    } else {
        $('.fc-message-area').hide();
    }

    $('input[name="wpdiscuz_report"]').on('change', function () {
        if ($(this).val() == 'other') {
            $('.fc-message-area').show();
        } else {
            $('.fc-message-area').hide();
        }
    });
});