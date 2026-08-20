<?php
$num = 20;

while ($num >= 0){
    if ($num % 5 == 0){
        echo $num . "- Múltiplo de 5\n";
    }else{
        echo $num . "\n";
    }
    $num --;
}
echo "FIM DA CONTAGEM";
?>