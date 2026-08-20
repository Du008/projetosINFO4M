<?php
$a = 15;
$b = 32;
$c = 21;

if( $a > $b && $a > $c){
    echo $a . " é o maior numero";
}elseif($b > $c && $b > $a){
    echo $b . " é o maior numero";
}else{
    echo $c . " é o maior numero";
}
?>