<?php
/* 
 * Project Name: KaiBB - http://www.kaibb.co.uk
 * Author: Christopher Shaw
 * This file belongs to KaiBB, it may be freely modified but this notice, and all copyright marks must be left
 * intact. See COPYING.txt
 */
class style{
        function open($tpl){
            global $root, $template,$accid;
            $t = file_get_contents("$root/tpl/$template/$tpl");
            return $t; 
        }

        
        function getcode($tag,$string){
            $begin = '<!-- BEGIN '.$tag.' -->';
            $end = '<!-- END '.$tag.' -->';
            $pos1 = stripos($string, $begin);
            $pos2 = stripos($string, $end);
            $count = strlen($string);
            $count = $count - $pos2;
            $content = substr($string, $pos1, -$count);
            $content = $content.$end;
            return $content;
        }

        
        function tags($Temp, $ParseTags){
            global $template, $siteaddress, $root;
            $globaltags = array("URL" => $siteaddress,"TPL" => $template);
            $Parse = array_merge((array)$ParseTags, (array)$globaltags);
            $T = $Temp;
            foreach($Parse as $UnParsed => $Parsed){
                $T = str_replace("{".$UnParsed."}", $Parsed, $T);
            }

            return $T;
        }

        
        function close(){
            $t = '';
            $content = '';
            $T='';
        }

    }
?>