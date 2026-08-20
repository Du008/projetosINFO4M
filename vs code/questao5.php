<?php

$num = 67;

if($num % 3 == 0 && $num % 5 == 0){
    echo $num . " é ao mesmo tempo múltiplo de 3 e 5";
}
elseif ($num % 3 == 0){
    echo $num . " é múltiplo de 3";
}elseif ($num % 5 == 0){
    echo $num . " é múltiplo de 5";
}else{
    echo $num . " não é múltiplo de 3 e 5";
}
?>

