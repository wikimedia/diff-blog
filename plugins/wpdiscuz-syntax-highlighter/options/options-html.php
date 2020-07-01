<?php
if (!defined("ABSPATH")) {
    exit();
}
$styles = [
    "default" => "Default",
    "a11y-dark" => "A 11 Y Dark",
    "a11y-light" => "A 11 Y Light",
    "agate" => "Agate",
    "androidstudio" => "Androidstudio",
    "an-old-hope" => "An Old Hope",
    "arduino-light" => "Arduino Light",
    "arta" => "Arta",
    "ascetic" => "Ascetic",
    "atelier-cave-dark" => "Atelier Cave Dark",
    "atelier-cave-light" => "Atelier Cave Light",
    "atelier-dune-dark" => "Atelier Dune Dark",
    "atelier-dune-light" => "Atelier Dune Light",
    "atelier-estuary-dark" => "Atelier Estuary Dark",
    "atelier-estuary-light" => "Atelier Estuary Light",
    "atelier-forest-dark" => "Atelier Forest Dark",
    "atelier-forest-light" => "Atelier Forest Light",
    "atelier-heath-dark" => "Atelier Heath Dark",
    "atelier-heath-light" => "Atelier Heath Light",
    "atelier-lakeside-dark" => "Atelier Lakeside Dark",
    "atelier-lakeside-light" => "Atelier Lakeside Light",
    "atelier-plateau-dark" => "Atelier Plateau Dark",
    "atelier-plateau-light" => "Atelier Plateau Light",
    "atelier-savanna-dark" => "Atelier Savanna Dark",
    "atelier-savanna-light" => "Atelier Savanna Light",
    "atelier-seaside-dark" => "Atelier Seaside Dark",
    "atelier-seaside-light" => "Atelier Seaside Light",
    "atelier-sulphurpool-dark" => "Atelier Sulphurpool Dark",
    "atelier-sulphurpool-light" => "Atelier Sulphurpool Light",
    "atom-one-dark" => "Atom One Dark",
    "atom-one-dark-reasonable" => "Atom One Dark Reasonable",
    "atom-one-light" => "Atom One Light",
    "brown-paper" => "Brown Paper",
    "codepen-embed" => "Codepen Embed",
    "color-brewer" => "Color Brewer",
    "darcula" => "Darcula",
    "dark" => "Dark",
    "darkula" => "Darkula",
    "docco" => "Docco",
    "dracula" => "Dracula",
    "far" => "Far",
    "foundation" => "Foundation",
    "github-gist" => "Github Gist",
    "github" => "Github",
    "gml" => "Gml",
    "googlecode" => "Googlecode",
    "grayscale" => "Grayscale",
    "gruvbox-dark" => "Gruvbox Dark",
    "gruvbox-light" => "Gruvbox Light",
    "hopscotch" => "Hopscotch",
    "hybrid" => "Hybrid",
    "idea" => "Idea",
    "ir-black" => "Ir Black",
    "isbl-editor-dark" => "Isbl Editor Dark",
    "isbl-editor-light" => "Isbl Editor Light",
    "kimbie.dark" => "Kimbie Dark",
    "kimbie.light" => "Kimbie Light",
    "lightfair" => "Lightfair",
    "magula" => "Magula",
    "mono-blue" => "Mono Blue",
    "monokai" => "Monokai",
    "monokai-sublime" => "Monokai Sublime",
    "nord" => "Nord",
    "obsidian" => "Obsidian",
    "ocean" => "Ocean",
    "paraiso-dark" => "Paraiso Dark",
    "paraiso-light" => "Paraiso Light",
    "pojoaque" => "Pojoaque",
    "purebasic" => "Purebasic",
    "qtcreator_dark" => "Qtcreator Dark",
    "qtcreator_light" => "Qtcreator Light",
    "railscasts" => "Railscasts",
    "rainbow" => "Rainbow",
    "routeros" => "Routeros",
    "school-book" => "School Book",
    "shades-of-purple" => "Shades Of Purple",
    "solarized-dark" => "Solarized Dark",
    "solarized-light" => "Solarized Light",
    "sunburst" => "Sunburst",
    "tomorrow" => "Tomorrow",
    "tomorrow-night" => "Tomorrow Night",
    "tomorrow-night-blue" => "Tomorrow Night Blue",
    "tomorrow-night-bright" => "Tomorrow Night Bright",
    "tomorrow-night-eighties" => "Tomorrow Night Eighties",
    "vs" => "Vs",
    "vs2015" => "Vs 2015",
    "xcode" => "Xcode",
    "xt256" => "Xt 256",
    "zenburn" => "Zenburn",
];
$smallPack = [
    "apache" => "Apache",
    "bash" => "Bash",
    "cs" => "C#",
    "cpp" => "C++",
    "css" => "CSS",
    "coffeescript" => "CoffeeScript",
    "diff" => "Diff",
    "xml" => "HTML, XML",
    "http" => "HTTP",
    "ini" => "Ini, TOML",
    "json" => "JSON",
    "java" => "Java",
    "javascript" => "JavaScript",
    "makefile" => "Makefile",
    "markdown" => "Markdown",
    "nginx" => "Nginx",
    "objectivec" => "Objective-C",
    "php" => "PHP",
    "perl" => "Perl",
    "properties" => "Properties",
    "python" => "Python",
    "ruby" => "Ruby",
    "sql" => "SQL",
    "shell" => "Shell Session"
];
$middlePack = [
    "armasm" => "ARM Assembly",
    "avrasm" => "AVR Assembler",
    "ada" => "Ada",
    "awk" => "Awk",
    "arduino" => "Arduino",
    "basic" => "Basic",
    "cal" => "C/AL",
    "clojure" => "Clojure",
    "d" => "D",
    "dart" => "Dart",
    "delphi" => "Delphi",
    "erlang" => "Erlang",
    "fsharp" => "F#",
    "fortran" => "Fortran",
    "go" => "Go",
    "groovy" => "Groovy",
    "haskell" => "Haskell",
    "julia" => "Julia",
    "kotlin" => "Kotlin",
    "lisp" => "Lisp",
    "livecodeserver" => "LiveCode",
    "livescript" => "LiveScript",
    "lua" => "Lua",
    "mips" => "MIPS Assembly",
    "mathematica" => "Mathematica",
    "matlab" => "Matlab",
    "postgres" => "PostgreSQL SQL dialect and PL/pgSQL",
    "prolog" => "Prolog",
    "r" => "R",
    "rust" => "Rust",
    "sas" => "SAS",
    "scala" => "Scala",
    "scheme" => "Scheme",
    "swift" => "Swift",
    "typescript" => "TypeScript",
    "vbnet" => "VB.NET",
    "verilog" => "Verilog",
];
$fullPack = [
    "1c" => "1C:Enterprise (v7, v8)",
    "accesslog" => "Access log",
    "actionscript" => "ActionScript",
    "asc" => "AngelScript",
    "applescript" => "AppleScript",
    "arcade" => "ArcGIS Arcade",
    "asciidoc" => "AsciiDoc",
    "aspectj" => "AspectJ",
    "abnf" => "Augmented Backus-Naur Form",
    "autohotkey" => "AutoHotkey",
    "autoit" => "AutoIt",
    "axapta" => "Axapta",
    "bnf" => "Backus–Naur Form",
    "brainfuck" => "Brainfuck",
    "cmake" => "CMake",
    "csp" => "CSP",
    "cos" => "Caché Object Script",
    "capnproto" => "Cap’n Proto",
    "ceylon" => "Ceylon",
    "clean" => "Clean",
    "clojure-repl" => "Clojure REPL",
    "coq" => "Coq",
    "crystal" => "Crystal",
    "crmsh" => "Crmsh",
    "dns" => "DNS Zone file",
    "dos" => "DOS .bat",
    "dts" => "Device Tree",
    "django" => "Django",
    "dockerfile" => "Dockerfile",
    "dust" => "Dust",
    "dsconfig" => "dsconfig",
    "erb" => "ERB (Embedded Ruby)",
    "elixir" => "Elixir",
    "elm" => "Elm",
    "erlang-repl" => "Erlang REPL",
    "excel" => "Excel",
    "ebnf" => "Extended Backus-Naur Form",
    "fix" => "FIX",
    "flix" => "Flix",
    "nc" => "G-code (ISO 6983)",
    "gams" => "GAMS",
    "gauss" => "GAUSS",
    "glsl" => "GLSL",
    "gml" => "GML",
    "feature" => "Gherkin",
    "golo" => "Golo",
    "gradle" => "Gradle",
    "hsp" => "HSP",
    "htmlbars" => "HTMLBars",
    "haml" => "Haml",
    "handlebars" => "Handlebars",
    "haxe" => "Haxe",
    "hy" => "Hy",
    "irpf90" => "IRPF90",
    "isbl" => "ISBL",
    "inform7" => "Inform 7",
    "x86asm" => "Intel x86 Assembly",
    "julia-repl" => "Julia REPL",
    "wildfly-cli" => "jboss-cli",
    "ldif" => "LDIF",
    "llvm" => "LLVM IR",
    "lasso" => "Lasso",
    "leaf" => "Leaf",
    "less" => "Less",
    "lsl" => "Linden Scripting Language",
    "mel" => "MEL(Maya Embedded Language)",
    "maxima" => "Maxima",
    "mercury" => "Mercury",
    "routeros" => "Microtik RouterOS script",
    "mizar" => "Mizar",
    "mojolicious" => "Mojolicious",
    "monkey" => "Monkey",
    "moonscript" => "MoonScript",
    "n1ql" => "N1QL",
    "nsis" => "NSIS",
    "nimrod" => "Nimrod",
    "nix" => "Nix",
    "ocaml" => "OCaml",
    "ruleslanguage" => "Oracle Rules Language",
    "oxygene" => "Oxygene",
    "parser3" => "Parser3",
    "pony" => "Pony",
    "powershell" => "PowerShell",
    "processing" => "Processing",
    "protobuf" => "Protocol Buffers",
    "puppet" => "Puppet",
    "purebasic" => "PureBASIC",
    "profile" => "Python profile",
    "pf" => "PF",
    "plaintext" => "Plain Text",
    "kdb" => "Q",
    "qml" => "QML",
    "re" => "ReasonML",
    "rib" => "RenderMan RIB",
    "rsl" => "RenderMan RSL",
    "graph" => "Roboconf",
    "scss" => "SCSS",
    "ml" => "SML",
    "sqf" => "SQF",
    "p21" => "STEP Part 21",
    "scilab" => "Scilab",
    "smali" => "Smali",
    "smalltalk" => "Smalltalk",
    "stan" => "Stan",
    "stata" => "Stata",
    "stylus" => "Stylus",
    "subunit" => "SubUnit",
    "tp" => "TP",
    "taggerscript" => "Tagger Script",
    "tcl" => "Tcl",
    "tex" => "TeX",
    "tap" => "Test Anything Protocol",
    "thrift" => "Thrift",
    "twig" => "Twig",
    "vbscript" => "VBScript",
    "vbscript-html" => "VBScript in HTML",
    "vhdl" => "VHDL",
    "vala" => "Vala",
    "vim" => "Vim Script",
    "xl" => "XL",
    "xpath" => "XQuery",
    "yaml" => "YAML",
    "zephir" => "Zephir",
];
?>
<script>
    jQuery(document).ready(function ($) {
        $('.wpd_syntax_package').change(function () {
            if (this.value === 'middle') {
                $('#wpd_syntax_lang_middle').show();
                $('#wpd_syntax_lang_full').hide();
            } else if (this.value === 'full') {
                $('#wpd_syntax_lang_middle').show();
                $('#wpd_syntax_lang_full').show();
            } else {
                $('#wpd_syntax_lang_middle').hide();
                $('#wpd_syntax_lang_full').hide();
            }
        });
    });
