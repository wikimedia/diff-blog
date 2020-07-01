<?php

if (!defined("ABSPATH")) {
    exit();
}

class wpDiscuzSyntaxHighlighterOptions {

    const OPTION_SLUG = "wpdiscuz_syntax_options";

    public $package;
    public $style;
    public $languages;
    public $customSelector;
    private $defaultOptions;
    public $tabKey = "wsh";

    public function __construct() {
        $this->add();
        $this->init();
        add_action("wpdiscuz_save_options", [&$this, "save"], 16);
        add_action("wpdiscuz_reset_options", [&$this, "reset"], 16);
        add_filter("wpdiscuz_settings", [&$this, "settingsArray"], 16);
    }

    private function initDefaults() {
        $this->defaultOptions = [
            "package" => "small",
            "style" => "default",
            "languages" => ["apache", "bash", "cs", "cpp", "css", "coffeescript", "diff", "xml", "http", "ini", "json", "java", "javascript", "makefile", "markdown", "nginx", "objectivec", "php", "perl", "properties", "python", "ruby", "sql", "shell"],
            "customselector" => "",
        ];
    }

    private function add() {
        $this->initDefaults();
        add_option(self::OPTION_SLUG, $this->defaultOptions, "", "no");
    }

    private function init() {
        $options = get_option(self::OPTION_SLUG);
        $this->style = $options["style"];
        $this->package = $options["package"];
        $this->languages = $options["languages"];
        $this->customSelector = $options["customselector"];
    }

    public function save() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $options["style"] = isset($_POST[$this->tabKey]["wpd_syntax_style"]) ? trim($_POST[$this->tabKey]["wpd_syntax_style"]) : $this->defaultOptions["style"];
            $options["package"] = isset($_POST[$this->tabKey]["wpd_syntax_package"]) ? trim($_POST[$this->tabKey]["wpd_syntax_package"]) : $this->defaultOptions["package"];
            $options["languages"] = isset($_POST[$this->tabKey]["wpd_syntax_languages"]) ? $_POST[$this->tabKey]["wpd_syntax_languages"] : [];
            $options["customselector"] = isset($_POST[$this->tabKey]["wpd_syntax_customselector"]) ? trim($_POST[$this->tabKey]["wpd_syntax_customselector"]) : "";
            update_option(self::OPTION_SLUG, $options);
        }
    }

    public function reset($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            delete_option(self::OPTION_SLUG);
            $this->add();
            $this->init();
        }
    }

    public function settingsArray($settings) {
        $this->init();
        $settings["addons"][$this->tabKey] = [
            "title" => __("Syntax Highlighter", "wpdiscuz_syntax"),
            "title_original" => "Syntax Highlighter",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WSH_DIR_PATH . "/options/options-html.php",
            "values" => $this,
            "options" => [
                "wpd_syntax_style" => [
                    "label" => __("Style", "wpdiscuz_syntax"),
                    "label_original" => "Style",
                    "description" => __("Plugin wpDiscuz Syntax Highlighter uses <a href='https://highlightjs.org/' target='_blank'>highlight.js</a> javascript library. Styles demo you can view <a href='https://highlightjs.org/static/demo/' target='_blank'>here</a>.", "wpdiscuz_syntax"),
                    "description_original" => "Plugin wpDiscuz Syntax Highlighter uses <a href='https://highlightjs.org/' target='_blank'>highlight.js</a> javascript library. Styles demo you can view <a href='https://highlightjs.org/static/demo/' target='_blank'>here</a>.",
                    "docurl" => "#"
                ],
                "wpd_syntax_package" => [
                    "label" => __("Language Packs", "wpdiscuz_syntax"),
                    "label_original" => "Language Packs",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpd_syntax_customselector" => [
                    "label" => __("Custom Selector", "wpdiscuz_syntax"),
                    "label_original" => "Custom Selector",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpd_syntax_lang_small" => [
                    "label" => __("Common", "wpdiscuz_syntax"),
                    "label_original" => "Common",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpd_syntax_lang_middle" => [
                    "label" => __("Middle", "wpdiscuz_syntax"),
                    "label_original" => "Middle",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wpd_syntax_lang_full" => [
                    "label" => __("Full", "wpdiscuz_syntax"),
                    "label_original" => "Full",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}
