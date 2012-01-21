<?
	//include "config.php";
?>
<html>
<head>
<script type="text/javascript" src="js/dhtmlxcommon.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script>
function enviarMsg(){

    //var nome = "igor";
	//alert(nome);
	
	//$.post('/otimolance/login/login/autenticar/', { 'item': nome }, 
	
	//function(data){
		//  alert(data.name);
	//},"json");
	
	//$.ajax({
		//type: "POST",
         //url: "/otimolance/login/login/autenticar/", //URL de destino
         //dataType: "json", //Tipo de Retorno
         //success: function(json){ //Se ocorrer tudo certo
		 //alert(json);
           // var msg = "Nome: " + json.nome + "\n";
            //msg += "Sobrenome: " + json.sobrenome + "\n";
            //msg += "Idade: " + json.idade;
            //alert(msg);
        // }
      //});
 }
 
 



</script>


</head>
<body>
<form >
	
	
	<input type="button" onclick="autenticar('igor', 'senha123')" value="Enviar" />
	
	<p id="result"></p>
</form>
</body>
</html>