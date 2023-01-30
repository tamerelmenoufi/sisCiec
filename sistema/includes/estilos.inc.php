<script language="javascript">
function mudar(opc,img) {
     eval("document.all"+"[\""+opc+"\"]"+".style.background"+"=\""+img+"\";");
  } 
</script>
<style>

.titulo_f {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #000000;
	font-weight: normal;
}


.font_branca {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #ffffff;
	font-weight: bold;
	text-align:center;
	background:#9A9A9A;
}
.bg_busca_aluno {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #ffffff;
	font-weight: bold;
	text-align:left;
	background:#9A9A9A;
}
.titulo_tabelas {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #ffffff;
	font-weight: bold;
	height:27px;
	background: #9A9A9A;
}


.titulos_modelos {
    font-family: "Trebuchet MS" ;
	font-size: 25px;
	font-style:normal;
	color: #68ABD1;
	font-weight: bold;
	text-align:left;
	vertical-align:top;
	height:12px;
}

.campos_azul {
    font-family: "Trebuchet MS" ;
	font-size: 18px;
	font-style:normal;
	color: #68ABD1;
	font-weight: bold;
	text-align:left;
	vertical-align:top;
	height:12px;
}

.descricoes {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #333333;
	font-weight: bold;
	text-align:right;
	text-decoration:none;
	background:#ffffff;
	border-top:	1px solid #C0C8D3;
	border-bottom: 1px solid #C0C8D3;
	height:20px;
		
}


.paginacao {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #000000;
	font-weight: bold;
	text-align:center;
	text-decoration:none;
	
}

.paginacao:hover {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #68ABD1;
	font-weight: bold;
	text-align:right;
	text-decoration:none ;

	
}

.pag_atual {
	font-family: "Trebuchet MS";
	font-size: 16px;
	font-style: normal;
	color: #68ABD1;
	font-weight: bold;
	text-align:right;
	border-top:	1px solid #C0C8D3;
	border-bottom: 1px solid #C0C8D3;
	border-left: 1px solid #C0C8D3;
	border-right: 1px solid #C0C8D3;
	background:#ffffff;
			
}


.tr_linha1 {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #;
	font-weight: normal;
	text-align:left;
	text-decoration:none;
	background:#f0f0f0;
}
.tr_linha2 {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #;
	font-weight: normal;
	text-align:left;
	text-decoration:none;
	background:#DEDDDD;
}

.titulo_campo {
	font-family: "Trebuchet MS";
	font-size: 12px;
	font-style: normal;
	color: #000000;
	font-weight: normal;
	text-align:rigth	;
	text-decoration:none;
 	background:#cccccc;

}

.bg_form {
	background: #ffffff;
}

.form_busca {
	border: 1px solid;
	border-color:#C0C8D3;
	background:#ffffff;
	width:140px;
	height:20px;
	padding:1px;
	color:#000000;

}

.botao_busca {
	background:#ffffff;
	border: 0px solid;
	border-color:#000000;
	width:50px;
	height:19px;
	font:"Trebuchet MS";
	font-size:12px;
	color:#000000;

}

.botao_limpa_busca {
	background:#ffffff;
	border: 0px solid;
	border-color:#000000;
	width:70px;
	height:19px;
	font:"Trebuchet MS";
	font-size:12px;
	color:#000000;

}

.linha_cinza {
	height:5px;
	background-image:url(../img/linha_cinza.gif);

}
	
.form_text {
	font-family:"Trebuchet MS", Helvetica, sans-serif;
	font-size:12px;
	color:#000000;
	border: 1px solid;
	border-color:#000000;
	background:#ffffff;
	width:300px;
	height:20px;
	padding:1px;

}	

.form_select {
	font-family:"Trebuchet MS", Helvetica, sans-serif;
	font-size:12px;
	color:#000000;
	border-color:#000000;
	background:#ffffff;
	width:300px;
	height:20px;
	padding:1px;

}		

.form_select_size {
	font-family:"Trebuchet MS", Helvetica, sans-serif;
	font-size:12px;
	color:#000000;
	border-color:#000000;
	background:#ffffff;
	width:300px;
	height:100px;
	padding:1px;

}		


.borda_tabela	{
	background-color:#ffffff;	
}

.link_in {
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #0C59B8;
	text-decoration: none;
}

.link_in:hover {
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #E68B2C;
	text-decoration: none;

}

.borda_right { 
border-left: solid 1px #ffcc00;
}

.botao_alterar {
	background:#B6CFDD;
	border: 1px solid #68ABD1;
	width:60px;
	height:19px;
	font:"Trebuchet MS";
	font-size:11px;
	color:#000000;
}
.bordafina_tabela { 
border-left: solid 1px #c1c1c1;
border-right: solid 1px #c1c1c1;
border-top: solid 1px #c1c1c1;
border-bottom: solid 1px #c1c1c1;
}
</style>
