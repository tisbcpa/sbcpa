<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Clube.php");?>
<? require("Funcoes/Ninhada.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		
		$Valores = split(",",PesquisarNinhadaIdNinhada($Id));
		
		$NuNinhada = substr($Valores[0],0,4); 
		$AnoNinhada = substr($Valores[0],4,4); 
				
		$DaNascimento = $Valores[1]; 
		$IdCanil = $Valores[2]; 
		$NrMachos = $Valores[3]; 
		$NrMachosVivos = $Valores[4]; 
		$NrFemeas = $Valores[5]; 
		$NrFemeasVivas = $Valores[6]; 
		$TxConsaguinidade = $Valores[7]; 
		$TxConsaguinidade = str_replace("$", ",", $TxConsaguinidade);
		$IdCachorroPai = $Valores[8]; 
		$IdCachorroMae = $Valores[9];
		$NoCanil = $Valores[10];
		$NoPai = $Valores[11];
		$NoMae = $Valores[12];
		$idClube = $Valores[13];
	
		
		$Combos = '<script>';
		$Combos = $Combos . 'document.Formulario.NrMachos.value = "'. $NrMachos .'";';
		$Combos = $Combos . 'document.Formulario.NrMachosVivos.value = "'. $NrMachosVivos .'";';
		$Combos = $Combos . 'document.Formulario.NrFemeas.value = "'. $NrFemeas .'";';		
		$Combos = $Combos . 'document.Formulario.NrFemeasVivas.value = "'. $NrFemeasVivas .'";';
		$Combos = $Combos . 'document.Formulario.idClube.value = "'. $idClube .'";';				
		$Combos = $Combos . '</script>';
	}
	else
	{
		$Id = "";
		$NuNinhada = "";
		$DaNascimento = "";
		$IdCachorroPai = "";
		$IdCachorroMae = "";
		$IdCanil = "";
		$NrMachos = "";
		$NrMachosVivos = "";
		$NrFemeas = "";
		$NrFemeasVivas = "";
		$NoCanil = "";
		$NoPai = "";
		$NoMae = "";
		$TxConsaguinidade = "";
		$Combos = "";
		$idClube = "";

		$Hoje = date("y/m/d");
		list ($ano,$mes,$dia) = split ('[/.-]', $Hoje);
		$AnoNinhada = "$ano";
		$AnoNinhada = "20" . $AnoNinhada;		



	}
?>

<head>

<script language="vbscript">
Function Substituir(texto)
	texto = replace(texto,"III/IV","IV/III")

	texto = replace(texto,"II/IV","IV/II")
	texto = replace(texto,"II/III","III/II")

	texto = replace(texto,"I/III","III/I")	
	texto = replace(texto,"I/II","II/I")
	texto = replace(texto,"I/IV","IV/I")

	Substituir = texto
End Function
</script>


<script language="JavaScript" src="Funcoes/FuncoesXML.js"></script>
<script language="javascript">
//Armazena o Número do elemento inicial do cadastro de filhote
var ObjMatriz = new Array(30);
var ArrayVisto = new Array(31);

function ImprimirPedigree(Id)
{
	window.open('Relatorios/Pedigree.php?Id='+Id,'Pedigree','width=780, height=520, left=5, top=20')
}

function VarrerArray(vl)
{
	var retorno = false;
	
	for(var i=0; i<31; i++)
	{
		if (ArrayVisto[i] == vl)	
		{
			retorno = true;
		}
	}
	
	return retorno;
}
	
