<script language="JavaScript">

   function Dados2(valor) {

	  //verifica se o browser tem suporte a ajax
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      } 
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser n�o tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  //se tiver suporte ajax
	  if(ajax) {
		 //deixa apenas o elemento 1 no option, os outros s�o exclu�dos
		 document.forms[0].codigo_professor.options.length = 1;

		 idOpcao  = document.getElementById("opcoes1");
		 
	     ajax.open("POST", "xml2.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 
		 ajax.onreadystatechange = function() {
            //enquanto estiver processando...emite a msg de carregando
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Carregando...";
	        }
			//ap�s ser processado - chama fun��o processXML que vai varrer os dados
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXML2(ajax.responseXML);
			   }
			   else {
			       //caso n�o seja um arquivo XML emite a mensagem abaixo
				   idOpcao.innerHTML = ":: Selecione ::";
			   }
            }else{
			       idOpcao.innerHTML = ":: Selecione ::";
			}
         }
		 //passa o c�digo do estado escolhido
	     var params = "disciplina="+valor;
         ajax.send(params);
      }
   }
   
   function processXML2(obj){
      //pega a tag cidade
      var dataArray   = obj.getElementsByTagName("professores");
      
	  //total de elementos contidos na tag cidade
	  if(dataArray.length > 0) {
	     //percorre o arquivo XML para extrair os dados
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			//cont�udo dos campos no arquivo XML
			var codigo1    =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao1 =  item.getElementsByTagName("descricao")[0].firstChild.nodeValue;
			
	        idOpcao.innerHTML = ":: Selecione ::";
			
			//cria um novo option dinamicamente  
			var novo = document.createElement("option");
			    //atribui um ID a esse elemento
			    novo.setAttribute("id", "opcoes1");
				//atribui um valor
			    novo.value = codigo1;
				//atribui um texto
			    novo.text  = descricao1;
				//finalmente adiciona o novo elemento
				document.forms[0].codigo_professor.options.add(novo);
		 }
	  }
	  else {
	    //caso o XML volte vazio, printa a mensagem abaixo
		idOpcao.innerHTML = ":: Selecione ::";
	  }	  
   }

</script>

