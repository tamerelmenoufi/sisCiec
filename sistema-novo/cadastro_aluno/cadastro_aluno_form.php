<?php

include("../includes/sessoes.inc.php");
include("../includes/connect.inc.php");
include("../includes/estilos.inc.php");
include("../includes/topo.inc.php");
include("../includes/funcoes_js.inc.php");
include("../calendario/calendar1.js");
include("../includes/verifica_pendencias.php");

if($del){
	$q = "select doc from documentos where codigo='$del'";
	//echo $q."<br>";
	list($doc) = mysql_fetch_row(mysql_query($q));
	$q = "delete from documentos where codigo='$del'";
	//echo $doc;
	mysql_query($q);
	if(is_file($doc)) unlink($doc);
	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&cod=".$cod."&op=editar#Adocs'</script>";
}



?>
<script language='javascript'>
function validar(){
//validar campo nome
if(!document.all.f.nome.value){
alert('Campo nome é obrigatório!');
document.all.f.nome.focus();
return false;
}
return true; 
}
    function notas(valor,nome){
	  if(!valor){
	     eval("document.all.f.x"+nome+".value='FT';");
	  }else if(valor == 0){
	     eval("document.all.f.x"+nome+".value='MT';");
	  }else if(valor < 5){
		 eval("document.all.f.x"+nome+".value='RP';");
	  }else{
		 eval("document.all.f.x"+nome+".value='AP';");
	  }
	}
</script>


<script language="javascript">

  function validar_matricula(CodCurso,Idade){
  
  //validar campo curso
  if(!document.all.f.codigo_curso.value){
  alert('Campo Curso é obrigatório!');
  document.all.f.codigo_curso.focus();
  return false;
  }
  //validar campo disciplina
  if(!document.all.f.codigo_disciplina.value){
  alert('Campo Disciplina é obrigatório!');
  document.all.f.codigo_disciplina.focus();
  return false;
  }
	if(document.all.f.codigo_turma.length > 0){
		 for(i=0;i<document.all.f.codigo_turma.length;i++){
			 if(document.all.f.codigo_turma[i].checked == true ){
				 var checado = true;
			 }
		 }
	  if(checado != true){
		    alert('Selecione uma turma !');
				return false;
		}
	}else{
		 if(document.all.f.codigo_turma.checked == false){
		    alert('Selecione uma turma !');
				return false;
		 }
  }
  
  
	<?php
		$query = "select * from cadastro_cursos";
		$result = mysql_query($query);
		while($d = mysql_fetch_object($result)){
			echo "\tif(CodCurso == '$d->codigo'){\n";
			echo "\t\tif(Idade < $d->idade){\n";
			echo "\t\t\talert(\"Idade Inferior a permitida para este curso.\\n\\nAcesso Negado!\");\n";
			echo "\t\t\treturn false;\n";
			echo "\t\t}\n";		
			echo "\t}\n";		
		}
	?>
  
  
  return true;
  }
  
function confirm_excluir(di,st){

<?php
   //mysql_connect("ciec-db","cieceja","S3nh@sb@nc0") or die("Erro na conex�o ".mysql_error());
   //mysql_select_db( "cieceja_cnery" ) or die("Erro no banco ".mysql_error());
   list($sen) = mysql_fetch_row(mysql_query("select senha from usuarios where login='admincnery'"));   

?>

if(st == 'MT'){

  if(confirm('Deseja excluir a disciplina ' +  di +'?')){
    return true;
  }else{
    return false;
  }
 

}else{


 var t = prompt('Digite o codigo');
 if(t == null) t = 'undefined';
 if(t == '<?=$sen?>'){


  if(confirm('Deseja excluir a disciplina ' +  di +'?')){
    return true;
  }else{
    return false;
  }
 

 }else if(t != 'undefined'){ alert("codigo incorreto, voce nao tem permissao!"); }

}

//alert(t);
return false;


}  
  


function desvincular(di){
  if(confirm('Deseja realmente desvincular a matricula?')){
	  window.location.href='<?=$PHP_SELF?>?op=editar&cod=<?=$cod?>&id=<?=$id?>&desv='+di+"#opinst";
  }else{
    return false;
  }
return false;
}  



   function imprimir_comprovante(val){
      var w = window.open("../relatorios_alunos/cartao.php?cod=" + val,"cartao");
	  w.focus();
	  return false;
   }


	function InstOp(op){
		if(op.value){ window.location.href='<?=$PHP_SELF?>?codigo_escola='+op.value+'&op=<?=$op?>&cod=<?=$cod?>&id=<?=$id?>#opinst'; }
		else{ window.location.href='<?=$PHP_SELF?>?codigo_escola=&op=<?=$op?>&cod=<?=$cod?>&id=<?=$id?>#opinst'; }
	}
	
	
	function consulta_unidades(uni,nome,pai,mae,rg,cpf){
      var w = window.open("./consulta_unidade.php?unidade=" + uni + "&nome="+nome+"&pai="+pai+"&mae="+mae+"&rg="+rg+"&cpf="+cpf,"unidade","width=800, height=600, scrollbars=1");
	  w.focus();
	  return false;
			
	}
  
    
