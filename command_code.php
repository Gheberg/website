<?php
$ref = $_GET["ref"];
$data = $_GET["data"];
?>
<center>
   <table border="0" cellpadding="0" cellspacing="0" width="450" style="border-color:black">
 <tr>
  <td>
   
  </td>
 </tr>
 <tr>
  <td>
   
  </td>

 </tr>

 <tr>
  <td width="300" bgcolor="#FFFFFF" valign="top" align="center">
   <div style="font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#000">
    <strong>Entrer votre code d'accès</strong>

    <form name="APform" action="https://www.allopass.com/check/index.php4" method="post">
     <input type="hidden" name="RECALL" value="1" />
	 <input type="hidden" name="SITE_ID" value="226116" />
     <input type="hidden" name="DOC_ID" value="1102689" />
	 <input type="hidden" name="DATAS" value="<?php echo"$ref";?><?php echo"$data";?>">
     <input type="hidden" name="LG_SCRIPT" value="fr_uk" /><input type="text" size="8" maxlength="10" value="" name="CODE0" style="background-color: #E7E7E7; border-bottom: 1px solid #000080; border-left: #000080 1px solid; border-right: #000080 1px solid; border-top: #000080 1px solid; color: #000080; cursor: text; font-family: Arial; font-size: 10pt; font-weight: bold; letter-spacing: normal; width: 70px; text-align: center;"> <br />

          <br />
      
     <input type="button" name="APsub" value="" onclick=" this.form.submit();this.form.APsub.disabled=true;" style="border:0px;margin:0px;padding:0px;width:48px;height:18px;background:url('https://www.allopass.com/imgweb/common/bt_ok.gif');" /><br />

    </form>

           <table border="0" width="300" cellpadding="0" cellspacing="0" style="margin-top: 3px;">
       <tr>
        <td></td>
       </tr>
      </table>
     
     
 <table border="0" width="300" cellpadding="0" cellspacing="0">
 <tr>

 <td align="center" bgcolor="#FFFFFF">

 </a>
 </td>
 </tr>
 </table>

         </div>
  </td>
 </tr>

</table>