function VerificarConsaguinidade(IdMae,IdPai)
{
	var Taxa = "";
	var Pagina = 'DadosCaesXML.php?IdPai='+ IdPai +'&IdMae='+ IdMae;
	//alert(Pagina);
	CarregarXml('IlhaXmlConsaguinidade',Pagina);
	Path = "/ROOT/row";
	TBRetorno = MontarTabela('IlhaXmlConsaguinidade',Path);
	c = 0;

	for (i=0;!TBRetorno.atEnd();TBRetorno.moveNext())
	{
		jNome = LerAtributo(TBRetorno,"Nome");
		jId = LerAtributo(TBRetorno,"Id");
		jTipo = LerAtributo(TBRetorno,"Tipo");
		jGrau = LerAtributo(TBRetorno,"Grau");				
		//Msg.innerHTML = Msg.innerHTML +"**"+ jId +"-"+ jNome + '<br>';
		
		Path = "/ROOT/row[@Nome = '"+ jNome +"']";
		TBRetorno2 = MontarTabela('IlhaXmlConsaguinidade',Path);

		for (i=0;!TBRetorno2.atEnd();TBRetorno2.moveNext())
		{
			jNome2 = LerAtributo(TBRetorno2,"Nome");
			jId2 = LerAtributo(TBRetorno2,"Id");
			jTipo2 = LerAtributo(TBRetorno2,"Tipo");
			jGrau2 = LerAtributo(TBRetorno2,"Grau");				

			if ((jId != "") && (jId2 != "") && (jId != jId2) && (!VarrerArray(jId)))
			{
				ArrayVisto[c] = jId2;
				c++;
				
				if (jTipo == jTipo2)
				{Taxa = Taxa + jNome.replace("*","'") + " " + jGrau +","+ jGrau2 +"; ";}
				
				if (jTipo != jTipo2)
				{Taxa = Taxa + jNome.replace("*","'") + " " + jGrau +"/"+ jGrau2 +"; ";}
			}
		}
	}

	Taxa = Taxa.substr(0,Taxa.length-2);
//	alert(Substituir(Taxa));
	document.Formulario.TxConsaguinidade.value = Substituir(Taxa);
}


