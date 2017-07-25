<?php
function mkSalt(){
    $salt = "";
    $saltChars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 23; $i++){
        $salt .= $saltChars[array_rand($saltChars)];
    }
    return $salt;    
}
?>