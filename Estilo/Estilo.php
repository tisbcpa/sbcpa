<? 
	session_start();
	if ($_SESSION["usuarioSBCPAsipaDsf3"] == ""){
		echo "<script>";
		//	echo "window.location.href = 'Acesso_Formulario.php'";
			echo "alert('Informe os dados de acesso!');";
        echo "</script>";
		die();
	}

require("FolhadeEstilo.php");
require("Funcoes/Conexao.php");

/*
$sql = "select Count(*) as Total from TBAcao Where StAtualizacao Is Null or StAtualizacao = '' Order By IdAcao";
$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
$Total = 0;
while ($row = mysql_fetch_array($sql_result))
{
	$Total = $row["Total"];
}

if ($Total > 50)
{
	echo("<script>window.open('Atualizar.php?PopUp=1','atualizar','width=300, height=180');</script>");
}
*/



$ScriptRodape = "<script>document.FormPesquisa.submit();</script>";
//$ScriptRodape = "<script>setTimeout(document.FormPesquisa.submit,200);</script>";

if (!isset($menu)) {
?>

<!-- #BFCCC9 -->


<!--chamada para o menu flutuante-->

<div ID="DownLevelDiv">
     Aguarde um instante, seu browser est� carregando o menu da aplica��o.
</div>

<script language="JavaScript" src="Funcoes/Toolbar.js"></script>
<script language="JavaScript" src="Funcoes/Validacoes.js"></script>
<script language="JavaScript">

var ToolBar_Supported = ToolBar_Supported ;
if (ToolBar_Supported != null && ToolBar_Supported == true)
{
	//To Turn on/off Frame support, set Frame_Supported = true/false.
	Frame_Supported = false;

	// Customize default ICP menu color - bgColor, fontColor, mouseoverColor
	setDefaultICPMenuColor("#BFCCC9", "#000000", "#ffffff");

	// Customize toolbar background color
	setToolbarBGColor("#BFCCC9");

	//***** Add ICP menus *****

addICPMenu("1", "Cachorro","#","","");
	addICPSubMenu("1","Cadastro","Cachorro_Formulario.php","");
	addICPSubMenu("1","Rela��o","Cachorro_Listar.php","");
	addICPSubMenu("1","Ninhada Nacional","Ninhada_Formulario.php","");
	addICPSubMenu("1","Ninhada Estrangeira","NinhadaEstrangeira_Formulario.php","");
	addICPSubMenu("1","S�mula","Sumula_Formulario.php","");
	//addICPSubMenu("2","Cachorros por Canil","Cachorro_ConsultaCanil.php","");

addICPMenu("2", "Canil","#","","");
	addICPSubMenu("2","Cadastro","Canil_Formulario.php","");
	addICPSubMenu("2","Rela��o","Canil_Listar.php","");
addICPMenu("3", "Figurantes","#","","");
	addICPSubMenu("3","Cadastro","Adestrador_Formulario.php","");
	addICPSubMenu("3","Rela��o","Adestrador_Listar.php","");

addICPMenu("32", "Diretoria","#","","");
	addICPSubMenu("32","Cadastro","Diretoria_Formulario.php","");
	addICPSubMenu("32","Rela��o","Diretoria_Listar.php","");


addICPMenu("31", "S�cios","#","","");
	addICPSubMenu("31","Cadastro","Socio_Formulario.php","");
	addICPSubMenu("31","Rela��o","Socio_Listar.php","");
addICPMenu("4", "Clubes","#","","");
	addICPSubMenu("4","Cadastro","Clube_Formulario.php","");
	addICPSubMenu("4","Rela��o","Clube_Listar.php","");
addICPMenu("5", "Exposi��es","#","","");
	addICPSubMenu("5","Cadastro","Exposicoes_Formulario.php","");
	addICPSubMenu("5","Rela��o","Exposicoes_Listar.php","");
	addICPSubMenu("5","Resultado CINE","javascript:AbrirRel(31)","");
	addICPSubMenu("5","Importar Resultado","javascript:AbrirRel(37)","");
addICPMenu("6", "Provas","#","","");
	addICPSubMenu("6","Cadastro","Provas_Formulario.php","");
	addICPSubMenu("6","Rela��o","Provas_Listar.php","");
addICPMenu("7", "Propriet�rios","#","","");
	addICPSubMenu("7","Cadastro","Proprietario_Formulario.php","");
	addICPSubMenu("7","Rela��o","Proprietario_Listar.php","");
addICPMenu("8", "Ju�zes","#","","");
	addICPSubMenu("8","Cadastro","Juiz_Formulario.php","");
	addICPSubMenu("8","Rela��o","Juiz_Listar.php","");

addICPMenu("10", "Relat�rios","#","","");
	addICPSubMenu("10","Registros por Ano","javascript:AbrirRel(0)","");
	addICPSubMenu("10","Registros por Filiada","javascript:AbrirRel(36)","");
	addICPSubMenu("10","Chapas por Ano","javascript:AbrirRel(1)","");
	addICPSubMenu("10","Ninhadas por Ano","javascript:AbrirRel(2)","");
	addICPSubMenu("10","N� de Canis Por UF","javascript:AbrirRel(4)","");
	addICPSubMenu("10","Sele��es por Ano","javascript:AbrirRel(5)","");
	addICPSubMenu("10","Canis Registrados por Ano","javascript:AbrirRel(7)","");
	addICPSubMenu("10","Raio X por Ano","javascript:AbrirRel(8)","");
	addICPSubMenu("10","Reprodutores por Ano","javascript:AbrirRel(9)","");
	addICPSubMenu("10","Reprodutoras por Ano","javascript:AbrirRel(10)","");
	addICPSubMenu("10","Mapa de Ninhada por Ano","javascript:AbrirRel(11)","");
	addICPSubMenu("10","Mapa de Ninhada Ano Canil","javascript:AbrirRel(12)","");
	addICPSubMenu("10","S�cios por UF","javascript:AbrirRel(13)","");
	addICPSubMenu("10","Filhotes Por Pai","javascript:AbrirRel(15)","");
	addICPSubMenu("10","Filhotes Por M�e","javascript:AbrirRel(16)","");
	//addICPSubMenu("10","Pesquisa por N� de Telefone","javascript:AbrirRel(17)","");
	addICPSubMenu("10","Pais e Filhotes por Per�odo","javascript:AbrirRel(18)","");
	addICPSubMenu("10","M�es e Filhotes por Per�odo","javascript:AbrirRel(19)","");
	addICPSubMenu("10","Pais e Chapas do Filhotes","javascript:AbrirRel(20)","");
	addICPSubMenu("10","M�es e Chapas do Filhotes","javascript:AbrirRel(21)","");
	addICPSubMenu("10","Rela��o Geral de Cachorros","javascript:AbrirRel(22)","");
	addICPSubMenu("10","Rela��o Geral de Clubes","javascript:AbrirRel(23)","");
	addICPSubMenu("10","Rela��o Geral de Ju�zes","javascript:AbrirRel(24)","");
	addICPSubMenu("10","Rela��o de Propriet�rios","javascript:AbrirRel(25)","");
	addICPSubMenu("10","Rela��o de Adestradores","javascript:AbrirRel(26)","");
	addICPSubMenu("10","Canis com/sem D�bitos","javascript:AbrirRel(27)","");
	addICPSubMenu("10","Cachorros por Canil","javascript:AbrirRel(28)","");
	addICPSubMenu("10","Cachorros por N� SBCPA","javascript:AbrirRel(29)","");
	addICPSubMenu("10","Cachorros por N� CBKC","javascript:AbrirRel(30)","");
	addICPSubMenu("10","S�mulas por Ano/Juiz","javascript:AbrirRel(33)","");
	addICPSubMenu("10","Sint�tico de Chapas","javascript:AbrirRel(34)","");
	addICPSubMenu("10","Sele��es Vencidas","javascript:AbrirRel(35)","");	
	addICPSubMenu("10","S�cios por filiadas","javascript:AbrirRel(38)","");	 

	//addICPSubMenu("10","Propriet�rios","javascript:AbrirRel(14)","");

addICPMenu("9", "Tabelas Auxiliares","#","","");
	addICPSubMenu("9","Adestramento","TBAdestramento_Listar.php","");	
	addICPSubMenu("9","Categoria","TBCategoria_Listar.php","");
	addICPSubMenu("9","Cor","TBCor_Listar.php","");
	addICPSubMenu("9","Qualifica��o C�o","TBQualificacaoCao_Listar.php","");		
	addICPSubMenu("9","Qualifica��o Juiz","TBQualificacaoJuiz_Listar.php","");
	addICPSubMenu("9","Raio X","TBRaioX_Listar.php","");
	addICPSubMenu("9","Sele��o","TBSelecao_Listar.php","");
	addICPSubMenu("9","Presidente e Diretor","TbPresidenteDiretor_Formulario.php","");

addICPMenu("11", "Sair","","javascript:sair()","");



	}
	//addICPMenu("Sair","Sair","","Default.php","");
	
	DownLevelDiv.style.display ='none';
	drawToolbar();


function sair(){
	parent.ManorPagina.location.href = 'about:blank';
	window.location.href='Sair.php';
}

function AbrirRel(n)
{
	var pag = new Array();
	pag[0] = "Rel_RegistrosPorAno.php";
	pag[1] = "Rel_ChapasPorAno.php";
	pag[2] = "Rel_EstatisticoNinhadas.php";
	pag[3] = "Rel_CanisPorUF.php";
	pag[4] = "Rel_CanisPorUF[EX].php";
	pag[5] = "Rel_SelecoesPorAno.php";
	pag[6] = "Rel_CanisPorAno.php";
	pag[7] = "Rel_CanisPorAno[EX].php";
	pag[8] = "Rel_RaioXPorAno.php";
	pag[9] = "Rel_Reprodutores.php";
	pag[10] = "Rel_Reprodutoras.php";
	pag[11] = "Rel_MapaNinhada.php";
	pag[12] = "Rel_MapaNinhadaCanil.php";
	pag[13] = "Rel_Personalizado.php";
	pag[14] = "Rel_Personalizado_Assoc.php";
	pag[15] = "Rel_FilhotesPais_Pai.php";
	pag[16] = "Rel_FilhotesPais_Mae.php";
	pag[17] = "Rel_Telefones.php";
	pag[18] = "Rel_FilhotesPorData_Pai.php";
	pag[19] = "Rel_FilhotesPorData_Mae.php";
	pag[20] = "Rel_FilhotesChapaPorData_Pai.php";
	pag[21] = "Rel_FilhotesChapaPorData_Mae.php";
	pag[22] = "Rel_CachorrosOrdemAlfabetica.php";
	pag[23] = "Rel_ClubesOrdemAlfabetica.php";
	pag[24] = "Rel_JuizOrdemAlfabetica.php";
	pag[25] = "Rel_ProprietarioOrdemAlfabetica.php";
	pag[26] = "Rel_AdestradoresOrdemAlfabetica.php";
	pag[27] = "Rel_CanisComDebito.php";
	pag[28] = "Rel_Cachorros_Canil.php";
	pag[29] = "Rel_CachorrosSequenciaRegistro.php";
	pag[30] = "Rel_CachorrosSequenciaCBKC.php";
	pag[31] = "Exposicoes_ListarResultadoCINE.php";
	pag[32] = "Exposicoes_ListarPontuacaoCINE.php";
	pag[33] = "Rel_SumulasJuiz.php";
	pag[34] = "Rel_ChapaReprodutorSintetico.php";
	pag[35] = "Rel_SelecaoVencida.php";
	pag[36] = "Rel_RegistrosPorAnoFiliada.php";
	//pag[37] = "http://sistemas/extranet/Exposicao_Importar.asp";
	pag[37] = "http://www.sbcpa.com.br/extranet/Exposicao_Importar.asp";
	pag[38] = "Rel_Personalizado2.php";

	if (n == 24){
		if (confirm("Deseja listar somente os Ju�zes Ativos?")){
			pag[24] = pag[24] + "?Ativo=1";
		}
	}

	window.open(pag[n],'','width=780, height=475, left=5, toolbar=yes, top=5, menubar=yes, scrollbars=yes');
}

</script>


<br>
<?
	//print_r($_SERVER); 
	//echo($_SERVER['PATH_INFO']);
 }?>

<center>