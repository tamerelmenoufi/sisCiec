<?php

  function verifica_certificacao($disciplina,$cod,$curso){ 
	  $query = "select codigo_disciplina from matricula where codigo_aluno='$cod' and codigo_curso='$curso' and situacao='AP'";
	  $result = mysql_query($query);
	  while($dados = mysql_fetch_object($result)){
		if($dados->codigo_disciplina == $disciplina){
		  $retorno = true;
		}
	  }
	  return $retorno;
   }

	$query = "select a.codigo_curso,b.descricao from matricula a left join cadastro_cursos b on a.codigo_curso = b.codigo where codigo_aluno='".$_GET[cod]."' group by codigo_curso";
	$result = mysql_query($query);
	//echo $query;
	while($cursos = mysql_fetch_object($result)){ $cur[] = $cursos->codigo_curso; $cur_desc[] = $cursos->descricao; }

	for($i=0;$i<count($cur);$i++){
		
		   $sql = "select codigo from cadastro_disciplinas where codigo_curso='".$cur[$i]."'";
		   //echo $sql;
		   $sql = mysql_query($sql);
				if(!mysql_num_rows($sql)){
				 $retorno = true;
				}
		
			while($ds = mysql_fetch_object($sql)){
			  if(!verifica_certificacao($ds->codigo,$_GET[cod],$cur[$i])){
				$retorno = true;
			  }
		   }
		
		   if($retorno){
				$mensagem .= "Aluno com pend&ecirc;ncias no Curso de ".$cur_desc[$i]."<br>";
		   }
   
	}

?>
