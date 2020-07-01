<?php

defined("ABSPATH") or exit;

function wpd_trns_phrases($key) {
    $phrases = [
        "Translate" => __("Translate", "wpdiscuz-translate"),
        "Show all" => __("Show all", "wpdiscuz-translate"),
        "Show all languages" => __("Show all languages", "wpdiscuz-translate"),
        "Original" => __("Original", "wpdiscuz-translate"),
        "Translate into" => __("Translate into", "wpdiscuz-translate"),
        "Can't translate" => __("Can't translate", "wpdiscuz-translate"),
        "Can't translate this comment" => __("Can't translate this comment", "wpdiscuz-translate"),
        "The original comment in" => __("The original comment in", "wpdiscuz-translate")
    ];
    if (isset($phrases[$key])) {
        $settings = get_option("translate_phrases");
        $phrase = isset($settings[$key]) ? wp_unslash($settings[$key]) : $phrases[$key];

        return __($phrase, "wpdiscuz-translate");
    }
}
