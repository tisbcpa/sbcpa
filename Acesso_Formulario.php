<?
require("Funcoes/Acesso.php");

	if ((isset($_POST["usuario"])) && (isset($_POST["senha"]))){
		$usuario = PesquisarUsuario($_POST["usuario"],$_POST["senha"]);
		
		if ($usuario == ''){
			echo("<script>alert('Acesso negado!');</script>");
		}
		else{
			session_start();
			$_SESSION["usuarioSBCPAsipaDsf3"] = "$usuario";
			echo "<script>window.location.href = 'Cachorro_Listar.php'</script>";
		}
	}


require_once("Estilo/FolhadeEstilo.php");
?>
<br><br><br><br><br><br><br><br><br>
<form name="formulario" method="post" onSubmit="return Validar()">
<table cellpadding="10" width="400" align="center">
    <tr>
    	<td colspan="2" align="center"><br>
        	<strong>Dados de acesso</strong><br><br>
        </td>
    </tr>
	<tr>
    	<td align="right"><strong>Login:</strong></td>
        <td><input type="text" size="25" name="usuario" id="usuario"></td>
    </tr>
	<tr>
    	<td align="right"><strong>Senha:</strong></td>
        <td><input type="password" size="25" name="senha" id="senha"></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><br>
        	<input type="submit" value=" Acessar ">
        </td>
    </tr>
</table>
</form>

<script>
function Validar(){
	var u = document.getElementById('usuario');
	var s = document.getElementById('senha');
	
	if ((u.value == '') && (s.value == '')){
		alert('Preenchar os campos para acessar');
		return false;
	}
	else{
		return true;
	}
}
</script>