<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
	if (isset($_GET["Nome"]))
	{
		PesquisarCachorroNOCachorro($_GET["Nome"]);
	}

?>



<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		
		$Valores = split(";",PesquisarCachorroIdCachorro($Id));
		
		$NoCachorro = $Valores[0];
		$TPSexo = $Valores[1];
		$IdCor = $Valores[2];
		$DaNascimento = $Valores[3];
		$IdCachorroPai = $Valores[4];
		$IdCachorroMae = $Valores[5];
		$IdProprietario = $Valores[6];
		$IdCanil = $Valores[7];
		$IdNinhada = $Valores[8];
		$NuRegistroNacional = $Valores[9];
		$NoTatuagem = $Valores[10];
		$NuRegistroInternacional = $Valores[11];
		$NuCBKC = $Valores[12];
		$NuRegistroRegional = $Valores[13];
		$SgUFRegistro = $Valores[14];
		$IdRaioX = $Valores[15];
		$DaRaioX = $Valores[16];
		$IdAdestramento = $Valores[17];
		$DaProvaAdestramento = $Valores[18];
		//$IdAdestramentoAlemanha = $Valores[19];
		$IdSelecao = $Valores[19];
		$DaSelecao = $Valores[20];
		$IdQualificacaoMaxima = $Valores[21];
		$InResistencia = $Valores[22];
		$DaProvaResistencia = $Valores[23];
		$DsObservacao = $Valores[24];
		$DaRegistro = $Valores[25];
		$NoProprietario = $Valores[26];
		$NoCanil = $Valores[27];
		$NoPai = $Valores[28];
		$NoMae = $Valores[29];
		$NuNinhada = $Valores[30];
		$Sumula = $Valores[31];
		$NuPai = $Valores[32];
		$NuMae  = $Valores[33];
		$NrMicrochip = $Valores[34];
		$DsAdestramento = $Valores[35];
		$IdRaioX1 = $Valores[36];
		$IdRaioX2 = $Valores[37];
		$IdRaioX3 = $Valores[38];
		$IdRaioX4 = $Valores[39];

		if ($InResistencia == ""){$InResistencia = 0;}
		
		if ($Sumula == "") {$Sumula = 0;}
	}
	else
	{
		$Id = "";
		$NoCachorro = "";
		$TPSexo = "";
		$IdCor = "";
		$DaNascimento = "";
		$IdCachorroPai = "";
		$IdCachorroMae = "";
		$IdProprietario = "";
		$IdCanil = "";
		$IdNinhada = "";
		$NuRegistroNacional = "";
		$NoTatuagem = "";
		$NuRegistroInternacional = "";
		$NuCBKC = "";
		$NuRegistroRegional = "";
		$SgUFRegistro = "";
		$IdRaioX = "";
		
		$IdRaioX1 = "";
		$IdRaioX2 = "";
		$IdRaioX3 = "";
		$IdRaioX4 = "";
		
		$DaRaioX = "";
		$IdAdestramento = "";
		$DaProvaAdestramento = "";
		$IdSelecao = "";
		$DaSelecao = "";
		$IdQualificacaoMaxima = "";
		$InResistencia = "0";
		$DaProvaResistencia = "";
		$DsObservacao = "";
		$DaRegistro = "";
		$NoProprietario = "";
		$NoCanil = "";
		$NoPai = "";
		$NoMae = "";
		$NuNinhada = "";
		$NuPai = "";
		$NuMae = "";
		$NrMicrochip = "";
		$DsAdestramento = "";
	}
?>

<head>
<script language="JavaScript">
function Pergunta(){
	return confirm('A impressão será realizada com a data de hoje');
}

function AbrirPopUp(obj)
{
	window.open('ConsultarPreenchimento_Corpo.php?Obj='+obj,'Pesquisar','width=500, height=260');
}

function Organizador(opc)
{
	if (opc == 1)
	{
		Formulario.Dados.style.display = '';
		Formulario.Qualificacoes.style.display = 'none';
		Formulario.Registros.style.display = '';
		Espaco1.style.display = '';
	}

	if (opc == 2)
	{
		Formulario.Dados.style.display = 'none';
		Formulario.Qualificacoes.style.display = '';
		Formulario.Registros.style.display = 'none';
		Espaco1.style.display = 'none';
	}
}

