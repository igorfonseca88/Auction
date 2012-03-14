<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="PT" />
<title>Ótimo Lance :: Login</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/conteudo.css" />
</head>

<body>
<div id="topo">
	<img src="<?=base_url();?>img/logo1.jpg" class="logo" />
	<h1>&rsaquo; Gerenciador de Leilões </h1>
</div>
<div id="conteudo" style="width:100%;margin:0 0 0 0">
	<div id="telaLogin"> 
		<form action="<?=base_url();?>login/login/autenticarAdmin" method='post'>
			Usuário (email cadastrado):<br/>
			<input name="usuarioEmail" type="text" class="text" size="35" id="usuarioEmail" />
			<br />
			Senha:<br />
			<input  type="password" name="senha" class="text" size="10" id="senha" />
			<br />
			<br />
			<input type="submit" value=" Entrar "  class="submit" />
			<br />
			<br />
		</form>
		<?= ($error != "") ? "<p class='error'>".$error."</p>" : ""; ?>
	</div>
</div>
</body>
</html>