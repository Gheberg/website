

<?php
if (substr_count(gethostbyaddr($_SERVER['REMOTE_ADDR']),'proxad')) { ?>
<div style="position:absolute;top:20%;left:20%;width:60%;height:40%;border:solid black 1px">
<center><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/52/Free_logo.svg/220px-Free_logo.svg.png"><br>
Vous �tes un abonn� Free.
<br><br>
En d�cidant de bloquer les publicit�s, Free vous emp�che d'acc�der gratuitement � ce forum de support technique.
<br>Nous vous invitons � prendre contact avec votre fournisseur d'acc�s pour d�sactiver ce blocage.<br>
Internet est un monde libre, <a href="https://www.gheberg.eu">Gheberg</a> oeuvre tous les jours pour proposer un internet libre.
<br>
Aucun fournisseur ne devrait analyser son trafic et d�cider d'autoriser ou non un flux.
</center>
</div>
<?php
}
?>