function Imprimir1(id)
{
	if (!Pergunta())
	{
		data = prompt('Informe a Data para a Impressão do Pedigree (DD/MM/AAAA) ');
		data = data.replace("/",".");
		data = data.replace("/",".");
		window.open('Relatorios/Pedigree.php?Data='+data+'&Id='+id,'Pedigree','width=780, height=520, left=5, top=20');
	}
	else
	{window.open('Relatorios/Pedigree.php?Id='+id,'Pedigree','width=780, height=520, left=5, top=20');}
}

function Imprimir2(id)
{
	if (!Pergunta())
	{
		data = prompt('Informe a Data para a Impressão do Pedigree (DD/MM/AAAA) ');
		data = data.replace("/",".");
		data = data.replace("/",".");
		window.open('Relatorios/Pedigree.php?Via=1&Data='+data+'&Id='+id,'Pedigree','width=780, height=520, left=5, top=20');
	}
	else
	{window.open('Relatorios/Pedigree.php?Via=1&Id='+id,'Pedigree','width=780, height=520, left=5, top=20');}
}

function Imprimir3(id)
{
	if (!Pergunta())
	{
		data = prompt('Informe a Data para a Impressão do Pedigree (DD/MM/AAAA) ');
		data = data.replace("/",".");
		data = data.replace("/",".");
		window.open('Relatorios/Pedigree3.php?Data='+data+'&Id='+id,'Pedigree','width=780, height=520, left=5, top=20');
	}
	else
	{window.open('Relatorios/Pedigree3.php?Id='+id,'Pedigree','width=780, height=520, left=5, top=20');}
}

</script>
</head>

