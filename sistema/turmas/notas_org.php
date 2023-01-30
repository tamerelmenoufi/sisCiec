<?php
	include("../includes/sessoes.inc.php");
	include("../includes/connect.inc.php");

$perm = mysql_num_rows(mysql_query("select * from permissoes where tipo='turma' and codigo_tipo='$cod' and ('".date("Y-m-d")."' between data_inicial and data_final)"));

	if($_SESSION['cook_perfil'] == 'u' and !$perm) { echo "<center><br><br><br><p>Acesso Negado!<br><a href=\"javascript:window.close()\">Voltar</a></p>"; exit; }
	


if($_GET[At] == 1){
	mysql_query("update matricula set publicado = '1', integracao = '2' where codigo_turma='".$_GET[cod]."'");
	//echo "update matricula set publicado = '1', integracao = '2' where codigo_turma='".$_GET[cod]."'<br>";
}
if($_GET[At] == 2){
	mysql_query("update matricula set publicado = '0', integracao = '2' where codigo_turma='".$_GET[cod]."'");
	//echo "update matricula set publicado = '0', integracao = '2' where codigo_turma='".$_GET[cod]."'";
}




	
					   if($_POST){
					      $n = count($_POST[codigo]);

//echo "CODIGOS:".$ns."<br>";

						  for($i=0;$i<$n;$i++){
                                                  set_time_limit(90);
						    $vt = false;
							$vt = $_POST[codigo][$i];
						    $vt1 = $_POST[codigo1][$i];
								$query = "update matricula set nota='".$_POST[nota][$vt]."', frequencia='".$_POST[frequencia][$vt]."', situacao='".$_POST[situacao][$vt]."', integracao = '2' where codigo = '".$vt."'";
								if(mysql_query($query)){ $soma++; }
								//echo $query."<br>";
								logs('matricula','update',$vt,$query);
								
								$query = "update matricula set nota='".$_POST[nota][$vt]."', frequencia='".$_POST[frequencia][$vt]."', situacao='".$_POST[situacao][$vt]."', integracao = '2' where codigo = '".$vt1."'";
								if(mysql_query($query)){ $soma++; }
								//echo $query."<br>";
								logs('matricula','update',$vt1,$query);
						  }





						  /*echo "<script>alert('atualização realizada com sucesso!')</script>";*/
					   }
					   
//echo "<h1>SOMA: $soma</h1>";

	
	
	
?>

<html>
<head>
<title> </title>

