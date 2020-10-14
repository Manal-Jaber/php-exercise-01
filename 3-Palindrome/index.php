<?php
function palindrome($string){
    $half = Math.floor(strlen($string)/2);
    if(substr($string, 0, $half ) === strrev(substr($string, (strlen($string)/2)+1,substr($string, 0, strlen($string)) ))){
        return true;
    }else{
        return false;
    }
    
}
echo palindrome("radar");
?>