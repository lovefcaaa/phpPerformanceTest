<?php
/*
* PHP Performance Test
*
* PHP Performance Test is distributed under GPL 2
* Copyright (C) 2014 lovefcaaa <https://github.com/lovefcaaa>
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2 of the License, or any later version.
*/
class PhpPerformanceTest{

     private function infoformat_size($size){
         $u = array('B', 'KB', 'MB', 'GB');
         for($i = 0; $size > 1024 && $i < 4; $i++){
             $size /= 1024;
             }
         return round($size, 2) . $u[$i];
         }
    
     private function stat($functionname){
         $str = "\n" . $functionname . ':' . 
         number_format(microtime(true) - $this -> t, 10, '.', '') . 
         ' S[' . $this -> infoformat_size(memory_get_usage(true)) . ']';
         $this -> t = microtime(true);
         echo $str;
         }
    
     private function echo_system_function(){
         echo '<pre>';
         $exts = get_loaded_extensions();
         $num_m = $num_f = 0;
         foreach($exts as $m){
             $num_m ++;
             $m_funs = get_extension_funcs($m);
             $num_f += count($m_funs);
             echo $m . '<br>';
             print_r($m_funs);
             }
         echo '<br>extension Number:' . $num_m;
         echo '<br>function Number:' . $num_f;
         }
         
    public function test_echo($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             echo 1;
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_md5($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             md5(1);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_curl($num = 100){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             $ch = curl_init ('http://127.0.0.1') ;
             curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
             $res = curl_exec ($ch) ;
             curl_close ($ch) ;
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_iconv($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             iconv("GBK", "UTF-8//IGNORE", '测试iconv');
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_mbstring($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             mb_convert_encoding('测试mbstring', "GBK", "UTF-8");
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_xml($num = 10000){
         $this -> t = microtime(true);
         $xml = "<para><note>simple  note</note><note>simple  note</note><note>simple note</note><note>simple note</note></para>";
         for($i = 0; $i < $num; $i ++){
             $p = xml_parser_create();
             xml_parse_into_struct($p, $xml, $vals, $index);
             xml_parser_free($p);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_reflection($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             $reflector = new ReflectionClass('et_reflection');
             $properties = $reflector -> getProperties();
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_filter($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             filter_var('bob@example.com', FILTER_VALIDATE_EMAIL);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_array_flip($num = 10000){
         $this -> t = microtime(true);
         $arr = array(11, 12, 13, 12);
         for($i = 0; $i < $num; $i ++){
             array_flip($arr);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_json($num = 10000){
         $this -> t = microtime(true);
         $arr = array(11, 12, 13, 12);
         for($i = 0; $i < $num; $i ++){
             json_decode(json_encode($arr));
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_rand($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             rand(0, 10000);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_image($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             $im = imagecreatetruecolor(100, 100);
             imagedestroy($im);
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_file($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             stat('/etc/hosts');
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     public function test_date($num = 10000){
         $this -> t = microtime(true);
         for($i = 0; $i < $num; $i ++){
             date("Y-m-d H:i:s", strtotime('2012-12-12 12:12:12'));
             }
         $this -> stat(__FUNCTION__."[$num]");
         }
    
     }

class et_reflection{
     public $one = '';
     public $two = '';
     public function funOne(){
         }
     public function funTwo(){
         }
     }
