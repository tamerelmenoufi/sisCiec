<script language="JavaScript" type="text/javascript">
<!--
function confirma_delete(cod,xid){
<?php
   mysql_connect("ciec-db","root","S3nh@sb@nc0") or die("Erro na conexção ".mysql_error());
   mysql_select_db( "cieceja_".$_SESSION['Dic'] ) or die("Erro no banco ".mysql_error());

   list($sen) = mysql_fetch_row(mysql_query("select senha from usuarios where login='admincnery'"));
?>
 var t = prompt('Digite o codigo');
 if(t == null) t = 'undefined';
 if(t == '<?=$sen?>'){
  if (confirm('Confirma a exclusao ?') == 1){
	window.location.href='<?=$PHP_SELF?>?op=excluir&cod='+cod+'&id='+xid;
  }
 }else if(t != 'undefined'){ alert('codigo incorreto, voce nao tem permissao!'); }
//alert(t);
//return false;
}
function confirma_delete_docs(cod,xid){
 var t = prompt('Digite o codigo');
 if(t == null) t = 'undefined';
 if(t == '<?=$sen?>'){
  if (confirm('Confirma a exclusao ?') == 1){
	window.location.href='<?=$PHP_SELF?>?op=editar&cod='+xid+'&del='+cod;
	}
 }
}
//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
function troca_cor(theRow, thePointerColor)
{
        var theCells = theRow.cells;
        var rowCellsCnt  = theCells.length;
    for (var c = 0; c < rowCellsCnt; c++) {
		theCells[c].style.backgroundColor = thePointerColor;
    }
}
//-->
</script>

<script language="JavaScript" type="text/javascript">
var ns6=document.getElementById&&!document.all
var ie=document.all
function show_text(texto, whichdiv){
   reset(whichdiv);
if (ie) eval("document.all."+whichdiv).innerHTML=texto
else if (ns6) document.getElementById(whichdiv).innerHTML=texto
}
function reset(whichdiv){
if (ie) eval("document.all."+whichdiv).innerHTML=' '
else if (ns6) document.getElementById(whichdiv).innerHTML=' '
}
</script>
