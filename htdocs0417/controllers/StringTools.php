<?php


class StringTools {


    public static function sanitize($text) {

        $text = strip_tags($text);
        $text = trim($text);
        $text = htmlspecialchars($text);

        return $text;
        


    }
}