function PreencherConsaguinidade()
{
	var IdMae = document.Formulario.IDMae.value;
	var IdPai = document.Formulario.IDPai.value;

	if ((IdMae != '') && (IdPai != ''))
	{VerificarConsaguinidade(IdMae,IdPai)}
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

var vlr = 0;
var Qtde = 1;


function ValidarQtdeFilhotes()
{
	var alerta = 'Informações Incorretas:\n';
	var alerta2 = alerta;
	var Qtde = parseInt(document.Formulario.elements.length);
	var QM = parseInt(document.Formulario.NrMachosVivos.value);
	var QF = parseInt(document.Formulario.NrFemeasVivas.value);
	var QtdeM = 0;
	var QtdeF = 0;
	
	for(i=23; i<Qtde; i=i+6)
	{
		if (document.Formulario.elements[i].value == 'M'){ QtdeM++;}
		if (document.Formulario.elements[i].value == 'F'){ QtdeF++;}
		i++;
	}

	if (QM != QtdeM)
	{alerta = alerta + '- A quantidade de Fikhotes Machos deve ser igual a Quantidade de Machos Vivos\n     Quantidade de Machos Vivos: '+ QM +'   Filhotes Machos: '+ QtdeM + '\n';}

	if (QF != QtdeF)
	{alerta = alerta + '- A quantidade de Filhotes Fêmeas deve ser igual a Quantidade de Fêmeas Vivas\n     Quantidade de Fêmeas Vivas: '+ QF +'   Filhotes Fêmeas: '+ QtdeF + '\n';}

	if (alerta != alerta2)
	{alert(alerta); return false;}
	else
	{return true;}
}


function ValidarCampos()
{
	var ArrayCampos = new Array(8)
	var ArrayMsg = new Array(8)
	ArrayCampos[1] = document.Formulario.DaNascimento;
	ArrayMsg[1] = " - Informar a Data de Nascimento;\n";
	ArrayCampos[2] = document.Formulario.IDCanil;
	ArrayMsg[2] = " - Informar o Canil;\n";
	ArrayCampos[3] = document.Formulario.NrMachos;
	ArrayMsg[3] = " - Informar o Número de Machos;\n";	
	ArrayCampos[4] = document.Formulario.NrFemeas
	ArrayMsg[4] = " - Informar o Número de Fêmeas;\n";	
	ArrayCampos[5] = document.Formulario.NrMachosVivos;
	ArrayMsg[5] = " - Informar o Número de Machos Vivos;\n";	
	ArrayCampos[6] = document.Formulario.NrFemeasVivas;
	ArrayMsg[6] = " - Informar o Número de Fêmeas Vivos;\n";	
	ArrayCampos[7] = document.Formulario.IDPai;
	ArrayMsg[7] = " - Informar o Pai da Ninhada;\n";	
	ArrayCampos[8] = document.Formulario.IDMae;
	ArrayMsg[8] = " - Informar a Mãe da Ninhada;\n";
//	ArrayCampos[9] = document.Formulario.idClube;
//	ArrayMsg[9] = " - Informar a Filiada;\n";
	
	return ValidarCamposGlobal(ArrayCampos,ArrayMsg);
}

function Validar()
{
	//PreencherConsaguinidade();

	if (ValidarCampos() && ValidarQtdeFilhotes())
	{
		AtivacaoTodosFilhotes(false);
		return true;
	}
	else
	{
		return false;
	}
}

function FilhotesCampo()
{
	Form = "";
	Form = Form + "<table border=0 class=SemBorda>";
	Form = Form + "  <tr>";
	Form = Form + "  <td><input type=hidden name=Id"+ Qtde +"><input type=text name=NrSBCPA"+ Qtde +" size=8 onBlur=Novo(this); OnFocus=EscreverCombo('');></td>";
	Form = Form + "  <td><input type=text name=NoCachorro"+ Qtde +" onKeyUp='PesquisarCachorroNome(this)' size=49></td>";
	Form = Form + "  <td><select name=TPSexo"+ Qtde +" OnFocus=EscreverCombo('');>";
	Form = Form + "		<option></option>";
	Form = Form + "		<option value=M>M</option>";
	Form = Form + "		<option value=F>F</option>";
	Form = Form + "	   </select></td>";
	Form = Form + "  <td><input type=text name=NrCBKC"+ Qtde +" size=8 OnFocus=EscreverCombo('');></td>";
	Form = Form + "  <td><input type=text name=NoTatuagem"+ Qtde +" size=8 OnFocus=EscreverCombo('');></td>";
	Form = Form + "  <td><? echo(str_replace('"','',str_replace("'","",MontarCombo("Cor",50))))?></td>";
	Form = Form + "  <td><img src=Imagens/Limpar.gif border=0 style='cursor: hand' OnClick='RetirarFilhoteNaoCadastrado("+ Qtde +")'  alt='Limpar Dados do Filhote'></td>";
	Form = Form + "</tr>";
	Form = Form + "</table>";

	NovoNome = 'IdCor'+ Qtde.toString();
	Form = Form.replace('IdCor',NovoNome);

	FilhotesCampoSpan.innerHTML = FilhotesCampoSpan.innerHTML + Form;
}


function Novo(num)
{
	if (num.value != '')
	{
		var RetornoVerficiacao = PesquisarRegistroSBCPA(num.value);
		
		if(RetornoVerficiacao == "")
		{
			AcrescentarNovo();
			setTimeout(Foco,100);
		}	
		else
		{
			var n = num.name.replace('NrSBCPA','');
			if (document.Formulario.elements[VarrerVetor(n)].value == '')
			{
				alert('Altere o Nº SBCPA, pois já existe um cachorro cadastrado com este Registro:\n    Registro: SBCPA '+ num.value +'\n    Nome: ' + RetornoVerficiacao);
				num.focus();
			}
		}
	}
}


function AcrescentarNovo()
{	
	var Novo = parseInt(document.Formulario.elements.length) - 1;
	var ver = parseInt(document.Formulario.elements.length) - 7;
	vlr = parseInt(document.Formulario.elements.length) - 6;
	console.log(document.Formulario.elements.length);
	console.log(document.Formulario.elements[ver]);
	//alert('SBCPA: ' + document.Formulario.elements[ver].name);	
	//alert('Nome: ' + document.Formulario.elements[vlr].name);
	
	if (document.Formulario.elements[ver].value != "")
	{
		//alert(document.Formulario.elements[ver].name);
		Qtde = document.Formulario.elements[ver].name.replace('NrSBCPA','');
		//Qtde = Qtde.replace('Id','');
		Qtde = parseInt(Qtde);
		Qtde++;
		AtribuirObj(Qtde,Novo);
		
		FilhotesCampo();
	}
	//alert('Novo: ' + document.Formulario.elements[Novo].name);
}

function Foco()
{
	document.Formulario.elements[vlr].focus();
}

function EscreverCombo(txt)
{
	ListarCachorros.innerHTML = txt;
}

function PesquisarRegistroSBCPA(num)
{
	num = 'SBCPA ' + num;
	CarregarXml('IlhaXml','Cachorro_PesquisarXML.php?Parametro='+num+'&Acao=1');
	var TbNuSBCPA = MontarTabela('IlhaXml',"/ROOT/row");

	try{
		var JNome = LerAtributo(TbNuSBCPA[0],"Nome");
		return JNome;
		//return "";
	}
	catch(e)
	{
		return "";
	}
}

var Carregado = false;
var QtdeCaracteres = 0;



function AtivacaoTodosFilhotes(valor)
{
	var t = 19;
	var f = document.Formulario.elements.length;
	for(var i=t; i<f; i++)
	{
		document.Formulario.elements[i].disabled = valor;
	}
	EscreverCombo('');
}



function AtivacaoCampos(Id,valor)
{
	var t = VarrerVetor(Id);
	var f = parseInt(t) + 6;
	for(var i=t; i<=f; i++)
	{
		document.Formulario.elements[i].disabled = valor;
	}
	EscreverCombo('');
}



function RetirarFilhoteNaoCadastrado(Id)
{
	var t = VarrerVetor(Id);
	var f = parseInt(t) + 6;
	for(var i=t; i<=f; i++)
	{
		document.Formulario.elements[i].value = "";
	}
	EscreverCombo('');
}

function VarrerVetor(n)
{
	for(i=1;i<=10;i++)
	{
		if (ObjMatriz[i])
		{
			v = ObjMatriz[i].split(',');
			if (v[0] == n)
			{return v[1];}
		}
	}	
}

function EscolherCachorro(nome,valor)
{
	var n = nome.replace("NoCachorro","");
	var elemento = VarrerVetor(n);	
	elementoIni = parseInt(elemento);
	PesquisarCachorroId(valor,elementoIni);
}

function PesquisarCachorroId(Id,elementoInicial)
{
	var Pagina = 'Cachorro_PesquisarXML.php?Parametro='+Id+'&Acao=3';
	CarregarXml('IlhaXmlCachorro',Pagina);
	var TBRetorno = MontarTabela('IlhaXmlCachorro','/ROOT/row');
	//elementoInicial --;
	//alert(document.Formulario.elements[elementoInicial].name +'  -  '+ Id);
	//elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = Id;
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"NuSBCPA").replace("SBCPA ","");
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"Nome");
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"Sexo");
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"NuCBKC");
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"NoTatuagem");
	elementoInicial ++;
	document.Formulario.elements[elementoInicial].value = LerAtributo(TBRetorno,"IdCor");
	EscreverCombo('');
	AcrescentarNovo();
}


