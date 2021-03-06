<?php

// マルチバイト mb
// 日本語 SJIS, UTF-8 3~6バイト
$text = "あいうえお";

echo strlen($text); // 15 
echo mb_strlen($text); // 5

// 文字列の置換
$str = "文字列を置換します";

echo str_replace("置換", "ちかん", $str);

// 指定文字列で分割
$str_2 = "指定文字列で、分割します";

echo "<pre>";
var_dump(explode("、", $str_2));
echo "</pre>";

//implode くっつける
$nogiArray = ["mayu", "seira", "haruka"];

echo "<pre>";
var_dump(implode(",", $nogiArray));
echo "</pre>";

// 正規表現
// 文字かどうか？ 数字かどうか？ 郵便番号かどうか？
$str_3 = "134-2394";
echo preg_match("/文字列/", $str_3);