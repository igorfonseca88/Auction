<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="PT" />
<title>Ótimo Lance :: Login</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/conteudo.css" />
</head>

<body>

<div id="conteudo" style="width:100%;margin:0 0 0 0">
	<div id="telaLogin"> 
	    <p>Já sou cliente</p>
		<form action="<?=base_url();?>clientes/login" method='post'>
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
		<p class="error"><?= ($error != null) ? $error : ""; ?></p>
	</div>
</div>
</body>
</html>