function RetirarFilhoteCadastrado(elemento)
{
	if (!confirm('Deseja realmente Retirar este Cachorro desta Ninhada?'))
	{return false;}

	var elementoInicial = VarrerVetor(elemento);
	var img = eval("document.all['Img"+ elemento +"']");
	var Id = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;
	var NuRegistroNacional = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;
	var NoCachorro = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;
	var TPSexo = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;
	var NuCBKC = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;
	var NoTatuagem = document.Formulario.elements[elementoInicial].value;
	elementoInicial ++;	
	var IdCor = document.Formulario.elements[elementoInicial].value;

	var DtNascimento = document.Formulario.DaNascimento.value;
	var NoPai = document.Formulario.IDPai.value;
	var NoMae = document.Formulario.IDMae.value;
	var IDCanil = document.Formulario.IDCanil.value;
	var NoNinhada = 'null'; //document.Formulario.IdNinhada.value;

	Pagina = "Cachorro_PesquisarXML.php?Acao=4&Parametro=Nenhum&Id="+ Id +"&NoCachorro="+ NoCachorro +"&TPSexo="+ TPSexo + "&IdCor="+ IdCor + "&DtNascimento="+ DtNascimento + "&NoPai="+ NoPai +"&NoMae="+ NoMae +"&IDCanil="+ IDCanil +"&NoNinhada="+ NoNinhada + "&NuRegistroNacional="+ NuRegistroNacional + "&NoTatuagem="+ NoTatuagem +"&NuCBKC=" + NuCBKC;
	CarregarXml('IlhaXml',Pagina);
	//alert(Pagina +'\n\n\n\n'+ IlhaXml.xml)
	TBRetorno = MontarTabela('IlhaXml','/ROOT/row');

	if (LerAtributo(TBRetorno,"Resultado") == "Alterado com êxito!")
	{	
		RetirarFilhoteNaoCadastrado(elemento);
		AtivacaoCampos(elemento,false);
		img.src = img.src.replace('Excluir','Limpar');
		img.alt = 'Limpar Dados do Filhote';
	}
}

