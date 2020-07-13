<?php

defined("ABSPATH") or exit;

function langList($apiType) {
    $yan_sup_lang = [
        "he" => __("Yiddish", "wpdiscuz-translate"), "tt" => __("Tatar", "wpdiscuz-translate"), "zh" => __("Chinese", "wpdiscuz-translate"),
    ];

    $google_sup_lang = [
        "am" => __("Amharic", "wpdiscuz-translate"), "bn" => __("Bengali", "wpdiscuz-translate"), "ceb" => __("Cebuano", "wpdiscuz-translate"),
        "ny" => __("Chichewa", "wpdiscuz-translate"), "zh_TW" => __("Chinese (Traditional)", "wpdiscuz-translate"), "co" => __("Corsican", "wpdiscuz-translate"),
        "eo" => __("Esperanto", "wpdiscuz-translate"), "fy" => __("Frisian", "wpdiscuz-translate"), "gu" => __("Gujarati", "wpdiscuz-translate"),
        "ha" => __("Hausa", "wpdiscuz-translate"), "haw" => __("Hawaiian", "wpdiscuz-translate"), "iw" => __("Hebrew", "wpdiscuz-translate"),
        "hi" => __("Hindi", "wpdiscuz-translate"), "hmn" => __("Hmong", "wpdiscuz-translate"), "ig" => __("Igbo", "wpdiscuz-translate"),
        "ja" => __("Japanese", "wpdiscuz-translate"), "jw" => __("Javanese", "wpdiscuz-translate"), "kn" => __("Kannada", "wpdiscuz-translate"),
        "km" => __("Khmer", "wpdiscuz-translate"), "ku" => __("Kurdish (Kurmanji)", "wpdiscuz-translate"), "lo" => __("Lao", "wpdiscuz-translate"),
        "lb" => __("Luxembourgish", "wpdiscuz-translate"), "ml" => __("Malayalam", "wpdiscuz-translate"), "mi" => __("Maori", "wpdiscuz-translate"),
        "mr" => __("Marathi", "wpdiscuz-translate"), "my" => __("Myanmar (Burmese)", "wpdiscuz-translate"), "ne" => __("Nepali", "wpdiscuz-translate"),
        "ps" => __("Pashto", "wpdiscuz-translate"), "pa" => __("Punjabi", "wpdiscuz-translate"), "sm" => __("Samoan", "wpdiscuz-translate"),
        "gd" => __("Scots Gaelic", "wpdiscuz-translate"), "st" => __("Sesotho", "wpdiscuz-translate"), "sn" => __("Shona", "wpdiscuz-translate"),
        "sd" => __("Sindhi", "wpdiscuz-translate"), "si" => __("Sinhala", "wpdiscuz-translate"), "so" => __("Somali", "wpdiscuz-translate"),
        "su" => __("Sundanese", "wpdiscuz-translate"), "ta" => __("Tamil", "wpdiscuz-translate"), "te" => __("Telugu", "wpdiscuz-translate"),
        "ur" => __("Urdu", "wpdiscuz-translate"), "xh" => __("Xhosa", "wpdiscuz-translate"), "yi" => __("Yiddish", "wpdiscuz-translate"),
        "yo" => __("Yoruba", "wpdiscuz-translate"), "zh" => __("Chinese (Simplified)", "wpdiscuz-translate"),
    ];

    $sup_lang = [
        "sq" => __("Albanian", "wpdiscuz-translate"), "en" => __("English", "wpdiscuz-translate"), "ar" => __("Arabic", "wpdiscuz-translate"),
        "hy" => __("Armenian", "wpdiscuz-translate"), "az" => __("Azerbaijan", "wpdiscuz-translate"), "af" => __("Afrikaans", "wpdiscuz-translate"),
        "eu" => __("Basque", "wpdiscuz-translate"), "be" => __("Belarusian", "wpdiscuz-translate"), "bg" => __("Bulgarian", "wpdiscuz-translate"),
        "bs" => __("Bosnian", "wpdiscuz-translate"), "cy" => __("Welsh", "wpdiscuz-translate"), "vi" => __("Vietnamese", "wpdiscuz-translate"),
        "hu" => __("Hungarian", "wpdiscuz-translate"), "ht" => __("Haitian(Creole)", "wpdiscuz-translate"), "gl" => __("Galician", "wpdiscuz-translate"),
        "nl" => __("Dutch", "wpdiscuz-translate"), "el" => __("Greek", "wpdiscuz-translate"), "ka" => __("Georgian", "wpdiscuz-translate"),
        "da" => __("Danish", "wpdiscuz-translate"), "id" => __("Indonesian", "wpdiscuz-translate"), "ga" => __("Irish", "wpdiscuz-translate"),
        "it" => __("Italian", "wpdiscuz-translate"), "is" => __("Icelandic", "wpdiscuz-translate"), "es" => __("Spanish", "wpdiscuz-translate"),
        "kk" => __("Kazakh", "wpdiscuz-translate"), "ca" => __("Catalan", "wpdiscuz-translate"), "ky" => __("Kyrgyz", "wpdiscuz-translate"),
        "zh" => __("Chinese", "wpdiscuz-translate"), "ko" => __("Korean", "wpdiscuz-translate"), "la" => __("Latin", "wpdiscuz-translate"),
        "lv" => __("Latvian", "wpdiscuz-translate"), "lt" => __("Lithuanian", "wpdiscuz-translate"), "mg" => __("Malagasy", "wpdiscuz-translate"),
        "ms" => __("Malay", "wpdiscuz-translate"), "mt" => __("Maltese", "wpdiscuz-translate"), "mk" => __("Macedonian", "wpdiscuz-translate"),
        "mn" => __("Mongolian", "wpdiscuz-translate"), "de" => __("German", "wpdiscuz-translate"), "no" => __("Norwegian", "wpdiscuz-translate"),
        "fa" => __("Persian", "wpdiscuz-translate"), "pl" => __("Polish", "wpdiscuz-translate"), "pt" => __("Portuguese", "wpdiscuz-translate"),
        "ro" => __("Romanian", "wpdiscuz-translate"), "ru" => __("Russian", "wpdiscuz-translate"), "sr" => __("Serbian", "wpdiscuz-translate"),
        "sk" => __("Slovakian", "wpdiscuz-translate"), "sl" => __("Slovenian", "wpdiscuz-translate"), "sw" => __("Swahili", "wpdiscuz-translate"),
        "tg" => __("Tajik", "wpdiscuz-translate"), "th" => __("Thai", "wpdiscuz-translate"), "tl" => __("Tagalog", "wpdiscuz-translate"),
        "tr" => __("Turkish", "wpdiscuz-translate"), "uz" => __("Uzbek", "wpdiscuz-translate"), "uk" => __("Ukrainian", "wpdiscuz-translate"),
        "fi" => __("Finish", "wpdiscuz-translate"), "fr" => __("French", "wpdiscuz-translate"), "hr" => __("Croatian", "wpdiscuz-translate"),
        "cs" => __("Czech", "wpdiscuz-translate"), "sv" => __("Swedish", "wpdiscuz-translate"), "et" => __("Estonian", "wpdiscuz-translate"),
        "ja" => __("Japanese", "wpdiscuz-translate")
    ];

    if ($apiType == "google") {
        $languages = array_merge($sup_lang, $google_sup_lang);
    } elseif ($apiType == "yandex") {
        $languages = array_merge($sup_lang, $yan_sup_lang);
    } else {
        return False;
    }

    asort($languages);
    return $languages;
}
