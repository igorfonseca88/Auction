 function autenticar(usuario, senha){
	var params = "usuario="+usuario+"&senha="+senha;
	dhtmlxAjax.post("/Otimolance/login/login/autenticar/",params,responseFunction);

 }

function responseFunction(loader){

	if(loader.xmlDoc.responseText){
		//document.getElementById("opacidade").style.display = "none";
		//document.getElementById("loadAjax").style.display = "none";
		//alert("teste");
		alert(loader.xmlDoc.responseText);
	}
}