</script>





<?php

if($_GET[desv]){
	mysql_query("update matricula set codigo_matricula = '' where codigo = '".$_GET[desv]."'");
	}


$data_nascimento = $dia_nascimento.'-'.$mes_nascimento.'-'.$ano_nascimento;

if (isset($inserir)){
	
	if($foto and $foto != 'none'){
		$foto_name	=	$_FILES["foto"]["name"];
		$ext = explode(".",$foto_name);
		$next = (count($ext)-1);
		$ext = $ext[$next];
		$ximg="img/".md5(date(YmdHis).$foto_name).".".$ext;
		$foto_temp	=	$_FILES["foto"]["tmp_name"];
		copy($foto_temp,$ximg);
		$imagem[foto] = "$ximg";
	}
	else {
		$imagem[foto] = "";
	}
	
	
	
$query = " insert into cadastro_aluno ( ";
$query .= " foto,";
$query .= " cci,";
$query .= " nome,";
$query .= " login,";
$query .= " senha,";
$query .= " nome_pai,";
$query .= " nome_mae,";
$query .= " cpf,";
$query .= " certidao_nascimento,";
$query .= " certidao_nascimento_livro,";
$query .= " certidao_nascimento_folha,";
$query .= " rg,";
$query .= " rg_orgao,";
$query .= " telefone,";
$query .= " sms,";
$query .= " email,";
$query .= " data_nascimento,";
$query .= " nacionalidade,";
$query .= " rne,";
$query .= " passaporte,";
$query .= " cidade,";
$query .= " estado,";
$query .= " data_inscricao,";
$query .= " obs_bloqueio,";
$query .= " observacao";
$query .= " ) values (";
$query .= " '".$imagem['foto']."',";
$query .= " '$cci',";
$query .= " '$nome',";
$query .= " replace('$rg','-',''),";
$query .= " replace('$rg','-',''),";
$query .= " '$nome_pai',";
$query .= " '$nome_mae',";
$query .= " '$cpf',";
$query .= " '$certidao_nascimento',";
$query .= " '$certidao_nascimento_livro',";
$query .= " '$certidao_nascimento_folha',";
$query .= " '$rg',";
$query .= " '$rg_orgao',";
$query .= " '$telefone',";
$query .= " '$sms',";
$query .= " '$email',";
$query .= " '".data_formata($data_nascimento)."',";
$query .= " '".(($nacionalidade == 'brasileira')?$nacionalidade:(($nacionalidade_qual)?$nacionalidade_qual:'estrangeira'))."',";
$query .= " '$rne',";
$query .= " '$passaporte',";
$query .= " '$cidade',";
$query .= " '$estado',";
$query .= " '".data_formata($data_inscricao)."',";
$query .= " '$obs_bloqueio',";
$query .= " '$observacao'";
$query .= " )";
//echo $query; //exit;
//*
$result = mysql_query($query);
$cod = mysql_insert_id();
logs('cadastro_aluno','insert',$cod,$query);
echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&cod=".$conf[Unidade].$cod."&op=editar'</script>";
//*/
}
elseif(isset($alterar)){
	
	if($foto and $foto != 'none'){
		$foto_name	=	$_FILES["foto"]["name"];
		$ext = explode(".",$foto_name);
		$next = (count($ext)-1);
		$ext = $ext[$next];
		$ximg="img/".md5(date(YmdHis).$foto_name).".".$ext;
		//$tipo = $_FILES["foto"]["type"];
		$foto_temp	=	$_FILES["foto"]["tmp_name"];
		copy($foto_temp,$ximg);
		$imagem[foto] = "$ximg";
		@unlink($foto_atual);
	}elseif($ap_foto){
		unlink($foto_atual);
		$imagem[foto] = "";
	}
	else {
		$imagem[foto] = $foto_atual;
	}		
		
$query = " update cadastro_aluno set";
$query .= " foto='".$imagem[foto]."',";
$query .= " cci='$cci',";
$query .= " nome='$nome',";
$query .= " login=replace('$rg','-',''),";
$query .= " senha=replace('$rg','-',''),";
$query .= " nome_pai='$nome_pai',";
$query .= " nome_mae='$nome_mae',";
$query .= " cpf='$cpf',";
$query .= " certidao_nascimento='$certidao_nascimento',";
$query .= " certidao_nascimento_livro='$certidao_nascimento_livro',";
$query .= " certidao_nascimento_folha='$certidao_nascimento_folha',";
$query .= " rg='$rg',";
$query .= " rg_orgao='$rg_orgao',";
$query .= " telefone='$telefone',";
$query .= " sms='$sms',";
$query .= " email='$email',";
$query .= " data_nascimento='".data_formata($data_nascimento)."',";
$query .= " nacionalidade='".(($nacionalidade == 'brasileira')?$nacionalidade:(($nacionalidade_qual)?$nacionalidade_qual:'estrangeira'))."',";
$query .= " rne='$rne',";
$query .= " passaporte='$passaporte',";
$query .= " cidade='$cidade',";
$query .= " estado='$estado',";
$query .= " data_inscricao='".data_formata($data_inscricao)."',";
$query .= " obs_bloqueio='$obs_bloqueio',";
$query .= " observacao='$observacao'";
$query .= " where codigo = '$codigo'";
mysql_query($query);
logs('cadastro_aluno','update',$codigo,$query);
echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&cod=$codigo&op=editar'</script>";


}elseif(isset($inserir_docs)){
	
	if($doc and $doc != 'none'){
		$doc_name	=	$_FILES["doc"]["name"];
		$ext = explode(".",$doc_name);
		$next = (count($ext)-1);
		$ext = $ext[$next];
		$xdoc="docs/".md5(date(YmdHis).$doc_name).".".$ext;
		$doc_temp	=	$_FILES["doc"]["tmp_name"];
		copy($doc_temp,$xdoc);
		$documento[doc] = "$xdoc";
	
	echo $query = "insert into documentos set cod_aluno='$codigo', nome='$nome_doc', doc='".$documento[doc]."'";
	mysql_query($query);
	logs('docs','insert',mysql_insert_id(),$query);
	
	}

	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&cod=$codigo&op=editar'</script>";
	
	
}






