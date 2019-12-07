<?
 $menu = "true";
 require("Estilo/Estilo.php");
?>
<?
	if (!isset($_GET["Tipo"]))
	{die();}

	$Texto = "";

	if ($_GET["Tipo"] == "Sumula")
	{
		$Pagina = "Sumula_Listar.php";
		$Texto = $Texto . "<option value='IDSumula'>Sumula</option>";
		$Texto = $Texto . "<option value='NuRegistroNacional'>Número SBCPA</option>";
		//$Texto = $Texto . "<option value='DTSumula'>Data</option>";
	}

	if ($_GET["Tipo"] == "Prova")
	{
		$Pagina = "Provas_Listar.php";
		$Texto = $Texto . "<option value='NoProva'>Provas</option>";
		$Texto = $Texto . "<option value='SgUF'>UF</option>";
		$Texto = $Texto . "<option value='NoCidade'>Cidade</option>";				
	}
	
	if ($_GET["Tipo"] == "Exposicao")
	{
		$Pagina = "Exposicoes_Listar.php";
		$Texto = $Texto . "<option value='NoExposicao'>Exposições</option>";
		$Texto = $Texto . "<option value='SgUF'>UF</option>";
		$Texto = $Texto . "<option value='NoCidade'>Cidade</option>";		
		$Texto = $Texto . "<option value='DTInicio'>Ano</option>";
	}
	
	if ($_GET["Tipo"] == "Ninhada")
	{
		$Pagina = "Ninhada_Listar.php";
		$Texto = $Texto . "<option value='NuNinhada'>Ninhada</option>";
	}


	if ($_GET["Tipo"] == "Juiz")
	{
		$Pagina = "Juiz_Listar.php";
		$Texto = $Texto . "<option value='NoJuiz'>Nome do Juiz</option>";
		$Texto = $Texto . "<option value='NoCidade'>Cidade</option>";
		$Texto = $Texto . "<option value='SGUF'>UF</option>";
	}

	if ($_GET["Tipo"] == "Cor")
	{
		$Pagina = "TbCor_Listar.php";
		$Texto = $Texto . "<option value='NoCor'>Nome da Cor</option>";
		$Texto = $Texto . "<option value='IdCor'>Código da Cor</option>";
	}

	if ($_GET["Tipo"] == "Categoria")
	{
		$Pagina = "TbCategoria_Listar.php";
		$Texto = $Texto . "<option value='NoCategoria'>Nome da Categoria</option>";
		$Texto = $Texto . "<option value='IdCategoria'>Código da Categoria</option>";
	}

	if ($_GET["Tipo"] == "RaioX")
	{
		$Pagina = "TbRaioX_Listar.php";
		$Texto = $Texto . "<option value='NoRaioX'>Nome do RaioX</option>";
		$Texto = $Texto . "<option value='IdRaioX'>Código do RaioX</option>";
	}
	
	if ($_GET["Tipo"] == "Classificacao")
	{
		$Pagina = "TbClassificacao_Listar.php";
		$Texto = $Texto . "<option value='NoClassificacao'>Nome da Classificacao</option>";
		$Texto = $Texto . "<option value='IdClassificacao'>Código da Classificacao</option>";
	}
	
	if ($_GET["Tipo"] == "Selecao")
	{
		$Pagina = "TbSelecao_Listar.php";
		$Texto = $Texto . "<option value='NoSelecao'>Nome da Selecao</option>";
		$Texto = $Texto . "<option value='IdSelecao'>Código da Selecao</option>";
	}

	if ($_GET["Tipo"] == "QualificacaoJuiz")
	{
		$Pagina = "TbQualificacaoJuiz_Listar.php";
		$Texto = $Texto . "<option value='NoQualificacaoJuiz'>Nome da Qualificacao</option>";
		$Texto = $Texto . "<option value='IdQualificacaoJuiz'>Código da Qualificacao</option>";
	}
	
	if ($_GET["Tipo"] == "Canil")
	{
		$Pagina = "Canil_Listar.php";
		$Texto = $Texto . "<option value='NoCanil'>Nome do Canil</option>";
		$Texto = $Texto . "<option value='NoProprietarioCanil'>Nome da Proprietário</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}
	
	if ($_GET["Tipo"] == "Clube")
	{
		$Pagina = "Clube_Listar.php";
		$Texto = $Texto . "<option value='SgClube'>Sigla do Clube</option>";
		$Texto = $Texto . "<option value='NoClube'>Nome do Clube</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}


	if ($_GET["Tipo"] == "Proprietario")
	{
		$Pagina = "Proprietario_Listar.php";
		$Texto = $Texto . "<option value='NoProprietario'>Nome do Proprietario</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}

	if ($_GET["Tipo"] == "Cachorro")
	{
		$Pagina = "Cachorro_Listar.php";
		$Texto = $Texto . "<option value='NoCachorro'>Nome do Cachorro</option>";
		$Texto = $Texto . "<option value='NuRegistroNacional'>Nº SBCPA</option>";
		$Texto = $Texto . "<option value='NoTatuagem'>Tatuagem</option>";
		$Texto = $Texto . "<option value='NoProprietario'>Nome do Proprietario</option>";
		$Texto = $Texto . "<option value='NuRegistroRegional'>N° Regional</option>";
		$Texto = $Texto . "<option value='NuRegistroInternacional'>N° Internacional</option>";
		$Texto = $Texto . "<option value='NuCBKC'>N° CBKC</option>";
	}
		
	if ($_GET["Tipo"] == "Socio")
	{
		$Pagina = "Socio_Listar.php";
		$Texto = $Texto . "<option value='NoSocio'>Nome do Sócio</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}
	
	
	if ($_GET["Tipo"] == "Adestrador")
	{
		$Pagina = "Adestrador_Listar.php";
		$Texto = $Texto . "<option value='NoAdestrador'>Nome do Figurante</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}

	if ($_GET["Tipo"] == "Diretoria")
	{
		$Pagina = "Diretoria_Listar.php";
		$Texto = $Texto . "<option value='NoDiretoria'>Nome do Diretor</option>";
		$Texto = $Texto . "<option value='NoCidade'>Nome da Cidade</option>";
		$Texto = $Texto . "<option value='SgUF'>Sigla UF</option>";
	}

	if ($_GET["Tipo"] == "Adestramento")
	{
		$Pagina = "TbAdestramento_Listar.php";
		$Texto = $Texto . "<option value='NoAdestramento'>Nome do Adestramento</option>";
		$Texto = $Texto . "<option value='IdAdestramento'>Codigo do Adestramento</option>";
	}	

	if ($_GET["Tipo"] == "QualificacaoCao")
	{
		$Pagina = "TbQualificacaoCao_Listar.php";
		$Texto = $Texto . "<option value='NoQualificacaoCao'>Nome do Qualificacao Cao</option>";
		$Texto = $Texto . "<option value='IdQualificacaoCao'>Codigo do Qualificacao Cao</option>";
	}
?>

<body leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<FORM name="FormularioPesquisa" action="<? echo($Pagina);?>" target="MaiorPagina" method="post" OnSubmit="document.FormularioPesquisa.Campo.focus()">
<table width="100%" border="0">
  <tr>
    <td>C<u>r</u>it&eacute;rio 
      <input name="Parametro" type="text" id="Parametro" size="60" OnBlur="if(this.value != ''){document.FormularioPesquisa.submit(); document.FormularioPesquisa.Campo.focus();}" accesskey="r"></td>
      <td> Campo de Pesquisa 
        <select name="Campo" style="width: 200">
			<? echo($Texto);?>
      </select></td>
    <td>&nbsp;</td>
  </tr>
</table>
</FORM>