<?php
include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");

include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../calendario/calendar1.js");

?>

<script>
   function enviar(op){
     var res = prompt('Deseja manter a Resolucao?','<?=$conf[r]?>');
     if(res){
       document.f.action='periodos_print.php?curso='+op+'&r='+res;
       document.f.submit();
     }
   }

</script>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="350" align="center" valign="top">Selecione o Per&iacute;odo:<br />
		<form action="periodos_print.php" target="_blank" method="post" name="f">
	       <select name="periodo">
           		<option value="">:: Selecione ::</option>
           <?php
				$query = "select * from periodos order by descricao";
				$result = mysql_query($query);
				while($d = mysql_fetch_object($result)){
			?>
            		<option value="<?=$d->codigo?>"><?=$d->descricao.' ('.data_formata($d->data_inicial).' a '.data_formata($d->data_final).')'?></option>
            <?php

				}
		   ?>
		</select>
    <br /><br />
      <input type="checkbox" id="marcar_modelo" name="modelo_anterior" value="1" > <span id="modelo_anterior" style="cursor:pointer;">Imprimir documento modelo anterior</span>
      <br /><br />
		<input type="button" name="sb" value="Ensino Medio" onclick="enviar('medio')" />   <input type="button" name="sb" value="Ensino Fundamental" onclick="enviar('fundamental')" />
       </form>
     </td>
   </tr>
 </table>

<script>

  document.getElementById('modelo_anterior').onclick = function()
   {
      console.log(document.getElementById('marcar_modelo').checked);
      if(document.getElementById('marcar_modelo').checked){
        document.getElementById('marcar_modelo').checked = false;
      }else{
        document.getElementById('marcar_modelo').checked = true;
      }
   }

</script>

<?php

include("../includes/rodape.inc.php");

?>
