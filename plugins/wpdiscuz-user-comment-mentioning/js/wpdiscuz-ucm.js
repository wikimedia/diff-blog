jQuery(document).ready(function ($) {
    function user_info(id) {
        $.ajax({
            type: "post",
            url: wpdiscuzAjaxObj.url,
            data: {
                action: 'get_user',
                wcm_user_id: id
            }
        }).done(function (response) {
            try {
                var user_info = $.parseJSON(response);
                set_user_info(user_info);
            } catch (e) {
                console.log(e);
            }
        });
    }
    function comment_info(comment_id) {
        $.ajax({
            type: "post",
            url: wpdiscuzAjaxObj.url,
            data: {
                action: 'get_comment_info',
                wcm_comment_id: comment_id
            }
        }).done(function (response) {
            try {
                var comment_info = $.parseJSON(response);
                set_comment_info(comment_info);
            } catch (e) {
                console.log(e);
            }
        });
    }
    function set_comment_info(comment_info) {
        var html = '';
        if (!comment_info.error) {
            var avatar = comment_info.avatar;
            var user_name = comment_info.user_name;
            var comment = comment_info.comment;
            html = "<div class='ucm-info-header'>" + avatar;
            html += " <div class='ucm-user-name'>" + user_name + "</div></div>";
            if (comment) {

                html += "<div class='ucm-discription'><i class=\"fas fa-quote-left\" aria-hidden=\"true\"></i> " + comment + " <i class=\"fas fa-quote-right\" aria-hidden=\"true\"></div>";
            }
        } else {

            html = comment_info.error;
        }
        $('.user-tooltip').html(html);
    }
    function set_user_info(user_info) {
        var html = '';
        if (!user_info.error) {
            var avatar = user_info.avatar;
            var user_name = user_info.user_name;
            var post_count = user_info.post_count;
            var comment_count = user_info.comment_count;
            var description = user_info.description;
            html = "<div class='ucm-info-header'>" + avatar;
            html += "<div class='ucm-right'> <div class='ucm-user-name'>" + user_name + "</div>";
            html += "<div class='ucm-counts-wrap'><div class='ucm-post-count'>" + wpdiscuzAjaxObj.wpdumc_text_posts + ": " + post_count + "</div>";
            html += "<div class='ucm-comment-count'>" + wpdiscuzAjaxObj.wpdumc_text_comments + ": " + comment_count + "</div> </div> </div></div>";
            if (description) {
                html += "<div class='ucm-discription'><i class=\"fas fa-quote-left\" aria-hidden=\"true\"></i> " + description + "<i class=\"fas fa-quote-right\" aria-hidden=\"true\"></div>";
            }
        } else {
            html = user_info.error;
        }
        $('.user-tooltip').html(html);
    }
    function set_tooltip() {
        var tooltip = "<div class='user-tooltip'><i class='fa fa-spinner fa-spin' style='font-size:24px;color:#888'></i></div>";
        var tooltip_exist = $('body').children('.user-tooltip').hasClass('user-tooltip');
        if (!tooltip_exist) {
            $('body').append(tooltip);
        }
    }

    $(function () {
        var u_id;
        var comment_id;
        $(document).delegate('.hint', 'mouseover', function () {
            if (u_id !== $(this).data('ucm_user_id')) {
                u_id = $(this).data('ucm_user_id');
            }
            if (u_id !== '') {
                user_info(u_id);
            }
        });
        $(document).delegate('.ucm-comment-id', 'mouseover', function () {
            if (comment_id !== $(this).text()) {
                comment_id = $(this).text();
            }
            if (comment_id !== '') {
                comment_info(comment_id);
            }
        });
        $(document).delegate('.ucm-comment-id', 'mousemove', function (event) {
            var windowWidth = window.innerWidth;
            var windowHeight = window.innerHeight;
            var left = event.pageX + 20;
            var top = event.pageY + 20;
            if (windowWidth < 400) {
                left = (windowWidth - 200) / 2;
            } else if (windowWidth - event.pageX < 200) {
                left = event.pageX - 200;
            }
            if (windowHeight - (event.pageY - $(window).scrollTop()) < 200) {
                top = event.pageY - 90;
            }
            $('.user-tooltip').css({top: top, left: left}).show();
        });
        $(document).delegate('.ucm-comment-id', 'mouseover', function () {
            set_tooltip();
        });
        $(document).delegate('.ucm-comment-id', 'mouseout', function () {
            $('.user-tooltip').remove();
        });
        $(document).delegate('.hint', 'mousemove', function (event) {
            var windowWidth = window.innerWidth;
            var windowHeight = window.innerHeight;
            var left = event.pageX + 20;
            var top = event.pageY + 20;
            if (windowWidth < 400) {
                left = (windowWidth - 200) / 2;
            } else if (windowWidth - event.pageX < 200) {
                left = event.pageX - 200;
            }
            if (windowHeight - (event.pageY - $(window).scrollTop()) < 200) {
                top = event.pageY - 90;
            }
            $('.user-tooltip').css({top: top, left: left}).show();
        });
        $(document).delegate('.hint', 'mouseout', function () {
            $('.user-tooltip').remove();
        });
        $(document).delegate('.hint', 'mouseover', function () {
            set_tooltip();
        });
    });
    $(document).delegate('.ucm-comment-id', 'click', function () {
        var mId = $(this).text().replace("#", '');
        var id_repl_exists = $("body").find('#comment-' + mId).length;
        if (id_repl_exists === 0) {
            window.location.reload(true);
        }
    });
});