if($op == 'editar'){

$xdisabled = 'disabled';
$tit = 'Editar ';
$query  = " select ";
$query .= "cadastro_aluno.codigo,";
$query .= "cadastro_aluno.foto, ";
$query .= "cadastro_aluno.cci, ";
$query .= "cadastro_aluno.nome, ";
$query .= "cadastro_aluno.nome_pai, ";
$query .= "cadastro_aluno.nome_mae, ";
$query .= "cadastro_aluno.cpf, ";
$query .= "cadastro_aluno.nacionalidade, ";
$query .= "cadastro_aluno.certidao_nascimento, ";
$query .= "cadastro_aluno.certidao_nascimento_folha, ";
$query .= "cadastro_aluno.certidao_nascimento_livro, ";
$query .= "cadastro_aluno.rg, ";
$query .= "cadastro_aluno.rg_orgao, ";
$query .= "cadastro_aluno.telefone, ";
$query .= "cadastro_aluno.sms, ";
$query .= "cadastro_aluno.email, ";
$query .= "cadastro_aluno.data_nascimento, ";
$query .= "cadastro_aluno.rne, ";
$query .= "cadastro_aluno.passaporte, ";
$query .= "cadastro_aluno.cidade, ";
$query .= "cadastro_aluno.estado, ";
$query .= "cadastro_aluno.data_inscricao, ";
$query .= "cadastro_aluno.obs_bloqueio, ";
$query .= "cadastro_aluno.observacao ";
$query .= " from cadastro_aluno where cadastro_aluno.codigo='$cod'";

$result = mysql_query($query);
list(
                 $codigo,
				 $foto,
				 $cci,
                 $nome,
				 $nome_pai,
				 $nome_mae,
                 $cpf,
                 $nacionalidade,
                 $certidao_nascimento,
                 $certidao_nascimento_livro,
                 $certidao_nascimento_folha,
                 $rg,
				 $rg_orgao,
                 $telefone,
                 $sms,
                 $email,
                 $data_nascimento,
                 $rne,
                 $passaporte,
				 $cidade,
				 $estado,
                 $data_inscricao,
				 $obs_bloqueio,
				 $observacao
		 ) = mysql_fetch_row($result);
$botoes  = "<input type='hidden' name='codigo' value='$codigo'>";
$botoes .= "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='alterar' class='botao_alterar' value='Alterar' title='Alterar'  onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
$botoes .= " <input type='button' name='novo' class='botao_alterar' value='Novo' title='Novo Cadastro' onclick=\"window.location.href='$PHP_SELF?op=novo'\" >";
if($_SESSION['cook_perfil'] == 'a'){
$botoes .= " <input type='button' name='permissoes' class='botao_alterar' value='Permissoes' title='Permissoes aos usuarios' onclick=\"window.open('../permissoes/turmas.php?tipo=aluno&codigo_tipo=$codigo','perm','width=500,height=450')\" >";
}
list($ano_nascimento,$mes_nascimento,$dia_nascimento) = explode("-",$data_nascimento);

}

elseif($op == 'novo'){

$xdisabled = '';
$tit = 'Inserir ';

$botoes = "<input type='hidden' name='id' value='$id'>";
$botoes .= "<input type='submit' name='inserir' class='botao_alterar' value='Inserir' title='Inserir'  onclick='return validar();'>";
$botoes .= " <input type='submit' name='cancelar' class='botao_alterar' value='Cancelar' title='Cancelar' >";
$data_inscricao = date(Y.'-'.m.'-'.d);

}

if(isset($cancelar)){
echo "\n<script>window.location.href='cadastro_aluno.php?id=$id'</script>";
}

