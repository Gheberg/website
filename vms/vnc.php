<?php
$serveur = $_GET['serveur'];
$donnee = explode(":", $serveur);
if ($donnee[0] != NULL AND $donnee[1] != NULL)
{
?>

<HTML>
<TITLE>
Gheberg - VNC
</TITLE>
<BODY>
Le mot de passe est necessairement celui de votre compte (il peut différer de celui de votre session principale).<br>
Attention : le mot de passe initial a été tronqué de tous caractères spéciaux. Y compris ". ; : / @", etc.
<br>
<APPLET ARCHIVE="TightVncViewer.jar"
        CODE="com.tightvnc.vncviewer.VncViewer"
        width='100%' height='100%' vspace=0 hspace=0>
<PARAM NAME="HOST" VALUE="<?php echo"$donnee[0]";?>">
<PARAM NAME="PORT" VALUE="<?php echo"$donnee[1]";?>">
</APPLET>

</BODY>
</HTML>
<?php
}
?>