<body>
<Form name="Formulario" method="post" action="Cachorro_Processar.php">
<input type="hidden" name="IdCachorro" value="<? echo($Id);?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
<table>
  <tr>
    <td><h3>Registro de Cachorros</h3></td>
  </tr>
  <tr>
    <td><table>
        <tr> 
          <td><a href="javascript: Organizador(1)">Dados do Cachorro</a></td>
          <td> | </td>
          <td><a href="javascript: Organizador(2)">Qualificações do Cachorro</a></td>
	
	<? if ($Id != ""){?>
          <td> | </td>
          <td><a href="javascript: window.location.href='Sumula_Formulario.php?Id=<? echo($Sumula);?>&IdCachorroSumula=<? echo($Id);?>&NoCachorroSumula=<? echo($NoCachorro);?>'">Súmula</a></td>
          <td> | </td>
          <td><a href="JavaScript:Imprimir1(<? echo($Id);?>)">Pedigree</a></td>
          <td> | </td>
          <td><a href="JavaScript:Imprimir2(<? echo($Id);?>)">2ª via</a></td>
          <td> | </td>
          <td><a href="JavaScript:Imprimir3(<? echo($Id);?>)">Pedrigree Novo</a></td>
	<? }?>
        </tr>
      </table>
      <br>
    </td>
  </tr>
  <tr>
    <td align=center> <fieldset id="Dados" style="width: 495"><legend>
      <table>
        <tr>
          <td>Dados do Cão</td>
        </tr>
      </table></legend>
      <table class="SemBorda">
        <tr> 
          <td>Nome</td>
          <td><input name="NoCachorro" type="text" value="<?echo($NoCachorro)?>" size="70" maxlength="50"></td>
        </tr>
      </table>
      <table width="484" class="SemBorda">
        <tr> 
          <td width="38">Sexo</td>
          <td width="106"><select name="TPSexo">
              <option></option>
              <option value="M">Macho</option>
              <option value="F">F&ecirc;mea</option>
            </select></td>
			<script>document.Formulario.TPSexo.value = '<?echo($TPSexo);?>';</script>
          <td width="24">Cor</td>
          <td width="24"><? echo(MontarCombo("Cor",100))?></td>
		    <script>document.Formulario.IdCor.value = '<?echo($IdCor);?>';</script>
          <td width="162"><div align="right">Data de Nascimento</div></td>
          <td width="102"><input name="DtNascimento" type="text" value="<?echo($DaNascimento)?>" size="12" maxlength="10" onKeyUp="FormatarData(this)"></td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
          <td>Pai&nbsp;&nbsp;&nbsp;&nbsp;</td><input type="hidden" name="IDPai" value="<? echo($IdCachorroPai);?>">
          <td><input name="NoPai" type="text" size="66" maxlength="50" value="<?echo($NuPai ." - ". $NoPai);?>" readonly>
              <a href="javascript: AbrirPopUp('Pai')"><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
          <td>M&atilde;e&nbsp;&nbsp;</td><input name="IDMae" type="hidden" value="<? echo($IdCachorroMae);?>">
          <td><input name="NoMae" type="text" size="66" maxlength="50" value="<?echo($NuMae ." - ". $NoMae)?>"  readonly>
              <a href="javascript: AbrirPopUp('Mae')""><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
            <td>Propriet&aacute;rio</td>
            <input name="IDProprietario" type="hidden" value="<?echo($IdProprietario);?>"> 
          <td> <input name="NoProprietario" type="text" size="57" maxlength="50" value="<?echo($NoProprietario)?>" readonly> 
            <a href="javascript: AbrirPopUp('Proprietario')"><img src="Imagens/Escolher.gif" border="0"></a>
			<a href="#"><img src="Imagens/Limpar.gif" border="0" onClick="document.Formulario.NoProprietario.value=''; document.Formulario.IDProprietario.value=''; document.Formulario.submit()"></a>
			 </td>
        </tr>
        <tr> 
          <td>Canil</td><input type="hidden" name="IDCanil" value="<?echo($IdCanil);?>">
          <td><input name="NoCanil" type="text" value="<?echo($NoCanil);?>" size="60" maxlength="50" readonly>
             <a href="javascript: AbrirPopUp('Canil')"><img src="Imagens/Escolher.gif" border="0"></a></td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
          <td>Ninhada</td>
          <td> 
	<input name="NoNinhada2" type="text" size="30" maxlength="50" value="<? echo($NuNinhada);?>" readonly="true">
	<input name="NoNinhada" type="hidden" size="60" maxlength="50" value="<? echo($IdNinhada);?>">
            </td>
          <td>Microchip:</td>
          <td> 
	<input name="NrMicrochip" type="text" size="20" maxlength="50" value="<? echo($NrMicrochip);?>">
            </td>

        </tr>
      </table>
      </fieldset>
      <span id="Espaco1"><br>
      <br>
      </span> <fieldset id="Registros" style="width: 495"><legend>
      <table>
        <tr>
          <td>Registros do Cão</td>
        </tr>
      </table></legend>
      <table class="SemBorda">
        <tr> 
          <td width="95"> N&ordm; Nacional</td>
          <td width="125"><input name="NuRegistroNacional" value="<?echo($NuRegistroNacional)?>" type="text" size="17" maxlength="15"></td>
          <td width="75">Tatuagem</td>
          <td><input name="NoTatuagem" value="<?echo($NoTatuagem)?>" type="text" size="23" maxlength="20"></td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
          <td width="95">N&ordm; Internacional</td>
          <td width="125"><input name="NuRegistroInternacional" value="<?echo($NuRegistroInternacional);?>" type="text" size="17" maxlength="15"></td>
          <td width="75">N&ordm; CBKC</td>
          <td><input name="NuCBKC" type="text" value="<?echo($NuCBKC);?>" size="23" maxlength="20"></td>
        </tr>
      </table>
      <table class="SemBorda">
        <tr> 
          <td width="95">Pelagem</td>
          <td width="125">
          		<select name="NuRegistroRegional" id="NuRegistroRegional">
                	<option value="0"></option>
                    <option value="PNL">Pelagem normal</option>
                    <option value="PLL">Pelagem longa</option>
                </select>
                
                <script>
					// Número de registro regional é pelagem
                	document.getElementById('NuRegistroRegional').value = '<?echo($NuRegistroRegional);?>';
                </script>
          </td>
          <td width="75">UF Registro</td>
          <td><input name="SgUFRegistro" type="text" value="<?echo($SgUFRegistro)?>" size="4" maxlength="2"></td>
        </tr>
      </table>
      <br>
      </fieldset>
      <fieldset id="Qualificacoes" style="display:none; width: 495"><legend>
      <table>
        <tr>
          <td>Qualificações do Cachorro</td>
        </tr>
      </table></legend>
      <table width="480" class="semborda">            
        <tr> 
          <td width="44">RaioX</td>
          <td width="216"><? echo(MontarCombo("RaioX",200))?></td>
		  <script>document.Formulario.IdRaioX.value = '<?echo($IdRaioX);?>';</script>
          <td width="96"><div align="right">Data do RaioX</div></td>
          <td width="104"><input name="DtRaioX" type="text" value="<?echo($DaRaioX);?>" size="12" maxlength="10" onKeyUp="FormatarData(this)"></td>
        </tr>
      </table>

      <table class=semborda>
      	<tr>
        	<td colspan=6><strong>Detalhamento do Raio X</strong></td>
        </tr>
        <tr>
        	<td width=20></td>
        	<td>Nacional:</td>
        	<td>Coxo-femural:</td>
            <td><? echo(MontarCombo("RaioX1",50))?></td>
            <td>&nbsp;&nbsp;Cotovelo:</td>
            <td><? echo(MontarCombo("RaioX2",50))?></td>
        </tr>
        <tr>
        	<td></td>
        	<td>Internacional: &nbsp;&nbsp;&nbsp;</td>
        	<td>Coxo-femural:</td>
            <td><? echo(MontarCombo("RaioX3",50))?></td>
            <td>&nbsp;&nbsp;Cotovelo:</td>
            <td><? echo(MontarCombo("RaioX4",50))?></td>
        </tr>
      </table>
      <script>
	  	document.Formulario.IdRaioX1.value = '<?echo($IdRaioX1);?>';
		document.Formulario.IdRaioX2.value = '<?echo($IdRaioX2);?>';
		document.Formulario.IdRaioX3.value = '<?echo($IdRaioX3);?>';
		document.Formulario.IdRaioX4.value = '<?echo($IdRaioX4);?>';
      </script>
	<br>

      <table width="480" class="semborda">
        <tr> 
          <td width="85">Adestramento</td>
          <td width="186"><? echo(MontarCombo("Adestramento",190))?></td>
		  <script>document.Formulario.IdAdestramento.value = '<?echo($IdAdestramento);?>';</script>
          <td width="86"><div align="right">Data Prova</div></td>
          <td width="103"><input name="DtProvaAdestramento" value="<?echo($DaProvaAdestramento)?>" type="text" size="12" maxlength="10" onKeyUp="FormatarData(this)"></td>
        </tr>
      </table>


      <table width="480" class="semborda">
        <tr> 
          <td width="85">Adestramentos</td>
          <td><input type="text" size="59" name="DsAdestramento" value="<?echo($DsAdestramento)?>" maxlength="100"></td>
        </tr>
      </table>


      <!--table width="480" class="semborda">
        <tr> 
          <td width="152">Adestramento Alemanha</td>
          <td width="316"><? echo(MontarCombo("AdestramentoAlemanha",190))?> <div align="right"></div></td>
          <script>document.Formulario.IdAdestramentoAlemanha.value = '<?echo($IdAdestramentoAlemanha);?>';</script>	
		</tr>
      </table-->
      <table width="480" class="semborda">
        <tr> 
          <td width="58">Sele&ccedil;&atilde;o</td>
          <td width="213"><? echo(MontarCombo("Selecao",190))?></td>
		  <script>document.Formulario.IdSelecao.value = '<?echo($IdSelecao);?>';</script>
          <td width="115"><div align="right">Validade Sele&ccedil;&atilde;o</div></td>
          <td width="103"><input name="DtSelecao" type="text" value="<?echo($DaSelecao);?>" size="12" maxlength="10" onKeyUp="FormatarData(this)"></td>
        </tr>
      </table>
      <table width="480" class="semborda">
        <tr> 
          <td width="129">Qualificacao Maxima</td>
          <td width="339"><? echo(MontarCombo("QualificacaoCao",211))?></td>
		  <script>document.Formulario.IdQualificacaoCao.value = '<?echo($IdQualificacaoMaxima);?>';</script>
        </tr>
      </table>
      <table width="480" class="semborda">
        <tr> 
          <td width="85">Resist&ecirc;ncia</td>
          <td width="186">
		   <select name="InResistencia">
              <option value="0" selected>N&atilde;o</option>
              <option value="1">Sim</option>
            </select></td>
			<script>document.Formulario.InResistencia.value = '<?echo($InResistencia);?>';</script>
          <td width="86"><div align="right">Data Prova</div></td>
          <td width="103"><input name="DtResistencia" type="text" value="<?echo($DaProvaResistencia)?>" size="12" maxlength="10" onKeyUp="FormatarData(this)"></td>
        </tr>
      </table>
      <table width="480" class="semborda">
        <tr> 
          <td>Observa&ccedil;&atilde;o</td>
        </tr>
        <tr> 
          <td><textarea name="DsObservacao" cols="73" rows="4"><?echo($DsObservacao)?></textarea></td>
        </tr>
      </table>
      </fieldset></td>
  </tr>
  <tr>
    <td> <div align="center"><br>
        <input type="Submit" value="Gravar Dados">
        &nbsp;&nbsp; 
        <input type="reset" value="Limpar Dados">
      </div></td>
  </tr>
</table>
</Form>
</body>
</html>


<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Cachorro">
	<? echo($ScriptRodape);?>
</form>