if(isset($matricular)){
$query = "insert into matricula set
                    codigo_escola = '$codigo_escola',
					codigo_curso = '$codigo_curso',
					codigo_disciplina = '$codigo_disciplina',
					codigo_turma = '$codigo_turma',
					codigo_aluno = '$codigo_aluno',
					data=NOW(),
					carga_horaria='$carga_horaria',
					data_exame = ".(($codigo_escola == $conf[codigo_curso]) ? " (select data_exame from turmas where turmas.codigo='$codigo_turma') " : "'".data_formata($data_final)."'").",
					exibe_dia='".(($exibe_dia) ? '1' : '0')."',
					exibe_mes='".(($exibe_mes) ? '1' : '0')."',
					exibe_ano='".(($exibe_ano) ? '1' : '0')."',
					observacao='$obs'";

//echo $query; exit;

$result = mysql_query($query);	

$cod = mysql_insert_id();
logs('matricula','insert',$cod,$query);		


list($dis_vinc) = mysql_fetch_row(mysql_query("select codigo from turmas where codigo_turma='".$codigo_turma."'"));
if($dis_vinc){
	$dv = mysql_fetch_object(mysql_query("select * from turmas where codigo='$dis_vinc'"));
	
			$query = "insert into matricula set
								codigo_matricula = '".$conf[Unidade]."$cod',
								codigo_escola = '$dv->codigo_escola',
								codigo_curso = '$dv->codigo_curso',
								codigo_disciplina = '$dv->codigo_disciplina',
								codigo_turma = '$dv->codigo',
								codigo_aluno = '$codigo_aluno',
								data=NOW(),
								carga_horaria='$carga_horaria',
								data_exame = '$dv->data_exame',
								exibe_dia='".(($exibe_dia) ? '1' : '0')."',
								exibe_mes='".(($exibe_mes) ? '1' : '0')."',
								exibe_ano='".(($exibe_ano) ? '1' : '0')."',
								observacao='$obs'";
			$result = mysql_query($query);	
			
			$cod = mysql_insert_id();
			logs('matricula','insert',$cod,$query);		
	
	}

		
echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&op=editar&cod=$codigo_aluno#fim'</script>";
}



for($i=0;$i<count($_POST[publicar_mat]);$i++){  
	
	if(isset($_POST[publicar][$_POST[publicar_mat][$i]])){
	$query = "update matricula set publicado = '1' where codigo='".$_POST[publicar_mat][$i]."'";
	$result = mysql_query($query);	
	logs('matricula','update',$_POST[publicar_mat][$i],$query);				
	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&op=$op&cod=$cod#fim'</script>"; 
	}
}


for($i=0;$i<count($_POST[despublicar_mat]);$i++){  
	
	if(isset($_POST[despublicar][$_POST[despublicar_mat][$i]])){
	$query = "update matricula set publicado = '0' where codigo='".$_POST[despublicar_mat][$i]."'";
	$result = mysql_query($query);	
	logs('matricula','update',$_POST[despublicar_mat][$i],$query);				
	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&op=$op&cod=$cod#fim'</script>"; 
	}
}


for($i=0;$i<count($_POST[excluir_mat]);$i++){  
	
	if(isset($_POST[excluir][$_POST[excluir_mat][$i]])){
	$query = "delete from matricula where codigo='".$_POST[excluir_mat][$i]."'";
	$result = mysql_query($query);	
	logs('matricula','update',$_POST[excluir_mat][$i],$query);				
	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&op=$op&cod=$cod#fim'</script>"; 
	}
}


for($i=0;$i<count($_POST[salvar_mat]);$i++){

	if(isset($_POST[salvar][$_POST[salvar_mat][$i]])){
	$query = "update matricula set nota='".$_POST[nota][$_POST[salvar_mat][$i]]."', frequencia='".$_POST[frequencia][$_POST[salvar_mat][$i]]."', situacao='".$_POST[situacao][$_POST[salvar_mat][$i]]."' where codigo='".$_POST[salvar_mat][$i]."'";
	$result = mysql_query($query);	
	logs('matricula','update',$_POST[salvar_mat][$i],$query);				
	echo "\n<script>window.location.href='cadastro_aluno_form.php?id=$id&op=$op&cod=$cod#fim'</script>"; 
	}
}


echo "<p>
		<a href=\"javascript:consulta_unidades('cnery','$nome','$nome_pai','$nome_mae','$rg','$cpf')\">CNERY</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href=\"javascript:consulta_unidades('sul','$nome','$nome_pai','$nome_mae','$rg','$cpf')\">SUL</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href=\"javascript:consulta_unidades('nacoes','$nome','$nome_pai','$nome_mae','$rg','$cpf')\">PQ das Na&ccedil;&atilde;es</a>
	   </p>";


echo "\n<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='f' id='f'>";
echo "\n<table width='100%' cellspacing='10' cellpadding='0'>";
echo "\n<tr><td avlign='top'>";
echo "\n              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "\n                <tr> ";
echo "\n                  <td colspan='2' class='titulos_modelos'>$tit Alunos";
echo "\n                <tr><td height='5px'></td></tr></table>";
echo "\n<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "\n<tr><td valign='top'>";
echo "\n       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "\n          <tr><td align='left' valign='top'>";


