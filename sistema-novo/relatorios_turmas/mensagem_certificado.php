<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-size: 30px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
}

.texto {
	font-size: 14px;
	font-weight: none;
	font-family: Arial, Helvetica, sans-serif;
	text-align:center;

}

.texto2 {
	font-size: 14px;
	font-weight: none;
	font-family: Arial, Helvetica, sans-serif;
	text-align:center;
	color:#3366CC;
	text-decoration:underline;
}

-->
</style>
<?php
	
	$query = "select b.descricao from turmas a left join cadastro_cursos b on a.codigo_curso=b.codigo where a.codigo='$cod_mensagem'";
	$result = mysql_query($query);
	list($curso) = mysql_fetch_row($result);	
	
	
	
?>

<table width="100%" height="500"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle"><table width="400" height="150" border="2" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><table width="400" height="150" cellpadding="10" cellspacing="0">
          <tr>
            <td align="center" valign="middle"><span class="style1">ALERTA ! </span></td>
          </tr>
          <tr>
            <td align="left" valign="middle" bgcolor="#EDEFEF" class="texto">O certificado de conclus&atilde;o do curso do 
              <b><?=$curso?></b>
              n&atilde;o pode ser emitido para esta turma por motivo de pend&ecirc;ncias em algumas disciplina. </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
