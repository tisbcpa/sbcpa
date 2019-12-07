<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
 <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? require("Funcoes/Provas.php");

	if (isset($_GET["IdProva"]))
	{
		$IdProva = $_GET["IdProva"];
		$IdCachorro = $_GET["IdCachorro"];

		ExcluirProvaResultado($IdProva,$IdCachorro);
		ListarCachorrosProva($IdProva);
		die();
	}

?>




<script>
function Excluir(IdP,IdC)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = '?IdProva=' + IdP + "&IdCachorro="+ IdC;
	}
}

function Novo()
{
	window.open('Provas_CadastrarCachorro.php','NovoFilhote','width=520, height=250');
}

function AtualizariFrame()
{window.location.reload();}

function Atualizar()
{
	setTimeout(500,AtualizariFrame());
}

</script>

<?
	if (isset($_GET["Id"]))
	{
		$IdProva = $_GET["Id"];
		ListarCachorrosProva($IdProva);
	}	
?>