echo "\n<tr class='bg_form'><td colspan=2>";
echo "\n<font size='3' color='#FF0000'><b>".$mensagem."</b></font>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nMatr&iacute;cula:<td>";
echo "\n<font size='5'><b>".matr($codigo)."</b></font>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nFoto:<td>";
if(is_file($foto)){
	echo "<img src='$foto' width='200'><br>";
	echo "<input type='checkbox' name='ap_foto' value='1'>Apagar Foto<br>";
	echo "<input type='hidden' name='foto_atual' value='$foto'>";
	}
echo "<input type='file' name='foto' value=''>";
	

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nCCI:<td>";
echo "\n<input type='text' name='cci' id='cci' value='$cci' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nNome:<td>";
echo "\n<input type='text' name='nome' id='nome' value='$nome' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nNome do Pai:<td>";
echo "\n<input type='text' name='nome_pai' id='nome_pai' value='$nome_pai' size='' maxlength='' class='form_text'>";
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nNome da M&atilde;e:<td>";
echo "\n<input type='text' name='nome_mae' id='nome_mae' value='$nome_mae' size='' maxlength='' class='form_text'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nCPF:<td>";
echo "\n<input type='text' name='cpf' id='cpf' value='$cpf' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nCertid&atilde;o de Nascimento:<td>";
echo "\n<input type='text' name='certidao_nascimento' id='certidao_nascimento' value='$certidao_nascimento' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nLivro/Folha:<td>";
echo "\n<input type='text' name='certidao_nascimento_livro' id='certidao_nascimento_livro' value='$certidao_nascimento_livro' size='' maxlength=''>";
echo "\n / <input type='text' name='certidao_nascimento_folha' id='certidao_nascimento_folha' value='$certidao_nascimento_folha' size='' maxlength=''>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nRG:<td>";
echo "\n<input type='text' name='rg' id='rg' value='$rg' size='' maxlength='' class='form_text'>";
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nOrg&atilde;o:<td>";
echo "\n<input type='text' name='rg_orgao' id='rg_orgao' value='$rg_orgao' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nTelefone:<td>";
echo "\n<input type='text' name='telefone' id='telefone' value='$telefone' size='' maxlength='' class='form_text'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nRecebimento de SMS?<td>";

echo "\n<input type='radio' name='sms' id='sms' value='n' ".(($sms == 'n') ? 'checked' : false)." >N&atilde;o ";
echo "\n<input type='radio' name='sms' id='sms' value='s' ".(($sms == 's') ? 'checked' : false)." >Sim";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nEmail:<td>";
echo "\n<input type='text' name='email' id='email' value='$email' size='' maxlength='' class='form_text'>";
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nData de Nascimento:<td>";

if($dia_nascimento == '00'){ $dia_nascimento = false; }
echo "\n&nbsp;<input type='text' name='dia_nascimento' id='dia_nascimento' value='$dia_nascimento' size='2' maxlength='2' >";
if($mes_nascimento == '00'){ $mes_nascimento = false; }
echo "\n&nbsp;<input type='text' name='mes_nascimento' id='mes_nascimento' value='$mes_nascimento' size='2' maxlength='2' >";
if($ano_nascimento == '0000'){ $ano_nascimento = false; }
echo "\n&nbsp;<input type='text' name='ano_nascimento' id='ano_nascimento' value='$ano_nascimento' size='4' maxlength='4' >";

echo " Idade ".CalcularIdade($dia_nascimento.'-'.$mes_nascimento.'-'.$ano_nascimento)." Anos";

$IdadeAluno = CalcularIdade($dia_nascimento.'-'.$mes_nascimento.'-'.$ano_nascimento);

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nNacionalidade:<td>";
echo "\n<input type='radio' name='nacionalidade' value='brasileira' ".(($nacionalidade == 'brasileira' or !$nacionalidade)?'checked':false)."> Brasileira ";
echo "\n<input type='radio' name='nacionalidade' value='estrangeira' ".(($nacionalidade != 'brasileira')?'checked':false).">  ";
echo "\n<input type='text' name='nacionalidade_qual' id='nacionalidade_qual' value='$nacionalidade' maxlength='' class='form_text' style='width:200px'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nNaturalidade:<td>";
echo "\n<input type='text' name='cidade' id='cidade' value='$cidade' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nEstado:<td>";
echo "\n<input type='text' name='estado' id='estado' value='$estado' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nRNE:<td>";
echo "\n<input type='text' name='rne' id='rne' value='$rne' size='' maxlength='' class='form_text'>";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nPassaporte:<td>";
echo "\n<input type='text' name='passaporte' id='passaporte' value='$passaporte' size='' maxlength='' class='form_text'>";


echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nData de Inscri&ccedil;&atilde;o:<td>";
echo "\n<input type='text' name='data_inscricao' id='data_inscricao' value='".data_formata($data_inscricao)."' size='' maxlength='' class='form_text'>";
echo "\n <a href='javascript:cal2.popup();'><img src='../calendario/img/cal.gif' width='16' height='16' border='0' alt='Clique para ver o calend�rio'></a>";
echo "\n		\n<script language='JavaScript'>\n";
echo "\n		<!-- \n";
echo "\n			var cal2 = new calendar1(document.f.data_inscricao);\n";
echo "\n			cal2.year_scroll = true;\n";
echo "\n			//cal2.time_comp = true;\n";
echo "\n		//-->\n";
echo "\n		</script>\n";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nBloquear Matr&iacute;cula:<td>";
echo "<input type='checkbox' name='obs_bloqueio' value='1' ".(($obs_bloqueio) ? 'checked' : false).">Marquar para bloquear";

echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>";
echo "\nObserva&ccedil;&atilde;oes:<td>";
echo "<textarea cols='40' rows='8' name='observacao'>$observacao</textarea>";

echo "\n<tr class='bg_form'><td align='center' class='titulo_campo'>";
echo "\nDocumentos:<td class='titulo_campo'>&nbsp;<tr><td colspan=3>";
echo "<table align='center'>";
echo "<tr><td colspan=3><a name='Adocs'></a>Novo Documento:";
echo "\n<tr><td><input type='text' name='nome_doc' id='nome_doc' value='' size='' maxlength='' class='form_text'>";
echo "<td><input type='file' name='doc' value=''>";
echo "<td><input type='submit' name='inserir_docs' value='Anexar'>";
echo "</table>";
$sql = "select * from documentos where cod_aluno = '$cod'";
//echo $sql;
$r = mysql_query($sql);
    echo "<table>";
while($rd = mysql_fetch_object($r)){

	echo "<tr><td>".$rd->nome."<td><a href='".$rd->doc."' target='_blank'><img src='../img/drafts.gif' width='15' height='15' border='0'></a>";	
	echo "	<a href=\"javascript:confirma_delete_docs($rd->codigo,'$cod');\">";
	echo "<img src='../img/trash.gif' alt='Excluir' border='0' width='16' height='16'></a></td>";
}
    echo "</table>";
echo "\n<tr class='bg_form'><td colspan='2' align='center'>";
echo $botoes; 
echo "\n              </table>";
echo "\n     </table>";
echo "\n     </table>";

//echo "\n		      </form> ";


