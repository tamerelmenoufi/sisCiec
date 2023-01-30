<?php
if($nivel){

echo <<<xxx
<td valign="top">
<table width="100%"  height="5" cellspacing="0" cellpadding="0" align="left" border="0">
            <tr> <td class="titulo_modelo_municipios" > Municípios</td> </tr>
			<tr>
               <td>
	  <select name="select" class="form_aberto" size="20" onChange="window.location.href='$PHP_SELF?cod_municipio='+this.value+'&pg=$pg&nivel=$nivel'">
xxx;

?>
<?php
	   
	  $query = "select cod_municipio,nome from municipios order by nome";
	  $result = mysql_query($query);
	  echo "<option value=''> Novo";
	  while(list($cod_mun,$nome_mun)=mysql_fetch_row($result)){
	  if($cod_mun == $cod_municipio){ $select = 'selected'; }else{ $select = false; }
	  echo "<option value='$cod_mun' $select>$nome_mun";
	  }
echo <<<xxx
	  </select>
           </tr>
               
</table>
xxx;
}
?>

</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" height="29" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td height="27" valign="middle" background="../img/bg_rodape.gif"><div align="center" class="style2"><img src="../img/logo_mohatron.gif" width="319" height="29"></div></td>
            </tr>
            <tr>
              <td height="30" valign="middle" bgcolor="#68ABD1"><div align="center"><span class="style2">Copyright
                  <?=date(Y)?>
              WM Sistema de educação - Todos os direitos reservados</span></div></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <iframe frameborder="0" width="0" height="0" src="../includes/ip.php"></iframe>    
  <iframe frameborder="0" width="0" height="0" src="http://<?=$_SERVER['SERVER_NAME']?>:8087/nacoes/atualizacao/cnery.php"></iframe>
</div>
</body>
</html>
