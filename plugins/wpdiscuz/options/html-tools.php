<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<div class="wrap wpdiscuz_tools_page">
    <div style="float:left; width:50px; height:55px; margin:10px 10px 10px 0px;">
        <img src="<?php echo esc_url_raw(plugins_url(WPDISCUZ_DIR_NAME . "/assets/img/dashboard/wpdiscuz-7-logo.png")); ?>" style="height: 48px;"/>
    </div>
    <h1 style="padding-bottom:20px; padding-top:15px;"><?php esc_html_e("wpDiscuz Tools", "wpdiscuz"); ?></h1>
    <br style="clear:both" />
    <?php settings_errors("wpdiscuz"); ?>
    <div id="toolsTab">
        <ul class="resp-tabs-list tools_tab_id">
            <li><?php esc_html_e("Export options", "wpdiscuz"); ?></li>
            <li><?php esc_html_e("Import options", "wpdiscuz"); ?></li>
            <li><?php esc_html_e("Export phrases", "wpdiscuz"); ?></li>
            <li><?php esc_html_e("Import phrases", "wpdiscuz"); ?></li>
            <li><?php esc_html_e("Import subscriptions", "wpdiscuz"); ?></li>            
            <li><?php esc_html_e("Regenerate Vote Metas", "wpdiscuz"); ?></li>
            <li><?php esc_html_e("Regenerate Closed Comments", "wpdiscuz"); ?></li>  
            <li><?php esc_html_e("Regenerate Vote Data", "wpdiscuz"); ?></li>  
            <li><?php esc_html_e("Synchronize Commenter Data", "wpdiscuz"); ?></li>           
            <li><?php esc_html_e("Rebuild Ratings", "wpdiscuz"); ?></li>           
            <li><?php esc_html_e("Fix Tables", "wpdiscuz"); ?></li>           
        </ul>
        <div class="resp-tabs-container tools_tab_id">
            <?php
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/options-export.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/options-import.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/phrases-export.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/phrases-import.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/subscriptions-import.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/regenerate-vote-metas.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/regenerate-closed-comments.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/regenerate-vote-data.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/sync-commenter-data.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/rebuild-ratings.php";
            include_once WPDISCUZ_DIR_PATH . "/options/tools-layouts/fix-tables.php";
            ?>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            var width = 0;
            var toolsTabsType = 'default';
            $('#toolsTab ul.resp-tabs-list.tools_tab_id li').each(function () {
                width += $(this).outerWidth(true);
            });

            if (width > $('#toolsTab').innerWidth()) {
                toolsTabsType = 'vertical';
            }

            //Horizontal Tab
            $('#toolsTab').wpdiscuzEasyResponsiveTabs({
                type: toolsTabsType, //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                tabidentify: 'tools_tab_id' // The tab groups identifier
            });
            window.addEventListener("hashchange", function () {
                var matches = location.href.match(/#toolsTab(\d+)/);
                if (matches !== null) {
                    $('.resp-tabs-list.tools_tab_id li').eq(matches[1] - 1).click();
                }
            });
        });
    </script>
</div>