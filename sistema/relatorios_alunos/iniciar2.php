<?php
include("../includes/sessoes.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../includes/connect.inc.php");
?>
<br><br><br><br>
<p><a href='alunos_concluentes.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino fundamental' target='_blank'>- Lista de Alunos Concluentes Ensino Fundamental</a></p>
<p><a href='alunos_concluentes.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Alunos Concluentes Ensino Médio</a></p>
<p><a href='alunos_concluentes_assinatura.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino fundamental' target='_blank'>- Lista de Assinaturas de Alunos Concluentes</a></p>
<p><a href='alunos_concluentes_assinatura.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Assinaturas de Alunos Concluentes</a></p>

<p><a href='alunos_concluentes_diario_oficial.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Alunos Concluentes Para o Diario Oficial</a></p>



<p><a href='alunos_concluentes_diario_oficial_1_4.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Alunos Concluentes Para o Diario Oficial (pagina 1/4)</a></p>
<p><a href='alunos_concluentes_diario_oficial_1_2.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Alunos Concluentes Para o Diario Oficial (pagina 1/2)</a></p>
<p><a href='alunos_concluentes_diario_oficial_3_4.php?d1=<?=$_POST[d1]?>&d2=<?=$_POST[d2]?>&curso=ensino medio' target='_blank'>- Lista de Alunos Concluentes Para o Diario Oficial (pagina 3/4)</a></p>


<br><br><br>
<div align='right'><a href='iniciar.php'>Voltar</a></div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include("../includes/rodape.inc.php");
?>