<?php
$load = sys_getloadavg();
$charge = $load[1] * 1000 / 30;

if ($charge <= "5") {echo "<img src=\"images/charge/5.jpg\">";}
if ($charge <= "10" and $charge > "5") {echo "<img src=\"images/charge/10.jpg\">";}
if ($charge <= "15" and $charge > "10") {echo "<img src=\"images/charge/15.jpg\">";}
if ($charge <= "20" and $charge > "15") {echo "<img src=\"images/charge/20.jpg\">";}
if ($charge <= "25" and $charge > "20") {echo "<img src=\"images/charge/25.jpg\">";}
if ($charge <= "30" and $charge > "25") {echo "<img src=\"images/charge/30.jpg\">";}
if ($charge <= "35" and $charge > "30") {echo "<img src=\"images/charge/35.jpg\">";}
if ($charge <= "40" and $charge > "35") {echo "<img src=\"images/charge/40.jpg\">";}
if ($charge <= "45" and $charge > "40") {echo "<img src=\"images/charge/45.jpg\">";}
if ($charge <= "50" and $charge > "45") {echo "<img src=\"images/charge/50.jpg\">";}
if ($charge <= "55" and $charge > "50") {echo "<img src=\"images/charge/55.jpg\">";}
if ($charge <= "60" and $charge > "55") {echo "<img src=\"images/charge/60.jpg\">";}
if ($charge <= "65" and $charge > "60") {echo "<img src=\"images/charge/65.jpg\">";}
if ($charge <= "70" and $charge > "65") {echo "<img src=\"images/charge/70.jpg\">";}
if ($charge <= "75" and $charge > "70") {echo "<img src=\"images/charge/75.jpg\">";}
if ($charge <= "80" and $charge > "75") {echo "<img src=\"images/charge/80.jpg\">";}
if ($charge <= "85" and $charge > "80") {echo "<img src=\"images/charge/85.jpg\">";}
if ($charge <= "90" and $charge > "85") {echo "<img src=\"images/charge/90.jpg\">";}
if ($charge <= "95" and $charge > "90") {echo "<img src=\"images/charge/95.jpg\">";}
if ($charge > "95") {echo "<img src=\"images/charge/100.jpg\">";}
?>