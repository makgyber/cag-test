<?php

$fp = fopen('php://stdin', 'r');
$in = '';
while($in != 'X'){
    echo 'tgraf>';
    $in =  trim(fgets($fp));
}
echo "Bye!";
