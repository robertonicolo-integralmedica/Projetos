
<?php 

if ($_SERVER['SCRIPT_FILENAME'] == "C:/xampp/htdocs/bla/email.php") {

	$html = '
	<html>
	<head>
	<title>Confirmação de Cadastro</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>

	<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	<table id="Tabela_01" width="600" height="922" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<img src="header.png" width="600" height="115" alt="Baixar imagens" style="display:block;">
			</td>
		</tr>
		<tr>
			<td>
				<img src="section2.png" width="600" height="300" alt="Baixar imagens" style="display:block;">
			</td>
		</tr>
		<tr>
			<!-- <td width="600" height="320" style="font-size: 18px; background: linear-gradient(to right, red, orange, yellow, green, blue);"> -->
			<td width="600" height="320" style="font-size: 18px; background: linear-gradient(to right, #e3e3e3, white, white, white, white, white, #e3e3e3);">
				<br>
				<p style="text-align: center;">Caro Lojista.</p>
				<p style="margin-left:5%;">Recebemos seu contato pelo nosso site manifestando interesse em ter os <b>suplementos Darkness</b> em sua loja.<br>
				<b>Você está no caminho certo! Afinal, é a linha mais hardcore do Brasil.</b><br>
				Vamos dar andamento à sua solicitação, para isso basta<br>
				seguir os próximos passos:
				<li style="margin-left:5%;">Clique no link abaixo e confirme seu cadastro.</li>
				<li style="margin-left:5%;">Aguarde o e-mail de efetivação.</li>
				<li style="margin-left:5%;">Após a efetivação, você receberá o retorno de um representante em <br>até 5 dias úteis.</li>
				</p>
				<p style="text-align: center;">Até breve!</p>
				<a href="email.php"><center><img src="btn.png" style="display:block;"></center></a><br>
			</td>
		</tr>
		<tr>
			<td>
				<img src="footer.png" width="600" alt="Baixar imagens" style="display:block;">
			</td>
		</tr>
	</table>

	</body>
	</html>';

	print $html;

}else{ 
	print "URL ERRADA"; 
}

?>