if($op == 'editar' and $dia_nascimento and $mes_nascimento and $ano_nascimento ){

//echo "\n<form action='$PHP_SELF' method='post' enctype='multipart/form-data' name='g' id='g'>";
echo "<a name='mat'></a>";
echo "\n<table width='100%' cellspacing='10' cellpadding='0'>";
echo "\n<tr><td avlign='top'>";
echo "\n              <table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "\n                <tr> ";
echo "\n                  <td colspan='2' class='titulos_modelos'>Matr&iacute;cula";

if(trim($obs_bloqueio)){
	
echo "\n                <tr> ";
echo "\n                  <td colspan='2'>";

	echo "<font size='5' color='red'>Verifique o campo observa&ccedil;&otilde;es antes de prosseguir!</font>"; 
	echo "  </table>";
	echo "  </table>";
	include("../includes/rodape.inc.php");
	exit;
	
	}


echo "\n                <tr><td height='5px'></td></tr></table>";
echo "\n<table width='100%' cellspacing='0' cellpadding='2' class='borda_tabela'>";
echo "\n<tr><td valign='top'>";
echo "\n       <table width='100%' border='0' cellpadding='2' cellspacing='0'>";
echo "\n          <tr><td align='left' valign='top'>";
//*
echo "\n<tr class='bg_form'><td align='right' class='titulo_campo'>Escola:";
echo "\n<td>";
echo "<a name='opinst'></a>";
//echo "<input type='checkbox' name='inst' value='1' onclick='javascript:InstOp(this)' ".(($inst) ? 'checked' : false).">";

$sql = "select codigo,descricao,op from cadastro_escola order by descricao";
$sql_result = mysql_query($sql);
echo "\n<select name='codigo_escola' id='codigo_escola' class='form_select' onchange='javascript:InstOp(this)'>"; 
echo "\n<option value=''>:: Selecione ::";
while(list($a,$b,$c)=mysql_fetch_row($sql_result)){
   if($c == '1' and !$codigo_escola){$selected = 'selected'; $codigo_escola=$conf[codigo_curso]; }  
   elseif($a == $codigo_escola) {$selected = 'selected';}else{$selected='';}
echo "\n<option value='$a' $selected>$b";
}
echo "\n</select>";

//*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$Dd = "select * from matricula where codigo_aluno='$cod' and situacao='AP'";
$Dd = mysql_query($Dd);
while($Ddr = mysql_fetch_object($Dd)){
   $VDd[] = $Ddr->codigo_disciplina;
}

if($codigo_escola == $conf['codigo_curso']){
include("ciec.php");
}else{
include("outras.php");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function getmicrotime(){ 

			list($sec, $usec) = explode(" ",microtime()); 
			return ($sec + $usec); 
			}

			$time_start = getmicrotime(); 
			$arquivo = "$PHP_SELF?op=$op&cod=$cod"; 
			$maxpag = 10;
			$maxlnk = 10;
		if ($id == ''){
				$param = 0;
		} else {
			$temp = $id;
			$passo1 = $temp - 1;
			$passo2 = $passo1*$maxpag;
			$param = $passo2;
		}

$sql = "select a.*,b.nome,c.codigo as cod_mat,c.nota,c.carga_horaria,c.frequencia,c.situacao,c.codigo_escola as codEscola, c.data_exame as dataexame, concat(d.descricao,' ',c.observacao) as disc,concat(e.descricao,' (',e.tipo,')') as disc_curso,f.descricao as escola, c.publicado from turmas a 
        left join cadastro_professor b on a.codigo_professor = b.codigo
		left join matricula c on a.codigo_curso=c.codigo_curso and a.codigo_disciplina=c.codigo_disciplina and a.codigo=c.codigo_turma
		left join cadastro_disciplinas d on a.codigo_curso=d.codigo_curso and a.codigo_disciplina=d.codigo
		left join cadastro_cursos e on a.codigo_curso=e.codigo 
		left join cadastro_escola f on c.codigo_escola=f.codigo
		where c.codigo_aluno='$cod' order by e.descricao,d.descricao,a.data_inicio desc,a.codigo";
//$sql_result = mysql_query($sql);

//echo $sql;
$result1 = mysql_query($sql);
$totreg = mysql_num_rows($result1);
$query = $sql." limit $param,$maxpag";
$result = mysql_query($query);
$totreg_01 = mysql_num_rows($result);

//echo $sql;

echo "\n<br><br><table bgcolor='#ffffff' bordercolor='#ffffff' width='100%'>";
if(mysql_num_rows($result)){

$cnt = 0;
while($dados = mysql_fetch_object($result)){ $contador ++;
//echo "\n<tr><td><input type='radio' name='codigo_turma' id='codigo_turma' value'".$dados->codigo."'>";

echo "\n<tr bgcolor='#cccccc'>";
//echo $dados->cod_mat;
echo "\n<td colspan='12'><b>Escola</b>";

echo "\n<tr bgcolor='#eeeeee'>";
echo "\n<td colspan='12'>".$dados->escola;


echo "\n<tr bgcolor='#cccccc'>";
echo "\n<td colspan='3'><b>Curso</b>";
echo "\n<td colspan='2'><b>Disciplina</b>";
echo "\n<td><b>C.H.</b>";
echo "\n<td colspan='4'><b>Professor</b>";
echo "\n<td align='center'>&nbsp;";

list($vin) = mysql_fetch_row(mysql_query("select codigo_matricula from matricula where codigo='$dados->cod_mat'"));
if($vin){
	echo "<input type='button' value='VINC' onclick=\"javascript:desvincular('$dados->cod_mat')\">";
	}


echo "\n<td>&nbsp;";


echo "\n<tr bgcolor='#eeeeee'>";
echo "\n<td colspan='3'>".$dados->disc_curso;
echo "\n<td colspan='2'>".$dados->disc."(".$dados->codigo.")";
echo "\n<td>".$dados->carga_horaria;
echo "\n<td colspan='4'>".(($dados->codEscola == $conf[codigo_curso]) ? $dados->nome : '-------------');

echo "\n<td>".(($dados->codEscola == $conf[codigo_curso]) ? "<input type='image' src='../img/printer.gif' title='Imprimir comprovante' onclick=\"return imprimir_comprovante('$dados->cod_mat');\">" : '-------------');
echo "\n<td>&nbsp;";

echo "\n<tr bgcolor='#cccccc'>";
echo "\n<td><b>Turno</b>";
echo "\n<td><b>In&iacute;cio</b>";
echo "\n<td><b>Final</b>";
echo "\n<td><b>Entada</b>";
echo "\n<td><b>Sa&iacute;da</b>";
echo "\n<td><b>Exame</b>";
echo "\n<td><b>Nota</b>";
echo "\n<td><b>Freq.</b>";
echo "\n<td>&nbsp;";
echo "\n<td><b>Situa&ccedil;&atilde;o:</b>";
echo "\n<td>&nbsp;";
echo "\n<td>&nbsp;";

echo "\n<tr bgcolor='#eeeeee'>";

if($dados->codEscola == $conf[codigo_curso]){
echo "\n<td>".$dados->turno;
echo "\n<td>".data_formata($dados->data_inicio);
echo "\n<td>".data_formata($dados->data_final);
echo "\n<td>".$dados->hora_inicio;
echo "\n<td>".$dados->hora_final;
echo "\n<td>".data_formata($dados->data_exame);
echo "\n<td><input type='text' name='nota[".$dados->cod_mat."]' value='".$dados->nota."' size='2' onkeyup=\"notas(this.value,'".$dados->cod_mat."')\" ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
echo "\n<td><input type='text' name='frequencia[".$dados->cod_mat."]' value='".$dados->frequencia."' size='2' ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
echo "\n<td>";
echo "\n<td>";

echo "\n<select name='situacao[".$dados->cod_mat."]' id='x".$dados->cod_mat."' ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
if($dados->situacao == 'MT'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='MT' $selected>matriculado";
if($dados->situacao == 'AP'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='AP' $selected>aprovado";
if($dados->situacao == 'RP'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='RP' $selected>reprovado";
if($dados->situacao == 'FT'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='FT' $selected>Faltou";
echo "\n</select>";

}else{

echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>---------------";
echo "\n<td>".data_formata($dados->dataexame);
echo "\n<td><input type='text' name='nota[".$dados->cod_mat."]' value='".$dados->nota."' size='2' onkeyup=\"notas(this.value,'".$dados->cod_mat."')\" ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
echo "\n<td><input type='text' name='frequencia[".$dados->cod_mat."]' value='".$dados->frequencia."' size='2' ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
echo "\n<td>";
echo "\n<td>";

echo "\n<select name='situacao[".$dados->cod_mat."]' id='x".$dados->cod_mat."' ".(($_SESSION['cook_perfil'] == 'u') ? 'disabled' : false).">";
if($dados->situacao == 'MT'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='MT' $selected>matriculado";
if($dados->situacao == 'AP'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='AP' $selected>aprovado";
if($dados->situacao == 'RP'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='RP' $selected>reprovado";
if($dados->situacao == 'FT'){ $selected = 'selected'; }else{ $selected = false; }
echo "\n<option value='FT' $selected>Faltou";
echo "\n</select>";

}

echo "\n<td>";
if($_SESSION['cook_perfil'] == 'a'){
echo "<input type='submit' style='background-image:url(../img/enviar.gif); border:0px; padding:0px; cursor:pointer; width:14px; height:14px;' title='Salvar' name='salvar[".$dados->cod_mat."]' value='_'>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if($dados->publicado){
echo "<input type='submit' style='background-image:url(../img/despublicar.png); background-size:100%; border:0px; cursor:pointer; padding:0px; width:14px; height:14px;' title='Publicar no site' name='despublicar[".$dados->cod_mat."]' value='_'>";
}else{
echo "<input type='submit' style='background-image:url(../img/publicar.png); background-size:100%; border:0px; cursor:pointer; padding:0px; width:14px; height:14px;' title='Retirar do site' name='publicar[".$dados->cod_mat."]' value='_'>";
}

}
echo "\n<td>";

echo "<input type='submit' style='background-image:url(../img/trash.gif); border:0px; padding:0px; width:14px; cursor:pointer; height:14px;' title='Excluir' name='excluir[".$dados->cod_mat."]' value='_' onclick=\"return confirm_excluir('$dados->disc','$dados->situacao');\">";
//echo "Perfil: ".$_SESSION['cook_perfil'];

if($_SESSION['cook_perfil'] == 'a'){
echo "\n<input type='hidden' name='salvar_mat[]' value='".$dados->cod_mat."'>";
echo "\n<input type='hidden' name='publicar_mat[]' value='".$dados->cod_mat."'>";
echo "\n<input type='hidden' name='despublicar_mat[]' value='".$dados->cod_mat."'>";
}
echo "\n<input type='hidden' name='excluir_mat[]' value='".$dados->cod_mat."'>";


echo "\n<tr bgcolor='#000000'><td colspan='12' height='2' bgcolor='#000000'>";

}$reg_final = $param + $contador;
}

echo "\n</table>";

echo "\n     </table>";


			$results_tot = $totreg;
			$results_parc = $totreg_01;
			$result_div = $results_tot/$maxpag;
			$n_inteiro = (int)$result_div;
			if ($n_inteiro < $result_div) {$n_paginas = $n_inteiro + 1;}
			else {$n_paginas = $result_div;}
			$pg_atual = $param/$maxpag+1;
			$reg_inicial = $param + 1;
			$pg_anterior = $pg_atual - 1;
			$pg_proxima = $pg_atual + 1;
			$time_end = getmicrotime(); 
			$time = $time_end - $time_start;
			echo "<tr><td height='10' valign='top'>";

echo "  <table border='0' cellspacing='0' align='center'>";
echo "    <tr>";
echo "      <td>";
			if ($id > 1) { echo "<a href='$arquivo&id=$pg_anterior' class='paginacao'><b><< anterior</font></a>"; }			if ($temp >= $maxlnk){
			if ($n_paginas > $maxlnk) {$n_maxlnk = $temp + 4;
			$maxlnk = $n_maxlnk;
			$n_start = $temp - 6;
			$lnk_impressos = $n_start;}}
			while(($lnk_impressos < $n_paginas) and ($lnk_impressos < $maxlnk))
			{ $lnk_impressos ++;

echo "      <center>";
echo "      <td>";
			if ($pg_atual != $lnk_impressos){echo "<a href=\"$arquivo&id=$lnk_impressos\" class=\"paginacao\">";}
			if ($pg_atual == $lnk_impressos){echo "<font class='pag_atual'>$lnk_impressos</font>";} else {echo "$lnk_impressos";}
echo "</a></b></font></td>";}

echo "	  </font></td>";
echo "      </center>";
echo "      <td>";
			if ($reg_final < $results_tot) {echo "<a href='$arquivo&id=$pg_proxima' class='paginacao'><b>Pr&oacute;ximo >></b></font></a></td>"; }

echo "    </tr>";
echo "  </table>";


}

echo "<a name='fim'></a>";

include("../includes/rodape.inc.php");
echo "\n</form>";
?>