</script>
<div class="wpd-subtitle">
    <?php _e("General", "wpdiscuz_syntax"); ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpd_syntax_style">
    <div class="wpd-opt-name">
        <label for="wpd_syntax_style"><?php echo $setting["options"]["wpd_syntax_style"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_style"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <select id="wpd_syntax_style" name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_style]">
            <?php
            foreach ($styles as $key => $value) {
                echo "<option value='" . $key . "'  " . selected($setting["values"]->style, $key, false) . ">" . $value . "</option>";
            }
            ?>
        </select>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpd_syntax_package">
    <div class="wpd-opt-name">
        <label><?php echo $setting["options"]["wpd_syntax_package"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_package"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switch-field">
            <input class="wpd_syntax_package" type="radio" value="small" <?php checked($setting["values"]->package == "small"); ?> name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_package]" id="wpd_syntax_package_small" />
            <label for="wpd_syntax_package_small" style="min-width:60px;"><?php _e("Common", "wpdiscuz_syntax"); ?></label>
            <input class="wpd_syntax_package" type="radio" value="middle" <?php checked($setting["values"]->package == "middle"); ?> name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_package]" id="wpd_syntax_package_middle" />
            <label for="wpd_syntax_package_middle" style="min-width:60px;"><?php _e("Middle", "wpdiscuz_syntax"); ?></label>
            <input class="wpd_syntax_package" type="radio" value="full" <?php checked($setting["values"]->package == "full"); ?> name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_package]" id="wpd_syntax_package_full" />
            <label for="wpd_syntax_package_full" style="min-width:60px;"><?php _e("Full", "wpdiscuz_syntax"); ?></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wpd_syntax_customselector">
    <div class="wpd-opt-name">
        <label for="wpd_syntax_customselector"><?php echo $setting["options"]["wpd_syntax_customselector"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_customselector"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" value="<?php echo $setting["values"]->customSelector; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_customselector]" id="wpd_syntax_customselector" />
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Languages", "wpdiscuz_syntax"); ?>
</div>
<?php
if ($setting["values"]->package == "small") {
    $langMiddelStyle = "display:none;";
    $langFullStyle = "display:none;";
} elseif ($setting["values"]->package == "middle") {
    $langMiddelStyle = "display:block;";
    $langFullStyle = "display:none;";
} else {
    $langMiddelStyle = "display:block;";
    $langFullStyle = "display:block;";
}
?>
<!-- Option start -->
<div class="wpd-opt-row" id="wpd_syntax_lang_small" data-wpd-opt="wpd_syntax_lang_small" style="border-bottom: none;">
    <div class="wpd-opt-input" style="width: calc(100% - 40px);">
        <h2 style="margin-bottom: 0px;font-size: 15px; color: #555;"><?php echo $setting["options"]["wpd_syntax_lang_small"]["label"] ?></h2>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_lang_small"]["description"] ?></p>
        <hr />
        <div class="wpd-multi-check" style="padding-top: 10px; padding-left: 10px;">
            <?php
            foreach ($smallPack as $key => $value) {
                ?>
                <div class="wpd-mublock-inline" style="width: 200px; min-width: 33%;">
                    <input type="checkbox" name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_languages][]" <?php checked(in_array($key, $setting["values"]->languages)); ?> value="<?php echo $key; ?>" id="wpd_syntax_languages_<?php echo $key; ?>" style="margin:0px; vertical-align: middle;">
                    <label for="wpd_syntax_languages_<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
                <?php
            }
            ?>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" id="wpd_syntax_lang_middle" data-wpd-opt="wpd_syntax_lang_middle" style="border-bottom: none;<?php echo $langMiddelStyle; ?>">
    <div class="wpd-opt-input" style="width: calc(100% - 40px);">
        <h2 style="margin-bottom: 0px;font-size: 15px; color: #555;"><?php echo $setting["options"]["wpd_syntax_lang_middle"]["label"] ?></h2>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_lang_middle"]["description"] ?></p>
        <hr />
        <div class="wpd-multi-check" style="padding-top: 10px; padding-left: 10px;">
            <?php
            foreach ($middlePack as $key => $value) {
                ?>
                <div class="wpd-mublock-inline" style="width: 200px; min-width: 33%;">
                    <input type="checkbox" name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_languages][]" <?php checked(in_array($key, $setting["values"]->languages)); ?> value="<?php echo $key; ?>" id="wpd_syntax_languages_<?php echo $key; ?>" style="margin:0px; vertical-align: middle;">
                    <label for="wpd_syntax_languages_<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
                <?php
            }
            ?>
            <div style="clear: both"></div>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" id="wpd_syntax_lang_full" data-wpd-opt="wpd_syntax_lang_full" style="border-bottom: none;<?php echo $langFullStyle; ?>">
    <div class="wpd-opt-input" style="width: calc(100% - 40px);">
        <h2 style="margin-bottom: 0px;font-size: 15px; color: #555;"><?php echo $setting["options"]["wpd_syntax_lang_full"]["label"] ?></h2>
        <p class="wpd-desc"><?php echo $setting["options"]["wpd_syntax_lang_full"]["description"] ?></p>
        <hr />
        <div class="wpd-multi-check" style="padding-top: 10px; padding-left: 10px;">
            <?php
            foreach ($fullPack as $key => $value) {
                ?>
                <div class="wpd-mublock-inline" style="width: 200px; min-width: 33%;">
                    <input type="checkbox" name="<?php echo $setting["values"]->tabKey; ?>[wpd_syntax_languages][]" <?php checked(in_array($key, $setting["values"]->languages)); ?> value="<?php echo $key; ?>" id="wpd_syntax_languages_<?php echo $key; ?>" style="margin:0px; vertical-align: middle;">
                    <label for="wpd_syntax_languages_<?php echo $key; ?>"><?php echo $value; ?></label>
                </div>
                <?php
            }
            ?>
            <div style="clear: both"></div>
        </div>
    </div>
</div>