let wpdumcCachequery = new Map(), wpdumcItems,
        wpdumcSearchTerm = '',
        wpdumcReng = null,
        wpdumcRenderListXHR = null;


function wpdiscuzUMCRenderList(searchTerm, renderList, mentionChar) {
    if (searchTerm.length > 0) {
        if (wpdumcCachequery.has(searchTerm)){
             renderList(wpdumcCachequery.get(searchTerm), searchTerm);
        }else {
            if (wpdumcRenderListXHR !== null) {
                wpdumcRenderListXHR.abort();
            }
            wpdumcRenderListXHR = jQuery.ajax({
                type: "post",
                url: wpdiscuzAjaxObj.url,
                data: {
                    action: 'get_all_users',
                    key_name: searchTerm,
                    post_id: wpdiscuzAjaxObj.wc_post_id
                }
            }).done(function (response) {
                try {
                    let usersData = jQuery.parseJSON(response);
                    if (typeof usersData !== "number") {
                        let users = jQuery.makeArray(usersData);
                        wpdumcCachequery.set(searchTerm,users);
                        renderList(users, searchTerm);
                    }else{
                        renderList([], searchTerm);
                    }
                } catch (e) {
                    console.log(e);
                }
            });
        }
    }else{
        renderList([], searchTerm);
    }
}

function wpdUMCInsertItem(item, insertItem) {
    let editor = wpDiscuzEditor.currentEditor,
    mentionCharPos = null,
    value = ' @' + item.value + ' ';
    if (editor === null) {
        return;
    }
    
    mentionCharPos = wpdumcReng.index - (wpdumcSearchTerm.length + 1);
    editor.deleteText(mentionCharPos, wpdumcSearchTerm.length + 1, Quill.sources.USER);
    editor.insertText(mentionCharPos, value, Quill.sources.USER);
    editor.setSelection(mentionCharPos + value.length, Quill.sources.USER);
}

function wpdUMCRenderItem(item, searchTerm) {
    wpdumcSearchTerm = searchTerm;
    let editor = wpDiscuzEditor.currentEditor;
    editor.emitter.emit(['editor-change', null, null, 'user']);
    wpdumcReng = editor.getSelection();
    let nicename = wpdiscuzAjaxObj.wpdumc_displayNicename ? `@${item.value}` : '';
    return `<div title="${nicename}"><span class="us-av">${item.avatar}</span><span class="us-dn">${item.display_name}</span></div>`;
}