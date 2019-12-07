<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? require("Funcoes/Exposicoes.php");

	if (isset($_GET["IdExposicao"]))
	{
		$IdExposicao = $_GET["IdExposicao"];
		$IdCachorro = $_GET["IdCachorro"];
		$InCategoria = $_GET["InCategoria"];

		ExcluirExposicaoResultado($IdExposicao,$IdCachorro,$InCategoria);
		ListarCachorrosExposicao($IdExposicao);
		die();
	}

?>




<script>
function Editar(Id)
{window.location.href = 'Proprietario_Formulario.php?Id=' + Id;}

function Excluir(IdE,IdC,IdCt)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = '?IdExposicao=' + IdE + "&IdCachorro="+ IdC +"&InCategoria="+ IdCt;
	}
}

function Novo()
{
	window.open('Exposicoes_CadastrarCachorro.php','NovoFilhote','width=520, height=250');
}

function AbrirAlteracao(IdExposicao,IdCachorro,InCategoria){
	window.open('Exposicoes_AlterarResultado.php?IdExposicao='+ IdExposicao +'&IdCachorro='+ IdCachorro +'&InCategoria='+InCategoria,'Alterar','width=520, height=200');
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
		$IdExposicao = $_GET["Id"];
		ListarCachorrosExposicao($IdExposicao);
	}	
?>
