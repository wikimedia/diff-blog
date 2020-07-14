<?php


abstract class MoOAuthClientBasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto rIA;
        }
        self::$constCacheArray = array();
        rIA:
        $Ed = get_called_class();
        if (array_key_exists($Ed, self::$constCacheArray)) {
            goto gxI;
        }
        $tG = new ReflectionClass($Ed);
        self::$constCacheArray[$Ed] = $tG->getConstants();
        gxI:
        return self::$constCacheArray[$Ed];
    }
    public static function isValidName($jd, $K7 = false)
    {
        $E4 = self::getConstants();
        if (!$K7) {
            goto y0m;
        }
        return array_key_exists($jd, $E4);
        y0m:
        $DY = array_map("\x73\164\162\164\x6f\x6c\157\x77\145\162", array_keys($E4));
        return in_array(strtolower($jd), $DY);
    }
    public static function isValidValue($Da, $K7 = true)
    {
        $Q_ = array_values(self::getConstants());
        return in_array($Da, $Q_, $K7);
    }
}
