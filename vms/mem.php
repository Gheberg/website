<?php
$server = $_GET['serv'];
header ("Content-type: image/png"); 
switch ($server) {

case 1:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/fafa.gheberg/memory-week.png");
    break;
case 2:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/chic.gheberg/memory-week.png");
    break;
case 3:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/node101.gheberg/memory-week.png");
    break;
case 4:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/node102.gheberg/memory-week.png");
    break;
case 5:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/node103.gheberg/memory-week.png");
    break;
case 6:
$image4 = imagecreatefrompng("http://graph.gheberg.eu/munin/gheberg/node104.gheberg/memory-week.png");
    break;
}

imagepng($image4);
?>