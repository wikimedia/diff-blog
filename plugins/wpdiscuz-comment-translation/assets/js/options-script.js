jQuery(document).ready(function ($) {
    if ($('.check-api').length) {
        if ($('#is-google')[0].checked) {
            $('#is-yandex').parent('.check-api').removeClass('yan-api-checked');
            $('.google-api-input').attr('name', 'api_key');
            $('.yandex-api').hide();
            $('.google-api').show();
        } else if ($('#is-yandex')[0].checked) {
            $('#is-google').parent('.check-api').removeClass('google-api-checked');
            $('.yandex-api-input').attr('name', 'api_key');
            $('.google-api').hide();
            $('.yandex-api').show();
        }
    }

    $(document).delegate('.check-api', 'click', function () {
        $('.set-api').css({'border': '1px solid #DDD', 'color': '#32373C'});
        $('.set-trns-api').css({'background': '#0073AA'});
        $('.valid-logo').html('');
        if ($('#is-google')[0].checked) {
            $('#is-google').parent('.check-api').addClass('google-api-checked');
            $('#is-yandex').parent('.check-api').removeClass('yan-api-checked');
            $('.yandex-api-input').removeAttr('name');
            $('.google-api-input').attr('name', 'api_key');
            $('.google-api').show();
            $('.yandex-api').hide();
        } else if ($('#is-yandex')[0].checked) {
            $('#is-yandex').parent('.check-api').addClass('yan-api-checked');
            $('#is-google').parent('.check-api').removeClass('google-api-checked');
            $('.google-api-input').removeAttr('name');
            $('.yandex-api-input').attr('name', 'api_key');
            $('.google-api').hide();
            $('.yandex-api').show();
        }
    });

    $(document).delegate('.set-trns-api', 'click', function () {
        var apiKey = $.trim($('[name = api_key]').val());

        if (apiKey.length) {
            var apiType;
            if ($('#is-google')[0].checked)
                apiType = 'google';
            else if ($('#is-yandex')[0].checked)
                apiType = 'yandex';

            $('.set-api').css({'border': '1px solid #DDD', 'color': '#32373C'});
            $('.set-trns-api').css({'background': '#0073AA'});
            $('.valid-logo').html('<image src="' + tr_php_obj.pl_url + '/assets/images/loading.gif" />');

            $.ajax({
                type: 'post',
                url: tr_php_obj.ajax_url,
                data: {
                    'action': 'discuz-trns',
                    'action_kind': 'set-key',
                    'trns_api_key': apiKey,
                    'trns_api_type': apiType
                }
            }).done(function (data) {
                try {
                    var response = $.parseJSON(data);
                    if (response.valid === '1') {
                        $('.set-api').css({'border': '1px solid #00B38F', 'color': '#00B38F'});
                        $('.set-trns-api').css({'background': '#00B38F'});
                        $('.valid-logo').html('<image src="' + tr_php_obj.pl_url + '/assets/images/ok.png" />');
                    } else {
                        $('.set-api').css({'border': '1px solid #EB4234', 'color': '#EB4234'});
                        $('.set-trns-api').css({'background': '#EB4234'});
                        $('.valid-logo').html('<image src="' + tr_php_obj.pl_url + '/assets/images/error.png" />');
                        console.log(response.error);
                    }
                } catch (e) {
                    $('.set-api').css({'border': '1px solid #EB4234', 'color': '#EB4234'});
                    $('.set-trns-api').css({'background': '#EB4234'});
                    $('.valid-logo').html('<image src="' + tr_php_obj.pl_url + '/assets/images/error.png" />');
                    console.log(e);
                }
            });//end AJAX    
        }
    });//end CLICK
});//end


