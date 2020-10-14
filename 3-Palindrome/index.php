<?php
function palindrome($string){
    $half = floor(strlen($string)/2);
    if(substr($string, 0, $half ) === strrev(substr($string, $half+1,strlen($string)))){
        return "true";
    }else{
        return "false";
    }
    
}
echo palindrome("rof");
?>