function PesquisarCachorroNome(nome)
{
	if (nome.value.length > 0)
	{
		if (Carregado != true)
		{
			var Ultimo = nome.value.indexOf(" ");
		
			if (Ultimo > -1)
			{ 
				var parametro = nome.value;
				var Pagina = 'Cachorro_PesquisarXML.php?Parametro='+parametro+'&Acao=2';
				CarregarXml('IlhaXmlNome',Pagina);
				Carregado = true;
				QtdeCaracteres = parametro.length;
				EscreverCombo('');
			}
		}
		else
		{
			if (nome.value.length > QtdeCaracteres)
			{
				if (Carregado == true)
				{
					PosicionarSelect(nome);
					//ListarCachorros.innerHTML = IlhaXmlNome.transformNode(IlhaXsl.XMLDocument);
					Path = "/ROOT/row[starts-with(@Nome,'"+ nome.value.toUpperCase() +"')]";
					
					try
					{
						TBRetorno = MontarTabela('IlhaXmlNome',Path);
						//ILHA = document.all("IlhaXmlNome").XMLDocument;
						//ILHA.setProperty("SelectionLanguage", "XPath");
						//TBRetorno = new Enumerator(ILHA.documentElement.selectNodes("/ROOT/*[starts-with(@Nome, '" + nome.value + "')]"));
					
						t = "<select id='SelectCachorros' size='5' style='width:350' OnClick=EscolherCachorro('"+ nome.name +"',this.value)>";
						for (i=0;!TBRetorno.atEnd();TBRetorno.moveNext())
						{
							t = t + "<option style='background-color: #F4F4F4' value='"+ LerAtributo(TBRetorno,"Id") +"'>"+ LerAtributo(TBRetorno,"NuSBCPA") +" - "+ LerAtributo(TBRetorno,"Nome") +"</option>";
							i++;
						}
						t = t + "</select>";
						if (i != 0)
						{EscreverCombo(t);}
						else
						{EscreverCombo('')}
					}
					catch(e)
					{
						EscreverCombo('');
					}
				}
			}				
			else
			{
				EscreverCombo('');
				Carregado = false;
			}
		}
	}	
	else
	{
		Carregado = false;
		EscreverCombo('');
	}
}

function PosicionarSelect(nome)
{
	var Num = nome.name.replace("NoCachorro","");
	var n = parseInt(Num);
	n--;
	var dif = n * 26;
	var ajuste = n * 1;
	var npos = dif + ajuste + 465;
	ListarCachorros.style.position = 'absolute';
	ListarCachorros.style.posLeft = 140;
	ListarCachorros.style.posTop = npos;
	//ListarCachorros.style.posTop = 465;
	//ListarCachorros.style.posTop = 490;
	//ListarCachorros.style.posTop = 540;
}

function AtribuirObj(NumFilhote,NumElemento)
{
	ObjMatriz[NumFilhote] = NumFilhote +','+ NumElemento;
}

function PontoVirgulaConsaguinidade(){
	if (event.keyCode == 13){
		document.Formulario.TxConsaguinidade.value = document.Formulario.TxConsaguinidade.value + ";";
	}
	
}
</Script>

</head>

<?
function Combo($nome)
{
	$Texto = '<select name="'. $nome .'">';
	for($i=0; $i<=20; $i++)
	{
		$Texto = $Texto . '<option value="'. $i .'">'. $i .'</option>';
	}
	$Texto = $Texto . '<select>';

	return $Texto;
}


function ComboAno($AnoNinhada)
{
	$Texto = '<select name="NrAnoNinhada">';
	for($i=$AnoNinhada; $i>=1900; $i--)
	{
		$Texto = $Texto . '<option value="'. $i .'">'. $i .'</option>';
	}
	$Texto = $Texto . '<select>';

	return $Texto;
}
?>

