<?php

/*
Plugin Name: Meu Plugin
Description: Tes of plugin creation
Version:     1.0.0
Author:      Matheus
Author URI:  google.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

$obj_mysqli = new mysqli("127.0.0.1", "root", "root", "cpcmt");
 
if ($obj_mysqli->connect_errno)
{
	echo "Ocorreu um erro na conexão com o banco de dados.";
	exit;
}
 
mysqli_set_charset($obj_mysqli, 'utf8');
 
//Validando a existência dos dados
if(isset($_POST["nome"]) && isset($_POST["email"]))
{
	if(empty($_POST["nome"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["email"]))
		$erro = "Campo e-mail obrigatório";
	else
	{
		//Vamos realizar o cadastro ou alteração dos dados enviados.
		$nome   = $_POST["nome"];
		$email  = $_POST["email"];
		
		$stmt = $obj_mysqli->prepare("INSERT INTO `membro` (`nome`,`email`) VALUES (?,?)");
		$stmt->bind_param('ss', $nome, $email);
		
		if(!$stmt->execute())
		{
			$erro = $stmt->error;
		}
		else
		{
			$sucesso = "Dados cadastrados com sucesso!";
		}
	}
	$obj_mysqli->close();
}

	function makeShortcode(){

?>
	<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
	  Nome:<br/> 
	  <input id="nome" type="text" required name="nome" placeholder="Digite seu nome"><br/><br/>
	  E-mail:<br/> 
	  <input id="email" type="email" required name="email" placeholder="Digite seu email"><br/><br/> 
	  <input type="hidden" value="-1" name="id" >
	  <button id="cadastrar" type="submit" onClick="noHidden()">Cadastrar</button>
	</form>
  <script>function noHidden(){
	  if(document.getElementById("nome").value != "" && document.getElementById("email").value !=""){
		alert("Obrigado pelo seu cadastro!");
	  }

  }
  </script>

<?php
	}
	add_shortcode('formulario','makeShortcode');
?>
	
	
	
	
