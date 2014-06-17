function verif_form_inscription(champ,div,type)
{
	
	if(type=='password')
	{
	
	var pass22=document.getElementById(champ).value;
	
	var reg = new RegExp(/^([a-z0-9]+){4,40}$/); 
	
	var resultat = reg.test(pass22);
	
		if(resultat==true) {
		document.getElementById(div).innerHTML='<img src="images/ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'0');
		}
		else {
		document.getElementById(div).innerHTML='<img src="images/not_ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'1');
		}
	
	}
	else if(type=='email')
	{
	
	var email=document.getElementById(champ).value;
	
	var reg = /^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/;
	
	var resultat = reg.test(email);
	
		if(resultat==true) {
		document.getElementById(div).innerHTML='<img src="images/ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'0');
		}
		else {
		document.getElementById(div).innerHTML='<img src="images/not_ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'1');
		}
	
	}
	else if(type=='empty')
	{
		
		var texte=document.getElementById(champ).value;
	
	if(texte!='')
	{
		document.getElementById(div).innerHTML='<img src="images/ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'0');
	}
	else
	{
		document.getElementById(div).innerHTML='<img src="images/not_ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'1');
	}
	
	}
else if(type=='chiffre')
	{
		
		var texte=document.getElementById(champ).value;
		
		if(!isFinite(texte))
		{
		document.getElementById(div).innerHTML='<img src="images/not_ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'1');
		}
		else
		{
		document.getElementById(div).innerHTML='<img src="images/ok.png" border="0" align="absmiddle"  />';
		change_field_color(champ,'0');
		}
	}

}