<body>
<Xml id="IlhaXml"></Xml>
<Xml id="IlhaXmlConsaguinidade"></Xml>
<Xml id="IlhaXmlNome"></Xml>
<Xml id="IlhaXmlCachorro"></Xml>
<Xml id="IlhaXsl" Src="Cachorro_Formatacao.xsl"></Xml>
<Form name="Formulario" method="post" OnSubmit="return Validar()" action="Ninhada_Processar.php">
<input type="hidden" name="Action" value="<? echo($Action)?>">
<input type="hidden" name="Id" value="<? echo($Id)?>">
  <table>
    <tr> 
      <td><h3>Registro de Ninhadas Nacional</h3></td>
    </tr>
    <tr> 
      <td>	
	  <fieldset id="Dados" style="width: 650">
	  <legend>
	     <table>
        <tr>
          <td>Dados da Ninhada</td>
        </tr>
      </table>
	  </legend>
        <table width="86%" align="center" class="SemBorda">
          <tr> 
            <td width="14%"><div align="right">Ninhada</div></td>
            <td width="13%"><input name="IdNinhada" type="text" value="<?echo($NuNinhada)?>" size="8" maxlength="7" disabled title="O Número da Ninhada é Gerado Automaticamente"></td>
            <td width="2%">/</td>
            <td width="8%">
		<!--input type="text" name="NrAnoNinhada" size="5" maxlength="4" value="<? echo($AnoNinhada)?>" disabled-->
		<?echo(ComboAno($AnoNinhada))?>
		<script>document.Formulario.NrAnoNinhada.value = '<? echo($AnoNinhada)?>';</script>
	</td>
            <td width="12%">&nbsp;</td>
            <td width="31%"><div align="right">Data de Nascimento</div></td>
            <td width="20%"><div align="left">
                <input name="DaNascimento" type="text" value="<?echo($DaNascimento)?>" size="10" maxlength="10" onKeyUp="FormatarData(this)">
              </div></td>
          </tr>
        </table>
        <table align="center" class="SemBorda">
          <tr> 
            <td>Filiada</td>
            <td><?=MontarComboClube()?></td>
			<td>&nbsp;</td>  
			<td>&nbsp;</td>
          </tr>
        </table>
        <table align="center" class="SemBorda">
          <tr> 
            <td>Canil</td>
            <input type="hidden" name="IDCanil" value="<?echo($IdCanil);?>">
            <td><input name="NoCanil" type="text" value="<?echo($NoCanil);?>" size="50" maxlength="50" readonly title="Não digite, escolha o Canil clicando no Botão ao lado"> 
              <a href="javascript: AbrirPopUp('Canil')"><img src="Imagens/Escolher.gif" border="0"></a></td>
			<td>&nbsp;</td>  
			<td>&nbsp;</td>
          </tr>
        </table>
        <table align="center" class="SemBorda">
          <tr> 
            <td width="89">
				<div align="right">N&ordm; de Machos</div></td>
            <td width="51">
				<!--input name="NrMachos" type="text" value="<?echo($NrMachos)?>" size="5" maxlength="2"-->
				<? echo(Combo('NrMachos'));?>
			</td>
            <td width="119">
				<div align="right">N&ordm; de Machos Vivos</div></td>
            <td width="30">
				<!--input name="NrMachosVivos" type="text" value="<?echo($NrMachosVivos)?>" size="5" maxlength="2"-->
				<? echo(Combo('NrMachosVivos'));?>
			</td>
          </tr>
          <tr> 
            <td><div align="right">N&ordm; de F&ecirc;meas</div></td>
            <td>
				<!--input name="NrFemeas" type="text" value="<?echo($NrFemeas)?>" size="5" maxlength="2"-->
				<? echo(Combo('NrFemeas'));?>
			</td>
            <td><div align="right">N&ordm; de F&ecirc;meas Vivas</div></td>
            <td>
				<!--input name="NrFemeasVivas" type="text" value="<?echo($NrFemeasVivas)?>" size="5" maxlength="2"-->
				<? echo(Combo('NrFemeasVivas'));?>
			</td>
          </tr>
        </table>
		
		<? echo($Combos);?>
		
	    </fieldset>
        <br>

	
		<fieldset id="Dados" style="width:650">
	  <legend>
	     <table>
        <tr>
            <td>Dados dos Pais</td>
        </tr>
      </table></legend>
	  
	  
        <table align="center" class="SemBorda">
          <tr> 
            <td>Pai&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <input type="hidden" name="IDPai" value="<? echo($IdCachorroPai);?>">
            <td><input name="NoPai" type="text" size="79" maxlength="50" value="<?echo($NoPai);?>" readonly title="Não digite, escolha o Pai clicando no Botão ao lado"> 
              <a href="javascript: AbrirPopUp('Pai')"><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
          </tr>
        </table>
        <table align="center" class="SemBorda">
          <tr> 
            <td>M&atilde;e&nbsp;&nbsp;</td>
            <input name="IDMae" type="hidden" value="<? echo($IdCachorroMae);?>">
            <td><input name="NoMae" type="text" size="79" maxlength="50" value="<?echo($NoMae)?>" readonly title="Não digite, escolha o Canil clicando no Botão ao lado"> 
              <a href="javascript: AbrirPopUp('Mae')"><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
          </tr>
        </table>
	    <table align="center" class="SemBorda">
          <tr> 
            <td>Consaguinidade &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="javascript:PreencherConsaguinidade()" title="Clique aqui para Gerar a Consaguinidade de Forma Automática">Gerar Consaguinidade</a>)</td>
          </tr>
          <tr> 
            <td><textarea name="TxConsaguinidade" cols="87" rows="3" onKeyPress="PontoVirgulaConsaguinidade()"><? echo($TxConsaguinidade);?></textarea></td>
          </tr>
        </table>

        </fieldset>
    <br>
        <fieldset id="FildsetFilhotes" style="display:znone;">
		<legend> 
	  <table>
        <tr>
            <td>Filhotes da Ninhada</td>
        </tr>
		</table>
		</legend>
		<br>
	<? if ($Id == ""){?>
	<table border="0" class="SemBorda">
	<tr>
		<td>N&ordm; SBCPA</td>
		<td>Nome</td>
		<td>Sexo</td>
		<td>CBKC</td>
		<td>Tatuagem</td>
		<td>Cor</td>
		<td></td>
	</tr>
	<tr>
		<td><input type="hidden" name="Id1"><input type="text" name="NrSBCPA1" size="8" OnFocus="EscreverCombo('')" onBlur="Novo(this);"></td>
		<td><input type="text" name="NoCachorro1" onKeyUp="PesquisarCachorroNome(this)" size="49"></td>
		<td><select name="TPSexo1" OnFocus="EscreverCombo('')">
				<option></option>
				<option value="M">M</option>
				<option value="F">F</option>
			   </select></td>
		<td><input type="text" name="NrCBKC1" size="8" OnFocus="EscreverCombo('')"></td>
		<td><input type="text" name="NoTatuagem1" size="8" OnFocus="EscreverCombo('')"></td>
		<td><? echo(str_replace("IdCor","IdCor1",MontarCombo("Cor",50)));?></td>
		<td><img src="Imagens/Limpar.gif" border="0" onClick="RetirarFilhoteNaoCadastrado(1)" style="cursor: hand" alt="Limpar Dados do Filhote"></td>
	</tr>
	</table>
	<script>
		var t = (document.Formulario.elements.length);
		var I = parseInt(t);
		I = I - 7;
		AtribuirObj(1,I);
	</script>
	<Span id="FilhotesCampoSpan"></Span>
	<? } else{
		echo(EscreverFilhotesDaNinhada($Id));
		echo("	<Span id=FilhotesCampoSpan></Span>");
	}?>

		<br><br>
		<!--br>	
		&nbsp;&nbsp;<iframe name="IframeNinhada" src="" width="480" height="100" scrolling="auto" frameborder="0"></iframe-->
        </fieldset>
		</td>
    </tr>
    <tr> 
      <td> <div align="center"><br>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <!--input type="button" value="Limpar Dados" onClick="ValidarQtdeFilhotes()"-->
        </div></td>
    </tr>
  </table>
	<? if ($Id != ""){?>
	<? echo("<script>AcrescentarNovo();</script>");?>
	<? }?>
</Form>
<div id="ListarCachorros"></div>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Ninhada">
</form>
<? echo($ScriptRodape);?>
</body>
</html>

