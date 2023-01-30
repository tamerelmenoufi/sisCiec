<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.x_menu{
color:#000000;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:20px;
text-align:right;
}
-->
</style>

<script language="javascript">
   function mostra_desc_menu(opc){
       desc_menu.innerHTML =  opc ;
   }

</script>


<?php
    if($ferramentas == 'alunos'){
?>

<table width="100%" height="110"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" background="../img/bg_topo_tools.gif"><table width="100"  border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td>&nbsp;</td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CONFIRMAÇÃO DE INSCRIÇÃO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_cci.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('inscricao.php',document.all.opcao.value,'600','200');"></a></td>
		<td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>ATESTADO DE ELIMINAÇÃO DE DISCIPLINAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_atest_elimina.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('atestado_eliminacao_cursos.php',document.all.opcao.value,'600','250');"></a></td>
		<td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE ELIMINAÇÃO DE DISCIPLINAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_certifi_elimina.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_eliminacao_cursos.php',document.all.opcao.value,'600','250');"></a></td>
        <!--
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE MATRÍCULA</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_matricula.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao.php',document.all.opcao.value,null,null);"></a></td>
		-->
<!--    <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE MATRÍCULA (Ensino Fundamental)</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_matricula.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_e_f.php',document.all.opcao.value,null,null);"></a></td>-->
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE MATRÍCULA</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_matricula.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_e_m_cursos.php',document.all.opcao.value,null,null);"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE CONCLUSÃO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_conclusao.jpg" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_cursos.php',document.all.opcao.value,'600','310');"></a></td>
<!--    <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE CONCLUSÃO ENSINO FUNDAMENTAL</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_conclusao.jpg" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_conclusao.php',document.all.opcao.value,'Ensino fundamental',null);"></a></td>-->
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CERTIFICADO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_certificado.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('certificado_cursos.php',document.all.opcao.value,'600','250');"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>ESPELHO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_historico.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('historico.php',document.all.opcao.value,null,null);"></a></td>
        <!--  <td height="70"><a href="#"><img src="../img/icon_dec_disciplinas.gif" width="53" height="53" border="0"></a></td>
         <td height="70"><a href="#"><img src="../img/icon_pagela_freq.gif" width="53" height="53" border="0"></a></td>
        <td height="70"><a href="#"><img src="../img/icon_pagela_notas.gif" width="53" height="53" border="0"></a></td> -->
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CARTÃO DE RESPOSTAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_cartao_resposta.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('cartao_resposta_geral.php',document.all.opcao.value,'600','200');"></a></td>
        <td height="70"><a href="iniciar.php" onMouseOver="mostra_desc_menu('<span class=x_menu>PUBLICAÇÃO DIÁRIO OFICIAL</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_diario_oficial.gif" width="53" height="53" border="0"></a></td>


        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>OFÍCIO DE AUTENTICIDADE</span>')" onMouseOut="mostra_desc_menu('')" onclick="return imprimir_relatorio('oficio_autenticidade_cursos.php',document.all.opcao.value,'600','250');"><img src="../img/icone_oficio_autenticidade.gif" width="53" height="53" border="0"></a></td>


      
      </tr>
	  <tr><td colspan="20" height="25"><div id="desc_menu"></div></td></tr>
    </table></td>
  </tr>
</table>
<?php
       }else{
?>


<table width="100%" height="53"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="top" background="../img/bg_topo_tools.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CONFIRMAÇÃO DE INSCRIÇÃO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_cci.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('cartao.php',document.all.opcao.value,null,null);"></a></td>
		<td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>ATESTADO DE ELIMINAÇÃO DE DISCIPLINAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_atest_elimina.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('atestado_eliminacao.php',document.all.opcao.value,null,null);"></a></td>
		<td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE ELIMINAÇÃO DE DISCIPLINAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_certifi_elimina.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao_cursos.php',document.all.opcao.value,'600','310');"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>DECLARAÇÃO DE MATRÍCULA</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_dec_matricula.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('declaracao.php',document.all.opcao.value,null,null);"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CERTIFICADO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_certificado.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('certificado_cursos.php',document.all.opcao.value,'600','310');"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>HISTÓRICO</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_historico.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('historico.php',document.all.opcao.value,null,null);"></a></td>

        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>PAGELA DE FREQUÊNCIAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_pagela_freq.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('lista_pagela.php',document.all.opcao.value,null,null);"></a></td>
        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>PAGELA DE NOTAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_pagela_notas.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('notas.php',document.all.opcao.value,null,null);"></a></td> 

        <td height="70"><a href="#" onMouseOver="mostra_desc_menu('<span class=x_menu>CARTÃO DE RESPOSTAS</span>')" onMouseOut="mostra_desc_menu('')"><img src="../img/icon_cartao_resposta.gif" width="53" height="53" border="0" onclick="return imprimir_relatorio('cartao_resposta.php',document.all.opcao.value,null,null);"></a></td>
      </tr>
	  	  <tr><td colspan="20" height="25"><div id="desc_menu"></div></td></tr>
    </table></td>
  </tr>
</table>


<?php
       }
?>