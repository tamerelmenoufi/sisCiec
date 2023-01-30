<script language="javascript">
function mudar(opc,img) {
     eval("document.all"+"[\""+opc+"\"]"+".style.background"+"=\""+img+"\";");
  } 
</script>
<style>
#bot_insert
{
display:block;
position:relative;
}
#bot_alterar
{
display:none;
position:relative;
}
.menu {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}

.menu:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
	
	
}

.link_in {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}

.link_in:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #ff0000;
	text-decoration: none;

}


.menu2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}


.form1 {
	padding: 2px;
	height: 22px;
	width: 340px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}

.bg_tabela_campos {
	background:#FCFCFE;
}

.text_area {
	padding: 2px;
	height: 50px;
	width: 340px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}

.text_area2 {
	padding: 2px;
	height: 130px;
	width: 340px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}

.opcoes {
	padding: 2px;
	height: 22px;
	width: 70px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}

.opcoes2 {
	padding: 0px;
	height: 22px;
	width: 90px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}


.opcoes3 {
	padding: 0px;
	height: 22px;
	width: 200px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}

.iframe {
	width: 338px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;
}


.titulo_f {
	font-family: Verdana;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	font-weight: normal;
}

.titulo {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	font-weight: normal;
	background-color: #cccccc;
}

.titulo_modelo_municipios {
	font-family: Arial;
	font-size: 13px;
	font-style: normal;
	color: #000000;
	font-weight: bold;

}

.titulo_modelo_municipios_grande {
	font-family: Tahoma;
	font-size: 25px;
	font-style: normal;
	color: #333333;
	font-weight: bold;

}


.bot_save {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_salvar_off.gif);	
	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_save:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_salvar_on.gif);	
	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_del {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_excluir_off.gif);	
	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_del:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_excluir_on.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}


.bot_insert {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_inserir_off.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_insert:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_inserir_on.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_alt {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #ffcc00;
	background:url(../img/btn_alterar_off.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_alt:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #ffcc00;
	background:url(../img/btn_alterar_on.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_cancel {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_cancelar_off.gif);	
	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_cancel:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_cancelar_on.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.del {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(./img/del_p.gif);
	width:22px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.bot_voltar {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_voltar_off.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}
.bot_voltar:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	color: #000000;
	background:url(../img/btn_voltar_on.gif);	width:79px;
	height:22px;
	border:0px;
	cursor:pointer;
}

.form_aberto {
	padding: 2px;
	border: 1px solid #7F9DB9;
	border-color:#91A7B4;
	font-family: Arial;
	font-size: 9px;
	font-style: normal;
	color: #000000;
	background-color:#ffffff;

}

.tabela_externa {
	
	border-bottom: 1px solid #91A7B4;
	border-left:  1px solid #91A7B4;
	border-right: 1px solid #91A7B4;
	

}

</style>