<style type="text/css">
<!--
body {
	background-image: url();
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
.borda_tabela {
border-bottom: solid 1px #000000;
border-top: solid 1px #000000;
border-left: solid 1px #000000;
border-right: solid 1px #000000;
font-size:12px;
}

.borda_tabela2 {
border-bottom: solid 1px #000000;
border-top: solid 1px #000000;
border-left: solid 1px #000000;
border-right: solid 1px #000000;
font-family:Arial, Helvetica, sans-serif;
font-size:11px;
text-align:center;
font-weight:bold;
}

.borda_baixo {
border-bottom: solid 1px #000000;
}

.borda_left {
border-left: solid 1px #000000;
}

.borda_right {
border-right: solid 1px #000000;
}

.arial20 {
font-family:Arial;
font-size:30px;
color:#000000;
font-weight:bold;
}

.arial13 {
font-family:Arial;
font-size:13px;
color:#000000;
font-weight:bold;
}

.arial10 {
font-family:Arial;
font-size:10px;
color:#000000;
font-weight:bold;
}

.arial21 {
font-family:Arial;
font-size:20px;
color:#000000;
font-weight:normal;
}

.arial11 {
font-family:Arial;
font-size:11px;
color:#000000;
font-weight:normal;
}

.arial16 {
font-family:Arial;
font-size:16px;
color:#000000;
font-weight:bold;
}

.arial14 {
font-family:Arial;
font-size:13px;
color:#000000;
font-weight:normal;
}

.style1 {
	font-size:11px;
	color:#000000;
	font-family: Arial;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {color:#000000; font-family: Arial; font-size: 11px;}
</style>

<script language='javascript'>

    function notas(valor,nome,form){
          if(!valor){
	     eval("document.all."+form+".x"+nome+".value='FT';");
          }else if(valor == 0){
	     eval("document.all."+form+".x"+nome+".value='MT';");
	  }else if(valor < 5){
		 eval("document.all."+form+".x"+nome+".value='RP';");
	  }else{
		 eval("document.all."+form+".x"+nome+".value='AP';");
	  }
  
	}
	
	
	function AtivaDesativa(valor){
		if(valor == 'publicar_site'){
			window.location.href='notas.php?cod=<?=$_GET[cod]?>&At=1';
		}else{
			window.location.href='notas.php?cod=<?=$_GET[cod]?>&At=2';
		}
	}
	


</script>


</head>

<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="640" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td ><table width="640"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
			
			<?php
			
			   
			   
			   $query = "select b.descricao as disc,
			                    c.nome,
								d.descricao as curso,
								a.data_exame,
								a.turno
								from turmas a
								left join cadastro_disciplinas b on a.codigo_disciplina=b.codigo
								left join cadastro_professor c on a.codigo_professor=c.codigo
								left join cadastro_cursos d on a.codigo_curso=d.codigo
								where a.codigo='$cod'";
				$result = mysql_query($query);
				$dados = mysql_fetch_object($result);
                      
			
			
			?>			
			
	<form action="" method="post" name="f1">
			<table width="640" cellpadding="0" cellspacing="0" class="borda_tabela">
              <tr>
                <td height="50" class="borda_tabela"><table width="640" height="19"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="50" height="19">&nbsp;</td>
                    <td width="166"><img src="../img/logo_p.gif" width="150" height="50"></td>
                    <td height="60" class="arial16">&nbsp;E&nbsp;&nbsp;</td>
                    <td><img src="../img/logo_ciec.gif" width="185" height="52"></td>
                    <td width="312"><div align="right"><span class="arial20">Supletivo</span><br>
                            <span class="arial10"><?=$conf[resolucao]?> </span></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="borda_tabela"><table width="640"  border="0" align="center" cellpadding="10" cellspacing="0">
                  <tr>
                    <td width="400" align="left" valign="top"><table width="400"  border="0" cellspacing="0" cellpadding="2" class="borda_tabela">
                      <tr>
                        <td class="borda_tabela"><div class="arial13">Disciplina:
                                <?=$dados->disc?>
                        </div></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="bottom" class=""><div class="arial13">Data do exame: 
                      <?=data_formata($dados->data_exame)?>
                    </div></td>
                  </tr>
                  <tr>
                    <td width="400" align="left" valign="top"><table width="400"  border="0" cellspacing="0" cellpadding="2" class="borda_tabela">
                      <tr>
                        <td class="borda_tabela"><div class="arial13">Professor(a): 
                          <?=$dados->nome?>
                        </div></td>
                      </tr>
                    </table></td>
                    <td align="left" valign="bottom" class="arial13"><?=$dados->curso?>&nbsp;-&nbsp;<?=$dados->turno?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" valign="top">
                    
                    <input type="button" id="publicar_site" value="Ativar Publica&ccedil;&atilde;o no site" onClick="AtivaDesativa(this.id)">&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <input type="button" id="despublicar_site" value="Desativar Publica&ccedil;&atilde;o no site" onClick="AtivaDesativa(this.id)">&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    
                    
                    </td>
                    </tr>
                </table>                  </td>
              </tr>
              <tr align="left" valign="top">
                <td align="center" class="borda_tabela"><table width="100%"  border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td>
					 
					 
					 
					 <table width="640"  border="0" cellspacing="0" cellpadding="0" class="borda_tabela">
                      <tr>
                        <td width="27" class="borda_tabela"><div class="arial13">
                          <div align="center">N&ordm;</div>
                        </div></td>
                        <td width="60" class="borda_tabela"><div class="arial13">
                          <div align="center"><a href='<?=$PHP_SELF?>?ord=cci&cod=<?=$cod?>' class="arial13">CCI</a></div>
                        </div></td>
                        <td width="302" class="borda_tabela"><div class="arial13">
                          <div align="center"><a href='<?=$PHP_SELF?>?ord=aln&cod=<?=$cod?>' class="arial13">Nome</a></div>
                        </div></td>
                        <td width="104" class="borda_tabela"><div class="arial13">
                          <div align="center">Nota</div>
                        </div></td>
                        <!--<td width="96" class="borda_tabela"><div class="arial13">
                          <div align="center">Frequ&ecirc;ncia</div>
                        </div></td>-->
                        <td width="96" class="borda_tabela"><div class="arial13">
                          <div align="center">Situa&ccedil;&atilde;o</div>
                        </div></td>
                      </tr>
                     <?php
					   

					   if(!$ord){ $com = " order by b.cci "; }
					   elseif($ord == 'cci'){ $com = " order by b.cci "; }
					   elseif($ord == 'aln'){ $com = " order by b.nome "; }
					   
					   $query = "select a.codigo,a.codigo_aluno,b.cci,b.nome from matricula a left join cadastro_aluno b on a.codigo_aluno=b.codigo where a.codigo_turma='$cod' and b.nome != '' and a.codigo_escola='$conf[codigo_curso]' group by a.codigo_aluno $com";
					   $result = mysql_query($query);
					   $n = mysql_num_rows($result);
					   $i=1;
					   $f = 1;
					   while($dados=mysql_fetch_object($result)){
                                           set_time_limit(90);					 
					   
					   if($i%100 == 0){
						   $f++;
?>
					  <tr>
                        <td width="27" align="center" class="borda_tabela" colspan='6'>
                        <br>
						<br>

                          <input type="hidden" name="n" value="<?=$n?>">
                          <input type="submit" name="sb" value="atualizar">
						<br>
						<br>
                        </td>
                        </tr>					
	                  </table>
                       </form>

                        <form action="" method="post" name="f<?=$f?>">
					<table width="640" cellpadding="0" cellspacing="0" class="borda_tabela">
                        
                        
<?php						   
					   }
					   
					   			   
					   
					   $sql = "select nota,frequencia,situacao from matricula where codigo='$dados->codigo'";
					   $sql_r = mysql_query($sql);
					   list($nota,$frequencia,$situacao) = mysql_fetch_row($sql_r);
					   
					   list($vin_matricula) = mysql_fetch_row(mysql_query("select codigo from matricula where codigo_matricula = '$dados->codigo'"));
					   
					 ?>
					  <tr>
                        <td width="27" align="center" class="borda_tabela">&nbsp;<?=$i?></td>
                        <td width="60" align="center" class="borda_tabela">&nbsp;<?=$dados->cci?></td>
                        <td width="302" class="borda_tabela">&nbsp;<?=strtoupper($dados->nome)?></td>
                        <td align="center" class="borda_tabela">
						<input name="nota[<?=$dados->codigo?>]" value="<?=$nota?>" type="text" size="5" onKeyUp="notas(this.value,'<?=$dados->codigo?>','f<?=$f?>')">
						<input type="hidden" name="codigo[]" value="<?=$dados->codigo?>">
						<input type="hidden" name="codigo1[]" value="<?=$vin_matricula?>">
						</td>
                        <!--<td width="96" align="center" class="borda_tabela">
						<input name="frequencia[<?=$dados->codigo?>]" value="<?=$frequencia?>" type="text" size="5">
						<input type="hidden" name="codigo[]" value="<?=$dados->codigo?>">
						</td>-->
                        <td width="96" align="center" class="borda_tabela">
						<select name="situacao[<?=$dados->codigo?>]"  id="x<?=$dados->codigo?>">
                          <?php 
						       if($situacao == 'MT'){ $mt = 'selected'; }else{ $mt = false; }
						       if($situacao == 'AP'){ $ap = 'selected'; }else{ $ap = false; }
						       if($situacao == 'RP'){ $rp = 'selected'; }else{ $rp = false; }
						       if($situacao == 'FT'){ $ft = 'selected'; }else{ $ft = false; }
						    
						  ?>
			  <option value="MT" <?=$mt?>>matriculado</option>
                          <option value="AP" <?=$ap?>>aprovado</option>
                          <option value="RP" <?=$rp?>>reprovado</option>
                          <option value="FT" <?=$ft?>>faltou</option>
                        </select>
						</td>
					  </tr>
                     <?php
					    $i++;
						}
					 ?>
					  <tr>
                        <td width="27" align="center" class="borda_tabela" colspan='6'>
                          <input type="hidden" name="n" value="<?=$n?>">
                          <input type="submit" name="sb" value="atualizar">
						</td>
                        </tr>
                  </table>
					
					
                      <br>
                      </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
