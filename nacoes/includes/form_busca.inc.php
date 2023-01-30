<?php

if(isset($limpa)){
 setcookie("chave_busca",false);
 setcookie("busca_escola",false);
 setcookie("busca_curso",false);
 setcookie("busca_disciplina",false);
 setcookie("busca_data_inicio",false);
 setcookie("busca_data_final",false);
 setcookie("busca_turno",false);
 setcookie("busca_professor",false);

echo "<script>window.location.href='$PHP_SELF';</script>"; 
}
if($chave or isset($sb)){
 setcookie("chave_busca",false);
 setcookie("chave_busca",$chave);
 setcookie("busca_curso",$chave_curso);
 setcookie("busca_escola",$chave_escola);
 setcookie("busca_disciplina",$chave_disciplina);
 setcookie("busca_data_inicio",$chave_data_inicio);
 setcookie("busca_data_final",$chave_data_final);
 setcookie("busca_turno",$chave_turno);
 setcookie("busca_professor",$chave); 

echo "<script>window.location.href='$PHP_SELF';</script>"; 
}

//$formulario  = "<form action='$PHP_SELF' method='post'>";
//removi <font>, 

$formulario .= "<span class='paginacao'></span>";
$formulario .= "<input type='text' name='chave' class='form_busca' value='$chave_busca'> ";
$formulario .= "<input type='submit' name='sb' value='buscar' class='botao_busca'>&nbsp;&nbsp;";
$formulario .= "<input type='submit' name='limpa' value='limpa busca' class='botao_limpa_busca'>";
//$formulario .= "</form>";

?>
