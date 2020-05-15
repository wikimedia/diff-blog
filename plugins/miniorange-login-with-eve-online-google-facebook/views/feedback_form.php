<?php

function mo_oauth_client_display_feedback_form() {
    if ( 'plugins.php' != basename( $_SERVER['PHP_SELF'] ) ) {
        return;
    }
    $deactivate_reasons = array("Does not have the features I'm looking for", "Do not want to upgrade to Premium version", "Confusing Interface",
        "Bugs in the plugin", "Unable to register", "Endpoints not available", "Other Reasons");
    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );
    wp_enqueue_script( 'utils' );
    wp_enqueue_style( 'mo_oauth_admin_settings_style', plugin_dir_url( dirname(__FILE__) ) . 'admin/css/style_settings.css');
    
?>
    </head>
    <body>
    <div id="oauth_client_feedback_modal" class="mo_modal">
        <div class="mo_modal-content">
            <span class="mo_close">&times;</span>
            <h3>Tell us what happened? </h3>
            <form name="f" method="post" action="" id="mo_oauth_client_feedback">
                <?php wp_nonce_field('mo_oauth_feedback_form','mo_oauth_feedback_form_field'); ?>
                <input type="hidden" name="mo_oauth_client_feedback" value="true"/>
                <div>
                    <p style="margin-left:2%">
                <?php
                    foreach ( $deactivate_reasons as $deactivate_reason ) { ?>
                    <div class="radio" style="padding:1px;margin-left:2%">
                        <label style="font-weight:normal;font-size:14.6px" for="<?php echo $deactivate_reason; ?>">
                            <input type="radio" name="deactivate_reason_radio" value="<?php echo $deactivate_reason; ?>"
                                   required>
                            <?php echo $deactivate_reason; ?></label>
                    </div>
                    <?php } ?>
                    <br>
                    <textarea id="query_feedback" name="query_feedback" rows="4" style="margin-left:2%;width: 330px"
                              placeholder="Write your query here"></textarea>
                    <br><br>
                    <div class="mo_modal-footer">
                        <input type="submit" name="miniorange_feedback_submit"
                               class="button button-primary button-large" style="float: left;" value="Submit"/>
                        <input id="mo_skip" type="submit" name="miniorange_feedback_skip"
                               class="button button-primary button-large" style="float: right;" value="Skip"/>
                    </div>
                </div>
            </form>
            <form name="f" method="post" action="" id="mo_feedback_form_close">
                <?php wp_nonce_field('mo_oauth_skip_feedback_form','mo_oauth_skip_feedback_form_field'); ?>
                <input type="hidden" name="option" value="mo_oauth_client_skip_feedback"/>
            </form>
        </div>
    </div>
    <script>

        jQuery('a[aria-label="Deactivate <?php echo MO_OAUTH_README_PLUGIN_NAME; ?>"]').click(function () {
            var mo_modal = document.getElementById('oauth_client_feedback_modal');
            var mo_skip = document.getElementById('mo_skip');
            var span = document.getElementsByClassName("mo_close")[0];
            mo_modal.style.display = "block";
            jQuery('input:radio[name="deactivate_reason_radio"]').click(function () {
                var reason = jQuery(this).val();
                var query_feedback = jQuery('#query_feedback');
                query_feedback.removeAttr('required')

                if (reason === "Does not have the features I'm looking for") {
                    query_feedback.attr("placeholder", "Let us know what feature are you looking for");
                    
                } else if (reason === "Other Reasons:") {
                    query_feedback.attr("placeholder", "Can you let us know the reason for deactivation");
                    query_feedback.prop('required', true);

                } else if (reason === "Bugs in the plugin") {
                    query_feedback.attr("placeholder", "Can you please let us know about the bug in detail?");

                } else if (reason === "Confusing Interface") {
                    query_feedback.attr("placeholder", "Finding it confusing? let us know so that we can improve the interface");

                } else if (reason === "Endpoints not available") {
                    query_feedback.attr("placeholder", "We will send you the Endpoints shortly, if you can tell us the name of your OAuth Server/App?");

                } else if (reason === "Unable to register") {
                    query_feedback.attr("placeholder", "Error while creating a new account? Can you please let us know the exact error?");

                }


            });


            span.onclick = function () {
                mo_modal.style.display = "none";
                jQuery('#mo_feedback_form_close').submit();
            }
            mo_skip.onclick = function() {
                mo_modal.style.display = "none";
                jQuery('#mo_feedback_form_close').submit();
            }

            window.onclick = function (event) {
                if (event.target == mo_modal) {
                    mo_modal.style.display = "none";
                }
            }
            return false;

        });
    </script><?php
}

?>