jQuery(document).ready(function ($) {
    $(document).delegate('#add_field', 'click', function () {
        $(this).before('<span style="display:flex; margin-bottom: 10px;"><input type="text" name="' + wpdiscuzFcObj.tabKey + '[optionType][]" value="" style="margin:1px;padding:3px 5px; width:90%;" /><input type="button" class="report_remove" value=""></span>');
    });
    $(document).delegate('.report_remove', 'click', function () {
        $(this).parents('span').remove();
    });
});